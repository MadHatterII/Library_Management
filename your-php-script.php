<?php
include 'connection.php';

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT username FROM admin_acc WHERE username='$username' AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        // Start session and redirect to dashboard
        session_start();
        $_SESSION['username'] = $username;
        echo json_encode(['success' => true, 'message' => 'Logged In Successfully']);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
        exit();
    }
}
?>
