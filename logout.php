<?php
session_start(); // Start the session

// Check if the user is already logged in
if (!isset($_SESSION['username'])) {
  // Redirect to the login page or any other appropriate action
  header("Location: login.php");
  exit();
}

// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or any other appropriate action
header("Location: login.php");
exit();
?>
