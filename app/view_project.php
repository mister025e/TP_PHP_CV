<?php
session_start(); // Start the session to access session variables
require 'db.php'; // Include the database connection file

$projectId = $_GET['id'] ?? null; // Get the project ID from the URL or set it to null if not present

if ($projectId) { // Check if a project ID was provided
    $stmt = $pdo->prepare('SELECT * FROM projects WHERE id = :id'); // Prepare a SQL statement to fetch the project by ID
    $stmt->execute(['id' => $projectId]); // Execute the statement with the provided project ID
    $project = $stmt->fetch(); // Fetch the project details from the database
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Project</title>
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
    <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
      <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
    <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
      <h1 class="text-center text-4xl font-bold tracking-tight text-white">Project Details</h1>

      <?php if ($project): ?>
        <div class="mt-8 text-white">
          <h2 class="text-2xl font-semibold"><?php echo htmlspecialchars($project['title']); ?></h2>
          <p class="mt-4"><?php echo htmlspecialchars($project['description']); ?></p>

          <?php if ($project['image']): ?>
            <div class="mt-6">
              <img src="<?php echo htmlspecialchars($project['image']); ?>" alt="Project Image" class="mx-auto max-w-full h-auto">
            </div>
          <?php endif; ?>
        </div>
      <?php else: ?>
        <p class="text-white text-center">Project not found.</p>
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