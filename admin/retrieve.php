<?php
session_start(); // Start the session
include "../connect.php";

// Check if an ID is provided in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure the ID is an integer

    // Begin transaction
    mysqli_begin_transaction($conn);

    try {
        // Prepare the SQL to move the asset to the archived_assets table
        $sqlInsert = "INSERT INTO asset (
        asset_id, 
        asset_type, 
        serial_no, 
        brand, 
        model_name, 
        color, 
        conditionn, 
        deployed_to,  
        employee_id, 
        department, 
        deployment_date, 
        location, 
        specifications, 
        comments, 
        accessories, 
        prev_users, 
        date_returned) SELECT asset_id,asset_type, serial_no, brand, model_name, color, conditionn, deployed_to, employee_id, department, deployment_date, location, specifications, comments, accessories, prev_users, date_returned FROM archive WHERE id = ?";

        // Prepare the statement for insertion
        $stmtInsert = mysqli_prepare($conn, $sqlInsert);
        mysqli_stmt_bind_param($stmtInsert, "i", $id);

        // Execute the insertion
        if (mysqli_stmt_execute($stmtInsert)) {
            // Prepare the SQL to delete the asset from the asset table
            $sqlDelete = "DELETE FROM archive WHERE id = ?";

            // Prepare the statement for deletion
            $stmtDelete = mysqli_prepare($conn, $sqlDelete);
            mysqli_stmt_bind_param($stmtDelete, "i", $id);

            // Execute the deletion
            if (mysqli_stmt_execute($stmtDelete)) {
                // Commit the transaction
                mysqli_commit($conn);
                // Redirect back to the original page with a success message
                header("Location: archive.php?status=success");
                exit();
            } else {
                // Rollback transaction if deletion fails
                mysqli_rollback($conn);
                die('Error executing the delete query: ' . mysqli_error($conn));
            }
        } else {
            // Rollback transaction if insertion fails
            mysqli_rollback($conn);
            die('Error executing the insert query: ' . mysqli_error($conn));
        }
    } catch (Exception $e) {
        // Rollback transaction on exception
        mysqli_rollback($conn);
        die('Transaction failed: ' . $e->getMessage());
    }
}
