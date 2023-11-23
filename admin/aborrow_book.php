<?php

// Check if the book ID is provided
if (isset($_POST['bookId'])) {
    $bookId = $_POST['bookId'];

    // You should perform additional validation and sanitation of data here

    include '../connection.php';

    // Get the borrower's ID from the session
    $borrowerIdNum = $_SESSION['id_num'];

    // Check if the user has already borrowed the same book without returning
    $existingBorrowQuery = "SELECT * FROM BorrowedBooks WHERE BookID = '$bookId' AND BorrowerIdNum = '$borrowerIdNum' AND ReturnDate IS NULL";

    $existingBorrowResult = $conn->query($existingBorrowQuery);

    if ($existingBorrowResult->num_rows > 0) {
        echo "You have already borrowed this book and it is not returned yet.";
    } else {
        // Get the current date
        $borrowDate = date("Y-m-d");

        // Insert the data into the BorrowedBooks table
        $insertQuery = "INSERT INTO BorrowedBooks (BookID, BorrowerIdNum, BorrowDate) VALUES ('$bookId', '$borrowerIdNum', '$borrowDate')";

        if ($conn->query($insertQuery) === TRUE) {
            echo "Borrow record added successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    $conn->close();
} else {
    echo "Book ID not provided.";
}
?>
