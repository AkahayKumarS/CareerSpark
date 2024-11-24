-- Create the CareerSpark Database
CREATE DATABASE IF NOT EXISTS careerspark;

-- Use the database
USE careerspark;

-- Create 'users' table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_type ENUM('student', 'admin') DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create 'profiles' table
CREATE TABLE profiles (
    profile_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    academic_info TEXT NOT NULL,
    interests TEXT,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Create 'recommendations' table
CREATE TABLE recommendations (
    recommendation_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    career_path VARCHAR(255) NOT NULL,
    confidence_score FLOAT,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Create 'resources' table
CREATE TABLE resources (
    resource_id INT AUTO_INCREMENT PRIMARY KEY,
    recommendation_id INT NOT NULL,
    resource_name VARCHAR(255) NOT NULL,
    resource_link VARCHAR(500) NOT NULL,
    FOREIGN KEY (recommendation_id) REFERENCES recommendations(recommendation_id) ON DELETE CASCADE
);

-- Create 'skills' table
CREATE TABLE skills (
    skill_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    skill_name VARCHAR(100) NOT NULL,
    skill_level ENUM('beginner', 'intermediate', 'advanced') DEFAULT 'beginner',
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Sample data insertion for testing purposes (optional)
-- Uncomment below if you want some initial data.

-- INSERT INTO users (name, email, password, user_type) 
-- VALUES ('John Doe', 'john@example.com', 'password123', 'student');

-- INSERT INTO profiles (user_id, academic_info, interests) 
-- VALUES (1, 'B.Tech CSE, 8.5 CGPA', 'Machine Learning, Web Development');

-- INSERT INTO recommendations (user_id, career_path, confidence_score) 
-- VALUES (1, 'Data Scientist', 85.5);

-- INSERT INTO resources (recommendation_id, resource_name, resource_link) 
-- VALUES (1, 'Data Science Bootcamp', 'https://example.com/ds-bootcamp');

-- INSERT INTO skills (user_id, skill_name, skill_level) 
-- VALUES (1, 'Python', 'advanced');
