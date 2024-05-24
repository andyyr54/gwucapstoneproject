<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'dbconfig.php';

    $sql2 = "INSERT INTO minor(departmentid,minorid,minor_name,credits_required) values('$departmentid','$minorid','$minor_name','$credits_required')";
    $res2 = mysqli_query($conn1, $sql2) or die(mysqli_error($conn1));

echo "NEW MINOR ADDED!";
}
?>