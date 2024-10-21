<?php
session_start();
require 'db.php';

if (!isset($_GET['id'])) {
    echo 'No CV ID provided.';
    exit;
}

$cvId = $_GET['id'];

// Fetch the CV from the database
$stmt = $pdo->prepare('SELECT * FROM cvs WHERE id = :id');
$stmt->execute(['id' => $cvId]);
$cv = $stmt->fetch();

if (!$cv) {
    echo 'CV not found.';
    exit;
}

// Decode the JSON fields
$skills = json_decode($cv['skills'], true);
$experiences = json_decode($cv['experiences'], true);
$educations = json_decode($cv['educations'], true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View CV - <?php echo htmlspecialchars($cv['cv_name']); ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($cv['cv_name']); ?></h1>

        <h2>Personal Information</h2>
        <p>Full Name: <?php echo htmlspecialchars($cv['full_name']); ?></p>
        <p>Email: <?php echo htmlspecialchars($cv['email']); ?></p>
        <p>Phone: <?php echo htmlspecialchars($cv['phone']); ?></p>

        <h2>Profile Picture</h2>
        <?php if ($cv['profile_image']): ?>
            <img src="<?php echo htmlspecialchars($cv['profile_image']); ?>" alt="Profile Picture" style="max-width: 200px;">
        <?php else: ?>
            <p>No profile picture uploaded.</p>
        <?php endif; ?>


        <h2>CV Title & Description</h2>
        <p>Title: <?php echo htmlspecialchars($cv['title']); ?></p>
        <p>Description: <?php echo htmlspecialchars($cv['description']); ?></p>

        <h2>Skills</h2>
        <?php foreach ($skills as $skill): ?>
            <p>Skill: <?php echo htmlspecialchars($skill['title']); ?></p>
            <p>Description: <?php echo htmlspecialchars($skill['description']); ?></p>
            <p>Years of Experience: <?php echo htmlspecialchars($skill['years_of_experience']); ?></p>
        <?php endforeach; ?>

        <h2>Work Experience</h2>
        <?php foreach ($experiences as $experience): ?>
            <p>Title: <?php echo htmlspecialchars($experience['title']); ?></p>
            <p>Start Date: <?php echo htmlspecialchars($experience['start_date']); ?></p>
            <p>End Date: <?php echo htmlspecialchars($experience['end_date']); ?></p>
        <?php endforeach; ?>

        <h2>Education</h2>
        <?php foreach ($educations as $education): ?>
            <p>School: <?php echo htmlspecialchars($education['school']); ?></p>
            <p>Start Date: <?php echo htmlspecialchars($education['start_date']); ?></p>
            <p>End Date: <?php echo htmlspecialchars($education['end_date']); ?></p>
        <?php endforeach; ?>
    </div>
</body>
</html>