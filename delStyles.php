<?php 
$id = $_GET['id'];
//$dbname = "roja";
//$db = mysqli_connect("localhost", "root", "", $dbname);
include('components/config.php');
$del = mysqli_query($conn,"DELETE FROM styles WHERE serialNo = '$id'"); // delete query

if($del)
{
    mysqli_close($conn); // Close connection
    $data = [ 'message'=>"Style Deleted Successfully"];
    extract($data);
    require 'viewStyles.php';
    header("location: viewStyles.php"); // redirects to all records page
    exit;	
}
else
{
    $data = [ 'message'=>"Error Deleting Style"];
    extract($data);
    require 'viewStyles.php';
    echo "Error deleting record"; // display error message if not delete
}
?>