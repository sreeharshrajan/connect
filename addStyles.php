<?php
include('components/sessions.php');
include('components/config.php');

if (isset($_POST["submit"])) {
    $season = $_POST['season'];
    $brand = $_POST['brands'];
    $gender = $_POST['gender'];
    $category = $_POST['category'];
    $product = $_POST['product'];
    $styleid = $_POST['styleID'];
    $pcmid = $_POST['pcmID'];
    $ean = $_POST['eanID'];

    $mode = $_POST['mode'];
    $status = $_POST['status'];

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
$collar = $_POST['collar'];
    $image = $_FILES["imageName"]["name"];
    $tempname = $_FILES["imageName"]["tmp_name"];
    $folder = "styleImages/" . $image;

    $query = "INSERT INTO styles VALUES ( 'NULL','$styleid','$season', '$brand', '$gender', '$category', '$product', '$pcmid', '$ean', '$image', '$mode',' $status', 
    '$fit', '$pattern', '$closure', '$length','$color', '$occassion', '$style', '$material', '$sleeve', '$pockets', '$neckline','$collar', '$others') ";
    // $query = "INSERT INTO styles VALUES ( 'NULL','$styleid','$season', '$brand', '$gender', '$category', '$product', '$pcmid', '$ean', '$image', '$mode',' $status','','','','','','','','','','','','') ";


    //  $quertna = "INSERT INTO tna VALUES ('NULL','$styleid','No Activity',NOW(),'NULL')";
    // $result = $conn->query($quertna);

    if (mysqli_query($conn, $query)) {
        $message = "Data Stored in a database successfully.";
    } else {
        $message = "ERROR: " . mysqli_error($conn) . "  Hush! Sorry.";
    }
    /*
    if (move_uploaded_file($tempname, $folder)) {
        $message = "Image uploaded successfully";
    } else {
        $message = "Failed to upload image";
    }
*/
    // Close connection
    mysqli_close($conn);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Styles</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/tailwind.min.css">
    <link rel="stylesheet" href="css/main.csss">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js" integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>

</head>

<body>
    <div class="wrapper bg-gray-100 min-h-screen ">
        <?php include('components/header.php'); ?>




        <div class="grid   ">
            <div class="flex justify-center">
                <div class="flex">
                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl mt-6 p-4 pt-6">Fill This Form To Add Styles</h1>
                </div>
            </div>


            <!-- Message component -->
            <?php if (isset($message)) { ?>
                <div class="flex flex-col justify-center items-center mx-auto my-2 w-1/3 p-4 bg-white shadow-md hover:shodow-lg rounded-2xl">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 rounded-2xl p-3  text-red-600 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="flex flex-col ml-3">
                                <div class="font-medium leading-none"><?php
                                                                        echo $message;
                                                                        ?></div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php  } ?>


            <div class=" flex bg-gray-100 items-center justify-center p-4 sm:py-12">
                <form method="post" enctype="multipart/form-data" action="" class="grid bg-white rounded-lg shadow-xl w-11/12 md:w-10/12 lg:w-10/12">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                        <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Season (required):</label>
                            <?php
                            $seasonOptions = array('SS21', 'AW21');
                            echo "<select  name='season'  class='py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent' id='season'>";
                            foreach ($seasonOptions as $option) {
                                echo "<option value='$option'>$option</option>";
                            }
                            echo "</select>";
                            ?>
                        </div>
                        <div class="grid grid-cols-1">
                            <label for="brands" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Brand (required):</label>

                            <?php
                            $brandOptions = array(
                                'USPA', 'GAP', 'Calvin Klein', 'Flying Machine', 'Aeropostale', 'Arrow', 'Ed Hardy',
                                'The Childrens Place', 'Sephora', 'True Blue', 'Unlimited', 'Ruf & Tuf', 'Stride', 'Guess', 'Cole Haan'
                            );
                            echo "<select id='brands' name='brands' class='py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent' >";
                            foreach ($brandOptions as $option) {
                                echo "<option value='$option'>$option</option>";
                            }
                            echo "</select>";
                            ?>


                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                        <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Gender</label>
                            <select name="gender" id="gender" class="py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                <?php "<option  value='$value' ></option>" ?>
                                <option value='' selected='selected'>Select Gender </option>
                            </select>
                        </div>
                        <div class=" grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Upload custom image here</label>
                            <div class="relative">
                                <div class="bg-red-300 rounded-xl hover:bg-red-light text-white font-bold py-2 px-8 w-full inline-flex justify-center  items-center">

                                    <input class="cursor-pointer mx-4 text-center text-black block " type="file" value="" name="imageName" id="image">

                                </div>

                            </div>
                        </div>

                    </div>

                    <div class=" grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                        <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Category:</label>
                            <select name="category" id="category" class="py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                <?php "<option  value='$value' ></option>" ?>
                                <option value='' disabled selected='selected'>Please select gender first</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Product:</label>
                            <select name="product" id="product" class="py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                <option value='' disabled selected='selected'>Please select category first</option>
                                <?php "<option  value='$value'></option>" ?>

                            </select>
                        </div>
                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                        <div class="grid grid-cols-1">
                            <label for="styleID" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Style ID (REQUIRED):</label>
                            <input required name="styleID" id="styleID" class="py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent" type="text" placeholder="Enter Style ID" />
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">PCM ID:</label>
                            <input name="pcmID" id="pcmID" class="py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent" type="text" placeholder="Enter PCM ID" />
                        </div>
                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                        <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">EAN (required):</label>
                            <input id="eanID" name="eanID" class="py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent" type="text" placeholder="EAN" required />
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Quantity(required):</label>
                            <input id="quantity" class="py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent" type="text" placeholder="Enter the Quantity" required />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                        <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Mode:</label>
                            <select id="mode" name="mode" class="py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                <option value="given">Given to Studio</option>
                                <option value="yetto">Yet to Recieve</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Style Status:</label>
                            <select id="status" name="status" class="py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                <option value="wip">Studio WIP</option>
                                <option value="nr">Not Recieved Yet</option>
                                <option value="cataloged">Cataloged</option>
                            </select>
                        </div>
                    </div>

                    <!-- Style Attributes -->

                    <fieldset class="grid grid-cols-1 mt-5 mx-7">
                        <legend class="uppercase md:text-md text-s text-gray-600 text-light font-semibold">Style Attributes</legend>
                        <p class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"> Enter the style attributes here: </p>
                        <div class="grid md:grid-cols-2 justify-center items-center md:grid-cols-2 gap-5 md:gap-6 mt-5 mx-7">
                            <div class="related grid md:grid-cols-2 gap-4">
                                <div class="mt-1 mb-1 table-row-group ">
                                    <label for="fit" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Fit (required):</label>
                                    <select required name="fit" id="fit" class="w-full py-2 table-row px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                        <?php "<option  value='$fit' ></option>" ?>
                                        <option value='' disabled selected='selected'>Select Fit </option>
                                        <option value='Slim Fit'>Slim Fit </option>
                                        <option value='Regular fit'>Regular Fit </option>
                                        <option value='Straight fit'>Straight Fit </option>
                                        <option value='Skinny fit'>Skinny Fit </option>
                                        <option value='Standard fit'>Standard Fit </option>
                                        <option value='Super Slim fit'>Super Slim Fit </option>
                                        <option value='Tailored fit'> Tailored Fit</option>
                                        <option value='Relaxed Fit(36)'>Relaxed Fit(36) </option>
                                        <option value='Easy Fit(23)'>Easy Fit(23) </option>
                                        <option value='Regular fit'>Regular Fit </option>
                                        <option value='Slightly Relaxed Fit(11)'>Slightly Relaxed Fit(11)</option>
                                        <option value='Fitted(10)'>Fitted(10) </option>
                                        <option value='Regular(4)'>Regular(4) </option>
                                        <option value='Boxy Fit(3)'> Boxy Fit(3)</option>
                                        <option value='Loose Fit(2)'>Loose Fit(2)</option>
                                        <option value='Bodycon Fit(1)'>Bodycon Fit(1) </option>
                                        <option value='Boyfriend Fit'>Boyfriend Fit </option>
                                        <option value='N/A'>N/A </option>
                                    </select>
                                </div>
                                <div class="mt-1 mb-1 table-row-group">
                                    <label for="pattern" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Pattern (required):</label>
                                    <select required name="pattern" id="pattern" class="table-row w-full py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                        <?php "<option  value='$pattern' ></option>" ?>
                                        <option value='' disabled selected='selected'>Select Pattern </option>
                                        <option value='Checked(2985)'>Checked(2985)</option>
                                        <option value='Printed(1797)'>Printed(1797)</option>
                                        <option value='Solid(1396)'>Solid(1396) </option>
                                        <option value='Striped(802)'>Striped(802) </option>
                                        <option value='Patterned Weave(412)'>Patterned Weave(412) </option>
                                        <option value='Washed(143)'>Washed(143) </option>
                                        <option value='Heathered(79)'> Heathered(79)</option>
                                        <option value='Textured(33)'>Textured(33) </option>
                                        <option value='Colour Blocked(15)'>Colour Blocked(15) </option>
                                        <option value='Dyed(18)'>Dyed(18) </option>
                                        <option value='Patterned Knit(8)'>Patterned Knit(8)</option>
                                        <option value='N/A'>N/A </option>
                                    </select>
                                </div>
                                <div class="mt-1 mb-1">
                                    <label for="closure" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Closure (required):</label>
                                    <select required name="closure" id="closure" class=" w-full py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                        <?php "<option  value='$closure' ></option>" ?>
                                        <option value='' disabled selected='selected'>Select Closure </option>
                                        <option value='Zipper'>Zipper </option>
                                        <option value='Button'>Button </option>
                                        <option value='N/A'>N/A </option>

                                    </select>
                                </div>
                                <div class="mt-1 mb-1">
                                    <label for="length" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Length (required):</label>
                                    <select required name="length" id="length" class="w-full py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                        <?php "<option  value='$length' ></option>" ?>
                                        <option value='' disabled selected='selected'>Select Length </option>
                                        <option value='Full Length(3544)'>Full Length(3544) </option>
                                        <option value='Below Knee Length(1)'>Below Knee Length(1) </option>
                                        <option value='Ankle Length(122)'> Ankle Length(122) </option>
                                        <option value='N/A'>N/A </option>
                                    </select>
                                </div>
                                <div class="mt-1 mb-1">
                                    <label for="color" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Color (required):</label>
                                    <select required name="color" id="color" class="w-full py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                        <?php "<option  value='$color' ></option>" ?>
                                        <option value='' disabled selected='selected'>Select Color </option>
                                        <option value='White(1008)'>White(1008) </option>
                                        <option value='Blue(910)'>Blue(910) </option>
                                        <option value='Pink(665)'>Pink(665) </option>
                                        <option value='Black(623)'>Black(623) </option>
                                        <option value='Red(380)'>Red(380) </option>
                                        <option value='Grey(357)'>Grey(357) </option>
                                        <option value='Green(290)'>Green(290) </option>
                                        <option value='Yellow(260)'>Yellow(260) </option>
                                        <option value='Orange(123)'>Orange(123) </option>
                                        <option value='Purple(85)'>Purple(85) </option>
                                        <option value='Beige(79'>Beige(79 </option>
                                        <option value='Brown(36)'>Brown(36) </option>
                                        <option value='Multi-Colour(72)'>Multi-Colour(72) </option>
                                        <option value='Assorted(5)'>Assorted(5) </option>
                                        <option value='N/A'>N/A </option>
                                    </select>
                                </div>
                                <div class="mt-1 mb-1 table-row-group">
                                    <label for="occassion" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Occassion (required):</label>
                                    <select required name="occassion" id="occassion" class="w-full table-row py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                        <?php "<option  value='$occassion' ></option>" ?>
                                        <option value='' disabled selected='selected'>Select Occassion </option>
                                        <option value='Casual(4748)'>Casual(4748) </option>
                                        <option value='Sport(78)'>Sport(78) </option>
                                        <option value='Smart Casual(12)'>Smart Casual(12) </option>
                                        <option value='Work(10)'>Work(10) </option>
                                        <option value='Party(5)'>Party(5) </option>
                                        <option value='Festive'>Festive </option>
                                        <option value='N/A'>N/A </option>
                                    </select>
                                </div>
                            </div>

                            <div class="related grid md:grid-cols-2 gap-4">
                                <div class="mt-1  mb-1 table-row-group">
                                    <label for="style" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Style (required):</label>
                                    <select required name="style" id="style" class="w-full table-row py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                        <?php "<option  value='$style' ></option>" ?>
                                        <option value='' disabled selected='selected'>Select Style </option>
                                        <option value='T-Shirt(1552)'>T-Shirt(1552) </option>
                                        <option value='Boxy Top(279)'>Boxy Top(279) </option>
                                        <option value='Tank Top(223)'>Tank Top(223) </option>
                                        <option value='Off-Shoulder Top(105)'>Off-Shoulder Top(105) </option>
                                        <option value='Peasant Top(68)'>Peasant Top(68) </option>
                                        <option value='Crop Top(62)'>Crop Top(62) </option>
                                        <option value='Blouson Top(61)'>Blouson Top(61) </option>
                                        <option value='Peplum Top(49)'>Peplum Top(49) </option>
                                        <option value='Racerback Top(37)'>Racerback Top(37) </option>
                                        <option value='Twofer Top(31)'>Twofer Top(31) </option>
                                        <option value='Swing Top(16)'>Swing Top(16) </option>
                                        <option value='Shirt(13)'>Shirt(13) </option>
                                        <option value='Spaghetti Top(12)'>Spaghetti Top(12) </option>
                                    </select>
                                </div>

                                <div class="mt-1 mb-1">
                                    <label for="material" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Material (required):</label>
                                    <select required name="material" id="material" class="w-full py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                        <?php "<option  value='$material' ></option>" ?>
                                        <option value='' disabled selected='selected'>Select Material </option>
                                        <option value='Cotton(3681)'>Cotton(3681) </option>
                                        <option value='Linen(328)'>Linen(328) </option>
                                        <option value='Rayon(39)'>Rayon(39) </option>
                                        <option value='Polyester(31)'>Polyester(31) </option>
                                        <option value='Modal(13)'>Modal(13) </option>
                                        <option value='Tencel(12)'>Tencel(12) </option>
                                        <option value='Viscose(11)'>Viscose(11)</option>
                                        <option value='Lyocell(7)'>Lyocell(7) </option>
                                    </select>
                                </div>
                                <div class="mt-1 mb-1">
                                    <label for="sleeve" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Sleeve (required):</label>
                                    <select required name="sleeve" id="sleeve" class="w-full table-row py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                        <?php "<option  value='$sleeve' ></option>" ?>
                                        <option value='' disabled selected='selected'>Select Sleeve Style</option>
                                        <option value='Long Sleeves(6814)'>Long Sleeves(6814) </option>
                                        <option value='Short Sleeves(881)'>Short Sleeves(881) </option>
                                        <option value='Sleeveless(638)'>Sleeveless(638) </option>
                                        <option value='Three-Quarter Sleeves(438)'>Three-Quarter Sleeves(438) </option>
                                        <option value='Bell Sleeves(183)'>Bell Sleeves(183) </option>
                                        <option value='Cap Sleeves(124)'>Cap Sleeves(124) </option>
                                        <option value='Flutter Sleeves(121)'>Flutter Sleeves(121) </option>
                                        <option value='Dolman Sleeves(71)'>Dolman Sleeves(71) </option>
                                        <option value='Elbow Sleeves(41)'>Elbow Sleeves(41) </option>
                                        <option value='Raglan Sleeves(40)'>Raglan Sleeves(40) </option>
                                        <option value='Puff Sleeves(31)'>Puff Sleeves(31) </option>
                                        <option value='Butterfly Sleeves(11)'>Butterfly Sleeves(11) </option>
                                        <option value='Others(11)'>Others(11) </option>
                                        <option value='Bishop Sleeves(10)'>Bishop Sleeves(10) </option>
                                    </select>
                                </div>
                                <div class="mt-1 mb-1">
                                    <label for="pockets" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Pockets (required):</label>
                                    <select required name="pockets" id="pockets" class="w-full table-row py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                        <?php "<option  value='$pockets' ></option>" ?>
                                        <option value='' disabled selected='selected'>Select Pockets </option>
                                        <option value='1'>1 </option>
                                        <option value='2'>2 </option>
                                        <option value='3'>3 </option>
                                        <option value='4'>4 </option>
                                        <option value='5'>5 </option>
                                        <option value='6'>6 </option>
                                        <option value='N/A'>N/A </option>
                                    </select>
                                </div>
                                <div class="mt-1  mb-1">
                                    <label for="nline" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Neckline (required):</label>
                                    <select required name="nline" id="nline" class="w-full table-row py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                        <?php "<option  value='$nline' ></option>" ?>
                                        <option value='' disabled selected='selected'>Select Neckline </option>
                                        <option value='Round Neck(3074)'>Round Neck(3074) </option>
                                        <option value='Crew Neck(494)'>Crew Neck(494) </option>
                                        <option value='V-Neck(391)'>V-Neck(391) </option>
                                        <option value='Scoop Neck(156)'>Scoop Neck(156) </option>
                                        <option value='Off-Shoulder(144)'>Off-Shoulder(144) </option>
                                        <option value='Band Neck(84)'>Band Neck(84) </option>
                                        <option value='Bateau Neck(52)'>Bateau Neck(52) </option>
                                        <option value='Square Neck(29)'>Square Neck(29) </option>
                                        <option value='Others(25)'>Others(25) </option>
                                        <option value='High Neck(20)'>Button </option>
                                        <option value='Pussy Bow(19)'>Pussy Bow(19) </option>
                                        <option value='Stand Neck(15)'>Stand Neck(15) </option>
                                        <option value='Turtleneck(14)'>Turtleneck(14) </option>
                                        <option value='U-Neck(15)'>U-Neck(15) </option>
                                        <option value='N/A'>N/A </option>
                                    </select>
                                </div>
                                <div class="mt-1  mb-1">
                                    <label for="collar" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Neckline (required):</label>
                                    <select required name="collar" id="collar" class="w-full table-row py-2 px-3 rounded-lg border-2 border-red-300 mt-1 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                        <?php "<option  value='$collar' ></option>" ?>
                                        <option value='' disabled selected='selected'>Select Collar Style </option>
                                        <option value=' Spread Collar(4141)'> Spread Collar(4141) </option>
                                        <option value='Button-Down Collar(1917)'>Button-Down Collar(1917) </option>
                                        <option value='Cutaway Collar(1129)'>Cutaway Collar(1129) </option>
                                        <option value='Forward Point Collar(123)'>Forward Point Collar(123) </option>
                                        <option value='Semi-Spread Collar(12)'>Semi-Spread Collar(12)</option>
                                        <option value='Others(10)'>Others(10) </option>
                                        <option value='Mock Collar(6)'>Mock Collar(6) </option>
                                        <option value='Hooded(5)'>Hooded(5) </option>
                                        <option value='Tall-Spread Collar(2)'>Tall-Spread Collar(2) </option>
                                        <option value='N/A'>N/A </option>
                                    </select>
                                </div>



                            </div>
                        </div>
                    </fieldset>


                    <div class="grid grid-cols-1 mt-5 mx-7">
                        <label for="others" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Other Specifications</label>
                        <input id="others" name="others" class=" py-2 px-3 h-12 rounded-lg border-2 border-red-300 mt-2 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent" type="text" placeholder="Enter Other Specifications" />
                    </div>
                    <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-8'>
                        <button type="reset" name="reset" id="reset" value="Reset" class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Reset</button>
                        <button type="submit" name="submit" id="submit" value="Submit" class='w-auto bg-red-500 hover:bg-red-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

<script>
    var genderObject = {
        "Women": {
            "Topwear": ["Tops", "T-shirts", "Kurtas", "Shirts", "Dresses & Jumpsuits", "Jackets", "Sweatshirts", "Tunics", "Sweaters"],
            "Bottomwear": ["Jeans", "Jeggings", "Track Pants", "Skirts", "Shorts", "Trousers"],
            "Ethnic wear": ["Kurtas", "Ethnic Bottoms", "Duppattas & Stoles"],
            "Innerwear": ["Panties", "Bra"],
            "Footwear": ["Sandals", "Sneakers", "Belly Shoes"],
            "Accessories": ["Belts & Wallets", "Sunglasses & Watches", "Bags & Backpacks", "Face Mask", "Deodrants"],
            "Beauty": ["Makeup", "Skincare", "Hair care", "Bath & Body", "Fragrances", "Tools & Brushes"]
        },
        "Men": {
            "Topwear": ["T-shirts", "Casual Shirts", "Formal Shirts", "Suits & Blazers", "Jackets", "Sweatshirts", "Sweaters"],
            "Bottomwear": ["Jeans", "Chinos", "Track Pants", "Casual Trousers", "Shorts", "Formal Trousers"],
            "Innerwear": ["Briefs", "Trunks", "Vests"],
            "Footwear": ["Formal Shoes", "Casual Shoes", "Sneakers", "Loafers", "Sandals", "Flip-Flops"],
            "Accessories": ["Belts & Wallets", "Sunglasses & Watches", "Bags & Backpacks", "Face Mask", "Deodrants"],
            "Beauty": ["Makeup", "Skincare", "Hair care", "Bath & Body", "Fragrances", "Tools & Brushes", "Grooming"]
        },
    }

    window.onload = function() {
        var genderSel = document.getElementById("gender");
        var categorySel = document.getElementById("category");
        var productSel = document.getElementById("product");
        for (var x in genderObject) {
            genderSel.options[genderSel.options.length] = new Option(x, x);
        }
        genderSel.onchange = function() {
            //empty Chapters- and Topics- dropdowns
            categorySel.length = 1;
            productSel.length = 1;
            //display correct values
            for (var y in genderObject[this.value]) {
                categorySel.options[categorySel.options.length] = new Option(y, y);
            }
        }
        categorySel.onchange = function() {
            //empty Chapters dropdown
            productSel.length = 1;
            //display correct values
            var z = genderObject[genderSel.value][this.value];
            for (var i = 0; i < z.length; i++) {
                productSel.options[productSel.options.length] = new Option(z[i], z[i]);
            }
        }
    }
</script>


</html>