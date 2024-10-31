<?php
session_start();
require '../db/db.php'; // Make sure to include your database connection file

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $cvName = $_POST['cv_name'];
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $skills = json_encode($_POST['skills']); // Assuming skills is an array
    $experiences = json_encode($_POST['experiences']); // Assuming experiences is an array
    $educations = json_encode($_POST['educations']); // Assuming educations is an array
    $profileImagePath = ''; // Placeholder for the profile image path

    // Handle profile image upload if applicable
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_image']['tmp_name'];
        $fileName = $_FILES['profile_image']['name'];
        $fileSize = $_FILES['profile_image']['size'];
        $fileType = $_FILES['profile_image']['type'];

        // Specify the upload directory (make sure this exists and is writable)
        $uploadFileDir = '../uploads/';
        $dest_path = $uploadFileDir . $fileName;

        // Move the file to the specified directory
        if(move_uploaded_file($fileTmpPath, $dest_path)) {
            $profileImagePath = $dest_path;
        } else {
            echo 'Error uploading the image.';
            exit;
        }
    }

    // Determine the user ID and visibility
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $visibility = isset($_POST['visibility']) ? $_POST['visibility'] : 'private';

    // Prepare and execute the insert statement
    try {
        $stmt = $pdo->prepare('
            INSERT INTO cvs (user_id, cv_name, full_name, email, phone, title, description, skills, experiences, educations, profile_image, visibility) 
            VALUES (:user_id, :cv_name, :full_name, :email, :phone, :title, :description, :skills, :experiences, :educations, :profile_image, :visibility)
        ');

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
            'profile_image' => $profileImagePath,
            'visibility' => $visibility,
        ]);

        // Redirect to a success page or the CV listing page
        header('Location: ../cvs/cv_list.php?status=success');
        exit;
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
    }
} else {
    echo 'Invalid request method.';
}
?>