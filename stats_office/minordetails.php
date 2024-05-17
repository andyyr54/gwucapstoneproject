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

                $minor_sql = "SELECT COUNT(*) AS row_count FROM minor";

    // Execute the query
    $minor_result = mysqli_query($conn, $minor_sql);

    // Check if the query was successful
    if ($minor_result) {
        // Fetch the result as an associative array
        $minor_row = mysqli_fetch_assoc($minor_result);

        // Access the count value
        $minor = $minor_row['row_count'];
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
            <span><b>Total minors:
                </b></span> <?php echo $minor  ?>  
        </div>   

        <div class="detail-field">
            <span><b>Total Departments:
                </b></span> <?php echo $department  ?>  
        </div>  

        <div class="detail-field">
            <span><b>Number of Minors in each Department:
                </b></span>
            </div> 

            <?php
        for ($i = 0; $i < $department; $i++) {
    $dp_row_sql = "SELECT * FROM department LIMIT 1 OFFSET $i";
    $dp_row_result = $conn->query($dp_row_sql);

    while ($dp_det_row = mysqli_fetch_assoc($dp_row_result)) {
        $Department_name = $dp_det_row['department_name'];
        $dp_Departmentid = $dp_det_row['departmentid'];
        $minor_count = 0;

        // Loop through majors for the current department
        $mn_row_sql = "SELECT * FROM minor WHERE departmentid = '$dp_Departmentid'";
        $mn_row_result = $conn->query($mn_row_sql);

        while ($mn_det_row = mysqli_fetch_assoc($mn_row_result)) {
            $Minor_name = $mn_det_row['minor_name'];
            $Minorid = $mn_det_row['minorid'];

            // Count majors for the current department
            $minor_count++;
        }

        // Display the department and major count
        // Department won't show if it doesn't have majors
        if($minor_count > 0){
        echo "<ul>$Department_name: $minor_count</ul>";
        }
    }
}

        ?>

        <div class="detail-field">
            <span><b>Number of students in each minor:
                </b></span>
            </div> 
        <?php
        for ($i = 0; $i < $minor; $i++) {
    $mi_row_sql = "SELECT * FROM minor LIMIT 1 OFFSET $i";
    $mi_row_result = $conn->query($mi_row_sql);

    while ($mi_det_row = mysqli_fetch_assoc($mi_row_result)) {
        $Minor_name = $mi_det_row['minor_name'];
        $mi_Minorid = $mi_det_row['minorid'];
        $student_count = 0;

        // Loop through majors for the current department
        $st_row_sql = "SELECT * FROM student WHERE minorid = '$mi_Minorid'";
        $st_row_result = $conn->query($st_row_sql);

        while ($st_det_row = mysqli_fetch_assoc($st_row_result)) {
            $st_Minorid = $st_det_row['minorid'];

            // Count majors for the current department
            $student_count++;
        }

        // Display the department and major count
        // Department won't show if it doesn't have majors
        if($student_count > 0){
        echo "<ul>$Minor_name: $student_count</ul>";
        }
    }
}
?>


    <div class="detail-field">
            <span><b>Percentage of students in each minor:
                </b></span>
            </div> 

         <?php
        for ($i = 0; $i < $minor; $i++) {
    $mi_row_sql = "SELECT * FROM minor LIMIT 1 OFFSET $i";
    $mi_row_result = $conn->query($mi_row_sql);

    while ($mi_det_row = mysqli_fetch_assoc($mi_row_result)) {
        $Minor_name = $mi_det_row['minor_name'];
        $mi_Minorid = $mi_det_row['minorid'];
        $student_count = 0;

        // Loop through majors for the current department
        $st_row_sql = "SELECT * FROM student WHERE minorid = '$mi_Minorid'";
        $st_row_result = $conn->query($st_row_sql);

        while ($st_det_row = mysqli_fetch_assoc($st_row_result)) {
            $st_Majorid = $st_det_row['majorid'];

            // Count majors for the current department
            $student_count++;
        }

        // Display the department and major count
        // Department won't show if it doesn't have majors
        if($student_count > 0){
            $minor_percent = round(($student_count / $student) * 100);

        echo "<ul>$Minor_name: $minor_percent%</ul>";
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
                        INNER JOIN minor m ON s.minorid = m.minorid
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
                    <th>Minor ID</th>
                    <th>Department ID</th>
                    <th>Department Name</th>
                    <th>Minor Name</th>
                    <th>Credits Required</th>
                </tr>

                


                <h2>View Minor Details</h2>
                <?php
                $sql_minor = "SELECT * FROM minor";
                $result_minor = mysqli_query($conn1, $sql_minor) or die(mysqli_error($conn1));

                while ($det_minor = mysqli_fetch_assoc($result_minor)) {
                    $minorid = $det_minor['minorid'];
                    $departmentid = $det_minor['departmentid'];
                    $minor_name = $det_minor['minor_name'];
                    $credits_required = $det_minor['credits_required'];

                    $sql_department = "SELECT * FROM department WHERE departmentid = '$departmentid'";
                    $result_department = mysqli_query($conn1, $sql_department) or die(mysqli_error($conn1));

                    // Fetch the data from the user query
                    $row_department = mysqli_fetch_array($result_department);
                    if (is_array($row_department)) {
                        $department_name = $row_department['department_name'];
                        
                    }

                
                    

                    
                    ?>

                    <tr>
                        <td><?php echo $minorid; ?></td>
                        <td><?php echo $departmentid; ?></td>
                        <td><?php echo $department_name; ?></td>
                        <td><?php echo $minor_name ?></td>
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