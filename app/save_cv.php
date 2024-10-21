<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Get the POST data
$userId = $_SESSION['user_id'];
$cvName = $_POST['cv_name'];
$fullName = $_POST['full_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$title = $_POST['title'];
$description = $_POST['description'];

// Convert skills, experiences, and educations to JSON
$skills = json_encode($_POST['skills']);
$experiences = json_encode($_POST['experiences']);
$educations = json_encode($_POST['educations']);

// Handle file upload
$profileImagePath = null;
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES['profile_image']['name']);
    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFile)) {
        $profileImagePath = $targetFile;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Prepare the SQL statement
$stmt = $pdo->prepare('INSERT INTO cvs (user_id, cv_name, full_name, email, phone, title, description, skills, experiences, educations, profile_image) 
    VALUES (:user_id, :cv_name, :full_name, :email, :phone, :title, :description, :skills, :experiences, :educations, :profile_image)');
$stmt->execute([
    'user_id' => $userId,
    'cv_name' => $cvName,
    'full_name' => $fullName,
    'email' => $email,
    'phone' => $phone,
    'title' => $title,
    'description' => $description,
    'skills' => $skills,
    'experiences' => $experiences,
    'educations' => $educations,
    'profile_image' => $profileImagePath // Save the profile image path
]);

// Redirect back to the CV page with a success message
header('Location: cv.php?success=true');
exit;
?>