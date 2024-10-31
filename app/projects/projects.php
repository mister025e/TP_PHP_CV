<?php 
session_start(); // Start the session to access session variables
require '../db/db.php'; // Include the database connection file

// Fetch all projects from the database
$stmt = $pdo->query('SELECT * FROM projects ORDER BY created_at DESC'); // Execute a query to select all projects ordered by creation date
$projects = $stmt->fetchAll(); // Fetch all results as an associative array

$isLoggedIn = isset($_SESSION['user_id']);

$firstName = '';
$lastName = '';

if ($isLoggedIn) {
    $stmt = $pdo->prepare('SELECT first_name, last_name FROM users WHERE id = :id');
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $user = $stmt->fetch();

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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Projects</title>
    <link rel="stylesheet" href="../styles/output.css"> <!-- Link to the stylesheet -->
</head>
<body>
<div class="bg-blue-950">
  <header class="absolute bg-gray-800 text-white text-sm inset-x-0">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1">
        <a href="../general/menu.php" class="-m-1.5 p-1.5 z-50">
          <span class="sr-only">Your Company</span>
          <img class="h-8 w-auto" src="https://static.vitrine.ynov.com/build/images/formation/logo-y-informatique--desktop.png" alt=""> <!-- Logo -->
        </a>
      </div>
      <div class="hidden lg:flex lg:gap-x-12">
        <a href="../general/profile.php" class="text-sm font-semibold leading-6 text-white z-50">PROFILE</a>
        <a href="../cvs/cv.php" class="text-sm font-semibold leading-6 text-white z-50">MY CV</a>
        <a href="../projects/projects.php" class="text-sm font-semibold leading-6 text-white z-50">PROJECTS</a>
      </div>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <?php if ($isLoggedIn): ?>
            <span class="text-sm font-semibold leading-6 text-white z-50 mr-4">
                <?php echo $firstName . ' ' . $lastName; ?>&nbsp;&nbsp;&nbsp;&nbsp;
            </span>
            <a href="../authentication/logout.php" class="text-sm font-semibold leading-6 text-white z-50">Log out</a>
        <?php endif; ?>
      </div>

    </nav>
  </header>

  <div class="relative isolate px-6 pt-14 lg:px-8">
    <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
      <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
    <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
      <h1 class="text-center text-4xl font-bold tracking-tight text-white">All Projects</h1>

      <?php if (count($projects) === 0): // Check if there are no projects ?>
          <p class="text-white text-center">No projects available at the moment.</p>
      <?php else: ?>
          <ul class="mt-8 text-white">
              <?php foreach ($projects as $project): // Loop through each project ?>
                  <li class="mb-4">
                      <a class="text-indigo-300 hover:text-indigo-500" href="../projects/view_project.php?id=<?php echo $project['id']; ?>">
                          <?php echo htmlspecialchars($project['title']); // Display project title ?>
                      </a>
                  </li>
              <?php endforeach; ?>
          </ul>
      <?php endif; ?>

      <h2 class="text-xl text-white mt-6">Add a New Project</h2>
      <form action="../projects/add_project.php" method="GET"> <!-- Form to redirect to add project page -->
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