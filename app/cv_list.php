<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch all saved CVs for the logged-in user
$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare('SELECT * FROM cvs WHERE user_id = :user_id');
$stmt->execute(['user_id' => $userId]);
$savedCvs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Saved CVs</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Your Saved CVs</h1>
        <?php if (count($savedCvs) === 0): ?>
            <p>You have no saved CVs.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($savedCvs as $cv): ?>
                    <li>
                        <a href="view_cv.php?id=<?php echo urlencode($cv['id']); ?>">
                            <?php echo htmlspecialchars($cv['cv_name']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>
</html>