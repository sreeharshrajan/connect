<?php
include('components/sessions.php');
include('components/config.php');

if (isset($_POST['delALL'])) {
    $checkbox = $_POST['check'];
    for ($i = 0; $i < count($checkbox); $i++) {
        $del_id = $checkbox[$i];
        mysqli_query($conn, "DELETE FROM styles WHERE serialno = '" . $del_id . "'");
        $message = "Data deleted successfully !";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Style Attributes</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/tailwind.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js" integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>
</head>

<body>

    <div class="wrapper bg-gray-100 min-h-screen overflow-hidden ">
        <?php include('components/header.php'); ?>
        <div class="px-4 flex bg-gray-100 items-center justify-center  sm:py-12">
            <div class="grid  rounded-lg ">
                <div class="flex justify-center">
                    <div class="flex">
                        <h1 class="text-gray-600 font-bold md:text-2xl text-xl p-4 pt-6"> Saved Style Attributes</h1>
                    </div>
                </div>


                <!-- Message component -->
                <?php
                if (isset($message)) {
                ?>
                    <div class="flex flex-col justify-center text-center mx-auto my-2 w-1/3 p-4 bg-white shadow-md hover:shodow-lg rounded-2xl">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 rounded-2xl p-3  text-red-600 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="flex flex-col ml-5 mx-3">
                                    <div class="font-medium text-center items-center align-center leading-none">
                                        <?php echo $message; ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php  } ?>
                <form id="editForm" class="bg-white mt-4 shadow-lg rounded-xl overflow-auto" method="post" onSubmit="return delete_confirm();">
                    <table id="tableID" class="table flex flex-col flex-no-wrap table-auto w-full leading-normal">
                        <thead class="uppercase text-xs font-semibold text-gray-600 bg-gray-200">
                            <tr class="hidden md:table-row ">
                                <th class="text-center  px-6 py-4">
                                    <p>Style ID</p>
                                </th>
                                <th class="text-center px-6 py-4">
                                    <p>Fit</p>
                                </th>
                                <th class="text-center px-5 py-4">
                                    <p>Pattern</p>
                                </th>
                                <th class="text-center px-5 py-4">
                                    <p>Closure</p>
                                </th>
                                <th class="text-center px-5 py-4">
                                    <p>Length</p>
                                </th>
                                <th class="text-right px-5 py-2">
                                    <p>Color</p>
                                </th>
                                <th class="text-center px-5 py-4">
                                    <p>Occassion</p>
                                </th>
                                <th class="text-center px-5 py-4">
                                    <p>Style</p>
                                </th>
                                <th class="text-center px-5 py-4">
                                    <p>Material</p>
                                </th>
                                <th class="text-center px-5 py-4">
                                    <p>Sleeve</p>
                                </th>
                                <th class="text-center px-5 py-4">
                                    <p>Pocket</p>
                                </th>
                                <th class="text-center px-5 py-4">
                                    <p>Neckline</p>
                                </th>
                                <th class="text-center px-5 py-4">
                                    <p>Collar</p>
                                </th>
                                <th class="text-center px-5 py-4">
                                    <p>Others</p>
                                </th>
                                <th class="text-center px-5 py-4">
                                    <p>Actions</p>
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="flex-1 sm:flex-none">

                            <?php

                            if (isset($_GET['pageno'])) {
                                $pageno = $_GET['pageno'];
                            } else {
                                $pageno = 1;
                            }

                            $limit = 5;
                            $offset = ($pageno - 1) * $limit;

                            $countQuery = "SELECT COUNT(*) FROM styles";
                            $rs_result = mysqli_query($conn, $countQuery);
                            $rowNos = mysqli_fetch_row($rs_result);
                            $totalRecords = $rowNos[0];
                            $total_pages = ceil($totalRecords / $limit);

                            $sql = "SELECT * FROM styles ORDER BY serialNo ASC LIMIT $offset, $limit";

                            $result = mysqli_query($conn, $sql);

                            // $result = mysqli_query($db, "SELECT * FROM styles ORDER BY serialNo ASC");
                            while ($row = mysqli_fetch_array($result)) {

                            ?>


                                <tr class="flex p-2 text-s hover:bg-gray-100 md:table-row flex-col flex-no-wrap  border-b border-gray-200">
                                    <td class="p-2 py-6 md:text-center">
                                        <p class="text-gray-900 whitespace-no-wrap"><?php echo $row['styleid']; ?> </p>
                                    </td>
                                    <td class="p-2 md:text-center">
                                        <p class="text-gray-900 whitespace-no-wrap"> <?php echo $row['fit']; ?></p>
                                    </td>
                                    <td class="p-2 md:text-center">
                                        <div class="text-gray-900 whitespace-no-wrap"> <?php echo $row['pattern']; ?></div>
                                    </td>

                                    <td class="p-2 md:text-center">
                                        <div class="text-gray-900 whitespace-no-wrap"> <?php echo $row['closure']; ?> </div>
                                    </td>
                                    <td class="p-2 md:text-center">
                                        <div class="text-gray-900 whitespace-no-wrap"> <?php echo $row['length']; ?> </div>
                                    </td>
                                    <td class="p-2 md:text-center">
                                        <div class="text-gray-900 whitespace-no-wrap"> <?php echo $row['color']; ?></div>
                                    </td>
                                    <td class="p-2">
                                        <p class="text-gray-900 whitespace-no-wrap"> <?php echo $row['occassion']; ?></p>
                                    </td>
                                    <td class="p-2">
                                        <p class="text-gray-900 whitespace-no-wrap"><?php echo $row['style']; ?> </p>
                                    </td>
                                    <td class="p-2 md:text-center">
                                        <div> <?php echo $row['material']; ?></div>
                                    </td>
                                    <td class="px-5 py-5 p-2">
                                        <p class="text-gray-900 whitespace-no-wrap"><?php echo $row['sleeve']; ?> </p>
                                    </td>
                                    <td class="p-2 md:text-center">
                                        <div><?php echo $row['pockets']; ?> </div>
                                    </td>
                                    <td class="p-2 md:text-center">
                                        <div><?php echo $row['neckline']; ?></div>
                                    </td>
                                    <td class="p-2 md:text-center">
                                        <div><?php echo $row['collar']; ?></div>
                                    </td>
                                    <td class="p-2 md:text-center">
                                        <div><?php echo $row['others']; ?></div>
                                    </td>

                                    <td class="p-2 inline-block md:text-center">
                                        <span class="relative inline-block px-3 py-1 font-semibold hover:text-white  leading-tight">
                                            <input type="checkbox" class="checkbox" id="checkItem" name="check[]" value="<?php echo $row["serialNo"]; ?>">

                                        </span>

                                        <span onclick="" class="relative rounded-full mt-3 inline-block font-semibold bg-green-200 hover:text-white hover:bg-green-500 inline-block px-3 mx-3 py-1 leading-tight">
                                            <a href="editAttributes.php?id=<?php echo $row['serialNo']; ?>" class=" inset-0 text-black-600 ">Edit</a>

                                        </span>

                                        <span onclick="return confirm('Do you want to delete');" class="relative  mt-3 mb-3 rounded-full bg-red-200 hover:text-white hover:bg-red-500 inline-block px-3 mx-3 py-1 font-semibold  leading-tight">
                                            <a href="delAttributes.php?id=<?php echo $row['serialNo']; ?>" class="text-black-600 inset-0 ">Delete </a>
                                        </span>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>

                        <div>

                    </table>
                    <div class="grid grid-cols-2  w-full text-right justify-between m-4 px-8 py-4">

                        <div class="group flex text-left justify-between">
                            <ul class="flex list-reset border border-black-100 rounded w-auto">
                                <li>
                                    <a class="<?php if ($pageno <= 1) {
                                                    echo 'javascript:void(0)';
                                                } ?> block hover:text-white hover:bg-red-400 border-r border-black-100 px-3 py-2" href="<?php if ($pageno <= 1) {
                                                                                                                                            echo '#';
                                                                                                                                        } else {
                                                                                                                                            echo "?pageno=" . ($pageno - 1);
                                                                                                                                        } ?>">Previous
                                    </a>
                                </li>
                                <li>
                                    <a class="<?php if ($pageno >= $total_pages) {
                                                    echo 'hide';
                                                } ?> block hover:text-white hover:bg-red-400 px-3 py-2 " href="<?php if ($pageno >= $total_pages) {
                                                                                                                    echo '#';
                                                                                                                } else {
                                                                                                                    echo "?pageno=" . ($pageno + 1);
                                                                                                                } ?>">Next</a>
                                </li>
                            </ul>
                        </div>
                        <div class="group items-right  justify-between">
                            <div class="relative rounded-full inline-block px-3 py-1  bg-gray-200 leading-tight">
                                <label for="checkALL">Select All</label>
                                <input class="checkALL" type="checkbox" id="checkALL">
                            </div>
                            <div class="relative rounded-full bg-red-200 hover:text-white hover:bg-red-500 inline-block px-3 mx-3 py-1 font-semibold  leading-tight">
                                <button type="submit" class="inset-0" name="delALL">Delete Selected</button>
                            </div>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>

    </div>
    </div>


</body>
<script>
    $(document).ready(function() {
        $("#editForm #checkALL").click(function() {
            $("#editForm input[type='checkbox']").prop('checked', this.checked);
        });

    });

    $('.table tbody tr').click(function(event) {
        var $target = $(event.target);
        if (!$target.is('input:checkbox')) {
            $(this).find('input:checkbox').each(function() {
                if (this.checked) this.checked = false;
                else this.checked = true;
            })
        }
    });

    function delete_confirm() {
        if ($('.checkbox:checked').length > 0) {
            var result = confirm("Are you sure to delete selected users?");
            if (result) {
                return true;
            } else {
                return false;
            }
        } else {
            alert('Select at least 1 record to delete.');
            return false;
        }
    }
</script>

</html>