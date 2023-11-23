<?php
include'../connection.php';
if($_SERVER['REQUEST_METHOD'] == 'POST') {
// Get the form data
$student_id = $_POST['studentid']; 
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Validate student ID uniqueness 
$sql = "SELECT id_num FROM student_acc WHERE id_num='$student_id'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){
  echo "<script>
  alert('Account already exist!');
  window.location.href = ''; 
</script>";
  exit();
}

// Check if passwords match
if($password != $confirm_password){
    echo "<script>
    alert('Password did not match!');
    window.location.href = ''; 
  </script>";
  exit(); 
}

// Insert data into database
$sql = "INSERT INTO student_acc (id_num, password) VALUES ('$student_id', '$password')";

if(mysqli_query($conn, $sql)){
    echo "<script>
    alert('Account created successfully!');
    window.location.href = '../ulogin.php'; 
  </script>";
} else {
  echo "Error: " . mysqli_error($conn);
}

 
 }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form {
  width: 300px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
}

label, input {
  display: block;
  margin-bottom: 10px; 
}

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
}

input[type="submit"] {
  width: 100%;
  background: #333;
  color: #fff;
  padding: 10px;
  border: 0;  
  transition: background-color 0.3s; 
}
input[type="submit"]:hover {
  background-color: #444;
  transform: scale(1.1); /* grow button */
  box-shadow: 2px 2px 10px rgba(0,0,0,0.3);
  background: linear-gradient(to bottom, #555, #333);
}
nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: #333;
  color: #fff;
  padding: 20px;
}

nav ul {
  display: flex;
  list-style-type: none;
}

nav ul li a {
  color: #fff;
  text-decoration: none;
  padding: 10px 15px;
}

.menu-toggle {
  display: none;
}

/* Responsive */
@media screen and (max-width: 768px) {

  .menu-toggle {
    display: block;
    cursor: pointer;
  }

  nav ul {
    display: none;
  }

}
.logo img {
  height: 70px;
  width: auto;
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
.overview {
  width: 400px;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 20px;

  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%); 
  background: #f2f2f2; 
  box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
}
    </style>
</head>
<body>
    <header><nav>
<div class="logo">
  <img src="../img/slsunew.png" alt="Logo"> 
</div>
<h1>L I B R A R Y - - | - - M A N A G E M E N T</h1><H1></H1>
  <ul>
    <li><a href="../ulogin.php">LOGIN AS STUDENT</a></li>
    <li><a href="../alogin.php">LOGIN AS ADMIN</a></li> 
  
  </ul>

  <div class="menu-toggle">
    <i class="fas fa-bars"></i>
  </div>
</nav>
</header>
<h1>Student Registration</h1>
<div>
<form class="overview" method="POST" action="">

  <h2>Register Student Account</h2>

  <label for="studentid">Student ID:</label>
  <input type="text" id="studentid" name="studentid">

  <label for="password">Password:</label>
  <input type="password" id="password" name="password">

  <label for="confirm_password">Confirm Password:</label>    
  <input type="password" id="confirm_password" name="confirm_password">

  <input type="submit" value="Register">

</form>
</div>
</body>
</html>