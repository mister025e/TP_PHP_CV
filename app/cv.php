<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Check if there's a success message after saving a CV
$success = isset($_GET['success']) ? $_GET['success'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Your CV</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Create Your CV</h1>
        
        <?php if ($success): ?>
            <p style="color:green;">CV saved successfully!</p>
        <?php endif; ?>

        <form action="save_cv.php" method="POST" enctype="multipart/form-data">
            <!-- Personal Information Section -->
            <h2>Personal Information</h2>
            <label for="cv_name">CV Name:</label>
            <input type="text" name="cv_name" id="cv_name" required>

            <label for="full_name">Full Name:</label>
            <input type="text" name="full_name" id="full_name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" required>

            <!-- Profile Image Section -->
            <h2>Profile Picture</h2>
            <label for="profile_image">Upload Profile Picture:</label>
            <input type="file" name="profile_image" id="profile_image" accept="image/*">

            <!-- CV Summary -->
            <h2>CV Title and Description</h2>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>

            <label for="description">Professional Summary:</label>
            <textarea name="description" id="description" rows="4" required></textarea>

            <!-- Skills Section (up to 3) -->
            <h2>Skills</h2>
            <label for="skill_title">Skill 1 - Title:</label>
            <input type="text" name="skills[0][title]" id="skill_title" required>

            <label for="skill_desc">Skill 1 - Description:</label>
            <textarea name="skills[0][description]" id="skill_desc" rows="2"></textarea>

            <label for="years_of_experience">Skill 1 - Years of Experience:</label>
            <input type="number" name="skills[0][years_of_experience]" id="years_of_experience" min="0" required>

            <!-- Add more skills similarly if needed -->

            <!-- External Work Experience -->
            <h2>External Work Experience</h2>
            <label for="experience_title">Experience 1 - Title:</label>
            <input type="text" name="experiences[0][title]" id="experience_title" required>

            <label for="experience_start">Experience 1 - Start Date:</label>
            <input type="date" name="experiences[0][start_date]" id="experience_start" required>

            <label for="experience_end">Experience 1 - End Date:</label>
            <input type="date" name="experiences[0][end_date]" id="experience_end">

            <!-- External Education -->
            <h2>External Education</h2>
            <label for="education_school">Education 1 - School Name:</label>
            <input type="text" name="educations[0][school]" id="education_school" required>

            <label for="education_start">Education 1 - Start Date:</labe>
            <input type="date" name="educations[0][start_date]" id="education_start" required>

            <label for="education_end">Education 1 - End Date:</label>
            <input type="date" name="educations[0][end_date]" id="education_end">

            <!-- Submit and Save CV -->
            <input type="submit" value="Save CV">
        </form>

        <!-- Button to View Saved CVs -->
        <form action="cv_list.php" method="get">
            <input type="submit" value="View Saved CVs">
        </form>
    </div>
</body>
</html>