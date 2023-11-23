<?php
session_start(); // Start the session

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['id_num'])) {
    header('Location: ../ulogin.php'); // Replace 'login.php' with the actual login page
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>View Books</title>
    <style>
        header {
            background: #333;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            padding: 10px;
            z-index: 1000;
        }

        body {
            margin: 0;
            background-color: #e5eaf5;
        }

        .container {
            max-width: 2000px;
            margin: 40px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 230px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 30px;
            height: 300px;
            background-color: #fff;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-size: 20px;
            height: 30px;
        }

        th {
            background-color: #845bb3;
        }

        .dashboard-buttons button.aviewbook {
            background-color: #845bb3;
        }

        /* Style for the status buttons */
        .status-btn {
            cursor: pointer;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .status-btn-available {
            background-color: #4CAF50;
            color: #fff;
        }

        .status-btn-not-available {
            background-color: #FF5733;
            color: #fff;
        }

        .borrow-btn {
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
        }
        .borrowed-btn {
            background-color: #e74c3c; /* Red color for borrowed status */
        }
        .pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination a {
    padding: 10px;
    margin: 0 5px;
    text-decoration: none;
    background-color: #ddd;
    color: #333;
    border-radius: 4px;
    cursor: pointer;
}

.pagination a:hover {
    background-color: #845bb3;
    color: #fff;
}

.pagination .active {
    background-color: #3498db;
    color: #fff;
}
    </style>
</head>

<body>
    <header>
        <?php include 'udash.php'; ?>
    </header>
    <div class="container">
        <?php
        include '../connection.php';

        // Pagination logic
        $booksPerPage = 12;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $booksPerPage;

        // Fetch data from the database with pagination
        $result = $conn->query("SELECT * FROM book WHERE status = 'Available' LIMIT $booksPerPage OFFSET $offset");

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Title</th><th>Author</th><th>Publication Date</th><th>Genre</th><th>Edition</th><th>Action</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['BookID']}</td>";
                echo "<td>{$row['Title']}</td>";
                echo "<td>{$row['Author']}</td>";
                echo "<td>{$row['PublicationDate']}</td>";
                echo "<td>{$row['Genre']}</td>";
                echo "<td>{$row['Edition']}</td>";
                echo "<td><button id='borrowButton_{$row['BookID']}' class='borrow-btn' onclick='borrowBook({$row['BookID']})'>Borrow</button></td>";
                echo "</tr>";
            }

            echo "</table>";

            // Display pagination links
            $totalBooks = $conn->query("SELECT COUNT(*) as total FROM book WHERE status = 'Available'")->fetch_assoc()['total'];
            $totalPages = ceil($totalBooks / $booksPerPage);

            echo "<div class='pagination'>";
            
            // Previous button
            if ($page > 1) {
                echo "<a href='?page=" . ($page - 1) . "'>&laquo; Previous</a>";
            }

            // Page numbers
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<a href='?page=$i' " . ($i == $page ? "class='active'" : "") . ">$i</a>";
            }

            // Next button
            if ($page < $totalPages) {
                echo "<a href='?page=" . ($page + 1) . "'>Next &raquo;</a>";
            }

            echo "</div>";
        } else {
            echo "No books found.";
        }

        $conn->close();
        ?>
    </div>

    <script>
        function borrowBook(bookId) {
            // Add your logic here to handle the borrowing action

            // Make an AJAX request to insert data into BorrowedBooks table
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);

                    // Update the button content and style
                    var borrowButton = document.getElementById('borrowButton_' + bookId);
                    borrowButton.innerHTML = 'Borrowed';
                    borrowButton.classList.add('borrowed-btn');
                    borrowButton.disabled = true; // Optional: Disable the button after borrowing
                }
            };
            xhttp.open("POST", "borrow_book.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("bookId=" + bookId);
        }
    </script>
</body>

</html>
