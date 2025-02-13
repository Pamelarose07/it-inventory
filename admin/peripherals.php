<?php
include "../connect.php";
session_start(); // Start the session

// Fetch data from both tables using a JOIN query using prepared statements
$sql = "SELECT * FROM asset WHERE `asset_type` = 'PERIPHERALS'";
$result = mysqli_query($conn, $sql);

if ($result === false) {
    die('Error executing the query: ' . mysqli_error($conn));
}

// Count the number of records using prepared statements
$count_sql = "SELECT COUNT(*) AS record_count FROM asset WHERE `asset_type` = 'PERIPHERALS'";
$count_result = mysqli_query($conn, $count_sql);
if ($count_result === false) {
    die('Error executing the query: ' . mysqli_error($conn));
}
$row_count = mysqli_fetch_assoc($count_result)['record_count'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <?php include("navbar.php"); ?>

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


    <div class="flex-1 p-8">
        <div class="flex items-center justify-between"> <!-- Flex container for layout -->
            <button class="w-auto h-auto">
                <div class="flex-1 h-full">
                    <div class="flex items-center justify-center flex-1 -mt-5 h-full p-2 border bg-black rounded-full">
                        <a href="home.php">
                            <div class="relative">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75 14.25 12m0 0 2.25 2.25M14.25 12l2.25-2.25M14.25 12 12 14.25m-2.58 4.92-6.374-6.375a1.125 1.125 0 0 1 0-1.59L9.42 4.83c.21-.211.497-.33.795-.33H19.5a2.25 2.25 0 0 1 2.25 2.25v10.5a2.25 2.25 0 0 1-2.25 2.25h-9.284c-.298 0-.585-.119-.795-.33Z" />
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            </button>
            <h5 class="text-2xl uppercase font-medium">Peripherals</h5>
            <div class="text-center mt-4">
                <span class="font-semibold">Total Records: <?php echo $row_count; ?></span>
            </div>
        </div>



        <table class="w-full text-sm text-center rtl:text-right text-black dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-black dark:text-gray-400">
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
                                    <a title="view" href="peripherals_view.php?id=<?php echo $row['id']; ?>" class="text-black ">

                                        <svg class="text-black hover:text-blue-500 w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </a>
                                    <form method="POST" action="peripherals_delete.php" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button title="delete" type="button" onclick="confirmDelete(this.form)" style="background:none; border:none; padding:0; cursor:pointer;">
                                            <svg class="text-black hover:text-blue-500 w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>





                                    <a title="archive" href="peripherals_archive.php?id=<?php echo $row['id']; ?>" class="text-black ">
                                        <svg class="text-black hover:text-blue-500 w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m2.826-1.5h11.648c1.345 0 2.451 1.134 2.49 2.454l.5 13.5a1.5 1.5 0 0 1-1.487 1.545H5.755a1.5 1.5 0 0 1-1.487-1.545l.5-13.5c.038-1.32 1.145-2.454 2.49-2.454Z" />
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