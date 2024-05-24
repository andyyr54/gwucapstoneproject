<?php
session_start();
    
if($_SESSION['user_type']=="admin") { 
                    
        include 'dbconfig.php';
     
        $majorid= $_GET["majorid"];
        $courseid= $_GET["courseid"];
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
      $sql_major_requirements=mysqli_query($conn,"SELECT * FROM major_requirements where majorid='$majorid' AND courseid='$courseid'");
      $row_major_requirements = mysqli_fetch_array($sql_major_requirements);
   
      if(is_array($row_major_requirements))
      {
       
    ?>
    <form action="updatingmajorrequirementdetails.php" method="post">
<h2>Update Major Requirement for this Particular course and Major ID </h2>
    <label for="name">Major ID</label>
        <input type="text" id="majorid" name="majorid" value="<?php echo $row_major_requirements['majorid']?>" required="required" readonly>

        <label for="name">CourseID</label>
        <input type="text" id="courseid" name="courseid" value="<?php echo $row_major_requirements['courseid']?>" required="required" readonly>

        <label for="name">Minimum Grade Required</label>
        <input type="text" id="minimum_grade_required" name="minimum_grade_required" value="<?php echo $row_major_requirements['minimum_grade_required']?>" required="required">
        
       
        <br>

        <button type="submit" name="save">Update</button>
        <br><br>
        <?php
        
    
    ?>
    </form>
    <a class="link" href="viewingmajordetails.php?majorid=<?php echo $majorid?>"><button >Cancel</button></a>
    </div>
    
</body>
</html>
<?php
    }
}
    else {
    // Redirect if not logged in
    header("Location: login.html");
    }
?>
