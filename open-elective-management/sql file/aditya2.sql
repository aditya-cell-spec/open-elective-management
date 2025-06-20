-- Create database
CREATE DATABASE IF NOT EXISTS aditya2;
USE aditya2;

-- Student Table
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
);

-- Courses Table
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(100),
    description TEXT
);

-- Student Course Selection
CREATE TABLE student_courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    course_id INT,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

-- Insert sample courses
INSERT INTO courses (course_name, description) VALUES 
('AI & ML', 'Artificial Intelligence and Machine Learning'),
('IoT', 'Internet of Things'),
('Cyber Security', 'Cyber security fundamentals and practices'),
('Cloud Computing', 'Cloud technology and its applications');
