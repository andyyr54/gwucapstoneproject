<?php
session_start();
    

                

        include 'dbconfig.php';
       $courseid=$_GET['courseid'];
       
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
        <?php
          $sql_course_prerequisite_exists=mysqli_query($conn,"SELECT * FROM course_prerequisite where courseid='$courseid'");
          $row_course_prerequisite_exists = mysqli_fetch_array($sql_course_prerequisite_exists);
          if(is_array($row_course_prerequisite_exists))
          {
            ?>
        <h2>Viewing Course Prerequisite Details</h2>
        <table>
            <tr>
            <th>Prerequisite ID</th>
            <th>Prerequisite</th>
            <th>Course ID</th>
            <th>Course</th>
            <th>Minimum Grade Required</th>
     
                
            </tr>
        <?php
             $sql_course_prerequisite= "SELECT * FROM course_prerequisite where courseid='$courseid'";
             $result_course_prerequisite = mysqli_query($conn1, $sql_course_prerequisite) or die(mysqli_error($conn1));


             while($det_course_prerequisite = mysqli_fetch_assoc($result_course_prerequisite)){
                // $departmentid=$det_major_table["departmentid"];
                $courseid=$det_course_prerequisite["courseid"];
                $prerequisiteid = $det_course_prerequisite["prerequisiteid"];

                $sql_course=mysqli_query($conn,"SELECT * FROM course where courseid='$courseid'");
                $row_course  = mysqli_fetch_array($sql_course);
                if(is_array($row_course))
                {
                        $course = $row_course["course_name"];
                }

                $sql_course_prereq=mysqli_query($conn,"SELECT * FROM course where courseid='$prerequisiteid'");
                $row_course_prereq  = mysqli_fetch_array($sql_course_prereq);
                if(is_array($row_course_prereq))
                {
                        $pre_req = $row_course_prereq["course_name"];
                }
                
    ?>
        
          
            <tr>
              
                <td><?php echo $det_course_prerequisite["prerequisiteid"];?></td>
                <td><?php echo $pre_req;?></td>
                <td><?php echo $det_course_prerequisite["courseid"] ;?></td>
                <td><?php echo $course;?></td>
                <td><?php echo $det_course_prerequisite["minimum_grade"] ?></td>
    
        
             
             
            </tr>
           <?php
            
        }
            
            ?>
            <!-- Add more rows as needed -->
        </table>
        <?php
    }
    else
    {
        ?>
<h2>There is no Course Prerequisite for for the CourseID - <?php echo $courseid ?></h2>
        <?php
    }
    ?>
    </div>
</body>
</html>

