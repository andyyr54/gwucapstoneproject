<?php
session_start();
date_default_timezone_set('America/New_York');

    $studentid=$_GET['studentid'];
    $crn=$_GET['crn'];
    $courseid=$_GET['courseid'];
    
    include 'dbconfig.php';
    $attendance_date = date('Y-m-d');
    $sql2 = "INSERT INTO attendance(studentid,crn,courseid,attendance_date) values('$studentid','$crn','$courseid','$attendance_date')";
    $res2 = mysqli_query($conn1, $sql2) or die(mysqli_error($conn1));

echo "Attendance Recorded!";

?>