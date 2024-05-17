<?php
session_start();
    
            if($_SESSION['user_type']=="student") { 
                $userid=$_SESSION['userid'];

        include 'dbconfig.php';
       
       
        ?>
        <!DOCTYPE html>
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
        <h2>Viewing Current Semester Schedule</h2>
        
        <?php
            
            //getting CRNID from enrollment table and looping it
            $sql_enrollment = "SELECT * FROM enrollment where studentid='$userid'";
            $result_enrollment = mysqli_query($conn1, $sql_enrollment) or die(mysqli_error($conn1));

            //looping through each CRN and getting details relevant data as 1 student can have n number of enrollments
            while($det_enrollment = mysqli_fetch_assoc($result_enrollment)){
                $crn=$det_enrollment["crn"];

                 //To Get Section number, CourseID, RoomID, facultyid, timeslotID from course_section table 
                 $sql_course_section=mysqli_query($conn,"SELECT * FROM course_section where crn='$crn'");
                $row_hold  = mysqli_fetch_array($sql_course_section);
                if(is_array($row_course_section))
                {
                $section_number=$row_course_section["section_number"];
                $roomid=$row_course_section["roomid"];
                $courseid=$row_course_section["courseid"];
                $facultyid=$row_course_section["facultyid"];
                $timeslotid=$row_course_section["timeslotid"];
                }




                //to get course_name query major_requirements/minor_requirements using course_id to get relevant major/minor ID -> then query the major/minor table for course name
                $sql_major_requirements=mysqli_query($conn,"SELECT * FROM major_requirements where courseid='$courseid'");
                $row_major_requirements  = mysqli_fetch_array($sql_major_requirements);

                $sql_minor_requirements=mysqli_query($conn,"SELECT * FROM minor_requirements where courseid='$courseid'");
                $row_minor_requirements  = mysqli_fetch_array($sql_minor_requirements);
                if(is_array($row_major_requirements))
                {

                    $majorid=$row_major_requirements["majorid"];

                    //Now the courseid was in major_requirements table so that means the course belonngs to major
                    //Fetch the course_name from major table
                    $sql_major=mysqli_query($conn,"SELECT * FROM major where majorid='$majorid'");
                    $row_major  = mysqli_fetch_array($sql_major);
                    if(is_array($row_major))
                    {
                        $course_name=$row_major["course_name"];
                        $no_of_credits=$row_major["credits_required"];
                    }
                }
                elseif(is_array($row_minor_requirements)){
                    $minorid=$row_minor_requirements["minorid"];

                    //Now the courseid was in minor_requirements table so that means the course belonngs to minor
                    //Fetch the course_name from minor table
                    $sql_minor=mysqli_query($conn,"SELECT * FROM minor where minorid='$minorid'");
                    $row_minor  = mysqli_fetch_array($sql_minor);
                    if(is_array($row_minor))
                    {
                        $course_name=$row_minor["course_name"];
                        $no_of_credits=$row_minor["credits_required"];
                    }
                 }
                 //Line 71 - 102 only to get course_name and credits

                 //Get professor name from user table using FacultyID/userID
                 $sql_user=mysqli_query($conn,"SELECT * FROM user where userid='$facultyid'");
                $row_user  = mysqli_fetch_array($sql_user);
                if(is_array($row_user))
                {
                        $professor_first_name=$row_user["first_name"];
                        $professor_last_name=$row_user["last_name"];
                }

                //Get Building ID by quering room table using roomid
                $sql_room=mysqli_query($conn,"SELECT * FROM room where roomid='$roomid'");
                $row_room  = mysqli_fetch_array($sql_room);
                if(is_array($row_room))
                {
                        $buildingid=$row_room["buildingid"];
                }

                //get days quering from timeslot_day table --> then day table
                $sql_timeslot_day=mysqli_query($conn,"SELECT * FROM timeslot_day where timeslotid='$timeslotid'");
                $row_timeslot_day  = mysqli_fetch_array($sql_timeslot_day);
                if(is_array($row_timeslot_day))
                {
                    $dayid=$row_timeslot_day["dayid"];
                    $sql_day=mysqli_query($conn,"SELECT * FROM day where dayid='$dayid'");
                    $row_day  = mysqli_fetch_array($sql_day);
                    if(is_array($row_day))
                        {   
                            $weekday=$row_day["weekday"];
                        }
                }

                //get timings start_time and end_time by querying timeslot_period -> period table
                $sql_timeslot_period=mysqli_query($conn,"SELECT * FROM timeslot_period where timeslotid='$timeslotid'");
                $row_timeslot_period  = mysqli_fetch_array($sql_timeslot_period);
                if(is_array($row_timeslot_period))
                {
                    $periodid=$row_timeslot_day["periodid"];
                    $sql_period=mysqli_query($conn,"SELECT * FROM period where periodid='$dayperiodidid'");
                    $row_period  = mysqli_fetch_array($sql_period);
                    if(is_array($row_period))
                        {   
                            $start_time=$row_period["start_time"];
                            $end_time=$row_period["end_time"];
                        }
                }

           
            
               
               
                
    ?>
        <table>
            <tr>
            <th>CRN</th>
                <th>Section</th>
                <th>CourseID</th>
                <th>Course Name</th>
                <th>Professor First Name</th>
                <th>Professor Last Name</th>
                <th>RoomID</th>
                <th>BuildingID</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Days</th>
                <th>Credits</th>
                
            </tr>
          
            <tr>
                <td><?php echo $crn; ?></td>
                <td><?php echo $section_number;?></td>
                <td><?php echo $courseid; ?></td>
                <td><?php echo $course_name; ?></td>
                <td><?php echo $professor_first_name; ?></td>
                <td><?php echo $professor_last_name; ?></td>
                <td><?php echo $roomid; ?></td>
                <td><?php echo $buildingid; ?></td>
                <td><?php echo $start_time; ?></td>
                <td><?php echo $end_time; ?></td>
                <td><?php echo $weekday; ?></td>
                <td><?php echo $no_of_credits; ?></td>
                
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
