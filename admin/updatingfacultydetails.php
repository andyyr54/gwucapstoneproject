<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'dbconfig.php';
 
    $sql1 = "UPDATE login SET  password='$password',attempts='$attempts',locked='$locked',email='$email' WHERE userid='$userid'";
    $res = mysqli_query($conn1, $sql1) or die(mysqli_error($conn1));
    $sql2 = "UPDATE user SET  first_name='$first_name',last_name='$last_name',gender='$gender',street='$street',zipcode='$zipcode',phone='$phone',dob='$dob' WHERE userid='$userid'";
    $res2 = mysqli_query($conn1, $sql2) or die(mysqli_error($conn1));

    $sql3 = "UPDATE faculty SET  rank='$rank',speciality='$speciality',faculty_type='$faculty_type' WHERE facultyid='$userid'";
    $res3 = mysqli_query($conn1, $sql3) or die(mysqli_error($conn1));

    if($faculty_type=="Full Time")
    {

        $sql_faculty_full_time = "UPDATE faculty_full_time SET  no_of_classes='$no_of_classes',office='$office' WHERE facultyid='$userid'";
        $res_faculty_full_time = mysqli_query($conn1, $sql_faculty_full_time) or die(mysqli_error($conn1));
    
    }
    else
    {
        $sql_faculty_part_time = "UPDATE faculty_part_time SET  no_of_classes='$no_of_classes',office='$office'  WHERE facultyid='$userid'";
        $res_faculty_part_time = mysqli_query($conn1, $sql_faculty_part_time) or die(mysqli_error($conn1));
    
    }

        echo "Updated Details !";
   
}
?>