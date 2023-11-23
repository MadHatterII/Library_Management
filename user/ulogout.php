<?php
session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION['id_num'])) {
    // If logged in, destroy the session and redirect to the login page
    session_destroy();
    header('Location: ../ulogin.php'); // Replace 'login.php' with the actual login page
    exit();
} else {
    // If not logged in, redirect to the login page
    header('Location: ../ulogin.php'); // Replace 'login.php' with the actual login page
    exit();
}
?>