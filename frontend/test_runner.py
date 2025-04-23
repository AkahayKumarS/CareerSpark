import pickle
import numpy as np

# Load trained model and label encoder
with open("careerlast.pkl", "rb") as model_file:
    model = pickle.load(model_file)

with open("label_encoder.pkl", "rb") as label_file:
    le = pickle.load(label_file)

# Skills in order based on dataset
skills = [
    "C Programming", "C++", "Java", "Python", "JavaScript", "HTML/CSS", "React.js", "Node.js", "Django", "Flask",
    "SQL", "MongoDB", "Git", "DevOps", "AWS", "Docker", "Kubernetes", "Android Development", "Flutter", "Machine Learning",
    "Deep Learning", "Data Structures", "Algorithms", "Cybersecurity", "Blockchain", "Cloud Computing", "AR/VR",
    "Computer Vision", "NLP"
]

# Rating mapping
rating_map = {
    "Not Interested": 0,
    "Poor": 1,
    "Beginner": 2,
    "Average": 3,
    "Intermediate": 4,
    "Excellent": 5,
    "Professional": 6
}

# Helper to convert form-style input dict to numeric array
def convert_input(skill_dict):
    return np.array([rating_map[skill_dict[skill]] for skill in skills]).reshape(1, -1)

# Test cases: expected_role -> skill ratings
test_cases = {
    "Frontend Developer": {
        "C Programming":"Not Interested", 
    "C++": "Poor",
    "Java": "Beginner",
    "Python": "Not Interested",
    "JavaScript": "Professional", 
    "HTML/CSS":  "Excellent",
    "React.js": "Intermediate",
    "Node.js": "Intermediate",
    "Django": "Poor",
    "Flask": "Not Interested",
    "SQL": "Poor",
    "MongoDB": "Poor",
    "Git": "Average",
    "DevOps": "Poor",
    "AWS": "Not Interested",
    "Docker": "Not Interested",
    "Kubernetes": "Not Interested",
    "Android Development": "Poor",
    "Flutter": "Poor",
    "Machine Learning": "Poor",
    "Deep Learning": "Not Interested",
    "Data Structures": "Intermediate",
    "Algorithms": "Intermediate",
    "Cybersecurity": "Poor",
    "Blockchain": "Not Interested", 
    "Cloud Computing": "Poor",
    "AR/VR": "Not Interested", 
    "Computer Vision": "Not Interested", 
    "NLP": "Poor"    
    },
    "Backend Developer": {
        "C Programming": "Average", "C++": "Intermediate", "Java": "Intermediate", "Python": "Excellent", "JavaScript": "Beginner",
        "HTML/CSS": "Beginner", "React.js": "Beginner", "Node.js": "Professional", "Django": "Professional", "Flask": "Professional",
        "SQL": "Excellent", "MongoDB": "Excellent", "Git": "Intermediate", "DevOps": "Average", "AWS": "Average", "Docker": "Intermediate",
        "Kubernetes": "Average", "Android Development": "Not Interested", "Flutter": "Not Interested", "Machine Learning": "Poor",
        "Deep Learning": "Poor", "Data Structures": "Intermediate", "Algorithms": "Intermediate", "Cybersecurity": "Average",
        "Blockchain": "Poor", "Cloud Computing": "Average", "AR/VR": "Not Interested", "Computer Vision": "Not Interested", "NLP": "Poor"
    },
    "Full Stack Developer": {
        "C Programming": "Beginner", "C++": "Beginner", "Java": "Intermediate", "Python": "Excellent", "JavaScript": "Excellent",
        "HTML/CSS": "Professional", "React.js": "Professional", "Node.js": "Professional", "Django": "Professional", "Flask": "Excellent", "SQL": "Professional", "MongoDB": "Professional", "Git": "Intermediate", "DevOps": "Intermediate", "AWS": "Average", "Docker": "Intermediate", "Kubernetes": "Average", "Android Development": "Beginner", "Flutter": "Poor", "Machine Learning": "Beginner", "Deep Learning": "Poor", "Data Structures": "Intermediate", "Algorithms": "Intermediate", "Cybersecurity": "Poor",
        "Blockchain": "Poor", "Cloud Computing": "Average", "AR/VR": "Poor", "Computer Vision": "Poor", "NLP": "Poor"
    },
    "Mobile App Developer": {
        "C Programming": "Beginner", "C++": "Beginner", "Java": "Excellent", "Python": "Average", "JavaScript": "Average",
        "HTML/CSS": "Intermediate", "React.js": "Intermediate", "Node.js": "Beginner", "Django": "Poor", "Flask": "Poor",
        "SQL": "Intermediate", "MongoDB": "Average", "Git": "Excellent", "DevOps": "Poor", "AWS": "Poor", "Docker": "Poor",
        "Kubernetes": "Poor", "Android Development": "Professional", "Flutter": "Professional", "Machine Learning": "Poor",
        "Deep Learning": "Poor", "Data Structures": "Intermediate", "Algorithms": "Intermediate", "Cybersecurity": "Poor",
        "Blockchain": "Poor", "Cloud Computing": "Poor", "AR/VR": "Poor", "Computer Vision": "Poor", "NLP": "Poor"
    },
    "AI/ML Engineer": {
        "C Programming": "Beginner", "C++": "Average", "Java": "Intermediate", "Python": "Professional", "JavaScript": "Poor",
        "HTML/CSS": "Poor", "React.js": "Poor", "Node.js": "Poor", "Django": "Intermediate", "Flask": "Intermediate",
        "SQL": "Intermediate", "MongoDB": "Average", "Git": "Average", "DevOps": "Poor", "AWS": "Average", "Docker": "Poor",
        "Kubernetes": "Poor", "Android Development": "Not Interested", "Flutter": "Not Interested", "Machine Learning": "Professional",
        "Deep Learning": "Professional", "Data Structures": "Excellent", "Algorithms": "Excellent", "Cybersecurity": "Poor",
        "Blockchain": "Poor", "Cloud Computing": "Average", "AR/VR": "Not Interested", "Computer Vision": "Intermediate", "NLP": "Intermediate"
    },
    "Cybersecurity Analyst": {
        "C Programming": "Average", "C++": "Intermediate", "Java": "Intermediate", "Python": "Intermediate", "JavaScript": "Poor",
        "HTML/CSS": "Poor", "React.js": "Poor", "Node.js": "Poor", "Django": "Poor", "Flask": "Poor",
        "SQL": "Intermediate", "MongoDB": "Average", "Git": "Intermediate", "DevOps": "Poor", "AWS": "Average", "Docker": "Average",
        "Kubernetes": "Average", "Android Development": "Poor", "Flutter": "Poor", "Machine Learning": "Poor",
        "Deep Learning": "Poor", "Data Structures": "Intermediate", "Algorithms": "Intermediate", "Cybersecurity": "Professional",
        "Blockchain": "Intermediate", "Cloud Computing": "Average", "AR/VR": "Poor", "Computer Vision": "Poor", "NLP": "Poor"
    },
    "Blockchain Developer": {
        "C Programming": "Beginner", "C++": "Average", "Java": "Intermediate", "Python": "Intermediate", "JavaScript": "Beginner",
        "HTML/CSS": "Beginner", "React.js": "Poor", "Node.js": "Poor", "Django": "Poor", "Flask": "Poor",
        "SQL": "Average", "MongoDB": "Average", "Git": "Intermediate", "DevOps": "Poor", "AWS": "Poor", "Docker": "Poor",
        "Kubernetes": "Poor", "Android Development": "Poor", "Flutter": "Poor", "Machine Learning": "Poor",
        "Deep Learning": "Poor", "Data Structures": "Intermediate", "Algorithms": "Intermediate", "Cybersecurity": "Intermediate",
        "Blockchain": "Professional", "Cloud Computing": "Average", "AR/VR": "Poor", "Computer Vision": "Poor", "NLP": "Poor"
    },
    "Cloud Architect": {
        "C Programming": "Poor", "C++": "Poor", "Java": "Intermediate", "Python": "Intermediate", "JavaScript": "Beginner",
        "HTML/CSS": "Beginner", "React.js": "Beginner", "Node.js": "Beginner", "Django": "Poor", "Flask": "Poor",
        "SQL": "Average", "MongoDB": "Average", "Git": "Intermediate", "DevOps": "Excellent", "AWS": "Professional", "Docker": "Excellent",
        "Kubernetes": "Excellent", "Android Development": "Poor", "Flutter": "Poor", "Machine Learning": "Poor",
        "Deep Learning": "Poor", "Data Structures": "Intermediate", "Algorithms": "Intermediate", "Cybersecurity": "Intermediate",
        "Blockchain": "Poor", "Cloud Computing": "Professional", "AR/VR": "Poor", "Computer Vision": "Poor", "NLP": "Poor"
    },
    "AR/VR Developer": {
        "C Programming": "Beginner", "C++": "Excellent", "Java": "Intermediate", "Python": "Average", "JavaScript": "Poor",
        "HTML/CSS": "Poor", "React.js": "Poor", "Node.js": "Poor", "Django": "Poor", "Flask": "Poor",
        "SQL": "Poor", "MongoDB": "Poor", "Git": "Intermediate", "DevOps": "Poor", "AWS": "Poor", "Docker": "Poor",
        "Kubernetes": "Poor", "Android Development": "Average", "Flutter": "Average", "Machine Learning": "Poor",
        "Deep Learning": "Poor", "Data Structures": "Average", "Algorithms": "Average", "Cybersecurity": "Poor",
        "Blockchain": "Poor", "Cloud Computing": "Poor", "AR/VR": "Professional", "Computer Vision": "Average", "NLP": "Poor"
    },
    "Computer Vision Engineer": {
        "C Programming": "Average", "C++": "Intermediate", "Java": "Intermediate", "Python": "Excellent", "JavaScript": "Poor",
        "HTML/CSS": "Poor", "React.js": "Poor", "Node.js": "Poor", "Django": "Intermediate", "Flask": "Intermediate",
        "SQL": "Intermediate", "MongoDB": "Intermediate", "Git": "Intermediate", "DevOps": "Poor", "AWS": "Poor", "Docker": "Poor",
        "Kubernetes": "Poor", "Android Development": "Poor", "Flutter": "Poor", "Machine Learning": "Professional",
        "Deep Learning": "Professional", "Data Structures": "Excellent", "Algorithms": "Excellent", "Cybersecurity": "Poor",
        "Blockchain": "Poor", "Cloud Computing": "Average", "AR/VR": "Poor", "Computer Vision": "Professional", "NLP": "Intermediate"
    },
    "NLP Engineer": {
        "C Programming": "Poor", "C++": "Poor", "Java": "Poor", "Python": "Excellent", "JavaScript": "Poor",
        "HTML/CSS": "Poor", "React.js": "Poor", "Node.js": "Poor", "Django": "Intermediate", "Flask": "Intermediate",
        "SQL": "Average", "MongoDB": "Average", "Git": "Intermediate", "DevOps": "Poor", "AWS": "Average", "Docker": "Poor",
        "Kubernetes": "Poor", "Android Development": "Poor", "Flutter": "Poor", "Machine Learning": "Professional",
        "Deep Learning": "Intermediate", "Data Structures": "Excellent", "Algorithms": "Excellent", "Cybersecurity": "Poor",
        "Blockchain": "Poor", "Cloud Computing": "Average", "AR/VR": "Poor", "Computer Vision": "Intermediate", "NLP": "Professional"
    }
}

# Run test cases
print("🎯 Running Test Cases:")
for expected_role, skill_dict in test_cases.items():
    input_data = convert_input(skill_dict)
    predicted = model.predict(input_data)[0]
    predicted_role = le.inverse_transform([predicted])[0]
    result = "✅" if predicted_role == expected_role else "❌"
    print(f"{result} Expected: {expected_role} | Predicted: {predicted_role}")
