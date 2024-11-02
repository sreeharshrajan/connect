<?php

include('components/config.php');

$serialNo = $_GET['id'];
$qry = mysqli_query($conn, "select * from styles where serialNo='$serialNo'");

$qryActivity = mysqli_query($conn, "select * from tna where sNo='$serialNo'");
$data = mysqli_fetch_array($qry);

if (isset($_POST['update'])) // when click on Update button
{
    $status = $_POST['status'];
    $mode = $_POST['mode'];

    $styleID = $data['styleid'];


    $update = mysqli_query($conn, "update styles set status='$status', mode='$mode' where serialNo='$serialNo'");


    if ($update) {
        mysqli_close($conn); // Close connection
        $data = ['message' => "Style Successfully Updated"];
        extract($data);
        require 'viewStyles.php';
        header("location:viewStyles.php"); // redirects to all records pseason
        exit;
    } else {

        echo mysqli_error($conn);
    }
}



?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/tailwind.min.css">
    <link rel="stylesheet" href="styles/main.css">
</head>

<body>


    <form method="POST" enctype="multipart/form-data">

        <div class="flex justify-center h-screen items-center bg-gray-200 antialiased">
            <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl">
                <div class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                    <p class="font-semibold text-gray-600">
                        Update Existing Style <span class="text-red-500"> <?php echo $data['styleid'] ?> </span>

                    </p>
                    <a href="<?php echo "viewStyles.php" ?>">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </a>
                </div>
                <div class="flex flex-col px-6 py-5 bg-gray-50">
                    <div class="grid grid-cols-1 md:grid-cols-2 items-center mb-5 sm:space-x-5">
                        <div class="grid grid-cols-1 mt-2 sm:mt-0">
                            <p class="mb-2 font-semibold text-gray-700">Current Mode</p>
                            <input class="w-full p-5 bg-gray-100 border border-gray-200 rounded shadow-sm appearance-none" type="text" name="mode" value="<?php echo $data['mode'] ?>" disabled>
                        </div>
                        <div class="grid grid-cols-1 sm:mt-0 mt-2">
                            <label class="mb-2 font-semibold text-gray-700">Edit Mode:</label>
                            <select id="mode" name="mode" class="py-5 px-3 rounded border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                <option value="given">Given to Studio</option>
                                <option value="yetto">Yet to Recieve</option>
                            </select>
                        </div>
                    </div>
                    <?php

                    ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 items-center mb-5 sm:space-x-5">
                        <div class="grid grid-cols-1">
                            <p class="mb-2 font-semibold text-gray-700">Current Catalouge Status</p>
                            <input class="w-full p-5 bg-gray-100 border border-gray-200 rounded shadow-sm appearance-none" type="text" name="status" value="<?php echo $data['status']; ?>" disabled>
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="mb-2 font-semibold text-gray-700">Edit Catalouge Status:</label>
                            <select id="status" name="status" class="py-5 px-3 rounded border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                <option value="WIP">Studio WIP</option>
                                <option value="NR">Not Recieved Yet</option>
                                <option value="Catalouged">Cataloged</option>
                            </select>
                        </div>
                    </div>



                </div>
                <div class="flex flex-row items-center justify-between p-5 bg-white border-t border-gray-200 rounded-bl-lg rounded-br-lg">
                    <a href="<?php echo "viewStyles.php" ?>" class="px-4 py-2 font-semibold text-gray-600">Cancel</a>
                    <button type="submit" class="px-4 py-2 text-white font-semibold bg-red-500 rounded" name="update" value="Update">
                        Save
                    </button>
                </div>
            </div>
        </div>



    </form>
</body>


</html>