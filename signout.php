<?php
session_start();

// Remove all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page or any other desired page after logout
header("Location: /film/index.php"); // Replace login.php with the appropriate URL
exit();
?>