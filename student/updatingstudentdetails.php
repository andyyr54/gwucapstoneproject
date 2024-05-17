<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'dbconfig.php';
    $userid= $_SESSION["userid"];
    $sql1 = "UPDATE login SET  password='$password' WHERE userid='$userid'";
    $res = mysqli_query($conn1, $sql1) or die(mysqli_error($conn1));
    $sql2 = "UPDATE user SET  first_name='$first_name',last_name='$last_name',gender='$gender',street='$street',zipcode='$zipcode',phone='$phone' WHERE userid='$userid'";
    $res2 = mysqli_query($conn1, $sql2) or die(mysqli_error($conn1));

        echo "Updated Details !";
   
}
?>