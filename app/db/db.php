<?php
// Database connection using PDO (PHP Data Objects)

// Define database connection parameters
$host = 'db';        // Hostname of the database server
$db = 'cv_db';       // Name of the database
$user = 'root';      // MySQL username (update as necessary)
$pass = 'root';      // MySQL password (update as necessary)
$charset = 'utf8mb4'; // Character set for the database

// Data Source Name (DSN) string for the PDO connection
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// PDO options for error handling and default fetch mode
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch results as associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Disable emulation of prepared statements
];

// Attempt to connect to the database using PDO
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Handle the connection error by throwing an exception with the error message and code
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Function to get a user from the database by their email
function getUserByEmail($pdo, $email) {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email'); // Prepare SQL query
    $stmt->execute(['email' => $email]);                              // Execute query with bound parameter
    return $stmt->fetch();                                             // Return the fetched user data
}

// Function to verify a hashed password against an input password
function verifyPassword($inputPassword, $storedHash) {
    return password_verify($inputPassword, $storedHash); // Check if the input password matches the stored hash
}
?>