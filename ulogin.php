<?php
 session_start();
include 'connection.php';

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id_num FROM student_acc WHERE id_num='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        // Start session and redirect to dashboard
       

        // Store user information in the session
        $_SESSION['id_num'] = $username;
        $_SESSION['login_success'] = true; // Set a flag for successful login

        // Redirect to the user's home page
        header('Location: user/uhome.php');
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <style>
        form {
            width: 300px;
            margin: 0 auto;
            font-family: Tahoma, Geneva, sans-serif;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        .container {
            padding: 16px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .overview {
            width: 400px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
        }

        header {
            background: #333;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            padding: 0;
        }

        .bottom-link {
            text-align: center;
            margin-top: 20px;
        }

        .bottom-link a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
<header>
    <?php include 'login.nav.php'; ?>
</header>

<form method="POST" action="">
    <div class="overview">
        <h2>Login to Your Student Account</h2>
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" id="password" name="password" required>

        <button type="submit" class="btn btn-success">Login</button>

    </div>
    <div class="bottom-link">
        Don't have an account?
        <a href="user/uregister.php">Register Here</a>
    </div>
</form>

<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
    <script>
        const pswrd = document.getElementById("password");
        const icon = document.querySelector(".icon");

        icon.onclick = function () {
            if (pswrd.type === "password") {
                pswrd.type = "text";
            } else {
                pswrd.type = "password";
            }
        }

        // Trigger SweetAlert based on the login_success session flag
        <?php if (isset($_SESSION['login_success']) && $_SESSION['login_success']): ?>
            Swal.fire({
                icon: 'success',
                title: 'Login Successful!',
                text: 'User logged in successfully'
            });
            <?php unset($_SESSION['login_success']); // Remove the session variable after displaying the alert ?>
        <?php endif; ?>
    </script>
</body>
</html>
