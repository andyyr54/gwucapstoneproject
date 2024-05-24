<?php
session_start();
    
            if($_SESSION['user_type']=="admin") { 
                

        include 'dbconfig.php';
       
       
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
            <th>User ID</th>
                <th>Student First Name</th>
                <th>Student Last Name</th>
                <th>FacultyID</th>
                <th>Faculty Name</th>
                <th>Date of Advising</th>
                <th>Student Type</th>
                <!-- <th>Gender</th>
                <th>DOB</th>
                <th>Street</th>
                <th>State</th>
                <th>ZipCode</th>
                <th>Phone</th> -->
                <th>Update Advising Details!</th>
           
            </tr>
        <?php
            
            $sql_studentdetails = "SELECT * FROM user WHERE user_type='Student' ORDER BY first_name ASC, last_name ASC";
            $result_studentdetails = mysqli_query($conn1, $sql_studentdetails) or die(mysqli_error($conn1));

            while($det_studentdetails = mysqli_fetch_assoc($result_studentdetails)){
                $userid=$det_studentdetails["userid"];
                $sql_advising=mysqli_query($conn,"SELECT * FROM advising where studentid='$userid'");
                $row_advising  = mysqli_fetch_array($sql_advising);
                if(is_array($row_advising))
                {
                        $facultyid=$row_advising['facultyid'];
                        $date_of_advising=$row_advising['date_of_advising'];
                        $student_type=$row_advising['student_type'];
                }
              

                
                $sql_faculty_name=mysqli_query($conn,"SELECT * FROM user where userid='$facultyid'");
          $row_faculty_name  = mysqli_fetch_array($sql_faculty_name);
          if(is_array($row_faculty_name))
          {
            $faculty_first_name=$row_faculty_name['first_name'];
          }
         
                $link="updateadvisingdetails.php?userid=".$userid;
              
                
    ?>
        
          
            <tr>
              
                <td><?php echo $det_studentdetails["userid"];?></td>
                <td><?php echo $det_studentdetails["first_name"] ?></td>
                <td><?php echo $det_studentdetails["last_name"] ?></td>
                <td><?php echo $facultyid ?></td>
                <td><?php echo $faculty_first_name ?></td>
                <td><?php echo $date_of_advising ?></td>
                <td><?php echo $student_type ?></td>
                <td><a href="<?php echo $link ?>"><button type="button" >Update Advising Details!</button></a></td>
               
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
    header("Location: login.html");
    }
?>
