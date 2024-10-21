<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $imagePath = null;

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
    
        // Get the file extension
        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        // Check for valid image extensions
        if (in_array($imageExtension, ['jpg', 'jpeg', 'png'])) {
            $imagePath = 'uploads/' . basename($imageName);
            move_uploaded_file($imageTmpPath, $imagePath);
        } else {
            // Handle invalid file type
            echo "Invalid file type. Only JPG and PNG are allowed.";
            exit;
        }
    }

    // Insert into database
    $stmt = $pdo->prepare('INSERT INTO projects (user_id, title, description, image) VALUES (:user_id, :title, :description, :image)');
    $stmt->execute([
        'user_id' => $userId,
        'title' => $title,
        'description' => $description,
        'image' => $imagePath
    ]);

    // Redirect to projects page
    header('Location: projects.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Add New Project</h1>
        <form action="add_project.php" method="POST" enctype="multipart/form-data">
            <label for="title">Project Title:</label>
            <input type="text" name="title" id="title" required>

            <label for="description">Project Description:</label>
            <textarea name="description" id="description" rows="4" required></textarea>

            <label for="image">Project Image:</label>
            <input type="file" name="image" id="image" accept="image/*">

            <input type="submit" value="Add Project">
        </form>
    </div>
</body>
</html>