<?php
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookId = $_POST['bookId'];
    $newStatus = $_POST['newStatus'];

    $updateQuery = "UPDATE book SET status = '$newStatus' WHERE BookID = '$bookId'";
    $conn->query($updateQuery);

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

$conn->close();
?>
