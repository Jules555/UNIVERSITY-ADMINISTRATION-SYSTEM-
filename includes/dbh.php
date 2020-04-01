<?php

$dbSeverName="localhost:3307";
$dbUserName="root";
$dbPassword="password";
$dbname="student_info";

//create conection to the server
$conn = mysqli_connect("$dbSeverName,$dbUserName,$dbPassword");

//select the database
$dtbase = mysqli_select_db($conn,$dbname);

?>
