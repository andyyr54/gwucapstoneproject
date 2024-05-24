<?php
session_start();
    
            if($_SESSION['user_type']=="admin") { 
                

        include 'dbconfig.php';
       
       
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
        <h2>View Existing Student Details who are on HOLD!</h2>
        <table>
            <tr>
            <th>Hold ID</th>
            <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Hold Date</th>
                <th>Hold Type</th>
                <!-- <th>Gender</th>
                <th>DOB</th>
                <th>Street</th>
                <th>State</th>
                <th>ZipCode</th>
                <th>Phone</th> -->
                <th>Drop Hold</th>
              
            </tr>
        <?php
            
            $sql_hold = "SELECT * FROM student_hold";
            $result_hold = mysqli_query($conn1, $sql_hold) or die(mysqli_error($conn1));

            while($det_result_hold = mysqli_fetch_assoc($result_hold)){
                $userid=$det_result_hold['studentid'];

    
                $sql_user=mysqli_query($conn,"SELECT * FROM user where userid='$userid'");
                $row_user  = mysqli_fetch_array($sql_user);
                if(is_array($row_user))
                {

                
                $userid=$row_user["userid"];
                    $holdid=$det_result_hold["holdid"];
                    $sql_hold_table=mysqli_query($conn,"SELECT * FROM hold where holdid='$holdid'");
                    $row_hold_table  = mysqli_fetch_array($sql_hold_table);
                    if(is_array($row_hold_table))
                    {
                            $holdtype=$row_hold_table["hold_type"];
                    }
                    $link_to_drop="drophold.php?studentid=".$userid."&holdid=".$holdid;
                
               
                
    ?>
        
          
            <tr>
              
                <td><?php echo $det_result_hold["holdid"];?></td>
                <td><?php echo $row_user["userid"];?></td>
                <td><?php echo $row_user["first_name"] ?></td>
                <td><?php echo $row_user["last_name"] ?></td>
                <td><?php echo $det_result_hold["date_of_hold"] ?></td>
                <td><?php echo $holdtype ?></td>
 
                <td><a href="<?php echo $link_to_drop ?>"><button type="button" >Drop Hold </button></a></td>
            </tr>
           <?php
                }
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
