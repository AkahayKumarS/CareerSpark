from flask import Flask, render_template, request
import pickle
import numpy as np
import mysql.connector

app = Flask(__name__)

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
    cursor.execute("SELECT title, course_link FROM courses WHERE title LIKE %s", (f"%{skill}%",))
    courses = cursor.fetchall()
    print("Courses: ", courses)
    connection.close()
    return courses

@app.route('/')
def career():
    return render_template("hometest.html")

@app.route('/predict', methods=['POST', 'GET'])
def result():
    if request.method == 'POST':
        result = request.form
        #print("User Input:", result)

        # Convert user input into a NumPy array
        user_ratings = np.array([float(value) for value in result.values()]).reshape(1, -1)

        # Load the ML model and make predictions
        loaded_model = pickle.load(open("careerlast.pkl", 'rb'))
        predictions = loaded_model.predict(user_ratings)

        # Extract the best-matched career role (string)
        best_matched_job_role = predictions[0]  # Now treated as a string
        print(f"Best Matched Career: {best_matched_job_role}")

        # Fetch job roles and required skills from the database
        job_roles = fetch_job_roles()  # Returns a list of dictionaries with job role info
        best_matched_job = next((job for job in job_roles if job['job_role'] == best_matched_job_role), None)

        if not best_matched_job:
            return f"Job role '{best_matched_job_role}' not found in the database.", 500

        required_skills = best_matched_job['required_skills'].split(", ")

        user_id = request.cookies.get('user_id')

        if not user_id:
        # Handle the case where the user is not logged in
            return "User not logged in. Please log in to access this feature.", 401
        
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

        # Render the testafter.html page with the results
        return render_template(
            "testafter.html",
            job0=best_matched_job_role,
            matched_skills=matched_skills,
            missing_skills=missing_skills,
            courses=courses_for_missing_skills
        )



if __name__ == '__main__':
    app.run(debug=True)
