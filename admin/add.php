<?php
include '../connect.php';
session_start();

// Check if the form is submitted for adding a new record
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $asset_id = $_POST['asset_id'];
    $asset_type = $_POST['asset_type'];

    // Insert new record
    $sql = "INSERT INTO asset (asset_id, asset_type) VALUES (?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed for new record insert: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("ss", $asset_id, $asset_type);

    if ($stmt->execute()) {
        $_SESSION['update_message'] = "New asset added successfully.";
    } else {
        $_SESSION['update_message'] = "Failed to add new asset.";
    }

    $stmt->close();

    // Redirect to avoid resubmission on page refresh
    header("Location: add.php");
    exit;
}

// Initialize empty variables for adding new assets
$asset_id = '';
$asset_type = '';

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Asset</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php include("navbar.php"); ?>
    <div class="printableArea">
        <form class="flex-1" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <section class="py-1 bg-blueGray-50">
                <div class="w-full px-4 mx-auto mt-6">
                    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                        <div class="rounded-t bg-white mb-0 px-6 py-6">
                            <div class="text-center flex justify-between">
                                <h6 class="text-blueGray-700 text-xl font-bold">
                                    Asset Form
                                </h6>
                                <div>
                                    <button class="no-print" onclick="window.print()">Print</button>
                                    <a href="asset.php">
                                        <button type="button" class="no-print bg-black text-white uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none">
                                            Back
                                        </button>
                                    </a>
                                    <button type="submit" name="submit" class="no-print bg-black text-white uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                            <div class="flex flex-wrap">
                                <!-- Asset ID Input -->
                                <div class="w-full lg:w-4/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                            Asset ID
                                        </label>
                                        <input type="text" name="asset_id" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none w-full" value="<?php echo $asset_id; ?>">
                                    </div>
                                </div>

                                <!-- Asset Type Select -->
                                <div class="w-full lg:w-4/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                            Asset Type
                                        </label>
                                        <select name="asset_type" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none w-full">
                                            <option value="">Choose one</option>
                                            <option value="Printer" <?php if ($asset_type == 'Printer') echo 'selected'; ?>>Printer</option>
                                            <option value="Computer" <?php if ($asset_type == 'Computer') echo 'selected'; ?>>Computer</option>
                                            <!-- Add other options -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>

    <script>
        function showSweetAlert(type, message) {
            Swal.fire({
                icon: type,
                title: message,
                showConfirmButton: false,
                timer: 3000
            });
        }

        // Display session message
        <?php if (isset($_SESSION['update_message'])) : ?>
            let message = "<?php echo $_SESSION['update_message']; ?>";
            let type = "success";
            showSweetAlert(type, message);
            <?php unset($_SESSION['update_message']); ?>
        <?php endif; ?>
    </script>
</body>

</html>