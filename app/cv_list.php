<?php
session_start(); // Start the session to access session variables
require 'db.php'; // Include the database connection file

// Fetch all CVs for the logged-in user
$stmt = $pdo->prepare('SELECT * FROM cvs WHERE user_id = ?');
$stmt->execute([$_SESSION['user_id']]); // Execute the statement with the user's ID
$cvs = $stmt->fetchAll(); // Fetch all the results as an array
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My CVs</title>
    <link rel="stylesheet" href="output.css"> <!-- Link to the CSS stylesheet -->
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
    <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
      <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
    <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
      <h1 class="text-center text-4xl font-bold tracking-tight text-white">My CVs</h1>

      <?php if (count($cvs) === 0): ?> <!-- Check if there are no CVs saved -->
          <p class="text-white text-center">You have no saved CVs.</p>
      <?php else: ?>
          <ul class="mt-8 text-white">
              <?php foreach ($cvs as $cv): ?> <!-- Loop through each CV and display it -->
                  <li class="mb-4">
                      <a class="text-indigo-300 hover:text-indigo-500" href="view_cv.php?id=<?php echo $cv['id']; ?>">
                          <?php echo htmlspecialchars($cv['cv_name']); ?> <!-- Display the CV name -->
                      </a>
                  </li>
              <?php endforeach; ?>
          </ul>
      <?php endif; ?>
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