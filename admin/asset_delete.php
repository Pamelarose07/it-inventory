<?php
require '../connect.php';
session_start();

ob_start(); // Start output buffering to prevent header issues

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_record'])) {
    // Check if the delete button was clicked
    if (isset($_POST['delete_record'])) {
        $id = $_POST['id'];

        // SQL query to delete the record
        $sql = "DELETE FROM asset WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed for record deletion: (" . $conn->errno . ") " . $conn->error);
        }

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $_SESSION['delete_message'] = "Record deleted successfully.";
            header("Location: asset.php?status=success"); // Redirect with status
            exit();
        } else {
            $_SESSION['delete_message'] = "Failed to delete record.";
        }

        $stmt->close();
    }
}

$conn->close();
ob_end_flush(); // End output buffering
