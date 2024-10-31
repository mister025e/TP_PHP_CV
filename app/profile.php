<?php
session_start();
require 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch user details from the database
$stmt = $pdo->prepare('SELECT first_name, last_name, email, rank, bio, phone FROM users WHERE id = :id');
$stmt->execute(['id' => $_SESSION['user_id']]);
$user = $stmt->fetch();

if ($user) {
    $firstName = htmlspecialchars($user['first_name']);
    $lastName = htmlspecialchars($user['last_name']);
    $email = htmlspecialchars($user['email']);
    $rank = htmlspecialchars($user['rank']);
    $bio = htmlspecialchars($user['bio'] ?? ''); // Default to empty string if bio is null
    $phone = htmlspecialchars($user['phone'] ?? ''); // Default to empty string if phone is null
}

// Update user details if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedFirstName = $_POST['first_name'];
    $updatedLastName = $_POST['last_name'];
    $updatedEmail = $_POST['email'];
    $updatedBio = $_POST['bio'];
    $updatedPhone = $_POST['phone'];

    $stmt = $pdo->prepare('UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email, bio = :bio, phone = :phone WHERE id = :id');
    $stmt->execute([
        'first_name' => $updatedFirstName,
        'last_name' => $updatedLastName,
        'email' => $updatedEmail,
        'bio' => $updatedBio,
        'phone' => $updatedPhone,
        'id' => $_SESSION['user_id']
    ]);

    // Update session variables
    $firstName = htmlspecialchars($updatedFirstName);
    $lastName = htmlspecialchars($updatedLastName);
    $email = htmlspecialchars($updatedEmail);
    $bio = htmlspecialchars($updatedBio);
    $phone = htmlspecialchars($updatedPhone);

    // Redirect to refresh the page and clear POST data
    header("Location: profile.php");
    exit;
}

$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $firstName . ' ' . $lastName; ?>'s Profile</title>
    <link rel="stylesheet" href="output.css">
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
      <header class="text-left">
        <h1 class="text-4xl font-bold tracking-tight text-white"><?php echo $firstName . ' ' . $lastName; ?></h1>
        <p class="text-white">Email: <?php echo $email; ?></p>
        <p class="text-white">Rank: <?php echo $rank; ?></p>
      </header>

      <form method="POST" class="bg-white rounded-lg shadow-md p-8 mt-6">
        <h2 class="text-2xl font-bold tracking-tight text-white">Edit Profile</h2>
        
        <label class="block mb-4">
          <span class="text-white">First Name</span>
          <input type="text" name="first_name" value="<?php echo $firstName; ?>" class="mt-1 block w-full border-gray-300 rounded-md">
        </label>

        <label class="block mb-4">
          <span class="text-white">Last Name</span>
          <input type="text" name="last_name" value="<?php echo $lastName; ?>" class="mt-1 block w-full border-gray-300 rounded-md">
        </label>

        <label class="block mb-4">
          <span class="text-white">Email</span>
          <input type="email" name="email" value="<?php echo $email; ?>" class="mt-1 block w-full border-gray-300 rounded-md">
        </label>

        <label class="block mb-4">
          <span class="text-white">Bio</span>
          <textarea name="bio" class="mt-1 block w-full border-gray-300 rounded-md"><?php echo $bio; ?></textarea>
        </label>

        <label class="block mb-4">
          <span class="text-white">Phone</span>
          <input type="text" name="phone" value="<?php echo $phone; ?>" class="mt-1 block w-full border-gray-300 rounded-md">
        </label>

        <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md mt-4">Save Changes</button>
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