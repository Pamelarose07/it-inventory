<?php

require '../connect.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_records'])) {
        // Retrieve all input values from the form
        $id = $_POST['id'];
        $asset_id = $_POST['asset_id'];
        $asset_type = $_POST['asset_type'];
        $serial_no = $_POST['serial_no'];
        $brand = $_POST['brand'];
        $model_name = $_POST['model_name'];
        $color = $_POST['color'];
        $conditionn = $_POST['conditionn'];
        $deployed_to = $_POST['deployed_to'];
        $employee_id = $_POST['employee_id'];
        $department = $_POST['department'];
        $department_date = $_POST['deployment_date'];
        $location = $_POST['location'];
        $specifications = $_POST['specifications'];
        $comments = $_POST['comments'];
        $accessories = $_POST['accessories'];
        $prev_users = $_POST['prev_users'];
        $date_returned = $_POST['date_returned'];

        // Prepare the SQL statement for updating the record
        $sql = "UPDATE asset SET 
            asset_type=?,
            serial_no=?,
            brand=?,
            model_name=?,
            color=?,
            conditionn=?,   
            deployed_to=?,
            employee_id=?,
            department=?,
            deployment_date=?,
            location=?,
            specifications=?,
            comments=?,
            accessories=?,
            prev_users=?,
            date_returned=?
            WHERE id=?";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed for records update: (" . $conn->errno . ") " . $conn->error);
        }

        // Bind parameters for the prepared statement
        $stmt->bind_param(
            "ssssssssssssssssi",
            $asset_type,
            $serial_no,
            $brand,
            $model_name,
            $color,
            $conditionn,
            $deployed_to,
            $employee_id,
            $department,
            $department_date,
            $location,
            $specifications,
            $comments,
            $accessories,
            $prev_users,
            $date_returned,
            $id
        );

        // Execute the update operation
        if ($stmt->execute()) {
            $_SESSION['update_message'] = "Record updated successfully.";
        } else {
            $_SESSION['update_message'] = "Failed to update record.";
        }

        $stmt->close();
    }
}

// Fetch record data if `id` is set
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM `asset` WHERE id = ?";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed for fetching record: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Sanitize output to prevent XSS
        $asset_id = htmlspecialchars($row['asset_id']);
        $asset_type = htmlspecialchars($row['asset_type']);
        $serial_no = htmlspecialchars($row['serial_no']);
        $brand = htmlspecialchars($row['brand']);
        $model_name = htmlspecialchars($row['model_name']);
        $color = htmlspecialchars($row['color']);
        $conditionn = htmlspecialchars($row['conditionn']);
        $deployed_to = htmlspecialchars($row['deployed_to']);
        $employee_id = htmlspecialchars($row['employee_id']);
        $department = htmlspecialchars($row['department']);
        $department_date = htmlspecialchars($row['deployment_date']);
        $location = htmlspecialchars($row['location']);
        $specifications = htmlspecialchars($row['specifications']);
        $comments = htmlspecialchars($row['comments']);
        $accessories = htmlspecialchars($row['accessories']);
        $prev_users = htmlspecialchars($row['prev_users']);
        $date_returned = htmlspecialchars($row['date_returned']);
    } else {
        echo "No records found for the specified id.";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</head>



<body>
    <?php include("navbar.php"); ?>
    <div class="printableArea">
        <form class="flex-1" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <section class=" py-1 bg-blueGray-50">
                <div class="w-full  px-4 mx-auto mt-6">
                    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                        <input type="hidden" name="update_records" value="1">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <div class="rounded-t bg-white mb-0 px-6 py-6">
                            <div class="text-center flex justify-between">
                                <h6 class="text-blueGray-700 text-xl font-bold">
                                    Asset Form
                                </h6>
                                <div>

                                    <a href="pos.php"><button type="button" class="no-print bg-black text-white hover:bg-red-600 active:bg-red-900 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150" type="button">
                                            Back
                                        </button></a>
                                    <button type="submit" name="submit" class="no-print bg-black text-white hover:bg-red-600 active:bg-red-900 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150" type="button">
                                        Save
                                    </button>
                                </div>

                            </div>
                        </div>
                        <?php if (isset($_SESSION['update_message'])) : ?>
                            <script>
                                swal({
                                    title: "Success!",
                                    text: "<?php echo $_SESSION['update_message']; ?>",
                                    icon: "success",
                                    button: "OK",
                                });
                            </script>
                            <?php unset($_SESSION['update_message']); ?>
                        <?php endif; ?>
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0">

                            <div class="flex flex-wrap">
                                <div class="w-full lg:w-4/12 px-4">
                                    <div class="relative w-full mb-3">

                                        <label class=" block uppercase text-blueGray-600 text-xs font-bold mb-2" for="grid-password">
                                            Asset ID
                                        </label>
                                        <input type="text" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" name="asset_id" value="<?php echo $asset_id; ?>" readonly>


                                    </div>

                                </div>
                                <div class="w-full lg:w-4/12 px-4">
                                    <div class="relative w-full mb-3">

                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                                            Asset Type
                                        </label>
                                        <select class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" name="asset_type">
                                            <option>Choose one</option>
                                            <option value="Printer" <?php if ($asset_type == 'Printer') echo 'selected'; ?>>Printer</option>
                                            <option value="Computer" <?php if ($asset_type == 'Computer') echo 'selected'; ?>>Computer</option>
                                            <option value="Laptop" <?php if ($asset_type == 'Laptop') echo 'selected'; ?>>Laptop</option>
                                            <option value="POS" <?php if ($asset_type == 'POS') echo 'selected'; ?>>POS</option>
                                            <option value="Mobile" <?php if ($asset_type == 'Mobile') echo 'selected'; ?>>Mobile</option>
                                            <option value="Robot" <?php if ($asset_type == 'Robot') echo 'selected'; ?>>Robot</option>
                                            <option value="Peripherals" <?php if ($asset_type == 'Peripherals') echo 'selected'; ?>>Peripherals</option>
                                            <option value="Tools" <?php if ($asset_type == 'Tools') echo 'selected'; ?>>Tools</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="w-full lg:w-4/12 px-4">
                                    <div class="relative w-full mb-3">

                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                                            Brand
                                        </label>
                                        <input type="text" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" name="brand" value="<?php echo $brand; ?>">

                                    </div>
                                </div>
                                <div class="w-full lg:w-4/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                                            Model
                                        </label>
                                        <input type="text" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" name="model_name" value="<?php echo $model_name; ?>">
                                    </div>
                                </div>
                                <div class="w-full lg:w-4/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                                            Serial Number
                                        </label>
                                        <input type="text" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" name="serial_no" value="<?php echo $serial_no; ?>">
                                    </div>
                                </div>
                                <div class="w-full lg:w-4/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                                            Location
                                        </label>
                                        <input type="text" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" name="location" value="<?php echo $location; ?>">

                                    </div>
                                </div>
                                <div class="w-full lg:w-4/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                                            Color
                                        </label>
                                        <input type="text" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" name="color" value="<?php echo $color; ?>">
                                    </div>
                                </div>
                                <div class="w-full lg:w-4/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                                            Accessories
                                        </label>
                                        <input type="text" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" name="accessories" value="<?php echo $accessories; ?>">

                                    </div>
                                </div>
                                <div class="w-full lg:w-4/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                                            Condition
                                        </label>
                                        <select class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" name="conditionn" value="<?php echo $conditionn; ?>">
                                            <option>Choose one</option>
                                            <option value="Working" <?php if ($conditionn == 'Working') echo 'selected'; ?>>Working</option>
                                            <option value="Faulty" <?php if ($conditionn == 'Faulty') echo 'selected'; ?>>Faulty</option>
                                            <option value="New" <?php if ($conditionn == 'New') echo 'selected'; ?>>New</option>
                                            <option value="Unknown" <?php if ($conditionn == 'Unknown') echo 'selected'; ?>>Unknown</option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <hr class="mt-6 border-b-1 border-blueGray-300">

                            <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                                Assigned to
                            </h6>
                            <div class="flex flex-wrap">
                                <div class="w-full lg:w-12/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                                            Employee Name
                                        </label>
                                        <input type="text" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" name="deployed_to" value="<?php echo $deployed_to; ?>">
                                    </div>
                                </div>
                                <div class="w-full lg:w-4/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                                            Employee ID
                                        </label>
                                        <input type="email" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" name="employee_id" value="<?php echo $employee_id; ?>">
                                    </div>
                                </div>
                                <div class="w-full lg:w-4/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                                            Department
                                        </label>
                                        <input type="text" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" name="department" value="<?php echo $department; ?>">
                                    </div>
                                </div>
                                <div class="w-full lg:w-4/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                                            Date Assigned
                                        </label>
                                        <input type="date" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" name="deployment_date" value="<?php echo $deployment_date; ?>">
                                    </div>
                                </div>
                            </div>

                            <hr class="mt-6 border-b-1 border-blueGray-300">


                            <div class="grid grid-cols-2 gap-4">
                                <div class="col-span-1">
                                    <div class="relative w-full mt-5 mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="grid-about-me">
                                            Specifications
                                        </label>
                                        <textarea id="grid-about-me" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" rows="4" name="specifications" value="<?php echo $specifications; ?>">

            </textarea>
                                    </div>
                                </div>

                                <div class="col-span-1">
                                    <div class="relative w-full mt-5 mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="grid-about-me-2">
                                            Comments
                                        </label>
                                        <textarea id="grid-about-me-2" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" rows="4" name="comments" value="<?php echo $comments; ?>">

            </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-wrap mt-3">

                                <div class="w-full lg:w-4/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                                            Previous Users
                                        </label>
                                        <input type="text" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" name="prev_users" value="<?php echo $prev_users; ?>">
                                    </div>
                                </div>
                                <div class="w-full lg:w-4/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                                            Date Returned
                                        </label>
                                        <input type="date" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" name="date_returned" value="<?php echo $date_returned; ?>">
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
        // Function to display SweetAlert2 alert
        function showSweetAlert(type, message) {
            Swal.fire({
                icon: type,
                title: message,
                showConfirmButton: false,
                timer: 3000
            });
        }

        // Check for session messages and display alerts
        <?php if (isset($_SESSION['update_message'])) : ?>
            let message = "<?php echo $_SESSION['update_message']; ?>";
            let type = "<?php echo $update_success ? 'success' : 'error'; ?>";
            showSweetAlert(type, message);
            <?php unset($_SESSION['update_message']); ?>
        <?php endif; ?>
    </script>
</body>

</html>