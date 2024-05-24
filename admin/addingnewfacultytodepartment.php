<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'dbconfig.php';

    $sql2 = "INSERT INTO faculty_department(departmentid,facultyid,percentage_of_time_spent,Date_of_assignment) values('$departmentid','$facultyid','$percentage_of_time_spent','$Date_of_assignment')";
    $res2 = mysqli_query($conn1, $sql2) or die(mysqli_error($conn1));

echo "ASSIGNED FACULTY TO THE DEPARTMENT !";
}
?>
