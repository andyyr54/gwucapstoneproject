<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'dbconfig.php';
 
    $sql1 = "UPDATE minor_requirements SET  courseid='$courseid',minimum_grade_required='$minimum_grade_required' WHERE minorid='$minorid' AND courseid='$courseid'";
    $res = mysqli_query($conn1, $sql1) or die(mysqli_error($conn1));
   
        echo "Updated Details !";
   
}
?>