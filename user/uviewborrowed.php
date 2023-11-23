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
    <title>View Borrowed Books</title>
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
            color: #fff;
        }

        .borrowed-btn {
            background-color: #e74c3c; /* Red color for borrowed status */
            color: #fff;
            cursor: pointer;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
        }

        .returned-btn {
            background-color: #3498db; /* Blue color for returned status */
            color: #fff;
            cursor: pointer;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;;
            transition: background-color 0.3s;
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

    <?php
    include '../connection.php';

    // Get the user's id_num from the session
    $userIdNum = $_SESSION['id_num'];

    // Define the number of records per page
    $recordsPerPage = 11;

    // Determine the current page
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Calculate the starting record for the current page
    $startFrom = ($currentPage - 1) * $recordsPerPage;

    // Fetch data from the BorrowedBooks table and join with the book table with pagination
    $result = $conn->query("
        SELECT BorrowedBooks.BookID, BorrowedBooks.BorrowDate, BorrowedBooks.ReturnDate, book.Title
        FROM BorrowedBooks
        INNER JOIN book ON BorrowedBooks.BookID = book.BookID
        WHERE BorrowedBooks.BorrowerIdNum = '$userIdNum'
        LIMIT $startFrom, $recordsPerPage
    ");

    // Fetch total number of records for pagination
    $totalRecords = $conn->query("
        SELECT COUNT(*) AS total FROM BorrowedBooks WHERE BorrowerIdNum = '$userIdNum'
    ")->fetch_assoc()['total'];

    // Calculate the total number of pages
    $totalPages = ceil($totalRecords / $recordsPerPage);

    // Check if there are borrowed books for the user
    if ($result->num_rows > 0) {
        echo "<div class='container'>";
        echo "<h2>Borrowed Books</h2>";
        echo "<table>";
        echo "<tr><th>Book ID</th><th>Title</th><th>Borrow Date</th><th>Return Date</th><th>Action</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['BookID']}</td>";
            echo "<td>{$row['Title']}</td>";
            echo "<td>{$row['BorrowDate']}</td>";
            echo "<td>{$row['ReturnDate']}</td>";
            
            // Determine the button class based on the return status
            $buttonClass = empty($row['ReturnDate']) ? 'borrowed-btn' : 'returned-btn';
            $buttonText = empty($row['ReturnDate']) ? 'Return' : 'Returned';
            
            echo "<td><button class='{$buttonClass}' onclick='returnBook({$row['BookID']})'>{$buttonText}</button></td>";
            echo "</tr>";
        }

        echo "</table>";

        // Display pagination links
        echo "<div class='pagination'>";
        // Display "Previous" link
        if ($currentPage > 1) {
            echo "<a href='?page=" . ($currentPage - 1) . "'>&laquo; Previous</a>";
        }
        
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='?page=$i' " . ($i == $currentPage ? "class='active'" : "") . ">$i</a>";
        }
        
        // Display "Next" link
        if ($currentPage < $totalPages) {
            echo "<a href='?page=" . ($currentPage + 1) . "'>Next &raquo;</a>";
        }
        
        echo "</div>";
    }

    $conn->close();
    ?>

    <script>
        function returnBook(bookId) {
            // Add your logic here to handle the return action

            // Show a confirmation prompt before performing the return action
            var confirmReturn = confirm("Are you sure you want to return this book?");
            
            if (confirmReturn) {
                // Make an AJAX request to update data in the BorrowedBooks table
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        alert(this.responseText);

                        // Update the button content and style
                        var returnButton = document.querySelector(`[onclick='returnBook(${bookId})']`);
                        returnButton.innerHTML = 'Returned';
                        returnButton.classList.remove('borrowed-btn');
                        returnButton.classList.add('returned-btn');
                        returnButton.disabled = true; // Optional: Disable the button after returning

                        // Reload the page after successful return
                        location.reload();
                    }
                };
                xhttp.open("POST", "return_book.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("bookId=" + bookId);
            }
        }
    </script>
</body>
</html>
