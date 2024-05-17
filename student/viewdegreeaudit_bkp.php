<?php
session_start();
    
            if($_SESSION['user_type']=="student") { 
                

        include 'dbconfig.php';
       $userid=$_SESSION['userid'];
    $studentid=$userid;
   
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
<?php
  $sql_student=mysqli_query($conn,"SELECT * FROM student where studentid='$studentid'");
  $row_student= mysqli_fetch_array($sql_student);
 $majorid=$row_student['majorid'];
 $minorid=$row_student['minorid'];
 $sql_major=mysqli_query($conn,"SELECT * FROM major where majorid='$majorid'");
 $row_major= mysqli_fetch_array($sql_major);
$major_name=$row_major['major_name'];
$sql_minor=mysqli_query($conn,"SELECT * FROM minor where minorid='$minorid'");
$row_minor= mysqli_fetch_array($sql_minor);
$minor_name=$row_minor['minor_name'];
?>
<center><h2>Student's Major is <?php echo $majorid." - ".$major_name;?> AND Minor is <?php echo $minorid." - ".$minor_name;?> </h2></center>
<div class="container">
    <h2>Viewing Course Registered by Student whether he has satisfied or not. </h2>
        <table>
            <tr>
            <th>CRN</th>
            <th>CourseID</th>
            <th>Course Name</th>
            <th>Department</th>
          
            <th>Credits</th>
            <th>Grade Obtained</th>
            <th>Satisfied/Unsatisfied</th>
          
           
              
            </tr>

            <?php
$sql_student_history = "SELECT * FROM student_history where studentid='$userid' ";
$row_student_history= mysqli_query($conn1, $sql_student_history) or die(mysqli_error($conn1));
$status="";
 //looping through each and getting details relevant
 while($det_student_history = mysqli_fetch_assoc($row_student_history)){
    $crn=$det_student_history['crn'];
    $grade_obtained=$det_student_history['grade'];
    $sql_course_section=mysqli_query($conn,"SELECT * FROM course_section where crn='$crn' ");
          $row_course_section= mysqli_fetch_array($sql_course_section);
          if(is_array($row_course_section))
          {

            $courseid=$row_course_section['courseid'];
            $roomid=$row_course_section['roomid'];
            $sql_course=mysqli_query($conn,"SELECT * FROM course where courseid='$courseid'");
$row_course= mysqli_fetch_array($sql_course);
 $course_name=$row_course['course_name'];
$departmentid=$row_course['departmentid'];
 $course_name=$row_course['course_name'];
 $number_of_credits=$row_course['no_of_credits'];

 $sql_major_requirements=mysqli_query($conn,"SELECT * FROM major_requirements where courseid='$courseid'");
$row_major_requirements= mysqli_fetch_array($sql_major_requirements);
$minimumPassGrade=$row_major_requirements['minimum_grade_required'];

// $minimumPassGrade="C";
 if (ord($grade_obtained) <= ord($minimumPassGrade)) {
     $status = "SATISFIED";
 } else {
     $status = "NOT SATISFIED";
 }
 
            ?>
       
        
           
        
          
            <tr>
            <td><?php echo $crn; ?></td>
            <td><?php echo $courseid; ?></td>
            <td><?php echo $course_name; ?></td>
                 <td><?php echo $departmentid;?></td>
             
                <td><?php echo $number_of_credits;?></td>
                <td><?php echo $grade_obtained; ?></td>
                <td><?php echo $status; ?></td>
          <?php
          
          ?>
               
         
            </tr>
           <?php
                }



 } //while loop end
        ?>
            <!-- Add more rows as needed -->
        </table>
       <br><br>


     
    </div>

    <center><h2>Total Requirements for MAJOR <?php echo $majorid." - ".$major_name;?> </h2></center>
    <div class="container">
    <h2>Viewing Total Requirements Needed for the major to complete. </h2>
        <table>
            <tr>
    
            <th>CourseID</th>
            <th>Course Name</th>
            <th>Department</th>
          
            <th>Credits</th>
            <th>Grade Required to Pass</th>
  
          
           
              
            </tr>

            <?php
$sql_major_requirements = "SELECT * FROM major_requirements where majorid='$majorid' ";
$row_major_requirements= mysqli_query($conn1, $sql_major_requirements) or die(mysqli_error($conn1));

 //looping through each and getting details relevant
 while($det_major_requirements = mysqli_fetch_assoc($row_major_requirements)){
    $courseid=$det_major_requirements['courseid'];
$grade_required=$det_major_requirements['minimum_grade_required'];
    $sql_course=mysqli_query($conn,"SELECT * FROM course where courseid='$courseid' ");
          $row_course= mysqli_fetch_array($sql_course);
          if(is_array($row_course))
          {

            $courseid=$row_course['courseid'];
          
            
 $course_name=$row_course['course_name'];
$departmentid=$row_course['departmentid'];
$number_of_credits=$row_course['no_of_credits'];

       

            ?>
       
        
           
        
          
            <tr>
        
            <td><?php echo $courseid; ?></td>
            <td><?php echo $course_name; ?></td>
                 <td><?php echo $departmentid;?></td>
             
                <td><?php echo $number_of_credits;?></td>
                <td><?php echo $grade_required; ?></td>
             
          <?php
          
          ?>
               
         
            </tr>
           <?php
                }



 } //while loop end
        ?>
            <!-- Add more rows as needed -->
        </table>
       <br><br>


     
    </div>

    
    <center><h2>Total Requirements for MINOR <?php echo $minorid." - ".$minor_name;?> </h2></center>
    <div class="container">
    <h2>Viewing Total Requirements Needed for the major to complete. </h2>
        <table>
            <tr>
    
            <th>CourseID</th>
            <th>Course Name</th>
            <th>Department</th>
          
            <th>Credits</th>
            <th>Grade Required to Pass</th>
  
          
           
              
            </tr>

            <?php
$sql_minor_requirements = "SELECT * FROM minor_requirements where minorid='$minorid' ";
$row_minor_requirements= mysqli_query($conn1, $sql_minor_requirements) or die(mysqli_error($conn1));

 //looping through each and getting details relevant
 while($det_minor_requirements = mysqli_fetch_assoc($row_minor_requirements)){
    $courseid=$det_minor_requirements['courseid'];
$grade_required=$det_minor_requirements['minimum_grade_required'];
    $sql_course=mysqli_query($conn,"SELECT * FROM course where courseid='$courseid' ");
          $row_course= mysqli_fetch_array($sql_course);
          if(is_array($row_course))
          {

            $courseid=$row_course['courseid'];
          
            
 $course_name=$row_course['course_name'];
$departmentid=$row_course['departmentid'];
$number_of_credits=$row_course['no_of_credits'];

       

            ?>
       
        
           
        
          
            <tr>
        
            <td><?php echo $courseid; ?></td>
            <td><?php echo $course_name; ?></td>
                 <td><?php echo $departmentid;?></td>
             
                <td><?php echo $number_of_credits;?></td>
                <td><?php echo $grade_required; ?></td>
             
          <?php
          
          ?>
               
         
            </tr>
           <?php
                }



 } //while loop end
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
