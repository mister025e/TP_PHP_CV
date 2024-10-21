<?php
session_start();
require 'db.php';

// Fetch all projects from the database
$stmt = $pdo->query('SELECT * FROM projects ORDER BY created_at DESC');
$projects = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Projects</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>All Projects</h1>

        <?php if (count($projects) === 0): ?>
            <p>No projects available at the moment.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($projects as $project): ?>
                    <li>
                        <a href="view_project.php?id=<?php echo $project['id']; ?>">
                            <?php echo htmlspecialchars($project['title']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <h2>Add a New Project</h2>
        <form action="add_project.php" method="GET">
            <input type="submit" value="Go to Add Project">
        </form>
    </div>
</body>
</html>