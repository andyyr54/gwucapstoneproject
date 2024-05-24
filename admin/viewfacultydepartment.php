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
        <?php

$sql_faculty=mysqli_query($conn,"SELECT * FROM faculty where facultyid='$userid'");
$row_faculty= mysqli_fetch_array($sql_faculty);
 $faculty_type=strtoupper($row_faculty['faculty_type']);

          $sql_faculty_department=mysqli_query($conn,"SELECT * FROM faculty_department where facultyid='$userid'");
          $row_faculty_department= mysqli_fetch_array($sql_faculty_department);
          if(is_array($row_faculty_department))
          {
            $linktoassignfacultydepartment="assignfacultytodepartment.php?facultyid=".$userid;
            ?>
        <h2>Viewing Faculty History Details for FacultyID - <?php echo $userid ?></h2>
        <table>
            <tr>
         
            <th>Faculty ID</th>
        
                <th>Department ID</th>
                <th>Faculty Type</th>
                <th>Percentage of Time Spent</th>
                <th>Date of Assignment</th>
                <!-- <th>Gender</th>
                <th>DOB</th>
                <th>Street</th>
                <th>State</th>
                <th>ZipCode</th>
                <th>Phone</th> -->
         
              
            </tr>
        <?php
            $no_of_department=0;
            $sql_faculty_department = "SELECT * FROM faculty_department where facultyid='$userid'";
            $row_faculty_department= mysqli_query($conn1, $sql_faculty_department) or die(mysqli_error($conn1));

            while($det_faculty_department= mysqli_fetch_assoc($row_faculty_department)){
 
                $no_of_department= $no_of_department+1;
    
               
                
    ?>
        
          
            <tr>
              
                <td><?php echo $det_faculty_department["facultyid"];?></td>
                <td><?php echo $det_faculty_department["departmentid"];?></td>
                <td><?php echo $faculty_type;?></td>
                <td><?php echo $det_faculty_department["percentage_of_time_spent"] ?></td>
                <td><?php echo $det_faculty_department["Date_of_assignment"] ?></td>

             
 
               
            </tr>
           <?php
                }
        
            
            ?>
            <!-- Add more rows as needed -->
        </table>
       <br><br>

        <?php
  
if( $faculty_type=="FULL TIME"){
    if($no_of_department<2)
    {
        ?>
        <center><a href="<?php echo $linktoassignfacultydepartment; ?>"><button type="button" >Assign Faculty to Department</button></a></center>
        <?php
       }
       else
       {
           ?>
        <center><a href=""><button type="button" >Cannot Assign as faculty is in 2 Department for Full Time</button></a></center>
        <?php
       }
    }
    if( $faculty_type=="PART TIME"){
        if($no_of_department<1)
        {
            ?>
            <center><a href="<?php echo $linktoassignfacultydepartment; ?>"><button type="button" >Assign Faculty to Department</button></a></center>
            <?php
           }
           else
           {
               ?>
            <center><a href=""><button type="button" >Cannot Assign as faculty is in 1 Department for Part Time</button></a></center>
            <?php
           }
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
