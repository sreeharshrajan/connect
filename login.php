<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('components/config.php');
//$db = new mysqli('localhost', 'root', '', 'roja');
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    //  $query = "SELECT email,password FROM users WHERE email=".$email." and password=".$password;
    // $query = "SELECT id, email,password FROM users";
    //    $result = $db->query($query);

    $sql = $conn->prepare("SELECT id,name,email,password FROM users WHERE email=? and password=? ");
    $sql->bind_param('ss', $email, $password);
    $sql->execute();
    $sql->bind_result($id, $name, $email, $password);
    $result = $sql->fetch();
    $sql->close();
    $_SESSION['id'] = $id;
    $_SESSION['login'] = $email;
    $uip = $_SERVER['REMOTE_ADDR'];
    $ldate = date('d/m/Y h:i:s', time());
    if ($result) {

        $uid = $_SESSION['id'];
        $uemail = $_SESSION['login'];
        $_SESSION['login_user'] = $uemail;
        $ip = $_SERVER['REMOTE_ADDR'];
        $geopluginURL = 'http://www.geoplugin.net/php.gp?ip=' . $ip;
        $addrDetailsArr = unserialize(file_get_contents($geopluginURL));
        $city = $addrDetailsArr['geoplugin_city'];
        $country = $addrDetailsArr['geoplugin_countryName'];
        $log = "insert into userLog(uId,userEmail,userIp,city,country) values('$uid','$uemail','$ip','$city','$country')";
        $conn->query($log);
        if ($log) {

            header("location:viewStyles.php");
        }
    } else {
        $message = "Invalid Username/Email or Password";
    }

    /* 
    if ($result) {
        echo "<script>alert(' Succssfully Loggedin');</script>";
    } else {
        echo "<script>alert(' Wrong Credentials');</script>";
    }
    */
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Final Project</title>
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">

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

<body class="body-bg flex flex-col h-screen pt-6 md:pt-10 pb-6 px-2 md:px-0" style="font-family:'Lato',sans-serif;">
    <header class="max-w-lg mb-10 h-10 mx-auto">
        <div class="mb-5">
            <a href="#">
                <h1 class="text-4xl font-bold text-white text-center">.connect</h1>
            </a>
        </div>
        <div class="flex justify-center space-x-10 hidden sm:block">
            <a href="index.php" class="text-white font-semibold hover:text-yellow-400 text-lg">Home</a>
            <a href="login.php" class="font-semibold text-lg text-yellow-400">Login</a>
            <a href="register.php" class="text-white font-semibold text-lg hover:text-yellow-400">Register</a>
        </div>
    </header>

    <div class="py-6 sm:py-10 ">
        <div class="relative py-2 sm:max-w-xl sm:mx-auto">

            <?php

            if (isset($message)) {

            ?>
                <div class="flex flex-col justify-center items-center mx-auto my-2 w-3/4 mb-8 p-4 bg-white shadow-md hover:shodow-lg rounded-2xl">
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

            <div class="bg-white max-w-lg mx-auto p-8 md:p-12 my-10 shadow-2xl relative px-4 py-8 bg-white sm:p-10  px-2 sm:rounded-3xl">
                <div class="max-w-md mx-auto">
                    <div class="mb-8 text-center">
                        <h1 class=" text-2xl font-bold">Login</h1>
                        <p class="text-gray-600 pt-2">Sign in to your account.</p>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <form method="post" action="" name="signup" class="form-horizontal space-y-5" onSubmit="return valid();">
                            <div>
                                <label class="block mb-1 font-medium text-gray-500">E-mail</label>
                                <input type="text" name="email" id="email" class="w-full border-2 border-red-200 p-3 rounded outline-none focus:border-red-500">
                            </div>
                            <div>
                                <label class="block mb-1 font-medium text-gray-500">Password</label>
                                <input type="password" name="password" id="password" class="w-full border-2 border-red-200 p-3 rounded outline-none focus:border-red-500">
                            </div>

                            <button name="login" id="login" type="submit" class="block w-full bg-red-400 hover:bg-red-500 p-4 rounded text-red-900 hover:text-white font-bold shadow-lg hover:shadow-xl transition duration-200 ">Login</button>


                        </form>
                    </div>
                </div>
            </div>

            <div class="justify-center text-center text-yellow-400 mt-6">
                <a class="no-underline font-bold border-b border-yellow-400 text-yellow-300" href="register.php">
                    Create an Account!
                </a>
            </div>
        </div>
</body>



</html>