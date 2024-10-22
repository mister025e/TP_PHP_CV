<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $imagePath = null;

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
    
        // Get the file extension
        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        // Check for valid image extensions
        if (in_array($imageExtension, ['jpg', 'jpeg', 'png'])) {
            $imagePath = 'uploads/' . basename($imageName);
            move_uploaded_file($imageTmpPath, $imagePath);
        } else {
            // Handle invalid file type
            echo "Invalid file type. Only JPG and PNG are allowed.";
            exit;
        }
    }

    // Insert into database
    $stmt = $pdo->prepare('INSERT INTO projects (user_id, title, description, image) VALUES (:user_id, :title, :description, :image)');
    $stmt->execute([
        'user_id' => $userId,
        'title' => $title,
        'description' => $description,
        'image' => $imagePath
    ]);

    // Redirect to projects page
    header('Location: projects.php');
    exit;
}

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
    <title>Add Project</title>
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

      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <?php if ($isLoggedIn): ?>
            <span class="text-sm font-semibold leading-6 text-white z-50 mr-4">
                <?php echo $firstName . ' ' . $lastName; ?>&nbsp;&nbsp;&nbsp;&nbsp;
            </span>
            <a href="logout.php" class="text-sm font-semibold leading-6 text-white z-50">Log out</a>
        <?php endif; ?>
      </div>

    </nav>
  </header>

  <div class="relative isolate px-6 pt-14 lg:px-8">
    <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
      <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
    <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
      <h1 class="text-center text-4xl font-bold tracking-tight text-white">Add a New Project</h1>

      <form action="add_project.php" method="POST" enctype="multipart/form-data" class="mt-8">
        <div class="mb-4">
          <label for="title" class="block text-white">Title:</label>
          <input type="text" name="title" required class="w-full px-4 py-2 text-black">
        </div>

        <div class="mb-4">
          <label for="description" class="block text-white">Description:</label>
          <textarea name="description" rows="5" required class="w-full px-4 py-2 text-black"></textarea>
        </div>

        <div class="mb-4">
          <label for="image" class="block text-white">Project Image (optional):</label>
          <input type="file" name="image" class="w-full px-4 py-2 text-white">
        </div>

        <div class="flex justify-center">
          <button type="submit" class="bg-indigo-600 text-white font-bold py-2 px-4 rounded">Add Project</button>
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