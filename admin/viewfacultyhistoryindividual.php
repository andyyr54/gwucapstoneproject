<?php
session_start();
    
            if($_SESSION['user_type']=="admin") { 
                

        include 'dbconfig.php';
       $userid=$_GET['facultyid'];
     
        ?>
        <!DOCTYPE html>
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
          $sql_faculty_history=mysqli_query($conn,"SELECT * FROM faculty_history where facultyid='$userid'");
          $row_faculty_history = mysqli_fetch_array($sql_faculty_history);
          if(is_array($row_faculty_history))
          {
            ?>
        <h2>Viewing Faculty History Details for FacultyID - <?php echo $userid ?></h2>
        <table>
            <tr>
         
            <th>Faculty ID</th>
        
                <th>CRN</th>
                <th>CourseID</th>
                <th>SemesterID</th>
                <!-- <th>Gender</th>
                <th>DOB</th>
                <th>Street</th>
                <th>State</th>
                <th>ZipCode</th>
                <th>Phone</th> -->
          
              
            </tr>
        <?php
            
            $sql_faculty_history = "SELECT * FROM faculty_history where facultyid='$userid'";
            $result_faculty_history= mysqli_query($conn1, $sql_faculty_history) or die(mysqli_error($conn1));

            while($det_faculty_history= mysqli_fetch_assoc($result_faculty_history)){
                $crn=$det_faculty_history['crn'];

    
               
                
    ?>
        
          
            <tr>
              
                <td><?php echo $det_faculty_history["facultyid"];?></td>
                <td><?php echo $det_faculty_history["crn"];?></td>
                <td><?php echo $det_faculty_history["courseid"] ?></td>
                <td><?php echo $det_faculty_history["semesterid"] ?></td>

             
 
               
            </tr>
           <?php
                }
        
            
            ?>
            <!-- Add more rows as needed -->
        </table>
    <?php
    }
    else
    {
        ?>
<h2>There is no History for for the FacultyID - <?php echo $userid ?></h2>
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
