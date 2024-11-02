<?php
include('components/sessions.php');
include('components/config.php');
//$conn = new mysqli('localhost', 'root', '', 'roja');

if (isset($_POST['delALL'])) {
    $checkbox = $_POST['check'];
    for ($i = 0; $i < count($checkbox); $i++) {
        $del_id = $checkbox[$i];
        mysqli_query($conn, "DELETE FROM tna WHERE sNo = '" . $del_id . "'");
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
    <title>T&A Calender</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/tailwind.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js" integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper bg-gray-100 min-h-screen ">
        <?php include('components/header.php'); ?>

        <div class="grid flex bg-gray-100 items-center justify-center  sm:py-12">
            <div class="  ">
                <div class="flex justify-center">
                    <div class="flex">
                        <h1 class="text-gray-600 font-bold md:text-2xl text-xl p-4 pt-6"> Time and Action Calender</h1>
                    </div>
                </div>

                <!-- Message component -->
                <?php if (isset($message)) { ?>
                    <div class="flex flex-col notification justify-center items-center mx-auto my-2 w-2/4 p-4 bg-white shadow-md hover:shodow-lg rounded-2xl">
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


                <div class=" grid flex items-center ">

                    <form id="editForm" class="bg-white mt-4 shadow-lg rounded-xl overflow-hidden" method="post" onSubmit="return delete_confirm();">
                        <table class="table flex flex-col flex-no-wrap table-auto w-full leading-normal">
                            <thead class="uppercase text-xs font-bold text-gray-600 bg-gray-200 justify-center ">
                                <tr class="hidden md:table-row">
                                    <th class="px-10 py-4   text-center text-xs tracking-wider">
                                        Bin ID
                                    </th>
                                    <th class="px-10 py-4   text-center text-xs tracking-wider">
                                        Style ID
                                    </th>
                                    <th class="px-16 py-4   text-center text-xs tracking-wider">
                                        Activities
                                    </th>
                                    <th class="px-10 py-4 text-center text-xs tracking-wider">
                                        Planned Date
                                    </th>
                                    <th class="  px-10 py-4 text-center text-xs tracking-wider">
                                        Actual Date
                                    </th>
                                    <th class="px-10 py-4   text-center text-xs tracking-wider ">
                                        <p>Actions</p>
                                    </th>
                                </tr>
                            </thead>


                            <?php

                            if (isset($_GET['pageno'])) {
                                $pageno = $_GET['pageno'];
                            } else {
                                $pageno = 1;
                            }

                            $limit = 5;
                            $offset = ($pageno - 1) * $limit;

                            $countQuery = "SELECT COUNT(*) FROM tna";
                            $rs_result = mysqli_query($conn, $countQuery);
                            $rowNos = mysqli_fetch_row($rs_result);
                            $totalRecords = $rowNos[0];
                            $total_pages = ceil($totalRecords / $limit);

                            $sql = "SELECT * FROM tna ORDER BY sNo ASC LIMIT $offset, $limit";

                            $result = mysqli_query($conn, $sql);

                            // $result = mysqli_query($conn, "SELECT * FROM tna ORDER BY sNo ASC");
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <tbody>
                                    <tr class="flex px-5 py-5  text-s hover:bg-gray-100 md:table-row flex-col flex-no-wrap  border-b border-gray-200">
                                        <td class="px-16 py-5 text-center text-sm">
                                            <p class="text-gray-900 text-center whitespace-no-wrap">
                                                <?php echo $row['binID']; ?>
                                            </p>
                                        </td>
                                        <td class="px-16 py-5 text-center text-sm">
                                            <p class="text-gray-900 text-center whitespace-no-wrap">
                                                <?php echo $row['styleID']; ?>
                                            </p>
                                        </td>
                                        <td class="px-16 py-5 ">
                                            <p class="text-gray-900 whitespace-no-wrap"><?php echo $row['activity']; ?> </p>
                                        </td>
                                        <td class="px-10 py-5 ">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                <?php echo $row['pDate']; ?>
                                            </p>
                                        </td>
                                        <td class="px-10 py-5 ">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                <?php echo $row['aDate']; ?>
                                            </p>
                                        </td>

                                        <td class="px-16 justify-between py-5 ">

                                            <span class="relative inline-block px-4 py-1 font-semibold hover:text-white  leading-tight">
                                                <input type="checkbox" class="checkbox" id="checkItem" name="check[]" value="<?php echo $row["sNo"]; ?>">

                                            </span>

                                            <span class=" cursor-pointer relative rounded-full inline-block mx-2 px-4 py-1 font-semibold bg-green-200 hover:text-white hover:bg-green-500  justify-center">
                                                <a href="edita.php?id=<?php echo $row['sNo'] ?>" class="text-black-600 inset-0 ">Edit </a>
                                            </span>


                                            <span onclick="return confirm('Do you want to delete');" class="cursor-pointer relative mx-2 hover:text-white hover:bg-red-500 rounded-full bg-red-200 inline-block px-3 py-1 font-semibold justify-center">
                                                <a href="delta.php?id=<?php echo $row['sNo']; ?>" class="text-black-600 inset-0 ">Delete </a>
                                            </span>

                                        </td>
                                    </tr>
                                </tbody>
                            <?php } ?>
                        </table>


                        <div class="grid grid-cols-2  w-full text-right justify-between m-4 px-8 py-4">

                            <div class="group flex text-left justify-between">

                                <?php if (ceil($totalRecords / $limit) > 0) : ?>
                                    <ul class="pagination flex list-reset border border-black-100 rounded w-auto">
                                        <?php if ($pageno > 1) : ?>
                                            <li class="prev currentpage block hover:text-white hover:bg-red-400 px-3 py-2"><a href="?pageno=<?php echo $pageno - 1 ?>">Prev</a></li>
                                        <?php endif; ?>

                                        <?php if ($pageno > 3) : ?>
                                            <li class="start currentpage block hover:text-white hover:bg-red-400 px-3 py-2"><a href="?pageno=1">1</a></li>
                                            <li class="dots py-2">...</li>
                                        <?php endif; ?>

                                        <?php if ($pageno - 2 > 0) : ?><li class="page currentpage block hover:text-white hover:bg-red-400 px-3 py-2"><a href="?pageno=<?php echo $pageno - 2 ?>"><?php echo $pageno - 2 ?></a></li><?php endif; ?>
                                        <?php if ($pageno - 1 > 0) : ?><li class="page currentpage block hover:text-white hover:bg-red-400 px-3 py-2"><a href="?pageno=<?php echo $pageno - 1 ?>"><?php echo $pageno - 1 ?></a></li><?php endif; ?>

                                        <li class="currentpage currentpage block px-3 py-2"><a href="?pageno=<?php echo $pageno ?>"><?php echo $pageno ?></a></li>

                                        <?php if ($pageno + 1 < ceil($totalRecords / $limit) + 1) : ?><li class="page currentpage block hover:text-white hover:bg-red-400 px-3 py-2"><a href="?pageno=<?php echo $pageno + 1 ?>"><?php echo $pageno + 1 ?></a></li><?php endif; ?>
                                        <?php if ($pageno + 2 < ceil($totalRecords / $limit) + 1) : ?><li class="page currentpage block hover:text-white hover:bg-red-400 px-3 py-2"><a href="?pageno=<?php echo $pageno + 2 ?>"><?php echo $pageno + 2 ?></a></li><?php endif; ?>

                                        <?php if ($pageno < ceil($totalRecords / $limit) - 2) : ?>
                                            <li class="dots py-2">...</li>
                                            <li class="end currentpage block hover:text-white hover:bg-red-400 px-3 py-2"><a href="?pageno=<?php echo ceil($totalRecords / $limit) ?>"><?php echo ceil($totalRecords / $limit) ?></a></li>
                                        <?php endif; ?>

                                        <?php if ($pageno < ceil($totalRecords / $limit)) : ?>
                                            <li class="next currentpage block hover:text-white hover:bg-red-400 px-3 py-2"><a href="?pageno=<?php echo $pageno + 1 ?>">Next</a></li>
                                        <?php endif; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>

                            <div class="group items-right  justify-between">
                                <div class="relative rounded-full inline-block  px-4 mx-3 py-2 bg-gray-200 leading-tight">
                                    <label for="checkALL">Select All</label>
                                    <input class="checkALL" type="checkbox" id="checkALL">
                                </div>

                                <div class="relative rounded-full bg-red-200 hover:text-white hover:bg-red-500 inline-block px-4 mx-3 py-2 font-semibold  leading-tight">
                                    <button type="submit" class="inset-0" name="delALL">Delete Selected</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
</script>

</html>