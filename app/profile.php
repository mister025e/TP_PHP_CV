<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$name = $_SESSION['first_name'] . " " . $_SESSION['last_name'];
$email = $_SESSION['email'];
$profileDescription = "This is the profile of " . $_SESSION['first_name'];

// If no first or last name, display default values (optional)
if (empty($_SESSION['first_name']) && empty($_SESSION['last_name'])) {
    $name = "John Doe";
    $profileDescription = "No description available.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name; ?>'s Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1><?php echo $name; ?></h1>
            <p>Email: <?php echo $email; ?></p>
        </header>

        <section class="profile">
            <h2>Profile</h2>
            <p><?php echo $profileDescription; ?></p>
        </section>
    </div>
</body>
</html>