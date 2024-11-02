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
    require 'styleAttributes.php';
    header("Location: http://$host/roja_project/styleAttributes.php"); 
    exit;	
}
else
{
    $data = [ 'message'=>"Error Deleting Style"];
    extract($data);
    require 'styleAttributes.php';
    echo "Error deleting record"; // display error message if not delete
}
?>