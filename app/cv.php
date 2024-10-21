<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Check if there's a success message after saving a CV
$success = isset($_GET['success']) ? $_GET['success'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Your CV</title>
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
    <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
      <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
    <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
      <h1 class="text-center text-4xl font-bold tracking-tight text-white">Create Your CV</h1>
      
      <?php if ($success): ?>
          <p style="color:green;" class="text-center">CV saved successfully!</p>
      <?php endif; ?>

      <form action="save_cv.php" method="POST" enctype="multipart/form-data">
          <h2 class="text-xl text-white mt-6">Personal Information</h2>
          <label for="cv_name" class="text-white">CV Name:</label>
          <input type="text" name="cv_name" id="cv_name" required class="mt-1 block w-full rounded-md border border-gray-300 p-2">
          
          <label for="full_name" class="text-white">Full Name:</label>
          <input type="text" name="full_name" id="full_name" required class="mt-1 block w-full rounded-md border border-gray-300 p-2">
          
          <label for="email" class="text-white">Email:</label>
          <input type="email" name="email" id="email" required class="mt-1 block w-full rounded-md border border-gray-300 p-2">
          
          <label for="phone" class="text-white">Phone:</label>
          <input type="text" name="phone" id="phone" required class="mt-1 block w-full rounded-md border border-gray-300 p-2">

          <h2 class="text-xl text-white mt-6">Profile Picture</h2>
          <label for="profile_image" class="text-white">Upload Profile Picture:</label>
          <input type="file" name="profile_image" id="profile_image" accept="image/*" class="mt-1 block w-full rounded-md border border-gray-300 p-2">

          <h2 class="text-xl text-white mt-6">CV Title and Description</h2>
          <label for="title" class="text-white">Title:</label>
          <input type="text" name="title" id="title" required class="mt-1 block w-full rounded-md border border-gray-300 p-2">

          <label for="description" class="text-white">Professional Summary:</label>
          <textarea name="description" id="description" rows="4" required class="mt-1 block w-full rounded-md border border-gray-300 p-2"></textarea>

          <h2 class="text-xl text-white mt-6">Skills</h2>
          <label for="skill_title" class="text-white">Skill 1 - Title:</label>
          <input type="text" name="skills[0][title]" id="skill_title" required class="mt-1 block w-full rounded-md border border-gray-300 p-2">

          <label for="skill_desc" class="text-white">Skill 1 - Description:</label>
          <textarea name="skills[0][description]" id="skill_desc" rows="2" class="mt-1 block w-full rounded-md border border-gray-300 p-2"></textarea>

          <label for="years_of_experience" class="text-white">Skill 1 - Years of Experience:</label>
          <input type="number" name="skills[0][years_of_experience]" id="years_of_experience" min="0" required class="mt-1 block w-full rounded-md border border-gray-300 p-2">

          <h2 class="text-xl text-white mt-6">External Work Experience</h2>
          <label for="experience_title" class="text-white">Experience 1 - Title:</label>
          <input type="text" name="experiences[0][title]" id="experience_title" required class="mt-1 block w-full rounded-md border border-gray-300 p-2">

          <label for="experience_start" class="text-white">Experience 1 - Start Date:</label>
          <input type="date" name="experiences[0][start_date]" id="experience_start" required class="mt-1 block w-full rounded-md border border-gray-300 p-2">

          <label for="experience_end" class="text-white">Experience 1 - End Date:</label>
          <input type="date" name="experiences[0][end_date]" id="experience_end" class="mt-1 block w-full rounded-md border border-gray-300 p-2">

          <h2 class="text-xl text-white mt-6">External Education</h2>
          <label for="education_school" class="text-white">Education 1 - School Name:</label>
          <input type="text" name="educations[0][school]" id="education_school" required class="mt-1 block w-full rounded-md border border-gray-300 p-2">

          <label for="education_start" class="text-white">Education 1 - Start Date:</label>
          <input type="date" name="educations[0][start_date]" id="education_start" required class="mt-1 block w-full rounded-md border border-gray-300 p-2">

          <label for="education_end" class="text-white">Education 1 - End Date:</label>
          <input type="date" name="educations[0][end_date]" id="education_end" class="mt-1 block w-full rounded-md border border-gray-300 p-2">

          <input type="submit" value="Save CV" class="mt-4 bg-indigo-600 text-white font-bold py-2 px-4 rounded">
      </form>

      <form action="cv_list.php" method="get" class="mt-4">
          <input type="submit" value="View Saved CVs" class="bg-indigo-600 text-white font-bold py-2 px-4 rounded">
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