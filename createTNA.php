<?php

include('components/config.php');

$check = (isset($_GET['check'])) ? $_GET['check'] : array();
$total = count($check);
$i = 0;


/*
if ($i == $total) {
    $data = ['message' => "No Styles Selected"];
    extract($data);
    require 'viewStyles.php';
    header("location:viewStyles.php");
    exit;
}
*/
?>





<!DOCTYPE html>
<html>

<head>
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/tailwind.min.css">
    <link rel="stylesheet" href="styles/main.css">
</head>

<body>
    <?php

    ?>



    <div class="flex justify-center min-h-screen items-center bg-gray-100 antialiased">
        <div class="w-full lg:w-3/5">
            <div class="flex justify-center">
                <div class="text-center">
                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl p-4 pt-6"> Create Time and Action for Selected Styles</h1>
                    <?php
                    ?>
                    <p class="text-sm "> Selected Style IDs :
                        <?php // while ($i < sizeof($check))   $i++;
                        for ($i = 0; $i < sizeof($check); $i++) {
                            //  echo " " . $check[$i];
                            $a = $check[$i];
                            echo " " . $a;
                        } ?>
                    </p>

                    <?php
                    ?>

                </div>
            </div>
            <?php

            if (isset($_POST['update'])) {

                $brandStyle = $_POST['brandStyle'];
                $brandMasters = $_POST['brandMasters'];
                $merchStory = $_POST['merchStory'];
                $PCMupload  = $_POST['PCMupload'];
                $samplesBinned  = $_POST['samplesBinned'];
                $shootsDone = $_POST['shootsDone'];
                $editing = $_POST['editing'];
                $visualQC = $_POST['visualQC'];
                $content = $_POST['content'];
                $finalQC = $_POST['finalQC'];
                $liveStyle = $_POST['liveStyle'];
                $binID = $_POST['binID'];

                //  $query =  "INSERT INTO activitybin  VALUES ('','$binID', '$styleID', '$brandStyle', '$brandMasters','$merchStory','$PCMupload','$samplesBinned' ,'$shootsDone','$editing','$visualQC','$content','$finalQC','$liveStyle')";
                $query =  "INSERT INTO activitybin (entryNo,binID,styleID,brandStyle,brandMasters,merchStory,PCMupload,samplesBinned,shootsDone,editing,visualQC,content,finalQC,liveStyle) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

                $stmt = $conn->prepare($query);
                $entryNo = NULL;

                if ($stmt) {

                    for ($i = 0; $i < sizeof($check); $i++) {
                        $styleID = $check[$i];
                        $stmt->bind_param('isssssssssssss', $entryNo, $binID, $styleID, $brandStyle, $brandMasters, $merchStory, $PCMupload, $samplesBinned, $shootsDone, $editing, $visualQC, $content, $finalQC, $liveStyle);
                        $quertna = "INSERT INTO tna VALUES ('NULL', '$binID','$styleID','Brand Style Selection','$brandStyle','NULL')";
                        $quertna0 = "INSERT INTO tna VALUES ('NULL', '$binID','$styleID','Brand Online Masters','$brandMasters','NULL')";
                        $quertna1 = "INSERT INTO tna VALUES ('NULL', '$binID','$styleID','Merch Story Curation','$merchStory','NULL')";
                        $quertna2 = "INSERT INTO tna VALUES ('NULL', '$binID'','$styleID','PCM Upload','$PCMupload','NULL')";
                        $quertna3 = "INSERT INTO tna VALUES ('NULL', '$binID','$styleID','Samples are Binned','$samplesBinned','NULL')";
                        $quertna4 = "INSERT INTO tna VALUES ('NULL', '$binID','$styleID','Shoot done as per target','$shootsDone','NULL')";
                        $quertna5 = "INSERT INTO tna VALUES ('NULL', '$binID','$styleID','Editing','$editing','NULL')";
                        $quertna6 = "INSERT INTO tna VALUES ('NULL', '$binID','$styleID','Visual QC(VQC)','$visualQC','NULL')";
                        $quertna7 = "INSERT INTO tna VALUES ('NULL', '$binID','$styleID','Content','$content','NULL')";
                        $quertna8 = "INSERT INTO tna VALUES ('NULL', '$binID','$styleID','Final QC(FQC)','$finalQC','NULL')";
                        $quertna9 = "INSERT INTO tna VALUES ('NULL', '$binID','$styleID','Style Go Live','$liveStyle','NULL')";
                        $result = $conn->query($quertna);
                        $result0 = $conn->query($quertna0);
                        $result1 = $conn->query($quertna1);
                        $result2 = $conn->query($quertna2);
                        $result3 = $conn->query($quertna3);

                         $result4 = $conn->query($quertna4);
                         $result5 = $conn->query($quertna5);
                         $result6 = $conn->query($quertna6);
                         $result7 = $conn->query($quertna7);
                         $result8 = $conn->query($quertna8);
                         $result9 = $conn->query($quertna9);
/*  
                        mysqli_query($conn,$quertna);
                        mysqli_query($conn,$quertna0);
                        mysqli_query($conn,$quertna1);
                        mysqli_query($conn,$quertna2);
                        mysqli_query($conn,$quertna3);
                        mysqli_query($conn,$quertna4);
                        mysqli_query($conn,$quertna5);
                        mysqli_query($conn,$quertna6);
                        mysqli_query($conn,$quertna7);
                        mysqli_query($conn,$quertna8);
                        mysqli_query($conn,$quertna9);*/
                        $stmt->execute();
                    }
                    $stmt->close();
                }
                exit(header("location: viewStyles.php"));




                //$result = mysqli_query($conn, $query);
                /*   
                foreach ($_POST['check'] as $check) {
                    $styleID = $check[$i];
                    mysqli_query($conn, $query);
                    echo $query;
                    $i++;

                $mysqli->query($query);
                    $data = ['message' => "Style Successfully Updated"];
                    extract($data);
                    require 'viewStyles.php';
                    header("location:viewStyles.php");
              
               
                    $styleID = $check[$i];
                    $query =  "INSERT INTO activitybin (entryNo,binID,styleID,brandStyle,brandMasters,merchStory,PCMupload,samplesBinned,shootsDone,editing,visualQC,content,finalQC,liveStyle) VALUES 
                    ('NULL', '$binID', '$styleID', '$brandStyle', '$brandMasters','$merchStory','$PCMupload','$samplesBinned','$shootsDone','$editing','$visualQC','$content','$finalQC','$liveStyle')";
                    $result = mysqli_query($conn, $query);
                   
                    echo $query;
                    echo $result;
                    $i++;
                }
                 
                while ($i < sizeof($check)) {
                    echo $i;
                    foreach ($styleID as $check[$i]) {
                        $query =  "INSERT INTO activitybin VALUES ('NULL', $binID, $styleID, $brandStyle, $brandMasters,$merchStory,$PCMupload,$samplesBinned,$shootsDone,$editing,$visualQC,$content,$finalQC,$liveStyle)";
                        $result = mysqli_query($conn, $query);
                        mysqli_close($conn); // Close connection
                        $data = ['message' => "Style Successfully Updated"];
                        extract($data);
                        require 'viewStyles.php';
                        header("location:viewStyles.php");
                    }
                    $i++;
                } */
                mysqli_close($conn);
            }
            ?>

            <form method="POST" class="overflow-x-auto">
                <div class="bg-white shadow-lg rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead class="mb-10">
                            <tr class="bg-gray-200 text-gray-600 uppercase  leading-normal">
                                <th class="py-4 px-6 text-center">List of Tasks</th>
                                <th class="py-4 px-6  text-center">Assign Dates</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 font-light">
                            <tr class=" whitespace-nowrap">
                                <td class="py-2 px-10 mt-4  border-gray-200 text-left font-medium">
                                    Brand Style Selection
                                </td>
                                <td class="py-2 px-10 mt-4 text-right font-medium">
                                    <input class="py-2 px-6 bg-gray-100 border border-gray-200 rounded hover:shadow-lg appearance-none" type="date" name="brandStyle">
                                </td>
                            </tr>
                            <tr class="  whitespace-nowrap">
                                <td class="py-2 px-10   border-gray-200  text-left font-medium">
                                    Brand Online Masters
                                </td>
                                <td class="py-2 px-10 text-right font-medium">
                                    <input class="py-2 px-6 bg-gray-100 border border-gray-200 rounded hover:shadow-lg appearance-none" type="date" name="brandMasters">

                                </td>
                            </tr>
                            <tr class=" text-left whitespace-nowrap">
                                <td class="py-2 px-10   border-gray-200  font-medium">
                                    Merch Story Curation
                                </td>
                                <td class="py-2 px-10 text-right font-medium">
                                    <input class="py-2 px-6 bg-gray-100 border border-gray-200 rounded hover:shadow-lg appearance-none" type="date" name="merchStory">
                                </td>
                            </tr>
                            <tr class=" text-left whitespace-nowrap">
                                <td class="py-2 px-10   border-gray-200  items-left font-medium">
                                    PCM Upload
                                </td>
                                <td class="py-2 px-10 text-right font-medium">
                                    <input class="py-2 px-6 bg-gray-100 border border-gray-200 rounded hover:shadow-lg appearance-none" type="date" name="PCMupload">
                                </td>
                            </tr>
                            <tr class=" text-left whitespace-nowrap">
                                <td class="py-2 px-10   border-gray-200  items-left font-medium">
                                    Samples are Binned
                                </td>
                                <td class="py-2 px-10 text-right font-medium">
                                    <input class="py-2 px-6 bg-gray-100 border border-gray-200 rounded hover:shadow-lg appearance-none" type="date" name="samplesBinned">
                                </td>
                            </tr>
                            <tr class=" text-left whitespace-nowrap">
                                <td class="py-2 px-10   border-gray-200  items-left font-medium">
                                    Shoot done as per target
                                </td>
                                <td class="py-2 px-10 text-right font-medium">
                                    <input class="py-2 px-6 bg-gray-100 border border-gray-200 rounded hover:shadow-lg appearance-none" type="date" name="shootsDone">

                                </td>
                            </tr>
                            <tr class=" text-left whitespace-nowrap">
                                <td class="py-2 px-10   border-gray-200  items-left font-medium">
                                    Editing
                                </td>
                                <td class="py-2 px-10 text-right font-medium">
                                    <input class="py-2 px-6 bg-gray-100 border border-gray-200 rounded hover:shadow-lg appearance-none" type="date" name="editing">

                                </td>
                            </tr>
                            <tr class=" text-left whitespace-nowrap">
                                <td class="py-2 px-10   border-gray-200  items-left font-medium">
                                    Visual QC(VQC)
                                </td>
                                <td class="py-2 px-10 text-right font-medium">
                                    <input class="py-2 px-6 bg-gray-100 border border-gray-200 rounded hover:shadow-lg appearance-none" type="date" name="visualQC">

                                </td>
                            </tr>
                            <tr class=" text-left whitespace-nowrap">
                                <td class="py-2 px-10   border-gray-200  items-left font-medium">
                                    Content
                                </td>
                                <td class="py-2 px-10 text-right font-medium">
                                    <input class="py-2 px-6 bg-gray-100 border border-gray-200 rounded hover:shadow-lg appearance-none" type="date" name="content">

                                </td>
                            </tr>
                            <tr class=" text-left whitespace-nowrap">
                                <td class="py-2 px-10   border-gray-200  items-left font-medium">
                                    Final QC(FQC)
                                </td>
                                <td class="py-2 px-10 text-right font-medium">
                                    <input class="py-2 px-6 bg-gray-100 border border-gray-200 rounded hover:shadow-lg appearance-none" type="date" name="finalQC">

                                </td>
                            </tr>
                            <tr class="pb-6 border-b  text-left whitespace-nowrap">
                                <td class="py-2 px-10 pb-6 border-b    border-gray-200  items-left font-medium">
                                    Style Go Live
                                </td>
                                <td class="py-2 px-10 pb-6 border-b  text-right font-medium">
                                    <input class="py-2 px-6 bg-gray-100 border border-gray-200 rounded hover:shadow-lg appearance-none" type="date" name="liveStyle">

                                </td>
                            </tr>

                        </tbody>

                    </table>
                    <div class="flex flex-row items-center justify-between py-6 px-12 items-right ">

                        <a href="<?php echo "viewStyles.php" ?>" class="font-semibold text-gray-600">Cancel</a>
                        <div class="">
                            <label for="binID" class="py-2 items-left font-medium">
                                Enter Bin ID<span class="text-red-500">* </span>
                            </label>
                            <input class="py-2  bg-gray-100 border border-gray-200 rounded appearance-none" type="text" name="binID" required>

                        </div>
                        <div class='flex items-center justify-center  md:gap-8 gap-4'>
                            <button type="reset" name="reset" id="reset" value="Reset" class='w-auto bg-gray-500 hover:bg-gray-700 rounded shadow-xl font-medium text-white px-4 py-2'>Reset</button>
                            <button type="submit" class="px-4 py-2 text-white font-semibold bg-red-500 rounded" name="update" value="Update">
                                Save
                            </button>
                        </div>


                    </div>
                </div>

        </div>
        <?php
        ?>
    </div>

    </form>
</body>

<?php  ?>

</html>