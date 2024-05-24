<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'dbconfig.php';
    if($prerequisiteid!=$courseid)
    {
        $sql2 = "INSERT INTO course_prerequisite(prerequisiteid,courseid,minimum_grade) values('$prerequisiteid','$courseid','$minimum_grade')";
        $res2 = mysqli_query($conn1, $sql2) or die(mysqli_error($conn1));
     
    echo "NEW COURSE-PRE REQUISITE ADDED!";
    }
    else
    {
        echo "FAILED - CANNOT HAVE SAME COURSE AS IT' PREREQUISITE";
    }
    
}
?>