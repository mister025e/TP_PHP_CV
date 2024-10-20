<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Prepare user information
$name = $_SESSION['first_name'] . " " . $_SESSION['last_name'];
$email = $_SESSION['email'];
$profileDescription = "This is the profile of " . $_SESSION['first_name'];

// Set default values if no first or last name is provided
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
    <title><?php echo htmlspecialchars($name); ?>'s Profile</title> <!-- Use htmlspecialchars to prevent XSS -->
    <link rel="stylesheet" href="output.css"> <!-- Ensure correct path -->
</head>
<body>
<div class="bg-blue-950">
  <header class="absolute bg-gray-800 text-white text-sm inset-x-0">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1">
        <a href="index.php" class="-m-1.5 p-1.5 z-50">
          <span class="sr-only">Your Company</span>
          <img class="h-8 w-auto" src="https://static.vitrine.ynov.com/build/images/formation/logo-y-informatique--desktop.png" alt="">
        </a>
      </div>
    </nav>
  </header>

  <div class="relative isolate px-6 pt-14 lg:px-8">
    <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
      <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
    <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
      <header class="text-left">
          <h1 class="text-4xl font-bold tracking-tight text-white"><?php echo htmlspecialchars($name); ?></h1>
          <p class="text-white">Email: <?php echo htmlspecialchars($email); ?></p>
      </header>

      <section class="profile mt-8">
          <h2 class="text-xl text-white mt-6">Profile</h2>
          <p class="text-white"><?php echo htmlspecialchars($profileDescription); ?></p>
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