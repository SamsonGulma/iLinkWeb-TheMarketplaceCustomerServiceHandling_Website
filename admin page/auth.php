<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to the login page
    header("Location:  /index.html"); // Redirect to your login page
    exit(); // Stop execution of further code
}
?>

