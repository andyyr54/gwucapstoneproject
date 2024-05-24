<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'dbconfig.php';

    $sql2 = "INSERT INTO department(departmentid,chairid,roomid,department_name,department_manager,email,phone) values('$departmentid','$chairid','$roomid','$department_name','$department_manager','$email','$phone')";
    $res2 = mysqli_query($conn1, $sql2) or die(mysqli_error($conn1));

echo "NEW DEPARTMENT ADDED!";
}
?>