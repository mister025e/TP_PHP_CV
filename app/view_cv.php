<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id'])) {
    echo 'No CV ID provided.';
    exit;
}

$cvId = $_GET['id'];
$userId = $_SESSION['user_id'];

// Fetch the CV from the database
$stmt = $pdo->prepare('SELECT * FROM cvs WHERE id = :id AND user_id = :user_id');
$stmt->execute(['id' => $cvId, 'user_id' => $userId]);
$cv = $stmt->fetch();

if (!$cv) {
    echo 'CV not found.';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo htmlspecialchars($cv['cv_name']); ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($cv['full_name']); ?></h1>
        <p>Email: <?php echo htmlspecialchars($cv['email']); ?></p>
        <p>Phone: <?php echo htmlspecialchars($cv['phone']); ?></p>

        <!-- Professional Summary -->
        <h2>Professional Summary</h2>
        <p><?php echo htmlspecialchars($cv['summary']); ?></p>

        <!-- Work Experience -->
        <h2>Work Experience</h2>
        <p><?php echo htmlspecialchars($cv['job_title']); ?> at <?php echo htmlspecialchars($cv['company']); ?></p>
        <p><?php echo htmlspecialchars($cv['job_start']); ?> to <?php echo htmlspecialchars($cv['job_end']); ?></p>
        <p><?php echo htmlspecialchars($cv['responsibilities']); ?></p>

        <!-- Education -->
        <h2>Education</h2>
        <p><?php echo htmlspecialchars($cv['degree']); ?> from <?php echo htmlspecialchars($cv['institution']); ?></p>
        <p><?php echo htmlspecialchars($cv['education_start']); ?> to <?php echo htmlspecialchars($cv['education_end']); ?></p>

        <!-- Skills -->
        <h2>Skills</h2>
        <ul>
            <?php 
            $skills = explode(',', $cv['skills']);
            foreach ($skills as $skill) {
                echo '<li>' . htmlspecialchars(trim($skill)) . '</li>';
            }
            ?>
        </ul>

        <!-- Projects -->
        <h2>Projects</h2>
        <p><strong><?php echo htmlspecialchars($cv['project_title']); ?>:</strong> <?php echo htmlspecialchars($cv['project_desc']); ?></p>

        <!-- Languages (if available) -->
        <?php if (!empty($cv['language_1']) || !empty($cv['language_2'])): ?>
            <h2>Languages</h2>
            <p><?php echo htmlspecialchars($cv['language_1']); ?></p>
            <p><?php echo htmlspecialchars($cv['language_2']); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>