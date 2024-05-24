<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'dbconfig.php';
 
    $sql1 = "UPDATE major SET  departmentid='$departmentid',major_name='$major_name',credits_required='$credits_required' WHERE majorid='$majorid'";
    $res = mysqli_query($conn1, $sql1) or die(mysqli_error($conn1));
   
        echo "Updated Details !";
   
}
?>