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
        <h2>Viewing All Minor Requirement Details</h2>
        <table>
            <tr>
            <th>Minor ID</th>
                <th>Course ID</th>
                <th>Minimum Grade Required</th>
             
               
                <th>Update Requirement Details!</th>
     
                
            </tr>
        <?php
             $sql_minor_table= "SELECT * FROM minor_requirements ";
             $result_minor_table = mysqli_query($conn1, $sql_minor_table) or die(mysqli_error($conn1));


             while($det_minor_table = mysqli_fetch_assoc($result_minor_table)){
                // $departmentid=$det_minor_table["departmentid"];
                $courseid=$det_minor_table["courseid"];
                $minorid=$det_minor_table["minorid"];
               $linkforupdateminorrequirement="updateminorrequirementdetails.php?minorid=".$minorid.'&courseid='.$courseid;
                
    ?>
        
          
            <tr>
              
                <td><?php echo $det_minor_table["minorid"];?></td>
                <td><?php echo $det_minor_table["courseid"] ;?></td>
                <td><?php echo $det_minor_table["minimum_grade_required"] ?></td>
    
        
                <td><a href="<?php echo $linkforupdateminorrequirement ?>"><button type="button" >Update Details!</button></a></td>
             
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
