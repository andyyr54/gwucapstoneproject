<?php
session_start();
      
    $crn=$_GET['crn'];
    $studentid=$_GET['studentid'];
    include 'dbconfig.php';
    $sql_update_student_history = "UPDATE student_history SET  grade='W' WHERE  crn='$crn' and studentid='$studentid' ";
    $res_update_student_history = mysqli_query($conn1, $sql_update_student_history) or die(mysqli_error($conn1));

    $sql_drop_enrollment = "delete from enrollment WHERE crn='$crn' and studentid='$studentid' ";
    $res_drop_enrollment = mysqli_query($conn1, $sql_drop_enrollment) or die(mysqli_error($conn1));
//   echo $crn;
//   echo $studentid;
     echo "Withdrawed / Dropped the Course Section";

