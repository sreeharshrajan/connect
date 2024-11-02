<?php
session_start();
include('components/config.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connect</title>
    <meta name="description" content="A DBMS Application to Manage TNA by Roja Jayaram">
    <meta name="keywords" content="connect,time and action calender">

    <script type='text/javascript' src='/scripts/jquery-3.6.0.min.js'></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/tailwind.min.css">
    <link rel="stylesheet" href="css/main.csss">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js" integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>

    <style>
        .body-bg {
            background: #D31027;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to left, #EA384D, #D31027);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to left, #EA384D, #D31027);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }
    </style>
</head>

<body class="body-bg flex flex-col h-screen justify-between pt-6 md:pt-10 pb-6 px-2 md:px-0" style="font-family:'Lato',sans-serif;">
    <header class="max-w-lg mb-10 h-10 mx-auto">
        <div class="mb-5">
            <a href="#">
                <h1 class="text-4xl font-bold text-white text-center">.connect</h1>
            </a>
        </div>
        <div class="flex justify-center space-x-10 hidden sm:block">
            <a href="index.php" class="text-yellow-400 font-semibold text-lg">Home</a>
            <a href="login.php" class="text-white font-semibold text-lg hover:text-yellow-400">Login</a>
            <a href="register.php" class="text-white font-semibold text-lg hover:text-yellow-400">Register</a>
        </div>
    </header>


    <section class=" px-12 sm:px-24 flex items-center relative">
        <?php

        include("components/banner.php");
        ?>
    </section>


    <footer class="max-w-full h-10  mx-auto flex justify-center text-white">
        <a href="#" class="hover:underline">Time and Action Calender Management System by Roja Jayaram</a>
        <span class="mx-3">•</span>
        <p> 2020-2021 </p>
    </footer>

</body>

</html>