<?php
require '../connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_record'])) {
    // Delete record if 'delete_record' button is clicked
    if (isset($_POST['delete_record'])) {
        $id = $_POST['id'];

        // SQL query to delete the record
        $sql = "DELETE FROM archive WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed for record deletion: (" . $conn->errno . ") " . $conn->error);
        }

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $_SESSION['delete_message'] = "Record deleted successfully.";
            // Redirect back to asset.php after deletion with a success message
            header("Location: archive.php?status=success");
            exit();
        } else {
            $_SESSION['delete_message'] = "Failed to delete record.";
        }

        $stmt->close();
    }
}

$conn->close();
ob_end_flush();
