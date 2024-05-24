<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'dbconfig.php';

    $sql2 = "INSERT INTO major_requirements(majorid,courseid,minimum_grade_required) values('$majorid','$courseid','$minimum_grade_required')";
    $res2 = mysqli_query($conn1, $sql2) or die(mysqli_error($conn1));

echo "NEW MAJOR REQUIREMENT ADDED!";
}
?>
