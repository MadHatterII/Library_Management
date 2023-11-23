<?php
include '../connection.php'; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST["title"];
    $author = $_POST["author"];
    $isbn = $_POST["isbn"];
    $publisher = $_POST["publisher"];
    $publication_date = $_POST["publication_date"];
    $genre = $_POST["genre"];
    $language = $_POST["language"];
    $edition = $_POST["edition"];
    $copies = $_POST["copies"];
    $status = $_POST["status"];

    // Perform any additional validation as needed

    // Now, you can perform database operations to insert the book into your database
    // Replace the SQL query with a prepared statement for better security

    $sql = "INSERT INTO book (title, author, isbn, publisher, publicationdate, genre, language, edition, copies, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssssssss", $title, $author, $isbn, $publisher, $publication_date, $genre, $language, $edition, $copies, $status);

        if ($stmt->execute()) {
            echo "Book added successfully";
            header("Location: abook_holdings.php");
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    // Redirect back to the add book page if accessed directly without submitting the form
    header("Location:addbook.php");
    exit();
}

// Close the database connection
$conn->close();
?>