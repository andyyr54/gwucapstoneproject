<?php
session_start();
    
            if($_SESSION['user_type']=="faculty") { 
                

        include 'dbconfig.php';
       $userid=$_SESSION['userid'];
     $crn=$_GET['crn'];
    
     date_default_timezone_set('America/New_York');
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
    <h2>Viewing Students Enrolled for CRN. - <?php echo $crn ?> </h2>
        <table>
            <tr>
 
            <th>Student ID</th>
            <th>Student First Name</th>
            <th>Student Last Name</th>
            <th>Grade</th>
            
            <th>Date Of Enrollment</th>
           
            <th>Change Grade</th>
          
           
              
            </tr>
        <?php
$facultyid=$userid;
$sql_course_section=mysqli_query($conn,"SELECT * FROM course_section where crn='$crn'");
$row_course_section = mysqli_fetch_array($sql_course_section);
$semesterid=$row_course_section['semesterid'];
$sql_semester=mysqli_query($conn,"SELECT * FROM semester where semesterid='$semesterid'");
$row_semester = mysqli_fetch_array($sql_semester);
$semester_end_date=$row_semester['end_date'];
$allow_grade_change="NO";

    // Assuming $semester_end_date is in the format 'm/d/Y'
    // $semester_end_date = '12/29/2023';

    // Convert the date to 'Y-m-d' format
    $date = DateTime::createFromFormat('m/d/Y', $semester_end_date);
    if ($date === false) {
        echo "Failed to parse date: $semester_end_date";
    } else {
        $semester_end_date = $date->format('Y-m-d');

        // Get today's date
        $today_date = date('Y-m-d');

        // Convert to DateTime objects
        $semester_end_date = date_create($semester_end_date);
        $today_date = date_create($today_date);

        // Calculate the difference in days
        $interval = date_diff($semester_end_date, $today_date);
        $days_left = $interval->format('%a');

        // Check if it's less than 2 days
        if ($days_left < 2) {
            // echo "Less than 2 days";
            $allow_grade_change="YES";
        }
    }



 $sql_enrollment= "SELECT * FROM enrollment where crn='$crn' ";
 $row_enrollment = mysqli_query($conn1, $sql_enrollment) or die(mysqli_error($conn1));

 //looping through each dayid and getting details relevant
 while($det_enrollment = mysqli_fetch_assoc($row_enrollment)){
    $crn=$det_enrollment['crn'];
    $studentid=$det_enrollment['studentid'];
    $current_grade=$det_enrollment['grade'];
    $link="updategrade.php?crn=".$crn."&studentid=".$studentid;

         $date_of_enrollment=$det_enrollment['date_of_enrollment'];
           
         $sql_user=mysqli_query($conn,"SELECT * FROM user where userid='$studentid'");
         $row_user = mysqli_fetch_array($sql_user);
         if(is_array($row_user))
         {
           
           $student_first_name=$row_user['first_name'];
           $student_last_name=$row_user['last_name'];
           $student_phone=$row_user['phone'];
           
         }
            ?>
       
        
           
        
          
            <tr>

            <td><?php echo $studentid; ?></td>
          
                <td><?php echo $student_first_name;?></td>
             <td><?php echo $student_last_name;?></td>
                <td><?php echo $current_grade;?></td>
                <td><?php echo $date_of_enrollment; ?></td>
                <?php
                 if($allow_grade_change=="YES"){
                    
                    ?>
                <td><a href="<?php echo $link ?>"><button type="button" >Change/Assign Grade </button></a></td>
                <?php
            }
            else
            {
                ?>
                <td><a href=""><button type="button" >Can't Change/Assign Grade. </button></a></td>
                <?php
            }
            ?>
          <?php
          
          ?>
               
         
            </tr>
           <?php
                
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
