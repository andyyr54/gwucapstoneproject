<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'dbconfig.php';
 
    $sql_student_history = "UPDATE student_history SET  grade='$grade' WHERE  crn='$crn' AND studentid='$studentid' ";
    $res = mysqli_query($conn1, $sql_student_history) or die(mysqli_error($conn1));
   
     
    $sql_enrollment = "UPDATE enrollment SET  grade='$grade' WHERE  crn='$crn' AND studentid='$studentid' ";
    $res = mysqli_query($conn1, $sql_enrollment) or die(mysqli_error($conn1));
        echo "Updated Details !";
   
}
?>