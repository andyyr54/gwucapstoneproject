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

                $full_time_sql = "SELECT COUNT(*) AS row_count FROM undergraduate_full_time";

    // Execute the query
    $full_time_result = mysqli_query($conn, $full_time_sql);

    // Check if the query was successful
    if ($full_time_result) {
        // Fetch the result as an associative array
        $full_time_row = mysqli_fetch_assoc($full_time_result);

        // Access the count value
        $full_time = $full_time_row['row_count'];
    } else {
        // Handle the case where the query fails
        echo "Error executing graduate query: " . mysqli_error($conn);
    }


    $part_time_sql = "SELECT COUNT(*) AS row_count FROM undergraduate_part_time";

    // Execute the query
    $part_time_result = mysqli_query($conn, $part_time_sql);

    // Check if the query was successful
    if ($part_time_result) {
        // Fetch the result as an associative array
        $part_time_row = mysqli_fetch_assoc($part_time_result);

        // Access the count value
        $part_time = $part_time_row['row_count'];
    } else {
        // Handle the case where the query fails
        echo "Error executing graduate query: " . mysqli_error($conn);
    }

    $PercentFullUnGrad = round(($full_time / ($full_time + $part_time)) * 100);
    $PercentPartUnGrad = round(($part_time / ($full_time + $part_time)) * 100);

    $totalstudents_sql = "SELECT COUNT(*) AS row_count FROM student";
    $totalstudents_result = mysqli_query($conn, $totalstudents_sql);

    // Check if the query was successful
    if ($totalstudents_result) {
        // Fetch the result as an associative array
        $totalstudents_row = mysqli_fetch_assoc($totalstudents_result);

        // Access the count value
        $students = $totalstudents_row['row_count'];
    } else {
        // Handle the case where the query fails
        echo "Error executing graduate query: " . mysqli_error($conn);
    }

    $PercentUnderGrads = round((($full_time + $part_time) / $students)*100);


     $totalgrads_sql = "SELECT COUNT(*) AS row_count FROM graduate";
     $totalgrads_result = mysqli_query($conn, $totalgrads_sql);

    // Check if the query was successful
    if ($totalgrads_result) {
        // Fetch the result as an associative array
        $totalgrads_row = mysqli_fetch_assoc($totalgrads_result);

        // Access the count value
        $grads = $totalgrads_row['row_count'];
    } else {
        // Handle the case where the query fails
        echo "Error executing graduate query: " . mysqli_error($conn);
    }

    $PercentGrads = round(($grads / $students)*100);

    $undergrad_sql = "SELECT COUNT(*) AS row_count FROM undergraduate";

    // Execute the query
    $undergrad_result = mysqli_query($conn, $undergrad_sql);

    // Check if the query was successful
    if ($undergrad_result) {
        // Fetch the result as an associative array
        $undergrad_row = mysqli_fetch_assoc($undergrad_result);

        // Access the count value
        $undergraduate = $undergrad_row['row_count'];
    } else {
        // Handle the case where the query fails
        echo "Error executing undergraduate query: " . mysqli_error($conn);
    }

        ?>

        <div class="detail-field">
            <span><b>Under Graduate Students:</b></span> <?php echo $undergraduate  ?> 
        </div>
        
        <div class="detail-field">
            <span><b>Full Time Under Graduate Students:
                </b></span> <?php echo $full_time  ?>  
        </div>

        <div class="detail-field">
            <span><b>Part Time Under Graduate Students:</b></span> <?php echo $part_time  ?> 
        </div> 
        <div class="detail-field">
            <span><b>Percentage of Full Time Under Graduate Students:</b></span> <?php echo $PercentFullUnGrad?><span>%</span>
        </div> 
        <div class="detail-field">
            <span><b>Percentage of Part Time Under Graduate Students:</b></span> <?php echo $PercentPartUnGrad?><span>%</span> 
        </div>    
        <div class="detail-field">
            <span><b>Percentage of Under Graduate Students:</b></span> <?php echo $PercentUnderGrads?><span>%</span> 
        </div>     
        <div class="detail-field">
            <span><b>Percentage of Graduate Students:</b></span> <?php echo $PercentGrads?><span>%</span> 
        </div>    
       
            <table>
                <tr>
                    <th>Student ID</th>
                    <th>Student First Name</th>
                    <th>Student Last Name</th>
                    <th>Student Type</th>
                    <th>Student Phone</th>
                    <th>Student Email</th>
                </tr>

                


                <h2>View Student Details</h2>
                <?php
                $sql_undergraduate = "SELECT * FROM undergraduate";
                $result_undergraduate = mysqli_query($conn1, $sql_undergraduate) or die(mysqli_error($conn1));

                while ($det_undergraduate = mysqli_fetch_assoc($result_undergraduate)) {
                    $studentid = $det_undergraduate['studentid'];
                    $student_type = $det_undergraduate['undergraduate_type'];

                    $sql_user = "SELECT * FROM user WHERE userid = '$studentid'";
                    $result_user = mysqli_query($conn1, $sql_user) or die(mysqli_error($conn1));

                    // Fetch the data from the user query
                    $row_user = mysqli_fetch_array($result_user);
                    if (is_array($row_user)) {
                        $first_name = $row_user['first_name'];
                        $last_name = $row_user['last_name'];
                        $phone = $row_user['phone'];
                    }

                    $sql_login = mysqli_query($conn, "SELECT * FROM login where userid='$studentid'");
                    $row_login = mysqli_fetch_array($sql_login);
                    if (is_array($row_login)) {
                        $email = $row_login['email'];
                    }

                    
                    ?>

                    <tr>
                        <td><?php echo $studentid; ?></td>
                        <td><?php echo $first_name; ?></td>
                        <td><?php echo $last_name; ?></td>
                        <td><?php echo $student_type ?></td>
                        <td><?php echo $phone ?></td>
                        <td><?php echo $email ?></td>
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