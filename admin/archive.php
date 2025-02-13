<?php
session_start(); // Start the session
include "../connect.php";

// Fetch data from both tables using a JOIN query using prepared statements
$sql = "SELECT * FROM archive ";
$result = mysqli_query($conn, $sql);

if ($result === false) {
    die('Error executing the query: ' . mysqli_error($conn));
}

// Count the number of records using prepared statements
$count_sql = "SELECT COUNT(*) AS record_count FROM archive";
$count_result = mysqli_query($conn, $count_sql);
if ($count_result === false) {
    die('Error executing the query: ' . mysqli_error($conn));
}
$row_count = mysqli_fetch_assoc($count_result)['record_count'];

// Check if an ID is provided in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure the ID is an integer

    // Begin transaction
    mysqli_begin_transaction($conn);

    try {
        // Prepare the SQL to move the asset to the archived_assets table
        $sqlInsert = "INSERT INTO archive (
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
        date_returned) SELECT asset_id,asset_type, serial_no, brand, model_name, color, conditionn, deployed_to, employee_id, department, deployment_date, location, specifications, comments, accessories, prev_users, date_returned FROM asset WHERE id = ?";

        // Prepare the statement for insertion
        $stmtInsert = mysqli_prepare($conn, $sqlInsert);
        mysqli_stmt_bind_param($stmtInsert, "i", $id);

        // Execute the insertion
        if (mysqli_stmt_execute($stmtInsert)) {
            // Prepare the SQL to delete the asset from the asset table
            $sqlDelete = "DELETE FROM asset WHERE id = ?";

            // Prepare the statement for deletion
            $stmtDelete = mysqli_prepare($conn, $sqlDelete);
            mysqli_stmt_bind_param($stmtDelete, "i", $id);

            // Execute the deletion
            if (mysqli_stmt_execute($stmtDelete)) {
                // Commit the transaction
                mysqli_commit($conn);
                // Redirect back to the original page with a success message
                header("Location: asset.php?status=success");
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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include("navbar.php"); ?>


    <div class="flex-1 p-8">
        <?php if (isset($_GET['status']) && $_GET['status'] === 'success') : ?>
            <script>
                Swal.fire({
                    title: "Success!",
                    text: "Record deleted successfully.",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            </script>
        <?php endif; ?>

        <div class="flex items-center justify-between"> <!-- Flex container for layout -->
            <button>
                <div class="w-auto h-auto">
                    <div class="flex-1 h-full">
                        <div class="flex items-center justify-center flex-1 -mt-5 h-full p-2 border bg-black rounded-full">
                            <a href="add_asset.php">
                                <div class="relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </button>
            <h5 class="text-2xl uppercase font-medium">Archive</h5>
            <div class="text-center mt-4">
                <span class="font-semibold">Total Records: <?php echo $row_count; ?></span>
            </div>
        </div>

        <table class="w-full text-sm text-center rtl:text-right text-black dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-gray-500  dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Asset ID</th>
                    <th scope="col" class="px-6 py-3">Type</th>
                    <th scope="col" class="px-6 py-3">Serial No</th>
                    <th scope="col" class="px-6 py-3">Model Name</th>
                    <th scope="col" class="px-6 py-3">Deployed To</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0) : ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr class="bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700 font-bold">
                            <td class="text-center px-1 py-1"><?php echo htmlspecialchars($row['asset_id']); ?></td>
                            <td class="text-center px-1 py-1"><?php echo htmlspecialchars($row['asset_type']); ?></td>
                            <td class="text-center px-1 py-1"><?php echo htmlspecialchars($row['serial_no']); ?></td>
                            <td class="text-center px-1 py-1"><?php echo htmlspecialchars($row['model_name']); ?></td>
                            <td class="text-center px-1 py-1"><?php echo htmlspecialchars($row['deployed_to']); ?></td>
                            <td class="text-center px-1 py-1">
                                <div class="flex items-center space-x-2 justify-center">
                                    <a href="archive_view.php?id=<?php echo $row['id']; ?>" class="text-black ">
                                        <div class="flex items-center space-x-2 justify-center">
                                            <svg class="text-black hover:text-blue-500 w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                                <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                    </a>
                                    <form method="POST" action="archive_delete.php" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button title="delete" type="button" onclick="confirmDelete(this.form)" style="background:none; border:none; padding:0; cursor:pointer;">
                                            <svg class="text-black hover:text-blue-500 w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>

                                    <a href="retrieve.php?id=<?php echo $row['id']; ?>" class="text-black ">
                                        <svg class="text-black hover:text-blue-500 w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                        </svg>
                                    </a>

                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" class="text-center px-6 py-4">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
<script>
    function confirmDelete(form) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const deleteInput = document.createElement('input');
                deleteInput.type = 'hidden';
                deleteInput.name = 'delete_record';
                deleteInput.value = '1';
                form.appendChild(deleteInput);

                form.submit(); // Submit the form if confirmed
            }
        });
    }
</script>