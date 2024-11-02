<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include('components/config.php');

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    if ($password != $cpassword) {
        $message = "The two passwords do not match";
    } else {
        $query = "INSERT INTO users VALUES('NULL','$name','$email','$password')";
        if (mysqli_query($conn, $query)) {
            $message = " User Succssfully Registered";
            header("location: login.php");
        } else {
            $message = " User already registered ";
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up | Connect</title>
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
            <a href="login.php" class="font-semibold text-white text-lg hover:text-yellow-400">Login</a>
            <a href="register.php" class="font-semibold text-lg text-yellow-400">Register</a>
        </div>
    </header>

    <div class="container mx-auto sm:py-6">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto">
            <?php if (isset($message)) { ?>
                <div class="flex flex-col justify-center items-center mx-auto my-2 w-1/2 mb-8 p-4 bg-white shadow-md hover:shodow-lg rounded-2xl">
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

            <div class=" px-2 bg-white shadow-lg sm:rounded-3xl sm:p-10">


                <div class="max-w-md mx-auto">
                    <div class="mb-6 text-center">
                        <h1 class="text-2xl font-bold ">Sign up</h1>
                        <p class="text-gray-600 pt-2">Fill the form to register your account.</p>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <form method="post" action="" name="signup" class="space-y-5 form-horizontal" onSubmit="">

                            <div class="form-group">
                                <label class="block mb-1 font-bold text-gray-500">Name <span class="text-red-500">* </span></label>
                                <input type="text" name="name" id="name" required="required" class="form-control w-full border-2 border-red-200 p-3 rounded outline-none focus:border-red-500">
                            </div>

                            <div class="form-group">
                                <label class="block mb-1 font-bold text-gray-500">E-mail <span class="text-red-500">* </span></label>
                                <input type="text" name="email" id="email" class="form-control w-full border-2 border-red-200 p-3 rounded outline-none focus:border-red-500">
                            </div>

                            <div class="form-group">
                                <label class="block mb-1 font-bold text-gray-500">Password <span class="text-red-500">* </span></label>
                                <input type="password" name="password" id="password" class="form-control w-full border-2 border-red-200 p-3 rounded outline-none focus:border-red-500">
                            </div>

                            <div class="form-group">
                                <label class="block mb-1 font-bold text-gray-500">Confirm Password <span class="text-red-500">* </span></label>
                                <input type="password" name="cpassword" id="cpassword" class="form-control w-full border-2 border-red-200 p-3 rounded outline-none focus:border-red-500">
                            </div>

                            <button class="block w-full bg-red-400 hover:bg-red-500 shadow-lg hover:shadow-xl p-4 rounded text-red-900 hover:text-red-800 transition duration-200 " name="submit" type="submit">Sign Up</button>

                            <div class="text-center text-sm text-grey-dark mt-4">
                                By signing up, you agree to the
                                <a class="no-underline border-b border-grey-dark text-blue-300" href="#">
                                    Terms of Service
                                </a> and
                                <a class="no-underline border-b border-grey-dark text-blue-300" href="#">
                                    Privacy Policy
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="justify-center text-center text-white mt-6">
                Already have an account?
                <a class="no-underline border-b border-yellow-400 text-yellow-300" href="login.php">
                    Log in
                </a>.
            </div>
        </div>
</body>

<script type="text/javascript">
    /*  function valid() {
        if (document.signup.password.value != document.signup.cpassword.value) {
            alert("Password and Re-Type Passwords Do not match  !!");
            document.registration.cpassword.focus();
            return false;
        }
        return true;
    } */
</script>

</html>