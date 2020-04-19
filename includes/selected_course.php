<?php 
session_start();
include_once 'dbh.php';

$id=$_SESSION['std_id'];
$course=$_POST['selectedCourses'];

for($i=0;$i<sizeof($course);$i++){
    $options=$course[$i] ;
    $sql="INSERT INTO selected_course (student_id,offer_id) VALUES ('$id','$options')";
    if(!mysqli_query($conn,$sql)){
        echo "Not inserted";
        
    }
    
}
