<?php 
//$id = $_GET['id'];
//$dbname = "roja";
//$host = $_SERVER['HTTP_HOST'];
//$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
//$db = mysqli_connect("localhost", "root", "", $dbname);
include('components/config.php');
$del = mysqli_query($conn,"DELETE FROM tna WHERE sNo = '$id'"); // delete query

if($del)
{
    mysqli_close($conn); // Close connection
    $data = [ 'message'=>"Activity Deleted Sucessfully"];
    extract($data);
    require 'taCalender.php';
    header("Location: http://$host/roja_project/taCalender.php"); 
    exit;	
}
else
{
    $data = [ 'message'=>"Eorror Deleting Activity"];
    extract($data);
    require 'taCalender.php';
    echo "Error deleting record"; // display error message if not delete
}
?>

