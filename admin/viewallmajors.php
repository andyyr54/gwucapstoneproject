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
        <h2>Viewing Major Details Of Department</h2>
        <table>
            <tr>
            <th>Major ID</th>
            <th>Department ID</th>
                <th>Major Name</th>
                <th>Credits Required</th>
               
         
                <!-- <th>Gender</th>
                <th>DOB</th>
                <th>Street</th>
                <th>State</th>
                <th>ZipCode</th>
                <th>Phone</th> -->
                <th>View More Major Details with Major Requirements !</th>
                <th>Update Major Details!</th>
                
            </tr>
        <?php
             $sql_major_table = "SELECT * FROM major where majorid!='NAA';";
             $result_major_table = mysqli_query($conn1, $sql_major_table) or die(mysqli_error($conn1));
 
             while($det_major_table = mysqli_fetch_assoc($result_major_table)){
                $departmentid=$det_major_table["departmentid"];
               $majorid=$det_major_table["majorid"];
                $linkforindividualdepartmentdetails="individualdepartmentdetails.php?departmentid=".$departmentid;
        

          $linkforviewingmajordetails="viewingmajordetails.php?majorid=".$majorid;
          $linkforupdatemajordetails="updatemajordetails.php?majorid=".$majorid;
                
    ?>
        
          
            <tr>
              
                <td><?php echo $det_major_table["majorid"];?></td>
                <td><?php echo $det_major_table["departmentid"];?></td>
                <td><?php echo $det_major_table["major_name"]; ?></td>
                <td><?php echo $det_major_table["credits_required"]; ?></td>

               
   
                <td><a href="<?php echo $linkforviewingmajordetails ?>"><button type="button" >View More Major Details!</button></a></td>
                <td><a href="<?php echo $linkforupdatemajordetails ?>"><button type="button" >Update Major Details!</button></a></td>
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
