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
    <link rel="stylesheet" href="output.css"> <!-- Make sure the link to the stylesheet is correct -->
</head>
<body>
<div class="bg-blue-950">
  <header class="absolute bg-gray-800 text-white text-sm inset-x-0">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1">
        <a href="#" class="-m-1.5 p-1.5">
          <span class="sr-only">Your Company</span>
          <img class="h-8 w-auto" src="https://static.vitrine.ynov.com/build/images/formation/logo-y-informatique--desktop.png" alt="">
        </a>
      </div>
    </nav>
  </header>

  <div class="relative isolate px-6 pt-14 lg:px-8">
    <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
      <header class="text-left">
          <h1 class="text-4xl font-bold tracking-tight text-white"><?php echo $name; ?></h1>
          <p class="text-white">Email: <?php echo $email; ?></p>
      </header>

      <section class="profile mt-8">
          <h2 class="text-xl text-white mt-6">Profile</h2>
          <p class="text-white"><?php echo $profileDescription; ?></p>
      </section>
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