<?php
session_start();
   
                $departmentid=$_GET['departmentid'];

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
        <h2>Viewing Major Details Of Department</h2>
        <table>
            <tr>
            <th>Major ID</th>
            <th>Department ID</th>
                <th>Major Name</th>
                <th>Credits Required</th>
               
         
                <!-- <th>Gender</th>
                <th>DOB</th>
                <th>Street</th>
                <th>State</th>
                <th>ZipCode</th>
                <th>Phone</th> -->
                <th>View More Major Details with Major Requirements !</th>
            
                
            </tr>
        <?php
             $sql_major_table = "SELECT * FROM major where departmentid='$departmentid';";
             $result_major_table = mysqli_query($conn1, $sql_major_table) or die(mysqli_error($conn1));
 
             while($det_major_table = mysqli_fetch_assoc($result_major_table)){
                $departmentid=$det_major_table["departmentid"];
               $majorid=$det_major_table["majorid"];
                $linkforindividualdepartmentdetails="individualdepartmentdetails.php?departmentid=".$departmentid;
        

          $linkforviewingmajordetails="viewingmajordetails.php?majorid=".$majorid;

                
    ?>
        
          
            <tr>
              
                <td><?php echo $det_major_table["majorid"];?></td>
                <td><?php echo $det_major_table["departmentid"];?></td>
                <td><?php echo $det_major_table["major_name"]; ?></td>
                <td><?php echo $det_major_table["credits_required"]; ?></td>

               
   
                <td><a href="<?php echo $linkforviewingmajordetails ?>"><button type="button" >View More Major Details!</button></a></td>
              
            </tr>
           <?php
            
        }
            
            ?>
            <!-- Add more rows as needed -->
        </table>
    </div>

    <!-- For Minor Table -->
    <div class="container">
        <h2>Viewing Minor Details Of Department</h2>
        <table>
            <tr>
            <th>Minor ID</th>
            <th>Department ID</th>
                <th>Minor Name</th>
                <th>Credits Required</th>
            
         
                <!-- <th>Gender</th>
                <th>DOB</th>
                <th>Street</th>
                <th>State</th>
                <th>ZipCode</th>
                <th>Phone</th> -->
                <th>View More Minor Details with Minor Requirements !</th>
 
                
            </tr>
            <?php
             $sql_minor_table = "SELECT * FROM minor where departmentid='$departmentid';";
             $result_minor_table = mysqli_query($conn1, $sql_minor_table) or die(mysqli_error($conn1));
 
             while($det_minor_table = mysqli_fetch_assoc($result_minor_table)){
                $departmentid=$det_minor_table["departmentid"];
               $minorid=$det_minor_table["minorid"];
                $linkforindividualdepartmentdetails="individualdepartmentdetails.php?departmentid=".$departmentid;
     
          $linkforviewingminordetails="viewingminordetails.php?minorid=".$minorid;

    ?>
        
          
            <tr>
              
                <td><?php echo $det_minor_table["minorid"];?></td>
                <td><?php echo $det_minor_table["departmentid"];?></td>
                <td><?php echo $det_minor_table["minor_name"]; ?></td>
                <td><?php echo $det_minor_table["credits_required"]; ?></td>
             
               
   
                
                <td><a href="<?php echo $linkforviewingminordetails ?>"><button type="button" >View More Minor Details!</button></a></td>
              
            </tr>
           <?php
            
        }
            
            ?>
            <!-- Add more rows as needed -->
        </table>
    </div>

    <!-- For Faculty Present in Current Department  -->
    <div class="container">
        <h2>Viewing faculties Of Department</h2>
        <table>
            <tr>
            <th>Faculty ID</th>
            <th>Faculty Name</th>
            <th>Department ID</th>
                <!-- <th>Percentage of Time Spent</th>
                <th>Date of Assignment</th> -->


                
            </tr>
            <?php
             $sql_faculty_department = "SELECT * FROM faculty_department where departmentid='$departmentid';";
             $result_faculty_department = mysqli_query($conn1, $sql_faculty_department) or die(mysqli_error($conn1));
 
             while($det_faculty_department = mysqli_fetch_assoc($result_faculty_department)){
                $facultyid=$det_faculty_department["facultyid"];
                $departmentid=$det_faculty_department["departmentid"];

                //getting faculty name
                $sql_user=mysqli_query($conn,"SELECT * FROM user where userid='$facultyid' ");
                $row_user= mysqli_fetch_array($sql_user);
                $faculty_first_name=$row_user['first_name'];


                // $linkforindividualdepartmentdetails="individualdepartmentdetails.php?departmentid=".$departmentid;
     


    ?>
        
          
            <tr>
              
                <td><?php echo $det_faculty_department["facultyid"];?></td>
                <td><?php echo $faculty_first_name;?></td>
                <td><?php echo $det_faculty_department["departmentid"];?></td>
                <!-- <td><?php echo $det_faculty_department["percentage_of_time_spent"]; ?></td>
                <td><?php echo $det_faculty_department["Date_of_assignment"]; ?></td> -->
             
               
   
                
           
              
            </tr>
           <?php
            
        }
            
            ?>
            <!-- Add more rows as needed -->
        </table>
    </div>

    <div class="container">
        <h2>Viewing Courses of this Department</h2>
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
          
                
            </tr>
        <?php
             $sql_course_table= "SELECT * FROM course  where departmentid='$departmentid' order by courseid ASC;";
             $result_course_table = mysqli_query($conn1, $sql_course_table) or die(mysqli_error($conn1));
 
             while($det_course_table = mysqli_fetch_assoc($result_course_table)){
                $departmentid=$det_course_table["departmentid"];
               $courseid=$det_course_table["courseid"];
                $linkforcourseprerequisitedetails="individualcoursedetails.php?courseid=".$courseid;
   

    ?>
        
          
            <tr>
              
                <td><?php echo $det_course_table["courseid"];?></td>
                <td><?php echo $det_course_table["departmentid"];?></td>
                <td><?php echo $det_course_table["course_name"]; ?></td>
                <td><?php echo $det_course_table["no_of_credits"]; ?></td>
                <td><?php echo $det_course_table["description"]; ?></td>
               
   
               
                <td><a href="<?php echo $linkforcourseprerequisitedetails ?>"><button type="button" >View More details with Prerequisite</button></a></td>
             
            </tr>
           <?php
            
        }
            
            ?>
            <!-- Add more rows as needed -->
        </table>
    </div>

    
</body>
</html>

