<?php
session_start();
    
            if($_SESSION['user_type']=="faculty") { 
                

        include 'dbconfig.php';
       
       $crn=$_GET['crn'];
       $attendance_date=$_GET['attendance_date'];
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
        <h2>Viewing Attendance Details of Student attended for class</h2>
        <table>
            <tr>
            <th>Student ID</th>
                <th>Student First Name</th>
                <th>Student Last Name</th>
              

                <th>Student Phone</th>
                <th>Student Email</th>
                <th>Attendance Date</th>
           
            </tr>
        <?php
            
            $sql_attendance = "SELECT * FROM attendance where crn='$crn' AND attendance_date='$attendance_date'";
            $result_attendance= mysqli_query($conn1, $sql_attendance) or die(mysqli_error($conn1));
            $date = date('jS F Y', strtotime($attendance_date));
            while($det_attendance = mysqli_fetch_assoc($result_attendance)){
      
                $studentid=$det_attendance['studentid'];

                
                
              

                
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
         
              
              
                
    ?>
        
          
            <tr>
              
                <td><?php echo $studentid;?></td>
                <td><?php echo $student_first_name; ?></td>
                <td><?php echo $student_last_name; ?></td>

                <td><?php echo $student_phone ?></td>
                <td><?php echo $student_email ?></td>
                <td><?php echo $date ?></td>
               
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
