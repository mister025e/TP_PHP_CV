<?php
session_start(); // Start session
session_destroy(); // Destroy all session data
header("Location: ../general/menu.php"); // Redirect to menu page
exit; // Stop further execution
?>