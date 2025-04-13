from flask import Flask, render_template, request, session
import pickle
import numpy as np
import mysql.connector
from datetime import timedelta, date
import os

app = Flask(__name__)

app.secret_key = os.getenv('FLASK_SECRET_KEY', 'fallback-secret-key')

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
    print("student technical skills: ",result)
    connection.close()
    return result['technical_skills'].split(", ") if result and result['technical_skills'] else []

# Fetch courses for a specific skill
def fetch_course_for_skill(skill):
    connection = get_db_connection()
    cursor = connection.cursor(dictionary=True) 
    # Use LIKE for partial matching within the course title
    cursor.execute("SELECT title, course_link, duration FROM courses WHERE title LIKE %s", (f"%{skill}%",))
    courses = cursor.fetchall()
    print("Courses: ", courses)
    connection.close()
    return courses

# Generate the roadmap
def generate_roadmap(missing_skills, courses):
    roadmap = []
    start_date = date.today()

    for skill in missing_skills:
        skill_courses = courses.get(skill, [])
        total_duration = sum(course.get('duration', 0) for course in skill_courses)  # Ensure duration is fetched correctly
        if skill_courses and total_duration > 0:
            end_date = start_date + timedelta(weeks=total_duration)
            roadmap.append({
                "skill": skill,
                "courses": skill_courses,
                "start_date": start_date.strftime('%Y-%m-%d'),
                "end_date": end_date.strftime('%Y-%m-%d'),
            })
            start_date = end_date  # Update start date for the next phase
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

@app.route('/predict', methods=['POST', 'GET'])
def result():
    user_id = request.cookies.get('user_id')

    if not user_id:
        # Handle the case where the user is not logged in
        return "User not logged in. Please log in to access this feature.", 401
    
    if request.method == 'POST':
        result = request.form
        #print("User Input:", result)

        # Convert user input into a NumPy array
        user_ratings = np.array([float(value) for value in result.values()]).reshape(1, -1)

        # Load the ML model and make predictions
        loaded_model = pickle.load(open("careerlast.pkl", 'rb'))
        predictions = loaded_model.predict(user_ratings)

        print("Predictions:", predictions)

        # Extract the best-matched career role (string)
        best_matched_job_role = predictions[0]
        print(f"Best Matched Career: {best_matched_job_role}")

        # Predict probabilities for all careers
        pred_proba = loaded_model.predict_proba(user_ratings)
        print("Prediction Probabilities:", pred_proba)

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
                

        # Calculate alternative career paths
        threshold = 0.05  # Set a threshold for alternative career paths
        alternative_careers = [
            (index, prob)
            for index, prob in enumerate(pred_proba[0])
            if prob > threshold and index != np.argmax(pred_proba[0])
        ]
        alternative_careers = sorted(alternative_careers, key=lambda x: -x[1])  # Sort by probability
        alternative_career_roles = [
            jobs_dict[career[0]] for career in alternative_careers
        ]

        print("Alternative Career Paths:", alternative_career_roles)

        # Fetch job roles and required skills from the database
        job_roles = fetch_job_roles()  # Returns a list of dictionaries with job role info
        best_matched_job = next((job for job in job_roles if job['job_role'] == best_matched_job_role), None)

        if not best_matched_job:
            return f"Job role '{best_matched_job_role}' not found in the database.", 500

        required_skills = best_matched_job['required_skills'].split(", ")

        user_skills = fetch_student_skills(user_id)

        # Identify matched and missing skills
        matched_skills = [skill for skill in required_skills if skill in user_skills]
        missing_skills = [skill for skill in required_skills if skill not in matched_skills]
        print(f"Matched skills: {matched_skills}")
        print(f"Missing skills: {missing_skills}")

        # Fetch courses for missing skills
        courses_for_missing_skills = {}
        for skill in missing_skills:
            courses = fetch_course_for_skill(skill)
            if courses:
                courses_for_missing_skills[skill] = courses

        # Generate the roadmap
        roadmap = generate_roadmap(missing_skills, courses_for_missing_skills)

        session['best_career'] = best_matched_job_role
        session['roadmap'] = roadmap

        #Querying part of the result() function
        conn = get_db_connection()  # Establish DB connection
        cursor = conn.cursor()

        # SQL query to fetch job ID for the best-matched career role (job0)
        query = "SELECT id FROM knowledge_network WHERE title = %s"
        cursor.execute(query, (best_matched_job_role,))  # Pass job0 as parameter

        # Fetch the job ID
        job_id = cursor.fetchone()[0]  # Assuming job_role is unique and only one ID is fetched

        cursor.close()
        conn.close()


        # Render the testafter.html page with the results
        return render_template(
            "testafter.html",
            job0=best_matched_job_role,
            job_id=job_id,
            alternative_careers=alternative_career_roles,
            matched_skills=matched_skills,
            missing_skills=missing_skills,
            courses=courses_for_missing_skills,
            roadmap=roadmap
        )

@app.route('/career_roadmap')
def career_roadmap():
    # Retrieve the roadmap details sent as query parameters
    job_role = session.get('best_career')
    roadmap = session.get('roadmap', [])

    # Render the career roadmap page with the details
    return render_template(
        'career_roadmap.html',  # Your HTML page name
        roadmap=roadmap,
        job_role=job_role
    )


if __name__ == '__main__':
    app.run(debug=True)
