<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'dbconfig.php';

    $sql1 = "UPDATE undergraduate SET  departmentid='$departmentid' WHERE studentid='$userid'";
    $res = mysqli_query($conn1, $sql1) or die(mysqli_error($conn1));
    if($undergraduate_type=="Full Time")
    {
        $sql2 = "UPDATE undergraduate_full_time SET  student_year='$student_year',minimum_credits='$minimum_credits',maximum_credits='$maximum_credits',credits_earned='$credits_earned' WHERE studentid='$userid'";
        $res2 = mysqli_query($conn1, $sql2) or die(mysqli_error($conn1));
    
    }
    else
    {
        $sql2 = "UPDATE undergraduate_part_time SET  student_year='$student_year',minimum_credits='$minimum_credits',maximum_credits='$maximum_credits',credits_earned='$credits_earned' WHERE studentid='$userid'";
        $res2 = mysqli_query($conn1, $sql2) or die(mysqli_error($conn1));
    
    }
   
        echo "Updated Details !";
   
}
?>