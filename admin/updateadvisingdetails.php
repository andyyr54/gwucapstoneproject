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
        <h2>Viewing/Changing Details for Advisor Details</h2>
    <?php

      $sql_student=mysqli_query($conn,"SELECT * FROM student where studentid='$userid'");
      $row_student  = mysqli_fetch_array($sql_student);

      

    ?>
    <form action="updatingadvisingdetails.php" method="post">

    <label for="name">User ID</label>
        <input type="text" id="userid" name="userid" value="<?php echo $userid?>" required="required" readonly>

       <br><br>
<h3>Select Below Faculty to advise for student</h3>
        <!-- Fetching All the available Major and Minor -->
        <select id="facultyid" name="facultyid">
        <?php
           $sql_major_all = "SELECT * FROM faculty  ";
           $result_major_all = mysqli_query($conn1, $sql_major_all) or die(mysqli_error($conn1));

           //looping through all major availanle
           while($det_major_all = mysqli_fetch_assoc($result_major_all)){
            $facid=$det_major_all["facultyid"];
            $sql_faculty_name=mysqli_query($conn,"SELECT * FROM user where userid='$facid'");
      $row_faculty_name  = mysqli_fetch_array($sql_faculty_name);
      $faculty_first_name=$row_faculty_name['first_name'];
            echo '<option value="'.$det_major_all["facultyid"].'">'.$det_major_all["facultyid"]." -  ".$faculty_first_name.'</option>';

        }

    ?>

    </select><br><br>
        <label for="name">Date Of Advising</label><br><br>
        <input type="date" id="date_of_advising" name="date_of_advising" value="" required="required" >
        <br><br>
 
    
      <br><br><button type="submit" name="save">Update</button>
        <br><br>
    </form>
    <a class="link" href="viewadvising.php"><button >Cancel</button></a>
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
