<?php
session_start();
    
            if($_SESSION['user_type']=="student") { 
                

        include 'dbconfig.php';
       $userid=$_SESSION['userid'];
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

$sql_student_history_exists=mysqli_query($conn,"SELECT * FROM student_history where studentid='$userid' AND semesterid='$semesterid'");
          $row_student_history_exists= mysqli_fetch_array($sql_student_history_exists);
          if(is_array($row_student_history_exists))
          {
            ?>
    <div class="container">
    <h2>Viewing Transcript -  <?php echo $semesterid ?>  </h2>
        <table>
            <tr>
            <th>CRN</th>
            <th>CourseID</th>
            <th>Course Name</th>
            <th>Department</th>
           <th>Room ID</th>
            <th>Credits</th>
            <th>Grade Obtained</th>
          
           
              
            </tr>
        <?php
$studentid=$userid;


          
          
 $sql_student_history = "SELECT * FROM student_history where studentid='$userid' AND semesterid='$semesterid'";
 $row_student_history= mysqli_query($conn1, $sql_student_history) or die(mysqli_error($conn1));

 //looping through each dayid and getting details relevant
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
          
        
            $sql_course=mysqli_query($conn,"SELECT * FROM course where courseid='$courseid'");
$row_course= mysqli_fetch_array($sql_course);
 $course_name=$row_course['course_name'];
 $number_of_credits=$row_course['no_of_credits'];

            ?>
       
        
           
        
          
            <tr>
            <td><?php echo $crn; ?></td>
            <td><?php echo $courseid; ?></td>
            <td><?php echo $course_name; ?></td>
                 <td><?php echo $departmentid;?></td>
                <td><?php echo $roomid;?></td>
                <td><?php echo $number_of_credits;?></td>
                <td><?php echo $grade_obtained; ?></td>
                
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
}
else
{
    ?>
<h2>There is no Transcript present as you haven't enrolled to any courses in this semester</h2>
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
