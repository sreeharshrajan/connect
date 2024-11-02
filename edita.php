<?php
include('components/sessions.php');
include('components/config.php');

$serialNo = $_GET['id'];

if (isset($_GET['id'])==0) {
    header("location:taCalender.php");
    exit;
}

$qry = mysqli_query($conn, "select * from tna where sNo='$serialNo'");
$data = mysqli_fetch_array($qry);


if (isset($_POST['update'])) // when click on Update button
{

    $aDate = $_POST['aDate'];

    $update = mysqli_query($conn, "update tna set aDate='$aDate' where sNo='$serialNo'");

    if ($update) {
        mysqli_close($conn); // Close connection
        //$_SESSION['message'] 
        $data = [ 'message'=>"Activity Successfully Edited"];
        extract($data);
        require 'taCalender.php';
        header("location:taCalender.php");
        exit;
    } else {
        $data = [ 'message'=>"Activity Failed to Update"];
        extract($data);
        require 'taCalender.php';
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


    <form method="POST">

        <div class="modal flex justify-center h-screen items-center bg-gray-200 antialiased">
            <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl">
                <div class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                    <p class="font-semibold text-gray-600">Update Actual Date for <span class="text-red-500"> <?php echo $data['activity'] ?> Activity</span> </p>
                    <a href="<?php echo "taCalender.php" ?>">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </a>
                </div>
                <div class="flex flex-col px-6 py-5 bg-gray-50">
                    <div class="flex flex-col sm:flex-row items-center mb-5 sm:space-x-5">
                        <div class="w-full sm:w-1/2">
                            <p class="mb-2 font-semibold text-gray-700">Planned Date</p>
                            <input class="w-full p-5 bg-gray-200 border border-gray-200 rounded shadow-sm appearance-none" type="date" name="pDate" value="<?php echo $data['pDate'] ?>" disabled>

                        </div>
                        <div class="w-full sm:w-1/2 mt-2 sm:mt-0">
                            <p class="mb-2 font-semibold text-gray-700">Select New Actual Date</p>
                            <input class="w-full p-5 bg-white border border-gray-200 rounded shadow-sm appearance-none" type="date" name="aDate" value="<?php echo $data['aDate'] ?>" Required>

                        </div>
                    </div>

                </div>
                <div class="flex flex-row items-center justify-between p-5 bg-white border-t border-gray-200 rounded-bl-lg rounded-br-lg">
                    <a href="<?php echo "taCalender.php" ?>" class="font-semibold text-gray-600">Cancel</a>
                    <button type="submit" class="px-4 py-2 text-white font-semibold bg-red-500 rounded" name="update" value="Update">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </form>
</body>

</html>