<?php
session_start();
    
            if($_SESSION['user_type']=="admin") { 
              

        include 'dbconfig.php';
       $semesterid=$_GET['semesterid'];
       
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
            width: 90%;
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
        <h2>Viewing All Course Section Details for Semester ID - <?php echo $semesterid?></h2>
        <table>
            <tr>
            <th>CRN</th>
            <th>Course ID</th>
            <th>Course Name</th>
                <th>Faculty ID</th>
                <th>Faculty Name</th>
                <th>Timeslot ID</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Days</th>
                <th>Room ID</th>
                <th>Semester ID</th>
                <th>Section Number</th>
                <th>Available Seats</th>
                <th>Update Course Section Details</th>
                <th>View Attendance</th>
                
            </tr>
        <?php
             $sql_course_section_table= "SELECT * FROM course_section where semesterid='$semesterid' order by crn ASC;";
             $result_course_section_table = mysqli_query($conn1, $sql_course_section_table) or die(mysqli_error($conn1));
 
             while($det_course_section_table = mysqli_fetch_assoc($result_course_section_table)){

                // $departmentid=$det_course_section_table["departmentid"];
                $facultyid=$det_course_section_table["facultyid"];
                $courseid=$det_course_section_table["courseid"];
                $timeslotid=$det_course_section_table["timeslotid"];
                //get faculty name
                $sql_faculty_name=mysqli_query($conn,"SELECT * FROM user where userid='$facultyid'");
                $row_faculty_name = mysqli_fetch_array($sql_faculty_name);
                
                $faculty_first_name=$row_faculty_name["first_name"];
                
                 //get course name
                 $sql_course_name=mysqli_query($conn,"SELECT * FROM course where courseid='$courseid'");
                 $row_course_name = mysqli_fetch_array($sql_course_name);
                 
                  $course_name=$row_course_name["course_name"];
                $crn=$det_course_section_table["crn"];
                $linkattendanceview="selectdateforviewattendanceofcourse.php?crn=".$crn;

                // $linkforcourseprerequisitedetails="individualcoursedetails.php?courseid=".$courseid;
                $linktoupdatecoursesection="updatecoursesectiondetails.php?crn=".$crn;

                 //get days quering from timeslot_day table --> then day table
                 $weekday="";
                 //getting dayid from timeslot_day table and looping it
             $sql_timeslot_day = "SELECT * FROM timeslot_day where timeslotid='$timeslotid'";
             $row_timeslot_day = mysqli_query($conn1, $sql_timeslot_day) or die(mysqli_error($conn1));
 
             //looping through each dayid and getting details relevant
             while($det_timeslot_day = mysqli_fetch_assoc($row_timeslot_day)){
 
                
                     $dayid=$det_timeslot_day["dayid"];
                     $sql_day=mysqli_query($conn,"SELECT * FROM day where dayid='$dayid'");
                     $row_day  = mysqli_fetch_array($sql_day);
                     if(is_array($row_day))
                         {   
                             $weekday=$weekday." ".$row_day["weekday"];
                         }
                 }
                 
                //get timings start_time and end_time by querying timeslot_period -> period table
                $sql_timeslot_period=mysqli_query($conn,"SELECT * FROM timeslot_period where timeslotid='$timeslotid'");
                $row_timeslot_period  = mysqli_fetch_array($sql_timeslot_period);
                if(is_array($row_timeslot_period))
                {
                    $periodid=$row_timeslot_period["periodid"];
                    $sql_period=mysqli_query($conn,"SELECT * FROM period where periodid='$periodid'");
                    $row_period  = mysqli_fetch_array($sql_period);
                    if(is_array($row_period))
                        {   
                            $start_time=$row_period["start_time"];
                            $end_time=$row_period["end_time"];
                        }
                }

                         
    ?>
        
          
            <tr>
              
                <td><?php echo $det_course_section_table["crn"];?></td>
                <td><?php echo $det_course_section_table["courseid"];?></td>
                <td><?php echo $course_name; ?></td>
                <td><?php echo $det_course_section_table["facultyid"]; ?></td>
                <td><?php echo $faculty_first_name; ?></td>
                <td><?php echo $det_course_section_table["timeslotid"]; ?></td>
                <td><?php echo $start_time; ?></td>
                <td><?php echo $end_time; ?></td>
                <td><?php echo $weekday; ?></td>
                <td><?php echo $det_course_section_table["roomid"]; ?></td>
                <td><?php echo $det_course_section_table["semesterid"]; ?></td>
                <td><?php echo $det_course_section_table["section_number"]; ?></td>
                <td><?php echo $det_course_section_table["available_seats"]; ?></td>
               
                <td><a href="<?php echo $linktoupdatecoursesection ?>"><button type="button" >Update Course Section Details</button></a></td>
                <td><a href="<?php echo $linkattendanceview ?>"><button type="button" >View Attendance</button></a></td>
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
