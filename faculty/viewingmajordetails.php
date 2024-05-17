<?php
session_start();
    

                

        include 'dbconfig.php';
       $majorid=$_GET['majorid'];
       
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
        <h2>Viewing Major Requirement Details</h2>
        <table>
            <tr>
            <th>Major ID</th>
            <th>Major</th>
                <th>Course ID</th>
                <th>Course</th>
                <th>Minimum Grade Required</th>
             
               
      
     
                
            </tr>
        <?php
             $sql_major_table= "SELECT * FROM major_requirements where majorid='$majorid'";
             $result_major_table = mysqli_query($conn1, $sql_major_table) or die(mysqli_error($conn1));


             while($det_major_table = mysqli_fetch_assoc($result_major_table)){
                // $departmentid=$det_major_table["departmentid"];
                $courseid=$det_major_table["courseid"];

                $sql_major=mysqli_query($conn,"SELECT * FROM major where majorid='$majorid'");
                $row_major  = mysqli_fetch_array($sql_major);
                if(is_array($row_major))
                {
                        $major = $row_major["major_name"];
                }


                $sql_course=mysqli_query($conn,"SELECT * FROM course where courseid='$courseid'");
                $row_course  = mysqli_fetch_array($sql_course);
                if(is_array($row_course))
                {
                        $course = $row_course["course_name"];
                }
              
           
    ?>
        
          
            <tr>
              
                <td><?php echo $det_major_table["majorid"];?></td>
                <td><?php echo $major;?></td>
                <td><?php echo $det_major_table["courseid"] ;?></td>
                <td><?php echo $course;?></td>
                <td><?php echo $det_major_table["minimum_grade_required"] ?></td>
    
        
             
            </tr>
           <?php
            
        }
            
            ?>
            <!-- Add more rows as needed -->
        </table>
    </div>
</body>
</html>

