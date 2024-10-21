<?php
session_start();
require 'db.php';

if (!isset($_GET['id'])) {
    echo 'No project ID provided.';
    exit;
}

$projectId = $_GET['id'];

// Fetch the project from the database
$stmt = $pdo->prepare('SELECT * FROM projects WHERE id = :id');
$stmt->execute(['id' => $projectId]);
$project = $stmt->fetch();

if (!$project) {
    echo 'Project not found.';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Project - <?php echo htmlspecialchars($project['title']); ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($project['title']); ?></h1>
        
        <h2>Description</h2>
        <p><?php echo nl2br(htmlspecialchars($project['description'])); ?></p>

        <h2>Image</h2>
        <?php if ($project['image']): ?>
            <img src="<?php echo htmlspecialchars($project['image']); ?>" alt="Project Image" width="400">
        <?php endif; ?>

        <h2>Created At</h2>
        <p><?php echo htmlspecialchars($project['created_at']); ?></p>

        <a href="projects.php">Back to Projects</a>
    </div>
</body>
</html>