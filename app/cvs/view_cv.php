<?php
session_start(); // Start the session to access session variables
require '../db/db.php'; // Include the database connection file

// Check if the CV ID is provided in the URL
if (!isset($_GET['id'])) {
    echo 'No CV ID provided.'; // Display an error if no ID is found
    exit;
}

$cvId = $_GET['id']; // Get the CV ID from the URL

// Fetch the CV from the database using the provided ID
$stmt = $pdo->prepare('SELECT * FROM cvs WHERE id = :id');
$stmt->execute(['id' => $cvId]); // Execute the statement with the CV ID
$cv = $stmt->fetch(); // Fetch the CV data

// Check if the CV was found
if (!$cv) {
    echo 'CV not found.'; // Display an error if the CV does not exist
    exit;
}

// Decode the JSON fields back to arrays for display
$skills = json_decode($cv['skills'], true);
$experiences = json_decode($cv['experiences'], true);
$educations = json_decode($cv['educations'], true);

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
    <title>View CV - <?php echo htmlspecialchars($cv['cv_name']); ?></title>
    <link rel="stylesheet" href="../styles/output.css">
</head>
<body>
    <div class="bg-blue-950">
        <header class="absolute bg-gray-800 text-white text-sm inset-x-0">
            <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="../general/menu.php" class="-m-1.5 p-1.5 z-50">
                        <img class="h-8 w-auto" src="https://static.vitrine.ynov.com/build/images/formation/logo-y-informatique--desktop.png" alt="Logo">
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
            <div class="mx-auto max-w-4xl py-32 sm:py-48 lg:py-56">
                <h1 class="text-center text-4xl font-bold tracking-tight text-white mb-10">
                    <?php echo htmlspecialchars($cv['cv_name']); ?>
                </h1>

                <h2 class="text-2xl font-semibold text-white">Personal Information</h2>
                <p class="mt-2 text-white">Full Name: <?php echo htmlspecialchars($cv['full_name']); ?></p>
                <p class="text-white">Email: <?php echo htmlspecialchars($cv['email']); ?></p>
                <p class="text-white">Phone: <?php echo htmlspecialchars($cv['phone']); ?></p>

                <h2 class="mt-8 text-2xl font-semibold text-white">Profile Picture</h2>
                <div class="mt-2">
                    <?php if ($cv['profile_image']): ?>
                        <img src="<?php echo htmlspecialchars($cv['profile_image']); ?>" alt="Profile Picture" class="max-w-xs rounded shadow-lg">
                    <?php else: ?>
                        <p class="text-white">No profile picture uploaded.</p>
                    <?php endif; ?>
                </div>

                <h2 class="mt-8 text-2xl font-semibold text-white">CV Title & Description</h2>
                <p class="mt-2 text-white">Title: <?php echo htmlspecialchars($cv['title']); ?></p>
                <p class="text-white">Description: <?php echo htmlspecialchars($cv['description']); ?></p>

                <h2 class="mt-8 text-2xl font-semibold text-white">Skills</h2>
                <?php if ($skills): ?>
                    <ul class="mt-2 text-white list-disc list-inside">
                        <?php foreach ($skills as $skill): ?>
                            <li>
                                <p>Skill: <?php echo htmlspecialchars($skill['title']); ?></p>
                                <p>Description: <?php echo htmlspecialchars($skill['description']); ?></p>
                                <p>Years of Experience: <?php echo htmlspecialchars($skill['years_of_experience']); ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-white">No skills listed.</p>
                <?php endif; ?>

                <h2 class="mt-8 text-2xl font-semibold text-white">Work Experience</h2>
                <?php if ($experiences): ?>
                    <ul class="mt-2 text-white list-disc list-inside">
                        <?php foreach ($experiences as $experience): ?>
                            <li>
                                <p>Title: <?php echo htmlspecialchars($experience['title']); ?></p>
                                <p>Start Date: <?php echo htmlspecialchars($experience['start_date']); ?></p>
                                <p>End Date: <?php echo htmlspecialchars($experience['end_date']); ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-white">No work experience listed.</p>
                <?php endif; ?>

                <h2 class="mt-8 text-2xl font-semibold text-white">Education</h2>
                <?php if ($educations): ?>
                    <ul class="mt-2 text-white list-disc list-inside">
                        <?php foreach ($educations as $education): ?>
                            <li>
                                <p>School: <?php echo htmlspecialchars($education['school']); ?></p>
                                <p>Start Date: <?php echo htmlspecialchars($education['start_date']); ?></p>
                                <p>End Date: <?php echo htmlspecialchars($education['end_date']); ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-white">No education details listed.</p>
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