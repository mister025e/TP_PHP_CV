<?php
// Database connection using PDO
$host = 'db';
$db = 'cv_db';
$user = 'root'; // Update this with your MySQL username
$pass = 'root';     // Update this with your MySQL password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

function getUserByEmail($pdo, $email) {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);
    return $stmt->fetch();
}

function verifyPassword($inputPassword, $storedHash) {
    return password_verify($inputPassword, $storedHash);
}
?>