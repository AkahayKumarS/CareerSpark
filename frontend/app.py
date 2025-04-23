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
    return render_template("hometest.html", zip=zip)

@app.route('/predict', methods=['POST', 'GET'])
def prediction():
    user_id = request.cookies.get('user_id')

    if not user_id:
        return "User not logged in. Please log in to access this feature.", 401

    if request.method == 'POST':
        # Load model and label encoder
        with open("careerlast.pkl", "rb") as f:
            loaded_model = pickle.load(f)
        with open("label_encoder.pkl", "rb") as f:
            le = pickle.load(f)

        result = request.form
        user_ratings = np.array([float(value) for value in result.values()]).reshape(1, -1)

        # predictions = loaded_model.predict(user_ratings)
        # best_matched_job_role = le.inverse_transform(predictions)[0]

        probs = loaded_model.predict_proba(user_ratings)[0]
        top_index = np.argmax(probs)
        top_role = le.inverse_transform([top_index])[0]
        top_prob = probs[top_index]

        print("Top role:", top_role, "Top prob:", top_prob)


        # If model is unsure, handle it
        if top_prob < 0.40:
            return "Prediction not confident enough. Please refine your input."

        # Convert form input to skill names
        form_keys = list(result.keys())

        # Define essential skill dependencies (customize as needed)
        role_keywords = {
            "Blockchain Developer": ["Blockchain"],
            "Frontend Developer": ["HTML/CSS", "JavaScript", "React.js"],
            "Backend Developer": ["Node.js", "SQL", "MongoDB"],
            "Full Stack Developer": ["HTML/CSS", "JavaScript", "React.js", "Node.js", "SQL"],
            "AI/ML Engineer": ["Machine Learning", "Python"],
            "Cybersecurity Analyst": ["Cybersecurity", "DevOps"],
            "Cloud Architect": ["AWS", "Cloud Computing", "DevOps"],
            "AR/VR Developer": ["AR/VR"],
            "Computer Vision Engineer": ["Computer Vision", "Deep Learning"],
            "NLP Engineer": ["NLP"],
            "Mobile App Developer": ["Android Development", "Flutter"]
        }

        # Map skills back to user ratings
        user_input_dict = {skill: float(value) for skill, value in zip(result.keys(), result.values())}

        # Custom logic to filter unrealistic predictions
        def has_critical_flaw(role, user_ratings_dict):
            return any(
                user_ratings_dict.get(skill, 0) <= 1  # Not Interested or Poor
                for skill in role_keywords.get(role, [])
            )

        # Recheck for flaws
        if has_critical_flaw(top_role, user_input_dict):
            # Find next best role that doesn't violate rules
            sorted_probs = sorted(list(enumerate(probs)), key=lambda x: -x[1])
            for idx, prob in sorted_probs[1:]:
                alt_role = le.inverse_transform([idx])[0]
                if not has_critical_flaw(alt_role, user_input_dict):
                    best_matched_job_role = alt_role
                    break
            else:
                best_matched_job_role = top_role  # fallback
        else:
            best_matched_job_role = top_role

        print("Final suggested role after skill check:", best_matched_job_role)
        pred_proba = loaded_model.predict_proba(user_ratings)

        # Show alternatives with probability threshold
        threshold = 0.05
        alternative_careers = [
            (index, prob) for index, prob in enumerate(pred_proba[0])
            if prob > threshold and index != np.argmax(pred_proba[0])
        ]
        alternative_careers = sorted(alternative_careers, key=lambda x: -x[1])
        alternative_career_roles = [le.inverse_transform([career[0]])[0] for career in alternative_careers]

        # Match against job_roles DB
        job_roles = fetch_job_roles()
        best_matched_job = next((job for job in job_roles if job['job_role'] == best_matched_job_role), None)

        if not best_matched_job:
            return f"Job role '{best_matched_job_role}' not found in the database.", 500

        required_skills = best_matched_job['required_skills'].split(", ")
        user_skills = fetch_student_skills(user_id)

        matched_skills = [skill for skill in required_skills if skill in user_skills]
        missing_skills = [skill for skill in required_skills if skill not in matched_skills]

        courses_for_missing_skills = {}
        for skill in missing_skills:
            courses = fetch_course_for_skill(skill)
            if courses:
                courses_for_missing_skills[skill] = courses

        roadmap = generate_roadmap(missing_skills, courses_for_missing_skills)

        # Store in session
        session['best_career'] = best_matched_job_role
        session['alternative_careers'] = alternative_career_roles
        session['matched_skills'] = matched_skills
        session['missing_skills'] = missing_skills
        session['courses'] = courses_for_missing_skills
        session['roadmap'] = roadmap

        # Save to DB
        conn = get_db_connection()
        # Use one cursor to fetch job_id
        cursor1 = conn.cursor()
        cursor1.execute("SELECT id FROM job_roles WHERE job_role = %s", (best_matched_job_role,))
        job_id_result = cursor1.fetchone()
        job_id = job_id_result[0] if job_id_result else None
        cursor1.close()  # ✅ Close cursor1

        # Use a fresh cursor for recommendations check and update
        cursor2 = conn.cursor()
        cursor2.execute("SELECT career_suggested FROM recommendations WHERE user_id = %s", (user_id,))
        existing = cursor2.fetchone()

        if existing:
            session['previous_career'] = existing[0]
            cursor2.execute("UPDATE recommendations SET career_suggested = %s, prediction_date = NOW() WHERE user_id = %s",(best_matched_job_role, user_id))
        else:
            session['previous_career'] = None
            cursor2.execute("INSERT INTO recommendations (user_id, career_suggested) VALUES (%s, %s)", (user_id, best_matched_job_role))

        conn.commit()
        cursor2.close()  # ✅ Close cursor2
        conn.close()

        session['job_id'] = job_id

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
