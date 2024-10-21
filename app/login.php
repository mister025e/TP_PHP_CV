<?php
session_start();
require 'db.php';

$error = ''; // Initialize error variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Fetch user by email
    $user = getUserByEmail($pdo, $email);
    
    // Validate user credentials
    if ($user && verifyPassword($password, $user['password'])) {
        // Set session variables upon successful login
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['rank'] = $user['rank'];
        
        header("Location: profile.php");
        exit;
    } else {
        $error = "Invalid email or password."; // Set error message for login failure
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="output.css">
</head>
<body>
<div class="bg-blue-950">
  <header class="absolute bg-gray-800 text-white text-sm inset-x-0">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1">
        <a href="index.php" class="-m-1.5 p-1.5 z-50">
          <img class="h-8 w-auto" src="https://static.vitrine.ynov.com/build/images/formation/logo-y-informatique--desktop.png" alt="">
        </a>
      </div>
    </nav>
  </header>

  <div class="relative isolate px-6 pt-14 lg:px-8">
    <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
      <h1 class="text-center text-4xl font-bold tracking-tight text-white">Login</h1>

      <?php if ($error): ?>
        <p style="color: red;" class="text-center"><?php echo htmlspecialchars($error); ?></p> <!-- Prevent XSS -->
      <?php endif; ?>

      <form method="POST" action="login.php" class="mt-8">
        <div class="mb-4">
          <label for="email" class="block text-white">Email:</label>
          <input type="email" name="email" required class="w-full px-4 py-2 text-black">
        </div>

        <div class="mb-4">
          <label for="password" class="block text-white">Password:</label>
          <input type="password" name="password" required class="w-full px-4 py-2 text-black">
        </div>

        <div class="flex justify-center">
          <button type="submit" class="bg-indigo-600 text-white font-bold py-2 px-4 rounded">Login</button>
        </div>
      </form>
    </div>
  </div>

  <footer>
    <div class="px-6 py-12 bg-gray-800 text-white text-sm inset-x-0 text-center">
      <p>&copy; 2022 Your Company. All rights reserved.</p>
    </div>
  </footer>
</div>
</body>
</html>