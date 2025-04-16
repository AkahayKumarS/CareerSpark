from flask import Flask, render_template, request, session, redirect, url_for, jsonify
import pickle
import numpy as np
import mysql.connector
from datetime import timedelta, date
import os
from dotenv import load_dotenv
import google.generativeai as genai
from flask_cors import CORS

 
load_dotenv()  # Load environment variables from .env file
app = Flask(__name__)
CORS(app, supports_credentials=True)

app.secret_key = os.getenv('FLASK_SECRET_KEY', 'fallback-secret-key')

# Load the Gemini API key from .env file
genai.configure(api_key=os.getenv("GEMINI_API_KEY"))

# models = genai.list_models()
# for model in models:
#     print(model.name)

# Database connection function
def get_db_connection():
    return mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="careerspark"
    )

# Fetch job roles and required skills from the database
def fetch_job_roles():
    connection = get_db_connection()
    cursor = connection.cursor(dictionary=True)
    cursor.execute("SELECT job_role, required_skills FROM job_roles")
    job_roles = cursor.fetchall()
    connection.close()
    return job_roles

# Fetch student's technical skills from the database
def fetch_student_skills(user_id):
    connection = get_db_connection()
    cursor = connection.cursor(dictionary=True)
    cursor.execute("SELECT technical_skills FROM student_profiles WHERE user_id = %s", (user_id,))
    result = cursor.fetchone()
    connection.close()
    return result['technical_skills'].split(", ") if result and result['technical_skills'] else []


def fetch_student_profile_info(user_id):
    connection = get_db_connection()
    cursor = connection.cursor(dictionary=True)
    
    try:
        query = """
                SELECT u.name, sp.bio, sp.college, sp.highest_qualification, sp.hobbies
                FROM users u
                JOIN student_profiles sp ON u.id = sp.user_id
                WHERE sp.user_id = %s"""
        
        cursor.execute(query, (user_id,))
        result = cursor.fetchone()
        return result if result else {}
    finally:
        cursor.close()
        connection.close()


# Fetch courses for a specific skill
def fetch_course_for_skill(skill):
    connection = get_db_connection()
    cursor = connection.cursor(dictionary=True) 
    cursor.execute("SELECT title, course_link, duration FROM courses WHERE title LIKE %s", (f"%{skill}%",))
    courses = cursor.fetchall()
    connection.close()
    return courses

# Generate the roadmap
def generate_roadmap(missing_skills, courses):
    roadmap = []
    start_date = date.today()

    for skill in missing_skills:
        skill_courses = courses.get(skill, [])
        total_duration = sum(course.get('duration', 0) for course in skill_courses)
        if skill_courses and total_duration > 0:
            end_date = start_date + timedelta(weeks=total_duration)
            roadmap.append({
                "skill": skill,
                "courses": skill_courses,
                "start_date": start_date.strftime('%Y-%m-%d'),
                "end_date": end_date.strftime('%Y-%m-%d'),
            })
            start_date = end_date
        else:
            roadmap.append({
                "skill": skill,
                "courses": [],
                "start_date": start_date.strftime('%Y-%m-%d'),
                "end_date": "No courses available",
            })

    return roadmap

@app.route('/')
def career():
    return render_template("hometest.html")

@app.route('/predict', methods=['POST','GET'])
def prediction():
    user_id = request.cookies.get('user_id')

    if not user_id:
        return "User not logged in. Please log in to access this feature.", 401
    
    if request.method == 'POST':
        # Process form data
        result = request.form
        user_ratings = np.array([float(value) for value in  result.values()]).reshape(1, -1)

        loaded_model = pickle.load(open("careerlast.pkl", 'rb'))
        predictions = loaded_model.predict(user_ratings)

        best_matched_job_role = predictions[0]

        pred_proba = loaded_model.predict_proba(user_ratings)

        jobs_dict = {0:'AI ML Specialist',
                1:'API Integration Specialist',
                2:'Application Support Engineer',
                3:'Business Analyst',
                4:'Customer Service Executive',
                5:'Cyber Security Specialist',
                6:'Data Scientist',
                7:'Database Administrator',
                8:'Graphics Designer',
                9:'Hardware Engineer',
                10:'Helpdesk Engineer',
                11:'Information Security Specialist',
                12:'Networking Engineer',
                13:'Project Manager',
                14:'Software Developer',
                15:'Software Tester',
                16:'Technical Writer'}
    
        threshold = 0.05
        alternative_careers = [
        (index, prob)
        for index, prob in enumerate(pred_proba[0])
        if prob > threshold and index != np.argmax(pred_proba[0])
        ]
        alternative_careers = sorted(alternative_careers,   key=lambda x: -x[1])
        alternative_career_roles = [
        jobs_dict[career[0]] for career in alternative_careers
        ]

        job_roles = fetch_job_roles()
        best_matched_job = next((job for job in job_roles if    job['job_role'] == best_matched_job_role), None)

        if not best_matched_job:
            return f"Job role '{best_matched_job_role}' not     found in the database.", 500

        required_skills = best_matched_job['required_skills'].  split(", ")
        user_skills = fetch_student_skills(user_id)

        matched_skills = [skill for skill in required_skills    if skill in user_skills]
        missing_skills = [skill for skill in required_skills    if skill not in matched_skills]

        courses_for_missing_skills = {}
        for skill in missing_skills:
            courses = fetch_course_for_skill(skill)
            if courses:
                courses_for_missing_skills[skill] = courses

        roadmap = generate_roadmap(missing_skills,  courses_for_missing_skills)

        # Store results in session
        session['best_career'] = best_matched_job_role
        session['alternative_careers'] =    alternative_career_roles
        session['matched_skills'] = matched_skills
        session['missing_skills'] = missing_skills
        session['courses'] = courses_for_missing_skills
        session['roadmap'] = roadmap

        conn = get_db_connection()  # Establish DB connection
        cursor = conn.cursor()

        # SQL query to fetch job ID for the best-matched career role (job0)
        query = "SELECT id FROM job_roles WHERE job_role = %s"
        cursor.execute(query, (best_matched_job_role,))  # Pass job0 as parameter

        # Fetch the job ID
        job_id = cursor.fetchone()[0]  # Assuming job_role is   unique and only one ID is fetched

        # Check if user already has a record
        cursor.execute("SELECT career_suggested FROM recommendations WHERE user_id = %s", (user_id,))
        existing = cursor.fetchone()

        if existing:
            session['previous_career'] = existing[0]
            cursor.execute(
                "UPDATE recommendations SET career_suggested = %s, prediction_date = NOW() WHERE user_id = %s",
                (best_matched_job_role, user_id))
        else:
            session['previous_career'] = None  # No previous suggestion
            cursor.execute(
                "INSERT INTO recommendations (user_id, career_suggested) VALUES (%s, %s)", (user_id, best_matched_job_role))
        
        conn.commit()
        cursor.close()
        conn.close()
        session['job_id'] = job_id

        # Redirect to GET route
        return redirect(url_for('result_page'))

@app.route('/result', methods=['GET'])
def result_page():
    # Retrieve data from session
    job0 = session.get('best_career')
    job_id = session.get('job_id')
    alternative_careers = session.get('alternative_careers')
    matched_skills = session.get('matched_skills')
    missing_skills = session.get('missing_skills')
    courses = session.get('courses')
    roadmap = session.get('roadmap')
    previous_career = session.get('previous_career')

    return render_template(
        "testafter.html",
        job0=job0,
        job_id=job_id,
        alternative_careers=alternative_careers,
        matched_skills=matched_skills,
        missing_skills=missing_skills,
        courses=courses,
        roadmap=roadmap,
        previous_career=previous_career
    )

@app.route('/career_roadmap')
def career_roadmap():
    job_role = session.get('best_career')
    roadmap = session.get('roadmap', [])

    return render_template(
        'career_roadmap.html',
        roadmap=roadmap,
        job_role=job_role
    )


@app.route("/chat", methods=["POST"])
def chat():
    data = request.get_json()
    user_input = data.get("message", "").strip()

    if not user_input:
        return jsonify({"reply": "Please enter a valid question."})

    user_id = request.cookies.get("user_id")
    if not user_id:
        return jsonify({"reply": "User not logged in."})

    # Fetch student skills
    student_skills = fetch_student_skills(user_id)

    # Fetch additional profile info
    profile_info = fetch_student_profile_info(user_id)
    name = profile_info.get("name", "Not Provided")
    bio = profile_info.get("bio", "Not Provided")
    college = profile_info.get("college", "Not Provided")
    qualification = profile_info.get("highest_qualification", "Not Provided")
    hobbies = profile_info.get("hobbies", "Not Provided")


    # Keywords indicating profile-based or career-related queries
    profile_keywords = ["name", "my profile", "bio", "who am i", "about me", "myself", "college", "qualification","hobbies"]

    career_keywords = ["career", "job", "skills", "resume", "future", "goal", "path", "guidance", "work",
                    "opportunity", "interview", "field", "domain", "profession", "recommend", "suggest"]

    # Lowercase user input for comparison
    user_input_lower = user_input.lower()

    is_profile_query = any(keyword in user_input_lower for keyword in profile_keywords)
    is_career_query = any(keyword in user_input_lower for keyword in career_keywords)

    # Build prompt accordingly
    if is_profile_query or is_career_query:
        prompt = f"""You are CareerBot, an intelligent assistant for students. Below is the student's profile:

        - Name: {name}
        - Bio: {bio}
        - College: {college}
        - Qualification: {qualification}
        - Hobbies: {hobbies}
        - Technical Skills: {', '.join(student_skills)}

        Now answer the question clearly and helpfully: "{user_input}" """
    else:
        prompt = f"""You are CareerBot, a helpful student chatbot. Answer this message in a friendly and concise way: "{user_input}" """

    try:
        model = genai.GenerativeModel(model_name="models/gemini-1.5-pro-latest")
        response = model.generate_content(prompt)
        return jsonify({"reply": response.text})
    except Exception as e:
        return jsonify({"reply": f"Error: {str(e)}"})


if __name__ == '__main__':
    app.run(debug=True)
