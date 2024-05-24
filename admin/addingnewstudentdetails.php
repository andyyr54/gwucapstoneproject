<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'dbconfig.php';
    $user_type="Student";
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
    
  
    $sql3 = "INSERT INTO student(studentid,student_type) values('$newuserid','$student_type')";
    $res3 = mysqli_query($conn1, $sql3) or die(mysqli_error($conn1));

    $sql_advising = "INSERT INTO advising(studentid,student_type) values('$newuserid','$student_type')";
    $res_advising = mysqli_query($conn1, $sql_advising) or die(mysqli_error($conn1));

        echo "New User (STUDENT) Added Details !";
   
        if($student_type=="Graduate")
        {
            
            $sql_graduate_table= "INSERT INTO graduate(studentid,program,graduate_type) values('$newuserid','$degree_type','$full_or_part_time')";
            $res_graduate_table = mysqli_query($conn1, $sql_graduate_table) or die(mysqli_error($conn1));

            if($full_or_part_time=="Full Time")
            {
                $sql_graduate_full_time_table= "INSERT INTO graduate_full_time(studentid) values('$newuserid')";
                $res_graduate_full_time_table = mysqli_query($conn1, $sql_graduate_full_time_table) or die(mysqli_error($conn1));
    
            }
            else
            {
                $sql_graduate_part_time_table= "INSERT INTO graduate_part_time(studentid) values('$newuserid')";
                $res_graduate_part_time_table = mysqli_query($conn1, $sql_graduate_part_time_table) or die(mysqli_error($conn1));
            }
        }
        else
        {
            $sql_undergraduate_table= "INSERT INTO undergraduate(studentid,undergraduate_type) values('$newuserid','$full_or_part_time')";
            $res_undergraduate_table = mysqli_query($conn1, $sql_undergraduate_table) or die(mysqli_error($conn1));

            if($full_or_part_time=="Full Time")
            {
                $sql_undergraduate_full_time_table= "INSERT INTO undergraduate_full_time(studentid) values('$newuserid')";
                $res_undergraduate_full_time_table = mysqli_query($conn1, $sql_undergraduate_full_time_table) or die(mysqli_error($conn1));
            }
            else
            {
                $sql_undergraduate_part_time_table= "INSERT INTO undergraduate_part_time(studentid) values('$newuserid')";
                $res_undergraduate_part_time_table = mysqli_query($conn1, $sql_undergraduate_part_time_table) or die(mysqli_error($conn1));
            }
        }
}
?>
