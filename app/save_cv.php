<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $cvName = $_POST['cv_name'] ?? 'Untitled CV';
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $summary = $_POST['summary'];
    $jobTitle = $_POST['job_title'];
    $company = $_POST['company'];
    $jobStart = $_POST['job_start'];
    $jobEnd = $_POST['job_end'];
    $responsibilities = $_POST['responsibilities'];
    $degree = $_POST['degree'];
    $institution = $_POST['institution'];
    $educationStart = $_POST['education_start'];
    $educationEnd = $_POST['education_end'];
    $skills = implode(',', $_POST['skills']);
    $projectTitle = $_POST['project_title'];
    $projectDesc = $_POST['project_desc'];
    $language1 = $_POST['language_1'];
    $language2 = $_POST['language_2'];

    $stmt = $pdo->prepare('INSERT INTO cvs (user_id, cv_name, full_name, email, phone, summary, job_title, company, job_start, job_end, responsibilities, degree, institution, education_start, education_end, skills, project_title, project_desc, language_1, language_2) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    
    $stmt->execute([
        $userId, $cvName, $fullName, $email, $phone, $summary, $jobTitle, $company, $jobStart, $jobEnd, $responsibilities, $degree, $institution, $educationStart, $educationEnd, $skills, $projectTitle, $projectDesc, $language1, $language2
    ]);

    header('Location: cv.php?success=1');
    exit;
}