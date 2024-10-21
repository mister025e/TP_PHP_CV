<?php
session_start();
require 'db.php';

// Fetch all projects from the database
$stmt = $pdo->query('SELECT * FROM projects ORDER BY created_at DESC');
$projects = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Projects</title>
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
      <h1 class="text-center text-4xl font-bold tracking-tight text-white">All Projects</h1>

      <?php if (count($projects) === 0): ?>
          <p class="text-white text-center">No projects available at the moment.</p>
      <?php else: ?>
          <ul class="mt-8 text-white">
              <?php foreach ($projects as $project): ?>
                  <li class="mb-4">
                      <a class="text-indigo-300 hover:text-indigo-500" href="view_project.php?id=<?php echo $project['id']; ?>">
                          <?php echo htmlspecialchars($project['title']); ?>
                      </a>
                  </li>
              <?php endforeach; ?>
          </ul>
      <?php endif; ?>

      <h2 class="text-xl text-white mt-6">Add a New Project</h2>
      <form action="add_project.php" method="GET">
          <input type="submit" value="Go to Add Project" class="mt-4 bg-indigo-600 text-white font-bold py-2 px-4 rounded">
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