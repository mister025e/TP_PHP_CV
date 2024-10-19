<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['first_name'] ?? '';
    $lastName = $_POST['last_name'] ?? '';
    
    // Hash the password
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    
    // Insert into database
    $stmt = $pdo->prepare('INSERT INTO users (email, first_name, last_name, password) VALUES (:email, :first_name, :last_name, :password)');
    $stmt->execute([
        'email' => $email,
        'first_name' => $firstName,
        'last_name' => $lastName,
        'password' => $passwordHash
    ]);
    
    // Redirect to login page
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form method="POST" action="register.php">
            <label for="email">Email:</label>
            <input type="email" name="email" required><br>

            <label for="first_name">First Name:</label>
            <input type="text" name="first_name"><br>

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name"><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required><br>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>