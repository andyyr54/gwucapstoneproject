<?php
session_start();
    
            if($_SESSION['user_type']=="admin") { 
                

        include 'dbconfig.php';
       $userid=$_GET['studentid'];
     $semesterid=$_GET['semesterid'];
     $linktoassignstudenttocoursesection="enrollstudenttocoursesection.php?studentid=".$userid."&semesterid=".$semesterid;
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
    <h2>Viewing Course Section Details for StudentID - <?php echo $userid ?> , For Semester - <?php echo $semesterid ?> </h2>
        <table>
            <tr>
            <th>CRN</th>
            <th>CourseID</th>
            <th>Course Name</th>
            <th>Student Type</th>
            <th>Timeslot ID</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Days</th>
            <th>Room ID</th>
            <th>Credits</th>
          
            <th>Drop Enrollment</th>
              
            </tr>
        <?php
$studentid=$userid;
$sql_student=mysqli_query($conn,"SELECT * FROM student where studentid='$userid'");
$row_student= mysqli_fetch_array($sql_student);
 $category=$row_student['student_type'];
 $student_type=$category;
 $total_credits=0;
 if(strtoupper($category)=="GRADUATE")
 {
    $sql_graduate=mysqli_query($conn,"SELECT * FROM graduate where studentid='$userid'");
    $row_graduate  = mysqli_fetch_array($sql_graduate);
    $student_type_full_or_part_time=$row_graduate['graduate_type'];
    $student_type=$student_type." - ".$row_graduate['graduate_type'];
 }
 else
 {
    $sql_undergraduate=mysqli_query($conn,"SELECT * FROM undergraduate where studentid='$userid'");
    $row_undergraduate  = mysqli_fetch_array($sql_undergraduate);
    $student_type_full_or_part_time=$row_undergraduate['undergraduate_type'];
    $student_type=$student_type." - ".$row_undergraduate['undergraduate_type'];
 }


 $sql_enrollment = "SELECT * FROM enrollment where studentid='$userid'";
 $row_enrollment = mysqli_query($conn1, $sql_enrollment) or die(mysqli_error($conn1));

 //looping through each dayid and getting details relevant
 while($det_enrollment = mysqli_fetch_assoc($row_enrollment)){
    $crn=$det_enrollment['crn'];
          $sql_course_section_exists_for_particular_semester=mysqli_query($conn,"SELECT * FROM course_section where crn='$crn' AND semesterid='$semesterid'");
          $row_course_section_exists_for_particular_semester= mysqli_fetch_array($sql_course_section_exists_for_particular_semester);
          if(is_array($row_course_section_exists_for_particular_semester))
          {
            $dropenrollment="dropenrollment.php?crn=".$crn."&studentid=".$userid;
            $courseid=$row_course_section_exists_for_particular_semester['courseid'];
            $sql_course=mysqli_query($conn,"SELECT * FROM course where courseid='$courseid'");
$row_course= mysqli_fetch_array($sql_course);
 $course_name=$row_course['course_name'];

          
         

            
            $courseid=$row_course_section_exists_for_particular_semester['courseid'];
            $sql_course=mysqli_query($conn,"SELECT * FROM course where courseid='$courseid'");
$row_course= mysqli_fetch_array($sql_course);
 $course_name=$row_course['course_name'];
 $number_of_credits=$row_course['no_of_credits'];

 $timeslotid=$row_course_section_exists_for_particular_semester["timeslotid"];
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
                $total_credits=$total_credits+$number_of_credits;
            ?>
       
        
           
        
          
            <tr>
            <td><?php echo $crn; ?></td>
            <td><?php echo $row_course_section_exists_for_particular_semester["courseid"]; ?></td>
            <td><?php echo $course_name; ?></td>
                
                <td><?php echo $student_type;?></td>
                <!-- <td><?php echo $departmentid;?></td> -->
                <td><?php echo $row_course_section_exists_for_particular_semester["timeslotid"];?></td>
                <td><?php echo $start_time; ?></td>
                <td><?php echo $end_time; ?></td>
                <td><?php echo $weekday; ?></td>
                <td><?php echo $row_course_section_exists_for_particular_semester["roomid"];?></td>
                
                <td><?php echo $number_of_credits; ?></td>
                <td><a href="<?php echo $dropenrollment ?>"><button type="button" >Drop/Withdraw</button></a></td>
          <?php
          
          ?>
               
         
            </tr>
           <?php
                }
            }

            ?>
            <!-- Add more rows as needed -->
        </table>
       <br><br>

        <?php
 
 if(strtoupper($student_type_full_or_part_time)=="FULL TIME")
 {

 
    if($total_credits<12)
    {
        ?>
        <center><a href="<?php echo $linktoassignstudenttocoursesection; ?>"><button type="button" >CLICK HERE TO Enroll Student to Course Section -  Semester - <?php echo $semesterid ?></button></a></center>
        <?php
       }
       else
       {
           ?>
        <center><a href=""><button type="button" >Cannot Enroll as Student is FULL TIME and Already having 12 credits of classes for Semester - <?php echo $semesterid ?></button></a></center>
        <?php
       }
    }
    if(strtoupper($student_type_full_or_part_time)=="PART TIME"){
        if($total_credits<4)
        {
            ?>
            <center><a href="<?php echo $linktoassignstudenttocoursesection; ?>"><button type="button" >CLICK HERE TO Enroll Student to Course Section</button></a></center>
            <?php
           }
           else
           {
               ?>
            <center><a href=""><button type="button" >Cannot Enroll as Student is PART TIME and Already having 4 credits of classes for Semester - <?php echo $semesterid ?></button></a></center>
            <?php
           }
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
