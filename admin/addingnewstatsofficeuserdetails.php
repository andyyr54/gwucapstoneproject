<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'dbconfig.php';
    $user_type="Stats Office";
    $sql2 = "INSERT INTO user(first_name,last_name,gender,dob,street,city,state,zipcode,phone,user_type)values('$first_name','$last_name','$gender','$dob','$street','$city','$state','$zipcode','$phone','$user_type')";
    $res2 = mysqli_query($conn1, $sql2) or die(mysqli_error($conn1));


$sql=mysqli_query($conn,"SELECT max(userid) FROM user;");
$row  = mysqli_fetch_array($sql);
if(is_array($row))
{
        $newuserid=$row['max(userid)'];
}

 
    $sql1 = "INSERT INTO login(userid,password,attempts,locked,email,user_type) values('$newuserid','$password','$attempts','$locked','$email','$user_type')";
    $res = mysqli_query($conn1, $sql1) or die(mysqli_error($conn1));
    
    $sql3 = "INSERT INTO stats_office(stats_office_id,stats_office_type) values('$newuserid','$stats_office_type')";
    $res3 = mysqli_query($conn1, $sql3) or die(mysqli_error($conn1));

        echo "New User (STAT'S OFFICE) Added Details !";
   
}
?>
