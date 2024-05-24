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
        <h2>View Student Details</h2>
        <table>
            <tr>
            <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <!-- <th>Gender</th>
                <th>DOB</th>
                <th>Street</th>
                <th>State</th>
                <th>ZipCode</th>
                <th>Phone</th> -->
                <th>Add Student to Hold</th>
       
            </tr>
        <?php
            
            $sql_studentdetails = "SELECT * FROM user WHERE user_type='Student' ORDER BY first_name ASC, last_name ASC";
            $result_studentdetails = mysqli_query($conn1, $sql_studentdetails) or die(mysqli_error($conn1));

            while($det_studentdetails = mysqli_fetch_assoc($result_studentdetails)){
                $userid=$det_studentdetails["userid"];
             
                $addstudenttohold="addstudenttohold.php?userid=".$userid;
                
               
                
    ?>
        
          
            <tr>
              
                <td><?php echo $det_studentdetails["userid"];?></td>
                <td><?php echo $det_studentdetails["first_name"] ?></td>
                <td><?php echo $det_studentdetails["last_name"] ?></td>
                <!-- <td><?php echo $det_studentdetails["gender"] ?></td>
                <td><?php echo $det_studentdetails["dob"] ?></td>
                <td><?php echo $det_studentdetails["street"] ?></td>
                <td><?php echo $det_studentdetails["state"] ?></td>
                <td><?php echo $det_studentdetails["zipcode"] ?></td>
                <td><?php echo $det_studentdetails["phone"] ?></td> -->
                 <td><a href="<?php echo $addstudenttohold ?>"><button type="button" >Add Student to Hold</button></a></td>
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
