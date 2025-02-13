<?php

require '../connect.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $username = $_POST['user'];
    $password = $_POST['pass'];


    // SQL Insert statement
    $sql = "INSERT INTO login (
            id, 
            username, 
            password 
           
        ) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed for records insert: (" . $conn->errno . ") " . $conn->error);
    }

    // Binding the parameters for the insert statement
    $stmt->bind_param(
        "sss",
        $id,
        $username,
        $password

    );

    // After executing insert operation
    if ($stmt->execute()) {
        $_SESSION['update_message'] = "Record added successfully.";
    } else {
        $_SESSION['update_message'] = "Failed to add asset.";
    }

    $stmt->close();
}

// Initialize empty variables for the form
$id = '';
$username = '';
$password = '';

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
<style>
    .inputBox {
        position: relative;
        width: 100%;

    }

    .inputBox input {
        position: relative;
        width: 100%;
        background: #333;
        border: none;
        outline: none;
        padding: 25px 10px 7.5px;
        border-radius: 4px;
        color: #fff;
        font-weight: 500;
        font-size: 1em;
    }

    .inputBox i {
        position: absolute;
        left: 0;
        padding: 15px 10px;
        font-style: normal;
        color: #aaa;
        transition: 0.5s;
        pointer-events: none;
    }
</style>


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
                                    Create User
                                </h6>
                                <div>

                                    <a href="user.php"><button type="button" class="no-print bg-black text-white hover:bg-red-600 active:bg-red-900 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150" type="button">
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
                        <div class="">
                            <div class="flex justify-center items-center"> <!-- Centering container -->
                                <div class="flex flex-col space-y-4 w-auto mb-36">
                                    <div class="inputBox mt-20">

                                        <input type="text" id="user" name="user" required> <i>Username</i>

                                    </div>

                                    <div class="inputBox">

                                        <input type="password" id="pass" name="pass" required> <i>Password</i>

                                    </div>
                                </div>





                                <hr class="mt-6 border-b-1 border-blueGray-300">



                                <hr class="mt-6 border-b-1 border-blueGray-300">


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