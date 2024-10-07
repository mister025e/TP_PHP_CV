<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Curriculum Vitae</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
        // Personal information variables
        $name = "John Doe";
        $title = "Web Developer | Programmer | Tech Enthusiast";
        $email = "johndoe@example.com";
        $phone = "(123) 456-7890";
        $profileDescription = "I am a passionate web developer with experience in creating dynamic websites and applications. Skilled in HTML, CSS, JavaScript, and backend technologies like Node.js. Looking forward to contributing my skills to a dynamic team.";
    ?>

    <div class="container">
        <!-- Header Section -->
        <header>
            <h1><?php echo $name; ?></h1>
            <p><?php echo $title; ?></p>
            <p>Email: <?php echo $email; ?> | Phone: <?php echo $phone; ?></p>
        </header>

        <!-- Profile Section -->
        <section class="profile">
            <h2>Profile</h2>
            <p><?php echo $profileDescription; ?></p>
        </section>

        <!-- Experience Section -->
        <section class="experience">
            <h2>Work Experience</h2>
            <div class="job">
                <h3>Senior Web Developer</h3>
                <p>ABC Company | 2019 - Present</p>
                <ul>
                    <li>Lead the development team for designing responsive websites and applications.</li>
                    <li>Optimized web performance, resulting in a 20% faster load time.</li>
                    <li>Mentored junior developers on modern JavaScript frameworks.</li>
                </ul>
            </div>

            <div class="job">
                <h3>Junior Web Developer</h3>
                <p>XYZ Solutions | 2016 - 2019</p>
                <ul>
                    <li>Assisted in building client websites using HTML, CSS, and JavaScript.</li>
                    <li>Collaborated with designers to implement UI/UX designs.</li>
                    <li>Maintained and updated existing websites for clients.</li>
                </ul>
            </div>
        </section>

        <!-- Education Section -->
        <section class="education">
            <h2>Education</h2>
            <p><strong>Bachelor of Science in Computer Science</strong> | University of Technology | 2012 - 2016</p>
        </section>

        <!-- Skills Section -->
        <section class="skills">
            <h2>Skills</h2>
            <ul>
                <li>HTML, CSS, JavaScript</li>
                <li>Node.js, Express.js</li>
                <li>React, Angular</li>
                <li>SQL, MongoDB</li>
                <li>Git, GitHub</li>
            </ul>
        </section>

        <!-- Projects Section -->
        <section class="projects">
            <h2>Projects</h2>
            <ul>
                <li><strong>Portfolio Website:</strong> A personal website showcasing my work and skills.</li>
                <li><strong>Task Manager App:</strong> A full-stack web application for managing tasks and deadlines.</li>
            </ul>
        </section>

        <!-- Footer Section -->
        <footer>
            <p>© 2024 <?php echo $name; ?> | Connect with me on <a href="#">LinkedIn</a> or <a href="#">GitHub</a></p>
        </footer>
    </div>
</body>
</html>
