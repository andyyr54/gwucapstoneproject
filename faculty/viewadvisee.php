<?php
session_start();
    
            if($_SESSION['user_type']=="faculty") { 
                

        include 'dbconfig.php';
       
       $facultyid=$_SESSION['userid'];
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
        <h2>View Student Details</h2>
        <table>
            <tr>
            <th>Student ID</th>
                <th>Student First Name</th>
                <th>Student Last Name</th>
              

                <th>Date of Advising</th>
                <th>Student Type</th>
                <th>Student Phone</th>
                <th>Student Email</th>
          <th>View Degree Audit</th>
          <th>View Transcript</th>
          <th>View Semester Schedule FALL2023</th>
          <th>View Semester Schedule SPRING2024</th>
            </tr>
        <?php
            
            $sql_advising = "SELECT * FROM advising where facultyid='$facultyid'";
            $result_advising= mysqli_query($conn1, $sql_advising) or die(mysqli_error($conn1));

            while($det_advising = mysqli_fetch_assoc($result_advising)){
      
                $studentid=$det_advising['studentid'];

                        $facultyid=$det_advising['facultyid'];
                        $date_of_advising=$det_advising['date_of_advising'];
                        $student_type=$det_advising['student_type'];
                
              

                
          $sql_user=mysqli_query($conn,"SELECT * FROM user where userid='$studentid'");
          $row_user = mysqli_fetch_array($sql_user);
          if(is_array($row_user))
          {
            
            $student_first_name=$row_user['first_name'];
            $student_last_name=$row_user['last_name'];
            $student_phone=$row_user['phone'];
            
          }
          $sql_login=mysqli_query($conn,"SELECT * FROM login where userid='$studentid'");
          $row_login  = mysqli_fetch_array($sql_login);
          if(is_array($row_login))
          {
            $student_email=$row_login['email'];
      
            
          }
          $link="viewdegreeaudit.php?studentid=".$studentid;
          $link2="viewtranscriptsummary.php?studentid=".$studentid;
          $link3="viewsemesterschedule.php?studentid=".$studentid."&semesterid=FALL2023";
          $link4="viewsemesterschedule.php?studentid=".$studentid."&semesterid=SPRING2024"; 
                
    ?>
        
          
            <tr>
              
                <td><?php echo $studentid;?></td>
                <td><?php echo $student_first_name; ?></td>
                <td><?php echo $student_last_name; ?></td>
 
    
                <td><?php echo $date_of_advising ?></td>
                <td><?php echo $student_type ?></td>
                <td><?php echo $student_phone ?></td>
                <td><?php echo $student_email ?></td>
                <td><a href="<?php echo $link ?>"><button type="button" >View Degree Audit of the student</button></a></td>
                <td><a href="<?php echo $link2 ?>"><button type="button" >View Degree Transcript of the student</button></a></td>
                <td><a href="<?php echo $link3 ?>"><button type="button" >View Semester Schedule</button></a></td>
                <td><a href="<?php echo $link4 ?>"><button type="button" >View Semester Schedule</button></a></td>
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
    header("Location: ../login.html");
    }
?>
