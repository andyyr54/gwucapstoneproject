<?php
session_start();
    
            if($_SESSION['user_type']=="admin") { 
                

        include 'dbconfig.php';
       $userid=$_GET['facultyid'];
     $semesterid=$_GET['semesterid'];
     $linktoassignfacultytocoursesection="addfacultytocoursesection.php?facultyid=".$userid."&semesterid=".$semesterid;
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

$sql_faculty=mysqli_query($conn,"SELECT * FROM faculty where facultyid='$userid'");
$row_faculty= mysqli_fetch_array($sql_faculty);
 $faculty_type=$row_faculty['faculty_type'];
 



          $sql_course_section_exists=mysqli_query($conn,"SELECT * FROM course_section where facultyid='$userid' AND semesterid='$semesterid'");
          $row_course_section_exists= mysqli_fetch_array($sql_course_section_exists);
          if(is_array($row_course_section_exists))
          {
            $sql_faculty_department=mysqli_query($conn,"SELECT * FROM faculty_department where facultyid='$userid'");
          $row_faculty_department= mysqli_fetch_array($sql_faculty_department);
            $departmentid=$row_faculty_department['departmentid'];
            
            $courseid=$row_course_section_exists['courseid'];
            $sql_course=mysqli_query($conn,"SELECT * FROM course where courseid='$courseid'");
$row_course= mysqli_fetch_array($sql_course);
 $course_name=$row_course['course_name'];
            ?>
        <h2>Viewing Course Section Details for FacultyID - <?php echo $userid ?> , For Semester - <?php echo $semesterid ?> </h2>
        <table>
            <tr>
            <th>CRN</th>
            <th>CourseID</th>
            <th>Course Name</th>
            <th>Faculty ID</th>
            <th>Faculty Type</th>
            <th>Timeslot ID</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Days</th>
            <th>Room ID</th>
            <th>Semester ID</th>
            <th>Section Number</th>
            <th>Available Seats</th>
                <!-- <th>Department ID</th> -->
                <th>Update this course Section</th>
               
             
                <!-- <th>Gender</th>
                <th>DOB</th>
                <th>Street</th>
                <th>State</th>
                <th>ZipCode</th>
                <th>Phone</th> -->
         
              
            </tr>
        <?php
            $no_of_course_section=0;
            $sql_course_section= "SELECT * FROM course_section where facultyid='$userid' AND semesterid='$semesterid'";
            $row_course_section= mysqli_query($conn1, $sql_course_section) or die(mysqli_error($conn1));

            while($det_course_section= mysqli_fetch_assoc($row_course_section)){
 
                $no_of_course_section= $no_of_course_section+1;
                $crn=$det_course_section["crn"];
                $link="updatecoursesectiondetails.php?crn=".$crn;
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
            <td><?php echo $det_course_section["crn"] ?></td>
            <td><?php echo $det_course_section["courseid"] ?></td>
            <td><?php echo $course_name; ?></td>
                <td><?php echo $det_course_section["facultyid"];?></td>
                
                <td><?php echo $faculty_type;?></td>
                <!-- <td><?php echo $departmentid;?></td> -->
                <td><?php echo $det_course_section["timeslotid"];?></td>
                <td><?php echo $start_time; ?></td>
                <td><?php echo $end_time; ?></td>
                <td><?php echo $weekday; ?></td>
                <td><?php echo $det_course_section["roomid"];?></td>
                <td><?php echo $det_course_section["semesterid"];?></td>
                
                <td><?php echo $det_course_section["section_number"] ?></td>
                <td><?php echo $det_course_section["available_seats"] ?></td>
 
                <td><a href="<?php echo $link ?>"><button type="button" >Update this course Section</button></a></td>
            </tr>
            </tr>
           <?php
                }
        
            
            ?>
            <!-- Add more rows as needed -->
        </table>
       <br><br>

        <?php
  
if( $faculty_type=="Full Time"){
    if($no_of_course_section<2)
    {
        ?>
        <center><a href="<?php echo $linktoassignfacultytocoursesection; ?>"><button type="button" >CLICK HERE TO ADD Course Section for faculty -  Semester - <?php echo $semesterid ?></button></a></center>
        <?php
       }
       else
       {
           ?>
        <center><a href=""><button type="button" >Cannot Assign as faculty is in 2 Course Section for Full Time for Semester - <?php echo $semesterid ?></button></a></center>
        <?php
       }
    }
    if( $faculty_type=="Part Time"){
        if($no_of_course_section<1)
        {
            ?>
            <center><a href="<?php echo $linktoassignfacultytocoursesection; ?>"><button type="button" >CLICK HERE TO Assign Faculty to Course Section</button></a></center>
            <?php
           }
           else
           {
               ?>
            <center><a href=""><button type="button" >Cannot Assign as faculty is in 1 Course Section for Part Time for Semester - <?php echo $semesterid ?></button></a></center>
            <?php
           }
        }


}
else {
    ?>
<h2>Faculty is not in any Course section FacultyID - <?php echo $userid ?>  , For Semester - <?php echo $semesterid ?> </h2>
            <center><a href="<?php echo $linktoassignfacultytocoursesection; ?>"><button type="button" >CLICK HERE TO ADD Course Section for faculty -  Semester- <?php echo $semesterid ?> </button></a></center>
            <?php
}

    ?>
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
