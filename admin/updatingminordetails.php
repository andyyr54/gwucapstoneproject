<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'dbconfig.php';
 
    $sql1 = "UPDATE minor SET  departmentid='$departmentid',minor_name='$minor_name',credits_required='$credits_required' WHERE minorid='$minorid'";
    $res = mysqli_query($conn1, $sql1) or die(mysqli_error($conn1));
   
        echo "Updated Details !";
   
}
?>