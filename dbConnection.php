<?php


$host = "localhost";
$user = "root";
$pwd = "";
$db = "users_info";

$conn = mysqli_connect("$host", "$user", "$pwd","$db");

if($conn === false){
    die("Fatal Error".mysqli_connect_error());
}

//$res = mysqli_query()


?>
