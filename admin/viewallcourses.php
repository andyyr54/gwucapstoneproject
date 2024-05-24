<?php
session_start();
    
            if($_SESSION['user_type']=="admin") { 
              

        include 'dbconfig.php';
       
       
        ?>
        <!DOCTYPE html>
<html>
<head>
    <style>
        button {
    background-color: grey; /* Green background */
    border: none; /* No borders */
    color: white; /* White text */
    padding: 7px 15px; /* Some padding */
    text-align: center; /* Centered text */
    text-decoration: none; /* No underline */
    display: inline-block;
    font-size: 16px;
    margin: 2px 1px;
    cursor: pointer; /* Mouse pointer on hover */
    border-radius: 12px; /* Rounded corners */
    transition-duration: 0.4s; /* Transition effects on hover */
}

button:hover {
    background-color: #45a049; /* Green background on hover */
    color: white; /* White text on hover */
}

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            width: 80%;
            padding: 16px;
            background-color: white;
            margin: 0 auto;
            margin-top: 50px;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
<?php include 'navbar.html'; ?>
    <div class="container">
        <h2>Viewing All Courses</h2>
        <table>
            <tr>
            <th>Course ID</th>
            <th>Department ID</th>
                <th>Course Name</th>
                <th>No of Credits</th>
                <th>Description</th>
         
                <!-- <th>Gender</th>
                <th>DOB</th>
                <th>Street</th>
                <th>State</th>
                <th>ZipCode</th>
                <th>Phone</th> -->
                <th>View More details with Prerequisite !</th>
                <th>Update Course Details!</th>
                
            </tr>
        <?php
             $sql_course_table= "SELECT * FROM course order by courseid ASC;";
             $result_course_table = mysqli_query($conn1, $sql_course_table) or die(mysqli_error($conn1));
 
             while($det_course_table = mysqli_fetch_assoc($result_course_table)){
                $departmentid=$det_course_table["departmentid"];
               $courseid=$det_course_table["courseid"];
                $linkforcourseprerequisitedetails="individualcoursedetails.php?courseid=".$courseid;
                $linkforupdatecoursedetails="updatecoursedetails.php?courseid=".$courseid;

    ?>
        
          
            <tr>
              
                <td><?php echo $det_course_table["courseid"];?></td>
                <td><?php echo $det_course_table["departmentid"];?></td>
                <td><?php echo $det_course_table["course_name"]; ?></td>
                <td><?php echo $det_course_table["no_of_credits"]; ?></td>
                <td><?php echo $det_course_table["description"]; ?></td>
               
   
               
                <td><a href="<?php echo $linkforcourseprerequisitedetails ?>"><button type="button" >View More details with Prerequisite</button></a></td>
                <td><a href="<?php echo $linkforupdatecoursedetails ?>"><button type="button" >Update Course Details</button></a></td>
            </tr>
           <?php
            
        }
            
            ?>
            <!-- Add more rows as needed -->
        </table>
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
