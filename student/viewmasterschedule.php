<?php
session_start();
    
   
     include 'dbconfig.php';
global $semesterid;
$semesterid = isset($_GET['semesterid']) ? $_GET['semesterid'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';
$search = mysqli_real_escape_string($conn1, $search);
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
        <form method="get" action="">
    <label for="semesterid">Semester:</label>
    <select name="semesterid" id="semesterid">
    <option value="FALL2023">FALL2023</option>
    <option value="SPRING2024">SPRING2024</option>
    </select>
    <label for="search">Search Course Name:</label>
    <select name="search" id="search">
    <?php
    // Retrive all course_names form course
    $sql_course_names = "SELECT DISTINCT course_name FROM course";
    $result_course_names = mysqli_query($conn1, $sql_course_names) or die(mysqli_error($conn1));

    // Loop through the results and populate the dropdown options
    while ($row_course_name = mysqli_fetch_assoc($result_course_names)) {
        $course_name = $row_course_name['course_name'];
        echo "<option value=\"$course_name\">$course_name</option>";
    }
    ?>
        </select>
        <input type="submit" value="search">
        </form>
        <h2>Viewing Semester MASTER Schedule for <?php echo $semesterid;?></h2>
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
                <th>Available Seats</th>
                
            </tr>
        <?php




            
            if (empty($search)) {
    $sql_course_section = "SELECT * FROM course_section WHERE semesterid='$semesterid' ORDER BY crn ASC";
    $result_course_section = mysqli_query($conn1, $sql_course_section) or die(mysqli_error($conn1));
            } else {
    
    $sql_course_section = "SELECT * FROM course_section WHERE semesterid='$semesterid' AND courseid IN (SELECT courseid FROM course WHERE course_name LIKE ?) ORDER BY crn ASC";
    $searchParam = "%$search%";
    $stmt = mysqli_prepare($conn1, $sql_course_section);
    mysqli_stmt_bind_param($stmt, "s", $searchParam);
    mysqli_stmt_execute($stmt);
    $result_course_section = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
}

            //looping through each CRN and getting details relevant data as 1 student can have n number of enrollments
            while($det_course_section = mysqli_fetch_assoc($result_course_section)){
                $crn=$det_course_section["crn"];

                 //To Get Section number, CourseID, RoomID, facultyid, timeslotID from course_section table 
            
                $section_number=$det_course_section["section_number"];
                $roomid=$det_course_section["roomid"];
                $courseid=$det_course_section["courseid"];
                $facultyid=$det_course_section["facultyid"];
                $timeslotid=$det_course_section["timeslotid"];
                $available_seats=$det_course_section["available_seats"];
                
                //get course name
                $sql_course=mysqli_query($conn,"SELECT * FROM course where courseid='$courseid'");
                $row_course  = mysqli_fetch_array($sql_course);
                if(is_array($row_course))
                {
                $course_name=$row_course["course_name"];
                $no_of_credits=$row_course["no_of_credits"];
                }

                //to get  query major_requirements/minor_requirements using course_id to get relevant major/minor ID -> then query the major/minor table for course name
                $sql_major_requirements=mysqli_query($conn,"SELECT * FROM major_requirements where courseid='$courseid'");
                $row_major_requirements  = mysqli_fetch_array($sql_major_requirements);

                $sql_minor_requirements=mysqli_query($conn,"SELECT * FROM minor_requirements where courseid='$courseid'");
                $row_minor_requirements  = mysqli_fetch_array($sql_minor_requirements);
                if(is_array($row_major_requirements))
                {

                    $majorid=$row_major_requirements["majorid"];

                    //Now the courseid was in major_requirements table so that means the course belonngs to major
                    //Fetch the course_name from major table
                    // $sql_major=mysqli_query($conn,"SELECT * FROM major where majorid='$majorid'");
                    // $row_major  = mysqli_fetch_array($sql_major);
                    // if(is_array($row_major))
                    // {
                      
                    //     $no_of_credits=$row_major["credits_required"];
                    // }
                }
                elseif(is_array($row_minor_requirements)){
                    $minorid=$row_minor_requirements["minorid"];

                    //Now the courseid was in minor_requirements table so that means the course belonngs to minor
                    //Fetch the course_name from minor table
                    // $sql_minor=mysqli_query($conn,"SELECT * FROM minor where minorid='$minorid'");
                    // $row_minor  = mysqli_fetch_array($sql_minor);
                    // if(is_array($row_minor))
                    // {
                        
                    //     $no_of_credits=$row_minor["credits_required"];
                    // }
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
                
                <td><?php echo $available_seats; ?></td>
            </tr>
           <?php
            }
        
            
            ?>
            <!-- Add more rows as needed -->
        </table>
    </div>
</body>
</html>
