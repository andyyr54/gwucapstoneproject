<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'dbconfig.php';
 
    $sql1 = "UPDATE course SET  departmentid='$departmentid',course_name='$course_name',description='$description',course_name='$course_name',no_of_credits='$no_of_credits' WHERE  courseid='$courseid'";
    $res = mysqli_query($conn1, $sql1) or die(mysqli_error($conn1));
   
        echo "Updated Details !";
   
}
?>