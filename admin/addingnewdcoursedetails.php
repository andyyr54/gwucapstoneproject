<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'dbconfig.php';

    $sql2 = "INSERT INTO course(courseid,departmentid,no_of_credits,description,course_name) values('$courseid','$departmentid','$no_of_credits','$description','$course_name')";
    $res2 = mysqli_query($conn1, $sql2) or die(mysqli_error($conn1));

echo "NEW COURSE ADDED!";
}
?>
