<?php
session_start();
    
if($_SESSION['user_type']=="admin") { 
                    
        include 'dbconfig.php';
     
        $userid= $_GET["userid"];
        ?><!DOCTYPE html>
<html>
<head>
    <style>
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
    <?php
      $sql=mysqli_query($conn,"SELECT * FROM login where userid='$userid'");
      $row  = mysqli_fetch_array($sql);
      $sql1=mysqli_query($conn,"SELECT * FROM user where userid='$userid'");
      $row_user_table  = mysqli_fetch_array($sql1);

      $sql_faculty_table=mysqli_query($conn,"SELECT * FROM faculty where facultyid='$userid'");
      $row_faculty_table  = mysqli_fetch_array($sql_faculty_table);
      if(is_array($row))
      {
        $faculty_type=$row_faculty_table['faculty_type'];
        if($faculty_type=="Full Time")
        {
            $sql_faculty_full_time=mysqli_query($conn,"SELECT * FROM faculty_full_time where facultyid='$userid'");
            $row_faculty_full_time  = mysqli_fetch_array($sql_faculty_full_time);
            if(is_array($row_faculty_full_time))
                {
                        $no_of_classes=$row_faculty_full_time['no_of_classes'];
                        $office=$row_faculty_full_time['office'];
                }
                
                
        }
        else{
            $sql_faculty_part_time=mysqli_query($conn,"SELECT * FROM faculty_part_time where facultyid='$userid'");
            $row_faculty_part_time  = mysqli_fetch_array($sql_faculty_part_time);
            if(is_array($row_faculty_part_time))
                {
                        $no_of_classes=$row_faculty_part_time['no_of_classes'];
                        $office=$row_faculty_part_time['office'];
                }
        }
        $date = new DateTime($row_user_table['dob']);
    ?>
    <form action="updatingfacultydetails.php" method="post">
        <h2>Updating Faculty Details </h2>

    <label for="name">User ID</label>
        <input type="text" id="userid" name="userid" value="<?php echo $row_user_table['userid']?>" required="required" readonly>
       
        <label for="name">Faculty Type</label>
        <input type="text" id="faculty_type" name="faculty_type" value="<?php echo $faculty_type?>" required="required" >
       

        <label for="name">First Name</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo $row_user_table['first_name']?>" required="required">

        <label for="name">Last Name</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $row_user_table['last_name']?>" required="required">
        
        <label for="name">Gender</label>
        <input type="text" id="gender" name="gender" value="<?php echo $row_user_table['gender']?>" required="required">
        
        <label for="name">Street</label>
        <input type="text" id="street" name="street" value="<?php echo $row_user_table['street']?>" required="required">
        
        <label for="name">Zipcode</label>
        <input type="number" id="zipcode" name="zipcode" value="<?php echo $row_user_table['zipcode']?>" required="required">
        
        <label for="name">Phone</label>
        <input type="text" id="phone" name="phone" value="<?php echo $row_user_table['phone']?>" required="required">
        
        <label for="name">DOB</label> <br> <br> 
        <input type="date" id="dob" name="dob" value="<?php echo $date->format('Y-m-d');?>" required="required">
        <br><br> 
        <!-- Faculty Table -->

        <label for="rank">Rank</label>
        <input type="text" id="rank" name="rank" value="<?php echo $row_faculty_table['rank']?>" required="required">
        
        <label for="speciality">Speciality</label>
        <input type="text" id="speciality" name="speciality" value="<?php echo $row_faculty_table['speciality']?>" required="required">
        
        <label for="faculty_type">Faculty Type</label>
        <input type="text" id="faculty_type" name="faculty_type" value="<?php echo $row_faculty_table['faculty_type']?>" required="required">
        
         <!-- Login Table -->
        <label for="attempts">No of Attempts</label>
        <input type="text" id="attempts" name="attempts" value="<?php echo $row['attempts']?>" required="required">
        
        <label for="locked">Locked</label>
        <input type="text" id="locked" name="locked" value="<?php echo $row['locked']?>" required="required">
        
        <label for="email">Email</label><br>
        <input type="text" id="email" name="email"  value="<?php echo $row['email']?>" required="required">
        
        <label for="password">Password</label><br>
        <input type="text" id="password" name="password"  value="<?php echo $row['password']?>" required="required">
        <br>
        <!-- faculty full time or part time details -->
        <label for="no_of_classes">No. Of. Classes</label><br>
        <input type="text" id="no_of_classes" name="no_of_classes"  value="<?php echo $no_of_classes?>" required="required">
        <br>
        <label for="office">Office</label><br>
        <input type="text" id="office" name="office"  value="<?php echo $office?>" required="required">
        <br>
        <button type="submit" name="save">Update</button>
        <br><br>
        <?php
        }
    
    ?>
    </form>
    <a class="link" href="viewfacultydetails.php"><button >Cancel</button></a>
    </div>
    
</body>
</html>
<?php
    }
    else {
    // Redirect if not logged in
    header("Location: login.html");
    }
?>
