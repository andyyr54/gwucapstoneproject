<?php
session_start();
    
            if($_SESSION['user_type']=="faculty") { 
                date_default_timezone_set('America/New_York');
                
                
               

        include 'dbconfig.php';
       $userid=$_SESSION['userid'];
     $semesterid=$_GET['semesterid'];
     $today_day=date('l'); 
    $day_match="NO";
    $current_time=date('h:i A');
    $time_match="NO";
    $allowrecodattendance="NO";
     //mocking
    //  $today_day="Monday";
    //  $current_time="8:39 PM";

     $current_time_check = strtotime($current_time);
 
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
    <h2>Viewing Roster Schedule For Semester - <?php echo $semesterid ?> </h2>
    <h3>Today is <?php echo $today_day;?> And current time is <?php echo $current_time;?> </h3>

        <table>
            <tr>
            <th>CRN</th>
            <th>CourseID</th>
            <th>Course Name</th>
            
            <th>Timeslot ID</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Days</th>
            <th>Room ID</th>
            <th>Section Number</th>
            <th>Credits</th>
            <th>View Students in this Course Section</th>
            <th>View Attendance</th>
        
            <th>Record Attendance</th>
              
            </tr>
        <?php
$facultyid=$userid;



 $sql_course_section = "SELECT * FROM course_section where facultyid='$userid' AND semesterid='$semesterid' ";
 $row_course_section = mysqli_query($conn1, $sql_course_section) or die(mysqli_error($conn1));

 //looping through each dayid and getting details relevant
 while($det_course_section = mysqli_fetch_assoc($row_course_section)){
    $crn=$det_course_section['crn'];
    $roomid=$det_course_section['roomid'];
         $link="viewstudentsenrolledincoursesection.php?crn=".$crn;
         $linkattendanceview="selectdateforviewattendanceofcourse.php?crn=".$crn;
       
        // $recordattendace="selectsemesterforviewattendanceofcourse.php?crn=".$crn."&courseid=";
            $courseid=$det_course_section['courseid'];
            $linktorecord="viewstudentstoassignattendance.php?crn=".$crn."&courseid=".$courseid;
            $sql_course=mysqli_query($conn,"SELECT * FROM course where courseid='$courseid'");
$row_course= mysqli_fetch_array($sql_course);
 $course_name=$row_course['course_name'];
$section_number=$det_course_section['section_number'];
 $number_of_credits=$row_course['no_of_credits'];

 $timeslotid=$det_course_section["timeslotid"];
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
                            
//   $today_day="Thursday";
                            // The day of today matches with one of the day described in class
                            if(($row_day["weekday"]== $today_day) && ($day_match=="NO") )
                            {
                                $day_match="YES";
                                // echo "DAY MATCH";
                            }
                        


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

                            if($day_match=="YES" && $time_match=="NO"){

                                // echo " TIME MATCH STARTED --";
                       
                                $start_time_check = strtotime($start_time);
                                $end_time_check = strtotime($end_time);
                            // echo $current_time_check;
                            // echo " -- ".$start_time_check;
                            // echo " -- ".$end_time_check;
                                if ($current_time_check >= $start_time_check && $current_time_check <= $end_time_check) {

                                $time_match=="YES";
                                $allowrecodattendance="YES";
                                // echo " TIME MATCH";
                            } 
                        }
                        }
                }
                
            ?>
       
        
           
        
          
            <tr>
            <td><?php echo $crn; ?></td>
            <td><?php echo $courseid; ?></td>
            <td><?php echo $course_name; ?></td>
                
               
                <!-- <td><?php echo $departmentid;?></td> -->
                <td><?php echo $timeslotid;?></td>
                <td><?php echo $start_time; ?></td>
                <td><?php echo $end_time; ?></td>
                <td><?php echo $weekday; ?></td>
                <td><?php echo $roomid;?></td>
                <td><?php echo $section_number;?></td>
                <td><?php echo $number_of_credits; ?></td>
                <td><a href="<?php echo $link ?>"><button type="button" >View Students Enrolled !</button></a></td>
                <td><a href="<?php echo $linkattendanceview ?>"><button type="button" >View Attendance</button></a></td>
                <?php
                if($allowrecodattendance=="YES")
                {
?>
                
                <td><a href="<?php echo $linktorecord ?>"><button type="button" >Record Attendance</button></a></td>
                <?php
                }
                else
                {
                    ?>
                    <td><a href=""><button type="button" >Can't record Record Attendance</button></a></td>
                    <?php 
                }
                ?>

          <?php
          
          ?>
               
         
            </tr>
           <?php
                    $day_match="NO";
                    $time_match="NO";
                    $allowrecodattendance="NO";
            }

            ?>
            <!-- Add more rows as needed -->
        </table>
       <br><br>

 
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
