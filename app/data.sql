-- Create database
--CREATE DATABASE cv_db;

-- Use the database
--USE cv_db;

-- Create table users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    password VARCHAR(255) NOT NULL,
    rank ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create table for saved CVs
CREATE TABLE IF NOT EXISTS cvs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    cv_name VARCHAR(100) NOT NULL,
    full_name VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(50),
    summary TEXT,
    job_title VARCHAR(255),
    company VARCHAR(255),
    job_start DATE,
    job_end DATE,
    responsibilities TEXT,
    degree VARCHAR(255),
    institution VARCHAR(255),
    education_start DATE,
    education_end DATE,
    skills TEXT,
    project_title VARCHAR(255),
    project_desc TEXT,
    language_1 VARCHAR(100),
    language_2 VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);