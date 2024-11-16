<?php
session_start();

// Check if the user is logged in by checking if the session variable is set
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit(); // Always call exit() after header to stop further script execution
} else {
    header("Location: dashboard.php");
    exit();
}
?>

