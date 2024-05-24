<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'dbconfig.php';
// echo $minor;
    $sql1 = "UPDATE student SET  majorid='$major' WHERE studentid='$userid'";
    $res = mysqli_query($conn1, $sql1) or die(mysqli_error($conn1));
 
   
        echo "Updated Details !";
   
}
?>