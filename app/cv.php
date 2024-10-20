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

        <form action="save_cv.php" method="POST">
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

            <!-- Professional Summary Section -->
            <h2>Professional Summary</h2>
            <label for="summary">Summary:</label>
            <textarea name="summary" id="summary" rows="4" required></textarea>

            <!-- Work Experience Section -->
            <h2>Work Experience</h2>
            <label for="job_title">Job Title:</label>
            <input type="text" name="job_title" id="job_title" required>

            <label for="company">Company Name:</label>
            <input type="text" name="company" id="company" required>

            <label for="job_start">Start Date:</label>
            <input type="date" name="job_start" id="job_start" required>

            <label for="job_end">End Date:</label>
            <input type="date" name="job_end" id="job_end">

            <label for="responsibilities">Key Responsibilities:</label>
            <textarea name="responsibilities" id="responsibilities" rows="3"></textarea>

            <!-- Education Section -->
            <h2>Education</h2>
            <label for="degree">Degree Title:</label>
            <input type="text" name="degree" id="degree" required>

            <label for="institution">Institution Name:</label>
            <input type="text" name="institution" id="institution" required>

            <label for="education_start">Start Date:</label>
            <input type="date" name="education_start" id="education_start" required>

            <label for="education_end">End Date:</label>
            <input type="date" name="education_end" id="education_end">

            <!-- Skills Section -->
            <h2>Skills</h2>
            <label for="skills">Skills (up to 3):</label>
            <input type="text" name="skills[]" id="skills_1" required>
            <input type="text" name="skills[]" id="skills_2">
            <input type="text" name="skills[]" id="skills_3">

            <!-- Projects Section -->
            <h2>Projects</h2>
            <label for="project_title">Project Title:</label>
            <input type="text" name="project_title" id="project_title" required>

            <label for="project_desc">Short Description:</label>
            <textarea name="project_desc" id="project_desc" rows="2" required></textarea>

            <!-- Languages Section -->
            <h2>Languages (optional)</h2>
            <label for="language_1">Language 1:</label>
            <input type="text" name="language_1" id="language_1">

            <label for="language_2">Language 2:</label>
            <input type="text" name="language_2" id="language_2">

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