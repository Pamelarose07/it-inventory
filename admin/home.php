<?php
session_start();
require '../connect.php'; // Make sure this path is correct

// Define categories and initialize counts
$categories = ['Printer', 'Computer', 'Laptop', 'Robot', 'Mobile', 'POS', 'Peripherals', 'Tools'];
$counts = [];

// Fetch counts for each category
foreach ($categories as $category) {
    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM `asset` WHERE `asset_type` = ?");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $counts[$category] = $row['count'];
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

</head>

<body>
    <?php include("navbar.php"); ?>
    <div class="container">

        <div class="flex items-center justify-center md:ml-40">
            <div class="grid grid-cols-2 mt-16 md:grid-cols-4 gap-16 md:mt-16">
                <a href="printer.php">
                    <div class="hover:-translate-y-4 w-26 h-20 md:w-52 md:h-36 bg-green-600 border border-gray-400 rounded-lg shadow" style="box-shadow: 0px 15px 10px -15px #111; transition: transform 250ms;">

                        <h5 class="text-sm text-center md:text-2xl font-sans font-bold tracking-tight text-white  px-6 py-2">
                            PRINTER</h5>

                        <div class="absolute">

                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-6 mt-8 hidden sm:inline" fill="white" height="2em" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M128 0C92.7 0 64 28.7 64 64l0 96 64 0 0-96 226.7 0L384 93.3l0 66.7 64 0 0-66.7c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0L128 0zM384 352l0 32 0 64-256 0 0-64 0-16 0-16 256 0zm64 32l32 0c17.7 0 32-14.3 32-32l0-96c0-35.3-28.7-64-64-64L64 192c-35.3 0-64 28.7-64 64l0 96c0 17.7 14.3 32 32 32l32 0 0 64c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-64zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                            </svg>
                        </div>
                        <h1 style=" font-family: sans-serif;" class="text-4xl md:text-6xl font-bold text-center md:text-right text-white md:mr-6 md:mt-4">
                            <?php echo htmlspecialchars($counts['Printer']); ?>
                        </h1>
                    </div>
                </a>

                <a href="computer.php">
                    <div class="hover:-translate-y-4 w-26 h-20 md:w-52 md:h-36 bg-yellow-500 border border-gray-400 rounded-lg shadow" style="box-shadow: 0px 15px 10px -15px #111; transition: transform 250ms;">

                        <h5 class="text-sm text-center md:text-2xl font-sans font-bold tracking-tight text-white  px-6 py-2">
                            COMPUTER</h5>

                        <div class="absolute">

                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-6 mt-8 hidden sm:inline" fill="white" height="2em" viewBox="0 0 640 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M384 96l0 224L64 320 64 96l320 0zM64 32C28.7 32 0 60.7 0 96L0 320c0 35.3 28.7 64 64 64l117.3 0-10.7 32L96 416c-17.7 0-32 14.3-32 32s14.3 32 32 32l256 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-74.7 0-10.7-32L384 384c35.3 0 64-28.7 64-64l0-224c0-35.3-28.7-64-64-64L64 32zm464 0c-26.5 0-48 21.5-48 48l0 352c0 26.5 21.5 48 48 48l64 0c26.5 0 48-21.5 48-48l0-352c0-26.5-21.5-48-48-48l-64 0zm16 64l32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm-16 80c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16zm32 160a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                            </svg>
                        </div>
                        <h1 style=" font-family: sans-serif;" class="text-4xl md:text-6xl font-bold text-center md:text-right text-white md:mr-6 md:mt-4">
                            <?php echo htmlspecialchars($counts['Computer']); ?>
                        </h1>
                    </div>
                </a>

                <a href="laptop.php">
                    <div class="hover:-translate-y-4 w-26 h-20 md:w-52 md:h-36 bg-red-600 border border-gray-400 rounded-lg shadow" style="box-shadow: 0px 15px 10px -15px #111; transition: transform 250ms;">

                        <h5 class="text-sm text-center md:text-2xl font-sans font-bold tracking-tight text-white  px-6 py-2">
                            LAPTOP</h5>

                        <div class="absolute">

                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-6 mt-8 hidden sm:inline" fill="white" height="2em" viewBox="0 0 640 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M128 32C92.7 32 64 60.7 64 96l0 256 64 0 0-256 384 0 0 256 64 0 0-256c0-35.3-28.7-64-64-64L128 32zM19.2 384C8.6 384 0 392.6 0 403.2C0 445.6 34.4 480 76.8 480l486.4 0c42.4 0 76.8-34.4 76.8-76.8c0-10.6-8.6-19.2-19.2-19.2L19.2 384z" />
                            </svg>
                        </div>
                        <h1 style="font-family: sans-serif;" class="text-4xl md:text-6xl font-bold text-center md:text-right text-white md:mr-6 md:mt-4">
                            <?php echo htmlspecialchars($counts['Laptop']); ?>
                        </h1>
                    </div>
                </a>

                <a href="robot.php">
                    <div class="hover:-translate-y-4 w-26 h-20 md:w-52 md:h-36 bg-blue-600 border border-gray-400 rounded-lg shadow" style="box-shadow: 0px 15px 10px -15px #111; transition: transform 250ms;">

                        <h5 class="text-sm text-center md:text-2xl font-sans font-bold tracking-tight text-white  px-6 py-2">
                            ROBOT</h5>

                        <div class="absolute">

                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-6 mt-8 hidden sm:inline" fill="white" height="2em" viewBox="0 0 640 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M320 0c17.7 0 32 14.3 32 32l0 64 120 0c39.8 0 72 32.2 72 72l0 272c0 39.8-32.2 72-72 72l-304 0c-39.8 0-72-32.2-72-72l0-272c0-39.8 32.2-72 72-72l120 0 0-64c0-17.7 14.3-32 32-32zM208 384c-8.8 0-16 7.2-16 16s7.2 16 16 16l32 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-32 0zm96 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l32 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-32 0zm96 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l32 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-32 0zM264 256a40 40 0 1 0 -80 0 40 40 0 1 0 80 0zm152 40a40 40 0 1 0 0-80 40 40 0 1 0 0 80zM48 224l16 0 0 192-16 0c-26.5 0-48-21.5-48-48l0-96c0-26.5 21.5-48 48-48zm544 0c26.5 0 48 21.5 48 48l0 96c0 26.5-21.5 48-48 48l-16 0 0-192 16 0z" />
                            </svg>
                        </div>
                        <h1 style=" font-family: sans-serif;" class="text-4xl md:text-6xl font-bold text-center md:text-right text-white md:mr-6 md:mt-4">
                            <?php echo htmlspecialchars($counts['Robot']); ?>
                        </h1>
                    </div>
                </a>

                <a href="mobile.php">
                    <div class="hover:-translate-y-4 w-26 h-20 md:w-52 md:h-36 bg-blue-400 border border-gray-400 rounded-lg shadow" style="box-shadow: 0px 15px 10px -15px #111; transition: transform 250ms;">

                        <h5 class="text-sm text-center md:text-2xl font-sans font-bold tracking-tight text-white  px-6 py-2">
                            MOBILE</h5>

                        <div class="absolute">

                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-6 mt-8 hidden sm:inline" fill="white" height="2em" viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M80 0C44.7 0 16 28.7 16 64l0 384c0 35.3 28.7 64 64 64l224 0c35.3 0 64-28.7 64-64l0-384c0-35.3-28.7-64-64-64L80 0zm80 432l64 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-64 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
                            </svg>
                        </div>
                        <h1 style=" font-family: sans-serif;" class="text-4xl md:text-6xl font-bold text-center md:text-right text-white md:mr-6 md:mt-4">
                            <?php echo htmlspecialchars($counts['Mobile']); ?>
                        </h1>
                    </div>
                </a>

                <a href="pos.php">
                    <div class="hover:-translate-y-4 w-26 h-20 md:w-52 md:h-36 bg-violet-500 border border-gray-400 rounded-lg shadow" style="box-shadow: 0px 15px 10px -15px #111; transition: transform 250ms;">

                        <h5 class="text-sm text-center md:text-2xl font-sans font-bold tracking-tight text-white  px-6 py-2">
                            POS</h5>

                        <div class="absolute">

                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-6 mt-8 hidden sm:inline" fill="white" height="2em" viewBox="0 0 640 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M64 64l0 288 512 0 0-288L64 64zM0 64C0 28.7 28.7 0 64 0L576 0c35.3 0 64 28.7 64 64l0 288c0 35.3-28.7 64-64 64L64 416c-35.3 0-64-28.7-64-64L0 64zM128 448l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-384 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z" />
                            </svg>
                        </div>
                        <h1 style=" font-family: sans-serif;" class="text-4xl md:text-6xl font-bold text-center md:text-right text-white md:mr-6 md:mt-4">
                            <?php echo htmlspecialchars($counts['POS']); ?>
                        </h1>
                    </div>
                </a>

                <a href="peripherals.php">
                    <div class="hover:-translate-y-4 w-26 h-20 md:w-52 md:h-36 bg-orange-600 border border-gray-400 rounded-lg shadow" style="box-shadow: 0px 15px 10px -15px #111; transition: transform 250ms;">

                        <h5 class="text-sm text-center sm:mr-5 md:text-2xl font-sans font-bold tracking-tight text-white  px-6 py-2">
                            PERIPHERALS</h5>

                        <div class="absolute">

                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-6 mt-8 hidden sm:inline" fill="white" height="2em" viewBox="0 0 640 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M288 432l0-16-160 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l176 0c-10-13.4-16-30-16-48zM64 32C28.7 32 0 60.7 0 96L0 320c0 35.3 28.7 64 64 64l224 0 0-64L64 320 64 96l224 0 0-16c0-18 6-34.6 16-48L64 32zm304 0c-26.5 0-48 21.5-48 48l0 352c0 26.5 21.5 48 48 48l224 0c26.5 0 48-21.5 48-48l0-352c0-26.5-21.5-48-48-48L368 32zM544 320a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zm-160 0a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zm64-192a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
                            </svg>
                        </div>
                        <h1 style="font-family: sans-serif;" class="text-4xl md:text-6xl font-bold text-center md:text-right text-white md:mr-6 md:mt-4">
                            <?php echo htmlspecialchars($counts['Peripherals']); ?>
                        </h1>
                    </div>
                </a>

                <a href="tools.php">
                    <div class="hover:-translate-y-4 w-26 h-20 md:w-52 md:h-36 bg-gray-400 border border-gray-400 rounded-lg shadow" style="box-shadow: 0px 15px 10px -15px #111; transition: transform 250ms;">

                        <h5 class="text-sm text-center md:text-2xl font-sans font-bold tracking-tight text-white  px-6 py-2">
                            TOOLS</h5>

                        <div class="absolute">
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-6 mt-8 hidden sm:inline" fill="white" height="2em" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M176 88l0 40 160 0 0-40c0-4.4-3.6-8-8-8L184 80c-4.4 0-8 3.6-8 8zm-48 40l0-40c0-30.9 25.1-56 56-56l144 0c30.9 0 56 25.1 56 56l0 40 28.1 0c12.7 0 24.9 5.1 33.9 14.1l51.9 51.9c9 9 14.1 21.2 14.1 33.9l0 92.1-128 0 0-32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 32-128 0 0-32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 32L0 320l0-92.1c0-12.7 5.1-24.9 14.1-33.9l51.9-51.9c9-9 21.2-14.1 33.9-14.1l28.1 0zM0 416l0-64 128 0c0 17.7 14.3 32 32 32s32-14.3 32-32l128 0c0 17.7 14.3 32 32 32s32-14.3 32-32l128 0 0 64c0 35.3-28.7 64-64 64L64 480c-35.3 0-64-28.7-64-64z" />
                            </svg>
                        </div>
                        <h1 style=" font-family: sans-serif;" class="text-4xl md:text-6xl font-bold text-center md:text-right text-white md:mr-6 md:mt-4">
                            <?php echo htmlspecialchars($counts['Tools']); ?>
                        </h1>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>

</html>