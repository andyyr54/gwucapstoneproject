<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'dbconfig.php';
    $user_type="Faculty";
    $sql2 = "INSERT INTO user(first_name,last_name,gender,dob,street,city,state,zipcode,phone,user_type)values('$first_name','$last_name','$gender','$dob','$street','$city','$state','$zipcode','$phone','$user_type')";
    $res2 = mysqli_query($conn1, $sql2) or die(mysqli_error($conn1));

   

$sql=mysqli_query($conn,"SELECT max(userid) FROM user;");
$row  = mysqli_fetch_array($sql);
if(is_array($row))
{
        $newuserid=$row['max(userid)'];
}
$sql_faculty_department = "INSERT INTO faculty_department(userid)values('$newuserid')";
$res_faculty_department = mysqli_query($conn1, $sql_faculty_department) or die(mysqli_error($conn1));

 
    $sql1 = "INSERT INTO login(userid,password,attempts,locked,email,user_type) values('$newuserid','$password','$attempts','$locked','$email','$user_type')";
    $res = mysqli_query($conn1, $sql1) or die(mysqli_error($conn1));

    $sql3 = "INSERT INTO faculty(facultyid,rank,speciality,faculty_type) values('$newuserid','$rank','$speciality','$faculty_type')";
    $res3 = mysqli_query($conn1, $sql3) or die(mysqli_error($conn1));
    
  
    if($faculty_type=="Full Time")
    {

        $sql_faculty_full_time = "INSERT INTO faculty_full_time(facultyid,no_of_classes,office) values('$newuserid','$no_of_classes','$office')";
        $res_faculty_full_time = mysqli_query($conn1, $sql_faculty_full_time) or die(mysqli_error($conn1));
        
    }
    else
    {
        $sql_faculty_part_time = "INSERT INTO faculty_part_time(facultyid,no_of_classes,office) values('$newuserid','$no_of_classes','$office')";
        $res_faculty_part_time = mysqli_query($conn1, $sql_faculty_part_time) or die(mysqli_error($conn1));
    
    }
        echo "New User (Faculty) Added Details !";
   
}
?>