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
        <h2>Viewing Department Details</h2>
        <table>
            <tr>
            <th>Department ID</th>
                <th>Chair ID</th>
                <th>RoomID</th>
                <th>Department Name</th>
                <th>Department Manager</th>
                <th>Email</th>
                <th>Phone</th>
                <!-- <th>Gender</th>
                <th>DOB</th>
                <th>Street</th>
                <th>State</th>
                <th>ZipCode</th>
                <th>Phone</th> -->
                <th>View More Details!</th>
                <th>Update Department Details!</th>
                
            </tr>
        <?php
             $sql_department = "SELECT * FROM department";
             $result_department = mysqli_query($conn1, $sql_department) or die(mysqli_error($conn1));
 
             while($det_department = mysqli_fetch_assoc($result_department)){
                $departmentid=$det_department["departmentid"];
               
                $linkforindividualdepartmentdetails="individualdepartmentdetails.php?departmentid=".$departmentid;
               $updatelinkforindividualdepartmentdetails="updateindividualdepartmentdetails.php?departmentid=".$departmentid;
                
    ?>
        
          
            <tr>
              
                <td><?php echo $det_department["departmentid"];?></td>
                <td><?php echo $det_department["chairid"] ?></td>
                <td><?php echo $det_department["roomid"] ?></td>
                <td><?php echo $det_department["department_name"] ?></td>
                <td><?php echo $det_department["department_manager"] ?></td>
                <td><?php echo $det_department["email"] ?></td>
                <td><?php echo $det_department["phone"] ?></td>
                <td><a href="<?php echo $linkforindividualdepartmentdetails ?>"><button type="button" >View More Details!</button></a></td>
                <td><a href="<?php echo $updatelinkforindividualdepartmentdetails ?>"><button type="button" >Update Details!</button></a></td>
             
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
