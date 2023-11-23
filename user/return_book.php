<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id_num'])) {
    echo "User not logged in.";
    exit();
}

// Check if the book ID is provided
if (isset($_POST['bookId'])) {
    $bookId = $_POST['bookId'];

    // Additional validation and sanitation can be performed here

    include '../connection.php';

    // Get the current date
    $returnDate = date("Y-m-d");

    // Update the ReturnDate in the BorrowedBooks table
    $updateQuery = "UPDATE BorrowedBooks SET ReturnDate = '$returnDate' WHERE BookID = '$bookId'";
    
    if ($conn->query($updateQuery) === TRUE) {
        echo "Book returned successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Book ID not provided.";
}
?>
