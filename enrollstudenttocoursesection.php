<?php
session_start();
    
if($_SESSION['user_type']=="admin") { 
                    
        include 'dbconfig.php';
   
       $studentid=$_GET['studentid'];
       $userid=$studentid;
       $semesterid=$_GET['semesterid'];
       $sql_student=mysqli_query($conn,"SELECT * FROM student where studentid='$userid'");
$row_student = mysqli_fetch_array($sql_student);
$student_type=strtoupper($row_student['student_type']);
// echo $student_type;
$final_student_type="UG";
if($student_type=="GRADUATE")
{
    $sql_graduate=mysqli_query($conn,"SELECT * FROM graduate where studentid='$userid'");
    $row_graduate = mysqli_fetch_array($sql_graduate);
    $program=strtoupper($row_graduate['program']);
    if($program=="PHD")
    {
        $final_student_type="PHD";
    }
    else
    {
        $final_student_type="MS";
    }
}
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
            width: 800px;
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
    <?php
;
// $sql=mysqli_query($conn,"SELECT max(userid) FROM user;");
// $row  = mysqli_fetch_array($sql);
// if(is_array($row))
// {
//         $newuserid=$row['max(userid)']+1;
// }

                
    ?>
    <?php
        if($final_student_type=="UG")
        {

        ?>
    <div class="container">
    <h2>Enroll Student to Course Section</h2>
    <form action="addingnewcoursesectiondetailstostudent.php" method="post">
  
      
    <label for="name">Student ID </label>
        <input type="text" id="studentid" name="studentid" value="<?php echo $studentid?>" required="required" readonly>

        <!-- get Student MAJORID AND RESPECTIVE DEPARTMENT AND SHOW COURSES ONLY OF THAT DEPARTMENT -->
<?php
$sql_student=mysqli_query($conn,"SELECT * FROM student where studentid='$studentid'");
$row_student= mysqli_fetch_array($sql_student);
 $student_majorid=$row_student['majorid'];
 $student_minorid=$row_student['minorid'];

//  Get major department id
$sql_major=mysqli_query($conn,"SELECT * FROM major where majorid='$student_majorid'");
$row_major= mysqli_fetch_array($sql_major);
 $major_departmentid=$row_major['departmentid'];
//  Get minor department id
$sql_minor=mysqli_query($conn,"SELECT * FROM minor where minorid='$student_minorid'");
$row_minor= mysqli_fetch_array($sql_minor);
 $minor_departmentid=$row_minor['departmentid'];

?>


    <br><br>
<h3>Select Below Course to assign CourseID for Course Section</h3>
        <!-- Fetching All the available Major and Minor -->
        <select id="crn" name="crn">
        <?php
         $sql_course = "SELECT * FROM course WHERE RIGHT(courseid, 4) < 6000 ";
         $result_course = mysqli_query($conn1, $sql_course) or die(mysqli_error($conn1));

 //looping through all course available for that majorid
 while($det_course= mysqli_fetch_assoc($result_course)){
         //Getting Course Name
         $course_name=$det_course['course_name'];
        $courseid=$det_course['courseid'];
         //checking and getting details whether that course is present in this course_section
         $sql_course_section=mysqli_query($conn,"SELECT * FROM course_section where semesterid='$semesterid' AND courseid='$courseid' AND available_seats>='1' ");
         $row_course_section= mysqli_fetch_array($sql_course_section);
         

         
         if(is_array($row_course_section))
         {
$timeslotid=$row_course_section['timeslotid'];
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
            echo '<option value="'.$row_course_section["crn"].'">'.$row_course_section["crn"]." -  ".$courseid." -  ".$course_name." -  ".$timeslotid." -  ".$weekday." -  ".$start_time." -  ".$end_time.'</option>';
        }
        }

    ?>  </select><br><br>



<label for="name">Semester ID </label>
        <input type="text" id="semesterid" name="semesterid" value="<?php echo $semesterid?>" required="required" readonly>


    <br><br>
    <label for="name">Date of Enrollment</label><br><br>
<input type="date" id="date_of_enrollment" name="date_of_enrollment" required="required" readonly>

<script>
    document.getElementById('date_of_enrollment').valueAsDate = new Date();
</script>


        <br>
   
    <br><br>
    <button type="submit" name="save">Enroll Student to Course Section</button><br><br>
    </form>
    <a class="link" href="index.php"><button >Cancel</button></a>
    </div>
    <?php
    }
    ?>

<!-- For students who are Masters -->
<?php
        if($final_student_type=="MS")
        {

        ?>
    <div class="container">
    <h2>Enroll Student to Course Section</h2>
    <form action="addingnewcoursesectiondetailstostudent.php" method="post">
  
      
    <label for="name">Student ID </label>
        <input type="text" id="studentid" name="studentid" value="<?php echo $studentid?>" required="required" readonly>

        <!-- get Student MAJORID AND RESPECTIVE DEPARTMENT AND SHOW COURSES ONLY OF THAT DEPARTMENT -->
<?php
$sql_student=mysqli_query($conn,"SELECT * FROM student where studentid='$studentid'");
$row_student= mysqli_fetch_array($sql_student);
 $student_majorid=$row_student['majorid'];
 $student_minorid=$row_student['minorid'];

//  Get major department id
$sql_major=mysqli_query($conn,"SELECT * FROM major where majorid='$student_majorid'");
$row_major= mysqli_fetch_array($sql_major);
 $major_departmentid=$row_major['departmentid'];
//  Get minor department id
$sql_minor=mysqli_query($conn,"SELECT * FROM minor where minorid='$student_minorid'");
$row_minor= mysqli_fetch_array($sql_minor);
 $minor_departmentid=$row_minor['departmentid'];

?>


    <br><br>
<h3>Select Below Course to assign CourseID for Course Section</h3>
        <!-- Fetching All the available Major and Minor -->
        <select id="crn" name="crn">
        <?php
         $sql_course = "SELECT * FROM course WHERE  RIGHT(courseid, 4) > 6000 AND RIGHT(courseid, 4) < 7000 ";
         $result_course = mysqli_query($conn1, $sql_course) or die(mysqli_error($conn1));

 //looping through all course available for that majorid
 while($det_course= mysqli_fetch_assoc($result_course)){
         //Getting Course Name
         $course_name=$det_course['course_name'];
        $courseid=$det_course['courseid'];
         //checking and getting details whether that course is present in this course_section
         $sql_course_section=mysqli_query($conn,"SELECT * FROM course_section where semesterid='$semesterid' AND courseid='$courseid' AND available_seats>='1' ");
         $row_course_section= mysqli_fetch_array($sql_course_section);
         

         
         if(is_array($row_course_section))
         {
$timeslotid=$row_course_section['timeslotid'];
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
            echo '<option value="'.$row_course_section["crn"].'">'.$row_course_section["crn"]." -  ".$courseid." -  ".$course_name." -  ".$timeslotid." -  ".$weekday." -  ".$start_time." -  ".$end_time.'</option>';
        }
        }

    ?>  </select><br><br>



<label for="name">Semester ID </label>
        <input type="text" id="semesterid" name="semesterid" value="<?php echo $semesterid?>" required="required" readonly>


    <br><br>
    <label for="name">Date of Enrollment</label><br><br>
<input type="date" id="date_of_enrollment" name="date_of_enrollment" required="required" readonly>

<script>
    document.getElementById('date_of_enrollment').valueAsDate = new Date();
</script>


        <br>
   
    <br><br>
    <button type="submit" name="save">Enroll Student to Course Section</button><br><br>
    </form>
    <a class="link" href="index.php"><button >Cancel</button></a>
    </div>
    <?php
    }
    ?>


<!-- For students who are PHD -->
<?php
        if($final_student_type=="PHD")
        {

        ?>
    <div class="container">
    <h2>Enroll Student to Course Section</h2>
    <form action="addingnewcoursesectiondetailstostudent.php" method="post">
  
      
    <label for="name">Student ID </label>
        <input type="text" id="studentid" name="studentid" value="<?php echo $studentid?>" required="required" readonly>

        <!-- get Student MAJORID AND RESPECTIVE DEPARTMENT AND SHOW COURSES ONLY OF THAT DEPARTMENT -->
<?php
$sql_student=mysqli_query($conn,"SELECT * FROM student where studentid='$studentid'");
$row_student= mysqli_fetch_array($sql_student);
 $student_majorid=$row_student['majorid'];
 $student_minorid=$row_student['minorid'];

//  Get major department id
$sql_major=mysqli_query($conn,"SELECT * FROM major where majorid='$student_majorid'");
$row_major= mysqli_fetch_array($sql_major);
 $major_departmentid=$row_major['departmentid'];
//  Get minor department id
$sql_minor=mysqli_query($conn,"SELECT * FROM minor where minorid='$student_minorid'");
$row_minor= mysqli_fetch_array($sql_minor);
 $minor_departmentid=$row_minor['departmentid'];

?>


    <br><br>
<h3>Select Below Course to assign CourseID for Course Section</h3>
        <!-- Fetching All the available Major and Minor -->
        <select id="crn" name="crn">
        <?php
         $sql_course = "SELECT * FROM course WHERE  RIGHT(courseid, 4) > 7000 AND RIGHT(courseid, 4) < 8000 ";
         $result_course = mysqli_query($conn1, $sql_course) or die(mysqli_error($conn1));

 //looping through all course available for that majorid
 while($det_course= mysqli_fetch_assoc($result_course)){
         //Getting Course Name
         $course_name=$det_course['course_name'];
        $courseid=$det_course['courseid'];
         //checking and getting details whether that course is present in this course_section
         $sql_course_section=mysqli_query($conn,"SELECT * FROM course_section where semesterid='$semesterid' AND courseid='$courseid' AND available_seats>='1' ");
         $row_course_section= mysqli_fetch_array($sql_course_section);
         

         
         if(is_array($row_course_section))
         {
$timeslotid=$row_course_section['timeslotid'];
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
            echo '<option value="'.$row_course_section["crn"].'">'.$row_course_section["crn"]." -  ".$courseid." -  ".$course_name." -  ".$timeslotid." -  ".$weekday." -  ".$start_time." -  ".$end_time.'</option>';
        }
        }

    ?>  </select><br><br>



<label for="name">Semester ID </label>
        <input type="text" id="semesterid" name="semesterid" value="<?php echo $semesterid?>" required="required" readonly>


    <br><br>
    <label for="name">Date of Enrollment</label><br><br>
<input type="date" id="date_of_enrollment" name="date_of_enrollment" required="required" readonly>

<script>
    document.getElementById('date_of_enrollment').valueAsDate = new Date();
</script>


        <br>
   
    <br><br>
    <button type="submit" name="save">Enroll Student to Course Section</button><br><br>
    </form>
    <a class="link" href="index.php"><button >Cancel</button></a>
    </div>
    <?php
    }
    ?>
</body>
</html>
<?php
    }
    else {
    // Redirect if not logged in
    header("Location: login.html");
    }
?>
