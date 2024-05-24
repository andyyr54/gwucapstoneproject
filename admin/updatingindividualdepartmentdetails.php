<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'dbconfig.php';
 
    $sql1 = "UPDATE department SET  chairid='$chairid',roomid='$roomid',department_name='$department_name',department_manager='$department_manager',email='$email',phone='$phone' WHERE departmentid='$departmentid'";
    $res = mysqli_query($conn1, $sql1) or die(mysqli_error($conn1));
   
        echo "Updated Details !";
   
}
?>