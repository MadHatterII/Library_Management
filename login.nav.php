<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Document</title>
    <style>
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
h1{
font-size: 2rem;
line-height: 1.2;
}
    </style>
      <script>
  
  document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector(".menu-toggle");
    const navList = document.querySelector("nav ul");

    menuToggle.addEventListener("click", function () {
      navList.classList.toggle("show");
    });
  });
</script>
</head>
<body>
<nav>
<div class="logo">
  <img src="img/slsunew.png" alt="Logo"> 
</div>
<h1>L I B R A R Y - - | - - M A N A G E M E N T</h1><H1></H1>
  <ul>
    <li><a href="ulogin.php">LOGIN AS STUDENT</a></li>
    <li><a href="alogin.php">LOGIN AS ADMIN</a></li> 
  
  </ul>

  <div class="menu-toggle">
    <i class="fas fa-bars"></i>
  </div>
</nav>
</body>
</html>