<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
         body {
            font-family: 'Times New Roman', Times, serif;
            /* Add 'serif' as a fallback in case Times New Roman is not available */
        }
    nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #494d5f; /* Adjust the color as needed */
    color: #c5c6c7;
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

        /* Add styling for buttons */
        .dashboard-buttons {
            display: flex;
            gap: 8px; /* Adjust the gap between layers */
            width: 60%; /* Share the same width for both layers */
            justify-content: flex-end; /* Align buttons to the right */
        }

        .button-layer {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 35%; /* Each layer takes 35% width */
        }

        .dashboard-buttons button {
            margin: 5px 0;
            padding: 10px 15px;
            background-color: #d0bdf4;
            color:black;
            border: none;
            cursor: pointer;
            font-family: 'Times New Roman', Times, serif;
            font-size: 1rem;
            width: 100%; /* Make sure all buttons in a layer have the same width */
        }
        .dashboard-buttons button:hover {
            background-color: #845bb3; /* Change background color on hover */
        }
        .dashboard-buttons .logout {
            background-color: #f2949c;
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

     

            .dashboard-buttons button {
                width: 100%;
            }
        }

        .logo img {
            height: 120px;
            width: auto;
        }

        h1 {
            font-size: 2rem;
            line-height: 1.2;
        }
     
    </style>
</head>
<body>
<nav>
    <div class="logo">
        <img src="../img/slsunew.png" alt="Logo">
    </div>
    <h1>L I B R A R Y  - | -  M A N A G E M E N T</h1>
    <div class="menu-toggle">
        <i class="fas fa-bars"></i>
    </div>

    <!-- Replace links with buttons -->
    <div class="dashboard-buttons">
        <!-- First layer of buttons -->
        <div class="button-layer">
            <button class="aviewbook" onclick="location.href='aviewbook.php'">AVAILABLE BOOKS</button>
            <button class="book_holdings" onclick="location.href='abook_holdings.php'">BOOK HOLDINGS</button>
            <button class="borrowedbooks" onclick="location.href='aborrowedbook.php'">BORROWED BOOKS</button>
            <button class="addbook" onclick="location.href='addbook.php'">ADD NEW BOOK</button>
        </div>

        <!-- Second layer of buttons -->
        <div class="button-layer">
            <button class="viewstudents" onclick="location.href='user-dashboard.php'">VIEW STUDENTS</button>
            <button onclick="location.href='admin-dashboard.php'">PENDING REQUEST</button>
            <button onclick="location.href='ahome.php'"></button>
            <button class="logout" onclick="location.href='ulogout.php'">LOG OUT</button>
        </div>
    </div>
</nav>

<!-- ... (your existing content) ... -->

<script>
    // Add JavaScript to toggle the navigation menu on small screens
    document.addEventListener("DOMContentLoaded", function () {
        const menuToggle = document.querySelector(".menu-toggle");
        const navList = document.querySelector("nav ul");

        menuToggle.addEventListener("click", function () {
            navList.classList.toggle("show");
        });
    });
</script>
</body>
</html>
