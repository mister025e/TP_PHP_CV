<?php
session_start(); // Start the session to access session variables
require '../db/db.php'; // Include the database connection file

// Check if the user is logged in by checking if 'user_id' exists in the session
$isLoggedIn = isset($_SESSION['user_id']);

// Initialize user name variables
$firstName = '';
$lastName = '';

// If the user is logged in, fetch their first name and last name
if ($isLoggedIn) {
    $stmt = $pdo->prepare('SELECT first_name, last_name FROM users WHERE id = :id');
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $user = $stmt->fetch();
    
    // Store the user's first name and last name
    if ($user) {
        $firstName = htmlspecialchars($user['first_name']);
        $lastName = htmlspecialchars($user['last_name']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum Vitae</title>
    <link rel="stylesheet" href="../styles/output.css"> <!-- Link to the Tailwind CSS file -->
</head>
<body>
<div class="bg-blue-950"> <!-- Main background for the page -->

  <!-- Header Section -->
  <header class="absolute bg-gray-800 text-white text-sm inset-x-0">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
      
      <!-- Logo section -->
      <div class="flex lg:flex-1">
        <a href="../general/index.php" class="-m-1.5 p-1.5 z-50">
          <span class="sr-only">Your Company</span>
          <img class="h-8 w-auto" src="https://static.vitrine.ynov.com/build/images/formation/logo-y-informatique--desktop.png" alt=""> <!-- Placeholder logo -->
        </a>
      </div>

      <!-- Navigation links visible on large screens -->
      <div class="hidden lg:flex lg:gap-x-12">
        <a href="../general/profile.php" class="text-sm font-semibold leading-6 text-white z-50">PROFILE</a>
        <a href="../cvs/cv.php" class="text-sm font-semibold leading-6 text-white z-50">MY CV</a>
        <a href="../projects/projects.php" class="text-sm font-semibold leading-6 text-white z-50">PROJECTS</a>
      </div>

      <!-- Login/Logout buttons and user name based on login status -->
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <?php if ($isLoggedIn): ?>
            <!-- If the user is logged in, display their name and the logout button -->
            <span class="text-sm font-semibold leading-6 text-white z-50 mr-4">
                <?php echo $firstName . ' ' . $lastName; ?>&nbsp;&nbsp;&nbsp;&nbsp;
            </span>
            <a href="../authentication/logout.php" class="text-sm font-semibold leading-6 text-white z-50">Log out</a>
        <?php else: ?>
            <!-- If the user is not logged in, show the register and login buttons -->
            <a href="../authentication/register.php" class="text-sm font-semibold leading-6 text-white z-50 ml-4">Register&nbsp;&nbsp;&nbsp;&nbsp;</a>
            <a href="../authentication/login.php" class="text-sm font-semibold leading-6 text-white z-50">Log in <span aria-hidden="true">&rarr;</span></a>
        <?php endif; ?>
      </div>
    </nav>
  </header>

  <!-- Main content -->
  <div class="relative isolate px-6 pt-14 lg:px-8">
    <!-- Decorative gradient effect for background -->
    <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
      <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
    
    <!-- Main introduction section -->
    <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
      <div class="text-center">
        <h1 class="text-balance text-4xl font-bold tracking-tight text-white sm:text-6xl">Start making your first CV now</h1> <!-- Main heading -->
        
        <!-- Button to navigate to the CV page -->
        <div class="mt-10 flex items-center justify-center gap-x-6">
          <a href="../cvs/cv.php" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get started</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer Section -->
  <footer>
    <div class="px-6 py-12 bg-gray-800 text-white text-sm inset-x-0 text-center">
      <p>&copy; 2022 Your Company. All rights reserved.</p> <!-- Footer copyright -->
    </div>
  </footer>
</div>
</body>
</html>