<?php
session_start();
include_once 'dbh.php';


$user_id = stripslashes($_POST['student_id']);
$user_pwd = stripslashes($_POST['student_pwd']);

$user_id = mysqli_real_escape_string($conn,$user_id);
$user_pwd = mysqli_real_escape_string($conn,$user_pwd);



$sql= " SELECT * FROM personal_info WHERE student_id = '".$user_id."' AND password = '".$user_pwd."' ";

$result= mysqli_query($conn,$sql);
$resultCheck= mysqli_num_rows($result);

if(mysqli_num_rows($result)==1){
	$_SESSION['std_id']=$user_id;
	header("location:../entrypanel.php");
	exit();
}
else{
	header("location:../login.html?Password_error_or_User_id_incorrect");
}

?>


