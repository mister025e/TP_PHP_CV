<?php
session_start(); // Start the session to access session variables
require 'db.php'; // Include the database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit;
}

// Get the POST data from the submitted form
$userId = $_SESSION['user_id'];
$cvName = $_POST['cv_name'];
$fullName = $_POST['full_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$title = $_POST['title'];
$description = $_POST['description'];

// Convert skills, experiences, and educations arrays to JSON format
$skills = json_encode($_POST['skills']);
$experiences = json_encode($_POST['experiences']);
$educations = json_encode($_POST['educations']);

// Handle file upload for profile image
$profileImagePath = null;
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
    $targetDir = "uploads/"; // Directory to store uploaded files
    $targetFile = $targetDir . basename($_FILES['profile_image']['name']);
    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFile)) {
        $profileImagePath = $targetFile; // Save the path of the uploaded file
    } else {
        echo "Sorry, there was an error uploading your file."; // Error handling for file upload
    }
}

// Prepare the SQL statement to insert the CV data into the database
$stmt = $pdo->prepare('INSERT INTO cvs (user_id, cv_name, full_name, email, phone, title, description, skills, experiences, educations, profile_image) 
    VALUES (:user_id, :cv_name, :full_name, :email, :phone, :title, :description, :skills, :experiences, :educations, :profile_image)');
$stmt->execute([ // Execute the prepared statement with the provided data
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