<?php
session_start();
    
if($_SESSION['user_type']=="admin") { 
                    
        include 'dbconfig.php';
     
        $userid= $_GET["studentid"];
        ?><!DOCTYPE html>
<html>
<head>
    <style>
        .red{
            color: red;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            width: 300px;
            padding: 16px;
            background-color: white;
            margin: 0 auto;
            margin-top: 50px;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="text"], input[type="password"],input[type="number"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: none;
            background-color: #5C6BC0;
            color: white;
        }
        .link {
            color: white;
            text-decoration: none;
            /* padding: 14px 16px; */
            float: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Viewing/Changing Details for Student</h2>
    <?php
    $sql_student=mysqli_query($conn,"SELECT * FROM student where studentid='$userid'");
    $row_student  = mysqli_fetch_array($sql_student);
    $category=$row_student['student_type'];
    $student_type="";

if(strtoupper($category)=="GRADUATE")
{
    $sql_graduate=mysqli_query($conn,"SELECT * FROM graduate where studentid='$userid'");
    $row_graduate  = mysqli_fetch_array($sql_graduate);
    $graduate_type=$row_graduate['graduate_type'];
    $departmentid=$row_graduate['departmentid'];
    $program=$row_graduate['program'];

    //For graduate as the form details are different
    if(strtoupper($graduate_type)=="FULL TIME")
    {
        
        $sql_graduate_full_time=mysqli_query($conn,"SELECT * FROM graduate_full_time where studentid='$userid'");
        $row_graduate_full_time = mysqli_fetch_array($sql_graduate_full_time);
        if(is_array($row_graduate_full_time)){
            $student_year=$row_graduate_full_time['student_year'];
            $thesis=$row_graduate_full_time['thesis'];
            $credits_earned=$row_graduate_full_time['credits_earned'];
        }
       
    }
    else
    {
        $sql_graduate_part_time=mysqli_query($conn,"SELECT * FROM graduate_part_time where studentid='$userid'");
        $row_graduate_part_time = mysqli_fetch_array($sql_graduate_part_time);
        if(is_array($row_graduate_part_time)){
            $student_year=$row_graduate_part_time['student_year'];
            $thesis=$row_graduate_part_time['thesis'];
            $credits_earned=$row_graduate_part_time['credits_earned'];
        }
        // else
        // {
        //     $student_year="No Details";
        //     $minimum_credits="No Details";
        //     $maximum_credits="No Details";
        //     $credits_earned="No Details";
        // }
    }


    ?>
    <h2 class="red">Student is -  </h2> <h3><?php echo $category;?> And <?php echo $graduate_type;?> <br><br>
    
    <form action="" method="post">

    <label for="name">User ID</label>
        <input type="text" id="userid" name="userid" value="<?php echo $userid?>" required="required" readonly>

        <label for="name">Department ID</label>
        <input type="text" id="departmentid" name="departmentid" value="<?php echo $departmentid?>" required="required" readonly>

        <label for="name">Program</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $program?>" required="required" readonly>
       
        <label for="name">Student Year</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo $student_year?>" required="required" readonly>
        <label for="name"> Credits Earned</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $credits_earned?>" required="required" readonly>
    
        <label for="name">Thesis</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $thesis?>" required="required" readonly>
        
        <br><br>
    </form>
<hr><hr><hr>
    <h2 class="red">Update Details</h2>

    <form action="updategraduatedetails.php" method="post">

<label for="name">User ID</label>
    <input type="text" id="userid" name="userid" value="<?php echo $userid?>" required="required" readonly>
    <label for="name">Graduate Type</label>
    <input type="text" id="graduate_type" name="graduate_type" value="<?php echo $graduate_type?>" required="required" readonly>

    <label for="name">Select Department</label> 
    <br>
        <!-- Fetching All the available Major and Minor -->
        <select id="departmentid" name="departmentid">
        
        <?php
           $sql_major_all = "SELECT * FROM department order by department_name ASC ";
           $result_major_all = mysqli_query($conn1, $sql_major_all) or die(mysqli_error($conn1));

           //looping through all deparment available
           while($det_major_all = mysqli_fetch_assoc($result_major_all)){
            echo '<option value="'.$det_major_all["departmentid"].'">'.$det_major_all["department_name"].'</option>';

        }

    ?>

    </select>
<br><br>
<label for="name">Program</label>
        <input type="text" id="program" name="program" value="<?php echo $program?>" required="required" >
       
        <label for="name">Student Year</label>
        <input type="text" id="student_year" name="student_year" value="<?php echo $student_year?>" required="required" >
        <label for="name"> Credits Earned</label>
        <input type="text" id="credits_earned" name="credits_earned" value="<?php echo $credits_earned?>" required="required" >
    
        <label for="name">Thesis</label>
        <input type="text" id="thesis" name="thesis" value="<?php echo $thesis?>" required="required" >
        
    <br><br>

        

      <br><br><button type="submit" name="save">Update</button>
        <br><br>
    </form>
    <a class="link" href="viewstudentdetails.php"><button >Cancel</button></a>
    </div>
    <?php
}
else
{
    $sql_undergraduate=mysqli_query($conn,"SELECT * FROM undergraduate where studentid='$userid'");
    $row_undergraduate  = mysqli_fetch_array($sql_undergraduate);
    $graduate_type=$row_undergraduate['undergraduate_type'];
    $department_id=$row_undergraduate['departmentid'];

    //For Undergraduategraduate as the form details are different
    if(strtoupper($graduate_type)=="FULL TIME")
    {
        
        $sql_undergraduate_full_time=mysqli_query($conn,"SELECT * FROM undergraduate_full_time where studentid='$userid'");
        $row_undergraduate_full_time = mysqli_fetch_array($sql_undergraduate_full_time);
        if(is_array($row_undergraduate_full_time)){
            $student_year=$row_undergraduate_full_time['student_year'];
            $minimum_credits=$row_undergraduate_full_time['minimum_credits'];
            $maximum_credits=$row_undergraduate_full_time['maximum_credits'];
            $credits_earned=$row_undergraduate_full_time['credits_earned'];
        }
       
    }
    else
    {
        $sql_undergraduate_part_time=mysqli_query($conn,"SELECT * FROM undergraduate_part_time where studentid='$userid'");
        $row_undergraduate_part_time = mysqli_fetch_array($sql_undergraduate_part_time);
        if(is_array($row_undergraduate_part_time)){
            $student_year=$row_undergraduate_part_time['student_year'];
            $minimum_credits=$row_undergraduate_part_time['minimum_credits'];
            $maximum_credits=$row_undergraduate_part_time['maximum_credits'];
            $credits_earned=$row_undergraduate_part_time['credits_earned'];
        }
        // else
        // {
        //     $student_year="No Details";
        //     $minimum_credits="No Details";
        //     $maximum_credits="No Details";
        //     $credits_earned="No Details";
        // }
    }


    ?>
    <h2 class="red">Student is -  </h2> <h3><?php echo $category;?> And <?php echo $graduate_type;?> <br><br>
    
    <form action="" method="post">

    <label for="name">User ID</label>
        <input type="text" id="userid" name="userid" value="<?php echo $userid?>" required="required" readonly>

        <label for="name">Department ID</label>
        <input type="text" id="departmentid" name="departmentid" value="<?php echo $department_id?>" required="required" readonly>


        <label for="name">Student Year</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo $student_year?>" required="required" readonly>

        <label for="name">Minimum Credits</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $minimum_credits?>" required="required" readonly>
       
        <label for="name">Maximum Credits</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $maximum_credits?>" required="required" readonly>
        <label for="name"> Credits Earned</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $credits_earned?>" required="required" readonly>
    
        <br><br>
    </form>
<hr><hr><hr>
    <h2 class="red">Update Details</h2>

    <form action="updateundergraduatedetails.php" method="post">

<label for="name">User ID</label>
    <input type="text" id="userid" name="userid" value="<?php echo $userid?>" required="required" readonly>
    <label for="name">UnderGraduate Type</label>
    <input type="text" id="undergraduate_type" name="undergraduate_type" value="<?php echo $graduate_type?>" required="required" readonly>

    <label for="name">Select Department</label> 
    <br>
        <!-- Fetching All the available Major and Minor -->
        <select id="departmentid" name="departmentid">
        
        <?php
           $sql_major_all = "SELECT * FROM department order by department_name ASC ";
           $result_major_all = mysqli_query($conn1, $sql_major_all) or die(mysqli_error($conn1));

           //looping through all deparment available
           while($det_major_all = mysqli_fetch_assoc($result_major_all)){
            echo '<option value="'.$det_major_all["departmentid"].'">'.$det_major_all["department_name"].'</option>';

        }

    ?>

    </select>
<br><br>
    <label for="name">Student Year</label>
    <input type="text" id="student_year" name="student_year" value="<?php echo $student_year?>" required="required" >

    <label for="name">Minimum Credits</label>
    <input type="text" id="minimum_credits" name="minimum_credits" value="<?php echo $minimum_credits?>" required="required" >
   
    <label for="name">Maximum Credits</label>
    <input type="text" id="maximum_credits" name="maximum_credits" value="<?php echo $maximum_credits?>" required="required" >
    <label for="name"> Credits Earned</label>
    <input type="text" id="credits_earned" name="credits_earned" value="<?php echo $credits_earned?>" required="required" >

    <br><br>

        

      <br><br><button type="submit" name="save">Update</button>
        <br><br>
    </form>
    <a class="link" href="viewstudentdetails.php"><button >Cancel</button></a>
    </div>
    <?php
}

     ?>
 
    
</body>
</html>
<?php
    }
    else {
    // Redirect if not logged in
    header("Location: login.html");
    }
?>
