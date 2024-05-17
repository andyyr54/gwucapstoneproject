<?php
session_start();
    
if ($_SESSION['user_type'] == "Stats Office") { 
    include 'dbconfig.php';
    $userid = $_SESSION['userid'];
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
                position: absolute; /* Add this line */
                top: 10px; /* Adjust top value as needed */
                right: 10px; /* Adjust right value as needed */
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
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

                $major_sql = "SELECT COUNT(*) AS row_count FROM major";

    // Execute the query
    $major_result = mysqli_query($conn, $major_sql);

    // Check if the query was successful
    if ($major_result) {
        // Fetch the result as an associative array
        $major_row = mysqli_fetch_assoc($major_result);

        // Access the count value
        $major = $major_row['row_count'];
    } else {
        // Handle the case where the query fails
        echo "Error executing graduate query: " . mysqli_error($conn);
    }


     $department_sql = "SELECT COUNT(*) AS row_count FROM department";

    // Execute the query
    $department_result = mysqli_query($conn, $department_sql);

    // Check if the query was successful
    if ($department_result) {
        // Fetch the result as an associative array
        $department_row = mysqli_fetch_assoc($department_result);

        // Access the count value
        $department = $department_row['row_count'];
    } else {
        // Handle the case where the query fails
        echo "Error executing graduate query: " . mysqli_error($conn);
    }


    $student_sql = "SELECT COUNT(*) AS row_count FROM student";

    // Execute the query
    $student_result = mysqli_query($conn, $student_sql);

    // Check if the query was successful
    if ($student_result) {
        // Fetch the result as an associative array
        $student_row = mysqli_fetch_assoc($student_result);

        // Access the count value
        $student = $student_row['row_count'];
    } else {
        // Handle the case where the query fails
        echo "Error executing graduate query: " . mysqli_error($conn);
    }



        ?>

        
        
        <div class="detail-field">
            <span><b>Total majors:
                </b></span> <?php echo $major  ?>  
        </div>   
       
        <div class="detail-field">
            <span><b>Total Departments:
                </b></span> <?php echo $department  ?>  
        </div>  

        <div class="detail-field">
            <span><b>Number of Majors in each Department:
                </b></span>
            </div> 

        <?php
        for ($i = 0; $i < $department; $i++) {
    $dp_row_sql = "SELECT * FROM department LIMIT 1 OFFSET $i";
    $dp_row_result = $conn->query($dp_row_sql);

    while ($dp_det_row = mysqli_fetch_assoc($dp_row_result)) {
        $Department_name = $dp_det_row['department_name'];
        $dp_Departmentid = $dp_det_row['departmentid'];
        $major_count = 0;

        // Loop through majors for the current department
        $mj_row_sql = "SELECT * FROM major WHERE departmentid = '$dp_Departmentid'";
        $mj_row_result = $conn->query($mj_row_sql);

        while ($mj_det_row = mysqli_fetch_assoc($mj_row_result)) {
            $Major_name = $mj_det_row['major_name'];
            $Majorid = $mj_det_row['majorid'];

            // Count majors for the current department
            $major_count++;
        }

        // Display the department and major count
        // Department won't show if it doesn't have majors
        if($major_count > 0){
        echo "<ul>$Department_name: $major_count</ul>";
        }
    }
}

        ?>
        <div class="detail-field">
            <span><b>Number of students in each major:
                </b></span>
            </div> 
        <?php
        for ($i = 0; $i < $major; $i++) {
    $mj_row_sql = "SELECT * FROM major LIMIT 1 OFFSET $i";
    $mj_row_result = $conn->query($mj_row_sql);

    while ($mj_det_row = mysqli_fetch_assoc($mj_row_result)) {
        $Major_name = $mj_det_row['major_name'];
        $mj_Majorid = $mj_det_row['majorid'];
        $student_count = 0;

        // Loop through majors for the current department
        $st_row_sql = "SELECT * FROM student WHERE majorid = '$mj_Majorid'";
        $st_row_result = $conn->query($st_row_sql);

        while ($st_det_row = mysqli_fetch_assoc($st_row_result)) {
            $st_Majorid = $st_det_row['majorid'];

            // Count majors for the current department
            $student_count++;
        }

        // Display the department and major count
        // Department won't show if it doesn't have majors
        if($student_count > 0){
        echo "<ul>$Major_name: $student_count</ul>";
        }
    }
}
?>


    <div class="detail-field">
            <span><b>Percentage of students in each major:
                </b></span>
            </div> 

         <?php
        for ($i = 0; $i < $major; $i++) {
    $mj_row_sql = "SELECT * FROM major LIMIT 1 OFFSET $i";
    $mj_row_result = $conn->query($mj_row_sql);

    while ($mj_det_row = mysqli_fetch_assoc($mj_row_result)) {
        $Major_name = $mj_det_row['major_name'];
        $mj_Majorid = $mj_det_row['majorid'];
        $student_count = 0;

        // Loop through majors for the current department
        $st_row_sql = "SELECT * FROM student WHERE majorid = '$mj_Majorid'";
        $st_row_result = $conn->query($st_row_sql);

        while ($st_det_row = mysqli_fetch_assoc($st_row_result)) {
            $st_Majorid = $st_det_row['majorid'];

            // Count majors for the current department
            $student_count++;
        }

        // Display the department and major count
        // Department won't show if it doesn't have majors
        if($student_count > 0){
            $major_percent = round(($student_count / $student) * 100);

        echo "<ul>$Major_name: $major_percent%</ul>";
        }
    }
}
?>

    <div class="detail-field">
            <span><b>Percentage of students in each Department:
                </b></span>
            </div> 

<?php
for ($i = 0; $i < $department; $i++) {
    $dp_row_sql = "SELECT departmentid, department_name FROM department LIMIT 1 OFFSET $i";
    $stmt_dp = $conn->prepare($dp_row_sql);
    $stmt_dp->execute();
    $result_dp = $stmt_dp->get_result();

    while ($dp_det_row = $result_dp->fetch_assoc()) {
        $Department_name = $dp_det_row['department_name'];
        $dp_departmentid = $dp_det_row['departmentid'];
        $student_count = 0;

        // Count students for the current department
        $st_row_sql = "SELECT COUNT(*) as student_count FROM student s
                        INNER JOIN major m ON s.majorid = m.majorid
                        WHERE m.departmentid = '$dp_departmentid'";
        $result_st = $conn->query($st_row_sql);

        if ($st_det_row = $result_st->fetch_assoc()) {
            $student_count = $st_det_row['student_count'];
        }

        // Display the department and student count
        if ($student_count > 0) {
            $department_percent = round(($student_count / $student) * 100);
            echo "<ul>$Department_name: $department_percent%</ul>";
        }
    }  
}
?>


        
            <table>
                <tr>
                    <th>Major ID</th>
                    <th>Department ID</th>
                    <th>Department Name</th>
                    <th>Major Name</th>
                    <th>Credits Required</th>
                </tr>

                


                <h2>View Major Details</h2>
                <?php
                $sql_major = "SELECT * FROM major";
                $result_major = mysqli_query($conn1, $sql_major) or die(mysqli_error($conn1));

                while ($det_major = mysqli_fetch_assoc($result_major)) {
                    $majorid = $det_major['majorid'];
                    $departmentid = $det_major['departmentid'];
                    $major_name = $det_major['major_name'];
                    $credits_required = $det_major['credits_required'];

                    $sql_department = "SELECT * FROM department WHERE departmentid = '$departmentid'";
                    $result_department = mysqli_query($conn1, $sql_department) or die(mysqli_error($conn1));

                    // Fetch the data from the user query
                    $row_department = mysqli_fetch_array($result_department);
                    if (is_array($row_department)) {
                        $department_name = $row_department['department_name'];
                        
                    }

                
                    

                    
                    ?>

                    <tr>
                        <td><?php echo $majorid; ?></td>
                        <td><?php echo $departmentid; ?></td>
                        <td><?php echo $department_name; ?></td>
                        <td><?php echo $major_name ?></td>
                        <td><?php echo $credits_required ?></td>
                    </tr>
                    

                <?php
                }
                ?>

            </table>
        </div>
    </body>
    </html>
<?php
} else {
    // Redirect if not logged in
    header("Location: ../login.html");
}
?>