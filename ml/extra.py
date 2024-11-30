from flask import Flask, render_template, request
import pickle
import numpy as np

app = Flask(__name__)

# Home page for user input
@app.route('/')
def career():
    return render_template("hometest.html")

# Prediction endpoint
@app.route('/predict', methods=['POST', 'GET'])
def result():
    if request.method == 'POST':
        # Collecting user inputs
        form_data = request.form.to_dict()
        input_values = list(map(float, form_data.values()))
        input_array = np.array(input_values).reshape(1, -1)
        
        # Load the trained model
        loaded_model = pickle.load(open("careerlast.pkl", 'rb'))
        prediction = loaded_model.predict(input_array)
        
        # Get prediction probabilities
        prediction_proba = loaded_model.predict_proba(input_array)
        
        # Process results
        job_roles = {
            0: 'AI ML Specialist', 1: 'API Integration Specialist', 2: 'Application Support Engineer',
            3: 'Business Analyst', 4: 'Customer Service Executive', 5: 'Cyber Security Specialist',
            6: 'Data Scientist', 7: 'Database Administrator', 8: 'Graphics Designer',
            9: 'Hardware Engineer', 10: 'Helpdesk Engineer', 11: 'Information Security Specialist',
            12: 'Networking Engineer', 13: 'Project Manager', 14: 'Software Developer',
            15: 'Software Tester', 16: 'Technical Writer'
        }
        predicted_job = job_roles.get(prediction[0], "Unknown Role")
        
        return render_template("testafter.html", predicted_job=predicted_job, prediction_proba=prediction_proba)

if __name__ == '__main__':
    app.run(debug=True)
