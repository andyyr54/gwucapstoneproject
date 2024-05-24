<?php
session_start();
    
            if($_SESSION['user_type']=="admin") { 
                

        include 'dbconfig.php';
       $userid=$_GET['studentid'];
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
    <h2>Viewing Degree Audit for Major. </h2>
        <table>
            <tr>
   
            <th>CourseID</th>
            <th>Course Name</th>
            <th>Department</th>
          
            <th>Credits</th>
            <th>Grade Obtained</th>
            <th>Satisfied/Unsatisfied</th>
          
            <th>Enrolled/Not Enrolled</th>
              
            </tr>

            <?php
$sql_major_table = "SELECT * FROM major_requirements where majorid='$majorid' ";
$row_major_table= mysqli_query($conn1, $sql_major_table) or die(mysqli_error($conn1));
$status="";
$major_completed = 0;
$is_enrolled="";
 //looping through each and getting details relevant
 while($det_major_table = mysqli_fetch_assoc($row_major_table)){
$courseid=$det_major_table['courseid'];
    $minimumPassGrade=$det_major_table['minimum_grade_required'];
    $majid=$det_major_table['majorid'];
    $sql_course_section=mysqli_query($conn,"SELECT * FROM course_section where courseid='$courseid' ");
          $row_course_section= mysqli_fetch_array($sql_course_section);
          if(is_array($row_course_section))
          {

            $sql_course=mysqli_query($conn,"SELECT * FROM course where courseid='$courseid'");
$row_course= mysqli_fetch_array($sql_course);
 $course_name=$row_course['course_name'];
$departmentid=$row_course['departmentid'];
 $course_name=$row_course['course_name'];
 $number_of_credits=$row_course['no_of_credits'];
 

 $sql_student_history=mysqli_query($conn,"SELECT * FROM student_history where courseid='$courseid' AND studentid='$studentid' ");
 $row_student_history= mysqli_fetch_array($sql_student_history);
 if(is_array($row_student_history))
 {
    $grade_obtained=$row_student_history['grade'];
 
$is_enrolled="ENROLLED";
// $minimumPassGrade="C";
 if (ord($grade_obtained) <= ord($minimumPassGrade)) {
     $status = "SATISFIED";
     $is_enrolled="COMPLETED";
     if($majorid == $majid ){
        $major_completed++;
     }
 } else {
     $status = "NOT SATISFIED";
 }
}
else
{
    $status = "NOT SATISFIED";
    $is_enrolled="NOT ENROLLED";
    $grade_obtained="NR";
}
            ?>
       
        
           
        
          
            <tr>

            <td><?php echo $courseid; ?></td>
            <td><?php echo $course_name; ?></td>
                 <td><?php echo $departmentid;?></td>
             
                <td><?php echo $number_of_credits;?></td>
                <td><?php echo $grade_obtained; ?></td>
                <td><?php echo $status; ?></td>
                <td><?php echo $is_enrolled; ?></td>
          <?php
          
          ?>
               
         
            </tr>
           <?php
                }



 } //while loop end
        ?>

            <?php
               $major_requirements_sql = "SELECT COUNT(*) AS row_count FROM major_requirements where majorid ='$majorid'";

    // Execute the query
    $major_requirements_result = mysqli_query($conn, $major_requirements_sql);

    // Check if the query was successful
    if ($major_requirements_result) {
        // Fetch the result as an associative array
        $major_requirements_row = mysqli_fetch_assoc($major_requirements_result);

        // Access the count value
        $major_requirements = $major_requirements_row['row_count'];
    } else {
        // Handle the case where the query fails
        echo "Error executing graduate query: " . mysqli_error($conn);
    }
        $major_completion = round(($major_completed / $major_requirements) * 100);
         ?>
            <!-- Add more rows as needed -->
            <h2 style="color: green;"><?php echo $major_name . ": " . $major_completion ."%"; ?> completed! </h2>
            <!-- Add more rows as needed -->
        </table>
       <br><br>


     
    </div>

    <div class="container">
    <h2>Viewing Degree Audit for Minor. </h2>
        <table>
            <tr>
   
            <th>CourseID</th>
            <th>Course Name</th>
            <th>Department</th>
          
            <th>Credits</th>
            <th>Grade Obtained</th>
            <th>Satisfied/Unsatisfied</th>
          
            <th>Enrolled/Not Enrolled</th>
              
            </tr>

            <?php
$sql_minor_table = "SELECT * FROM minor_requirements where minorid='$minorid' ";
$row_minor_table= mysqli_query($conn1, $sql_minor_table) or die(mysqli_error($conn1));
$status="";
$is_enrolled="";
$minor_completed = 0;
 //looping through each and getting details relevant
 while($det_minor_table = mysqli_fetch_assoc($row_minor_table)){
$minid = $det_minor_table['minorid'];
$courseid=$det_minor_table['courseid'];
    $minimumPassGrade=$det_minor_table['minimum_grade_required'];
    $sql_course_section=mysqli_query($conn,"SELECT * FROM course_section where courseid='$courseid' ");
          $row_course_section= mysqli_fetch_array($sql_course_section);
          if(is_array($row_course_section))
          {

            $sql_course=mysqli_query($conn,"SELECT * FROM course where courseid='$courseid'");
$row_course= mysqli_fetch_array($sql_course);
 $course_name=$row_course['course_name'];
$departmentid=$row_course['departmentid'];
 $course_name=$row_course['course_name'];
 $number_of_credits=$row_course['no_of_credits'];

 $sql_student_history=mysqli_query($conn,"SELECT * FROM student_history where courseid='$courseid' AND studentid='$studentid' ");
 $row_student_history= mysqli_fetch_array($sql_student_history);
 if(is_array($row_student_history))
 {
    $grade_obtained=$row_student_history['grade'];
 
$is_enrolled="ENROLLED";
// $minimumPassGrade="C";
 if (ord($grade_obtained) <= ord($minimumPassGrade)) {
     $status = "SATISFIED";
     $is_enrolled="COMPLETED";
      if($minorid == $minid){
     $minor_completed++;
 }
 } else {
     $status = "NOT SATISFIED";
 }
}
else
{
    $status = "NOT SATISFIED";
    $is_enrolled="NOT ENROLLED";
}
            ?>
       
        
           
        
          
            <tr>

            <td><?php echo $courseid; ?></td>
            <td><?php echo $course_name; ?></td>
                 <td><?php echo $departmentid;?></td>
             
                <td><?php echo $number_of_credits;?></td>
                <td><?php echo $grade_obtained; ?></td>
                <td><?php echo $status; ?></td>
                <td><?php echo $is_enrolled; ?></td>
          <?php
          
          ?>
               
         
            </tr>
           <?php
                }



 } //while loop end
        ?>
            <?php 
              $minor_requirements_sql = "SELECT COUNT(*) AS row_count FROM minor_requirements where minorid ='$minorid'";

    // Execute the query
    $minor_requirements_result = mysqli_query($conn, $minor_requirements_sql);

    // Check if the query was successful
    if ($minor_requirements_result) {
        // Fetch the result as an associative array
        $minor_requirements_row = mysqli_fetch_assoc($minor_requirements_result);

        // Access the count value
        $minor_requirements = $minor_requirements_row['row_count'];
    } else {
        // Handle the case where the query fails
        echo "Error executing graduate query: " . mysqli_error($conn);
    }
        $minor_completion = round(($minor_completed / $minor_requirements) * 100);
         ?>

        <h2 style="color: green;"><?php echo $minor_name . ": " . $minor_completion ."%"; ?> completed! </h2>
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
