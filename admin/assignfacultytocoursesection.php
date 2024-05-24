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
        <h2>View Faculty Details</h2>
        <table>
            <tr>
            <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Department ID</th>
                <th>Faculty Type</th>
    
                <!-- <th>Gender</th>
                <th>DOB</th>
                <th>Street</th>
                <th>State</th>
                <th>ZipCode</th>
                <th>Phone</th> -->

                <th>Assign/View Faculty to Course Section according to Semester!</th>
            </tr>
        <?php
            
            $sql_facultydetails = "SELECT * FROM user where user_type='Faculty' ORDER BY first_name ASC, last_name ASC";
            $result_facultydetails = mysqli_query($conn1, $sql_facultydetails) or die(mysqli_error($conn1));

            while($det_facultydetails = mysqli_fetch_assoc($result_facultydetails)){
                $userid=$det_facultydetails["userid"];
                $link="selectsemesterforfacultyassign.php?facultyid=".$userid;
                $sql_departmentid=mysqli_query($conn,"SELECT * FROM faculty_department where facultyid='$userid';");
                $row_departmentid  = mysqli_fetch_array($sql_departmentid);
                if(is_array($row_departmentid))
                    {
                        $departmentid=$row_departmentid['departmentid'];
                    }
                $sql_faculty=mysqli_query($conn,"SELECT * FROM faculty where facultyid='$userid';");
                $row_faculty  = mysqli_fetch_array($sql_faculty);
                if(is_array($row_faculty))
                    {
                        $faculty_type=$row_faculty['faculty_type'];
                    }
                
    ?>
        
          
            <tr>
              
                <td><?php echo $det_facultydetails["userid"];?></td>
                <td><?php echo $det_facultydetails["first_name"] ?></td>
                <td><?php echo $det_facultydetails["last_name"] ?></td>
                <td><?php echo $departmentid; ?></td>
                <td><?php echo $faculty_type; ?></td>
                <td><a href="<?php echo $link ?>"><button type="button" >Assign/View Faculty to Course Section according to Semester</button></a></td>
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
