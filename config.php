<?php

$host = "localhost";
$user = "root";
$pass = "Padanisa@6987!";
$db   = "rig_dashboard";

$conn = mysqli_connect($host,$user,$pass,$db);

if(!$conn){
die("Database connection failed");
}

?>
