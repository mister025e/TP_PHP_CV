<?php
session_start(); // Start session
session_destroy(); // Destroy all session data
header("Location: index.php"); // Redirect to index page
exit; // Stop further execution
?>