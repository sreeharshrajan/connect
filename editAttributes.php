<?php
include('components/config.php');

$serialNo = $_GET['id'];
$qry = mysqli_query($conn, "select * from styles where serialNo='$serialNo'");
$data = mysqli_fetch_array($qry);

if (isset($_POST['update'])) // when click on Update button
{
    $fit = $_POST['fit'];
    $pattern = $_POST['pattern'];
    $closure = $_POST['closure'];
    $length = $_POST['length'];
    $color = $_POST['color'];
    $occassion = $_POST['occassion'];
    $style = $_POST['style'];
    $material = $_POST['material'];
    $sleeve = $_POST['sleeve'];
    $pockets = $_POST['pockets']; 
    $neckline = $_POST['nline'];
    $others = $_POST['others'];


    $update = mysqli_query($conn, "update styles set fit='$fit', pattern='$pattern', closure='$closure',length='$length', color='$color', occassion='$occassion',
    style='$style', material='$material', sleeve='$sleeve',pockets='$pockets', neckline='$neckline', others='$others' where serialNo='$serialNo'");


    if ($update) {
        mysqli_close($conn); // Close connection
        $data = ['message' => "Style Successfully Updated"];
        extract($data);
        require 'viewAttributes.php';
        header("location:viewAttributes.php");
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
            <div class="flex flex-col w-10/12 sm:w-4/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl">
                <div class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                    <p class="font-semibold text-gray-600">
                        Update Existing Style Attributes <span class="text-red-500"> <?php echo $data['styleid'] ?> </span>

                    </p>
                    <a href="<?php echo "viewAttributes.php" ?>">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </a>
                </div>
                <div class="flex flex-col px-6 py-5 bg-gray-50">
                    <fieldset class="grid grid-cols-1  mx-8">
                        
                        <div class=" grid grid-cols-2">
                            <div class="mt-1 mb-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Fit :</label>
                                <input class="block py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent" placeholder="Enter the Fit" type="text" id="fit" value="<?php echo $data['fit']; ?>" name="fit">
                            </div>
                            <div class="mt-1 mb-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Pattern :</label>
                                <input class="block py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent" placeholder="Enter the Pattern" type="text" id="pattern" name="pattern" value="<?php echo $data['pattern']; ?>">
                            </div>
                            <div class="mt-1 mb-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Closure :</label>
                                <input class="block py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent" placeholder="Enter the Closure" type="text" id="closure" name="closure" value="<?php echo $data['closure']; ?>">
                            </div>
                            <div class="mt-1 mb-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Length :</label>
                                <input class="block py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent" placeholder="Enter the Length" type="text" id="length" name="length" value="<?php echo $data['length']; ?>">
                            </div>
                            <div class="mt-1 mb-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Color :</label>
                                <input class="block py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent" placeholder="Enter the Color" id="color" type="text" name="color" value="<?php echo $data['color']; ?>">
                            </div>
                            <div class="mt-1 mb-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Occassion :</label>
                                <input class="block py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent" placeholder="Enter the Occassion" id="occassion" type="text" name="occassion" value="<?php echo $data['occassion'];?>">
                            </div>
                        </div>

                        <div class="related grid grid-cols-2">
                            <div class="mt-1  mb-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Style :</label>
                                <input class="block py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent" type="text" placeholder="Enter the Style" id="style" name="style" value="<?php echo $data['style'];?>">
                            </div>
                            <div class="mt-1 mb-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Material :</label>
                                <input class="block py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent" type="text" placeholder="Enter the Material" id="material" name="material" value="<?php echo $data['material'];?>">
                            </div>
                            <div class="mt-1 mb-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Sleeve :</label>
                                <input class="block py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent" type="text" placeholder="Enter the Sleeve" id="sleeve" name="sleeve" value="<?php echo $data['sleeve'];?>">
                            </div>
                            <div class="mt-1 mb-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Pockets :</label>
                                <input class="block py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent" type="text" placeholder="Enter the Pockets" id="pockets" name="pockets" value="<?php echo $data['pockets'];?>">
                            </div>
                            <div class="mt-1  mb-1">
                                <label for="nline" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Neckline :</label>
                                <input id="nline" name="nline" class="block py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent" type="text" placeholder="Enter the Neckline" value="<?php echo $data['neckline'];?>">
                            </div>
                            <div class="mt-1  mb-1">
                                <label for="others" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Others :</label>
                                <input id="others" name="others" class="block py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent" type="text" placeholder="Enter Other Attributes" value="<?php echo $data['others'];?>">
                            </div>


                        </div>

                    </fieldset>


                </div>
                <div class="flex flex-row items-center justify-between p-5 bg-white border-t border-gray-200 rounded-bl-lg rounded-br-lg">
                <a href="<?php echo "viewAttributes.php" ?>" class="px-4 py-2 font-semibold text-gray-600">Cancel</a>
                    <button type="submit" class="px-4 py-2 text-white font-semibold bg-red-500 rounded" name="update" value="Update">
                        Save
                    </button>
                </div>
            </div>
        </div>



    </form>
</body>


</html>