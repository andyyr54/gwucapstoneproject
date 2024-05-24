<?php
session_start();
    
if($_SESSION['user_type']=="admin") { 
                    
        include 'dbconfig.php';
     
      
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
        
    textarea {
        width: 90%;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
        resize: vertical; /* Allows the user to resize the textarea vertically */
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
      $sql_course=mysqli_query($conn,"SELECT * FROM course where courseid='$courseid'");
      $row_courses = mysqli_fetch_array($sql_course);
   
      if(is_array($row_courses))
      {
       
    ?>
    <form action="updatingcoursedetails.php" method="post">
<h2>Update Course Details  </h2>
    <label for="name">Course ID</label>
        <input type="text" id="courseid" name="courseid" value="<?php echo $row_courses['courseid']?>" required="required" readonly>

        <label for="name">DepartmentID</label>
        <input type="text" id="departmentid" name="departmentid" value="<?php echo $row_courses['departmentid']?>" required="required">

        <label for="name">Course Name</label>
        <input type="text" id="course_name" name="course_name" value="<?php echo $row_courses['course_name']?>" required="required">
        
        <label for="name">No Of Credits</label>
        <input type="text" id="no_of_credits" name="no_of_credits" value="<?php echo $row_courses['no_of_credits']?>" required="required">
        
        <label for="description">Description</label>
<textarea id="description" name="description" required="required" style="height: 154px;"><?php echo $row_courses['description']?></textarea>

        <br>

        <button type="submit" name="save">Update</button>
        <br><br>
        <?php
        
    
    ?>
    </form>
    <a class="link" href="viewallcourses.php"><button >Cancel</button></a>
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
