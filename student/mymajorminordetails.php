<?php
session_start();
    
if($_SESSION['user_type']=="student") { 
                    
        include 'dbconfig.php';
     
        $userid= $_SESSION["userid"];
        $sql_student=mysqli_query($conn,"SELECT * FROM student where studentid='$userid'");
$row_student = mysqli_fetch_array($sql_student);
$student_type=strtoupper($row_student['student_type']);
// echo $student_type;
$final_student_type="UG";
if($student_type=="GRADUATE")
{
    $sql_graduate=mysqli_query($conn,"SELECT * FROM graduate where studentid='$userid'");
    $row_graduate = mysqli_fetch_array($sql_graduate);
    $program=strtoupper($row_graduate['program']);
    if($program=="PHD")
    {
        $final_student_type="PHD";
    }
    else
    {
        $final_student_type="MS";
    }
}

// echo $final_student_type;
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
<?php
        if($final_student_type=="UG")
        {

        
        ?>
    <div class="container">
      
        <h2>Viewing/Changing Details for Major/Minor. I am studying <?php echo $final_student_type?></h2>
    <?php
      $sql=mysqli_query($conn,"SELECT * FROM login where userid='$userid'");
      $row  = mysqli_fetch_array($sql);
      $sql1=mysqli_query($conn,"SELECT * FROM user where userid='$userid'");
      $row_user_table  = mysqli_fetch_array($sql1);
      $sql_student=mysqli_query($conn,"SELECT * FROM student where studentid='$userid'");
      $row_student  = mysqli_fetch_array($sql_student);

      

    ?>
    <form action="updatingstudentmajorminordetails.php" method="post">

    <label for="name">User ID</label>
        <input type="text" id="userid" name="userid" value="<?php echo $row_user_table['userid']?>" required="required" readonly>

        <label for="name">First Name</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo $row_user_table['first_name']?>" required="required" readonly>

        <label for="name">Last Name</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $row_user_table['last_name']?>" required="required" readonly>
       
        <?php
        if(is_array($row_student))
        {
$current_major_id=$row_student['majorid'];
$current_minor_id=$row_student['minorid'];

$sql_major=mysqli_query($conn,"SELECT * FROM major where majorid='$current_major_id'");
$row_major  = mysqli_fetch_array($sql_major);
if(is_array($row_major)){
    $current_major_name=$row_major['major_name'];

}
else{
    $current_major_name="Student not enrolled";
}

$sql_minor=mysqli_query($conn,"SELECT * FROM minor where minorid='$current_minor_id'");
$row_minor  = mysqli_fetch_array($sql_minor);
if(is_array($row_minor)){
    $current_minor_name=$row_minor['minor_name'];

}
else{
    $current_minor_name="Student not enrolled";
}
        }
        else
        {
            $current_minor_name="Student not enrolled";
            $current_major_name="Student not enrolled";
        }
// echo $current_major_id;
?>
<hr><hr>
 <h3>Current Major & Minor Details </h3>
        <label for="name">Major Name</label>
        <input type="text" id="current_major_name" name="current_major_name" value="<?php echo $current_major_name?>" required="required" readonly>
        <label for="name">Minor Name</label>
        <input type="text" id="current_minor_name" name="current_minor_name" value="<?php echo $current_minor_name?>" required="required" readonly>
        
<?php
        
        ?>
        <hr><hr>
        <h3>Select Below Major if you wish to Update/DROP</h3>
        <!-- Fetching All the available Major and Minor -->
        <select id="major" name="major">
        <?php
           $sql_major_all = "SELECT * FROM major WHERE RIGHT(majorid, 2) < 10  order by major_name ASC ";
           $result_major_all = mysqli_query($conn1, $sql_major_all) or die(mysqli_error($conn1));

           //looping through all major availanle
           while($det_major_all = mysqli_fetch_assoc($result_major_all)){
            echo '<option value="'.$det_major_all["majorid"].'">'.$det_major_all["major_name"].'</option>';

        }

    ?>

    </select>
    <h3>Select Below Minor if you wish to Update/DROP</h3>
        <!-- Fetching All the available Major and Minor -->
        <select id="minor" name="minor">
        <option value="NAA">NOT ASSIGNED/DROP MAJOR</option>
        <?php
           $sql_minor_all = "SELECT * FROM minor order by minor_name ASC ";
           $result_minor_all = mysqli_query($conn1, $sql_minor_all) or die(mysqli_error($conn1));

           //looping through all major availanle
           while($det_minor_all = mysqli_fetch_assoc($result_minor_all)){
            echo '<option value="'.$det_minor_all["minorid"].'">'.$det_minor_all["minor_name"].'</option>';

        }
    
    ?>
   
    </select>

      <br><br><button type="submit" name="save">Update</button>
        <br><br>
    </form>
    <a class="link" href="index.php"><button >Cancel</button></a>
   
    </div>
    <?php
    }
    ?>

    <!-- IF STUDENT IS MS ( MASTERS) -->
    <?php
        if($final_student_type=="MS")
        {

        
        ?>
    <div class="container">
      
        <h2>Viewing/Changing Details for Major. I am studying <?php echo $final_student_type?></h2>
    <?php
      $sql=mysqli_query($conn,"SELECT * FROM login where userid='$userid'");
      $row  = mysqli_fetch_array($sql);
      $sql1=mysqli_query($conn,"SELECT * FROM user where userid='$userid'");
      $row_user_table  = mysqli_fetch_array($sql1);
      $sql_student=mysqli_query($conn,"SELECT * FROM student where studentid='$userid'");
      $row_student  = mysqli_fetch_array($sql_student);

      

    ?>
    <form action="updatingstudentmajorminordetailsforms.php" method="post">

    <label for="name">User ID</label>
        <input type="text" id="userid" name="userid" value="<?php echo $row_user_table['userid']?>" required="required" readonly>

        <label for="name">First Name</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo $row_user_table['first_name']?>" required="required" readonly>

        <label for="name">Last Name</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $row_user_table['last_name']?>" required="required" readonly>
       
        <?php
        if(is_array($row_student))
        {
$current_major_id=$row_student['majorid'];
$current_minor_id=$row_student['minorid'];

$sql_major=mysqli_query($conn,"SELECT * FROM major where majorid='$current_major_id'");
$row_major  = mysqli_fetch_array($sql_major);
if(is_array($row_major)){
    $current_major_name=$row_major['major_name'];

}
else{
    $current_major_name="Student not enrolled";
}

$sql_minor=mysqli_query($conn,"SELECT * FROM minor where minorid='$current_minor_id'");
$row_minor  = mysqli_fetch_array($sql_minor);
if(is_array($row_minor)){
    $current_minor_name=$row_minor['minor_name'];

}
else{
    $current_minor_name="Student not enrolled";
}
        }
        else
        {
            $current_minor_name="Student not enrolled";
            $current_major_name="Student not enrolled";
        }
// echo $current_major_id;
?>
<hr><hr>
 <h3>Current Major Details </h3>
        <label for="name">Major Name</label>
        <input type="text" id="current_major_name" name="current_major_name" value="<?php echo $current_major_name?>" required="required" readonly>
<?php
        
        ?>
        <hr><hr>
        <h3>Select Below Major if you wish to Update/DROP</h3>
        <!-- Fetching All the available Major and Minor -->
        <select id="major" name="major">
        <option value="NAA">NOT ASSIGNED/DROP MAJOR</option>
        <?php
             $sql_major_all = "SELECT * FROM major WHERE RIGHT(majorid, 2) > 10 AND RIGHT(majorid, 2) < 20 order by major_name ASC ";
           $result_major_all = mysqli_query($conn1, $sql_major_all) or die(mysqli_error($conn1));

           //looping through all major availanle
           while($det_major_all = mysqli_fetch_assoc($result_major_all)){
            echo '<option value="'.$det_major_all["majorid"].'">'.$det_major_all["major_name"].'</option>';

        }

    ?>

    </select>


      <br><br><button type="submit" name="save">Update</button>
        <br><br>
    </form>
    <a class="link" href="index.php"><button >Cancel</button></a>
   
    </div>
    <?php
    }
    ?>


<!-- IF STUDENT IS PHD ( PHD) -->
<?php
        if($final_student_type=="PHD")
        {

        
        ?>
    <div class="container">
      
        <h2>Viewing/Changing Details for Major. I am studying <?php echo $final_student_type?></h2>
    <?php
      $sql=mysqli_query($conn,"SELECT * FROM login where userid='$userid'");
      $row  = mysqli_fetch_array($sql);
      $sql1=mysqli_query($conn,"SELECT * FROM user where userid='$userid'");
      $row_user_table  = mysqli_fetch_array($sql1);
      $sql_student=mysqli_query($conn,"SELECT * FROM student where studentid='$userid'");
      $row_student  = mysqli_fetch_array($sql_student);

      

    ?>
    <form action="updatingstudentmajorminordetailsforms.php" method="post">

    <label for="name">User ID</label>
        <input type="text" id="userid" name="userid" value="<?php echo $row_user_table['userid']?>" required="required" readonly>

        <label for="name">First Name</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo $row_user_table['first_name']?>" required="required" readonly>

        <label for="name">Last Name</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $row_user_table['last_name']?>" required="required" readonly>
       
        <?php
        if(is_array($row_student))
        {
$current_major_id=$row_student['majorid'];
$current_minor_id=$row_student['minorid'];

$sql_major=mysqli_query($conn,"SELECT * FROM major where majorid='$current_major_id'");
$row_major  = mysqli_fetch_array($sql_major);
if(is_array($row_major)){
    $current_major_name=$row_major['major_name'];

}
else{
    $current_major_name="Student not enrolled";
}

$sql_minor=mysqli_query($conn,"SELECT * FROM minor where minorid='$current_minor_id'");
$row_minor  = mysqli_fetch_array($sql_minor);
if(is_array($row_minor)){
    $current_minor_name=$row_minor['minor_name'];

}
else{
    $current_minor_name="Student not enrolled";
}
        }
        else
        {
            $current_minor_name="Student not enrolled";
            $current_major_name="Student not enrolled";
        }
// echo $current_major_id;
?>
<hr><hr>
 <h3>Current Major Details </h3>
        <label for="name">Major Name</label>
        <input type="text" id="current_major_name" name="current_major_name" value="<?php echo $current_major_name?>" required="required" readonly>
<?php
        
        ?>
        <hr><hr>
        <h3>Select Below Major if you wish to Update/DROP</h3>
        <!-- Fetching All the available Major and Minor -->
        <select id="major" name="major">
        <?php
             $sql_major_all = "SELECT * FROM major WHERE RIGHT(majorid, 2) > 20 AND RIGHT(majorid, 2) < 30 order by major_name ASC ";
           $result_major_all = mysqli_query($conn1, $sql_major_all) or die(mysqli_error($conn1));

           //looping through all major availanle
           while($det_major_all = mysqli_fetch_assoc($result_major_all)){
            echo '<option value="'.$det_major_all["majorid"].'">'.$det_major_all["major_name"].'</option>';

        }

    ?>

    </select>


      <br><br><button type="submit" name="save">Update</button>
        <br><br>
    </form>
    <a class="link" href="index.php"><button >Cancel</button></a>
   
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
