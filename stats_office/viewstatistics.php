<?php
session_start();

if ($_SESSION['user_type'] == "stats_office") {
    include 'dbconfig.php';
    $userid = $_SESSION['userid'];
    ?>

    <!DOCTYPE html>
    <html>
    <head>
    <style>
    button {
    background-color: grey; 
    border: none; 
    color: white; 
    padding: 7px 15px; 
    text-align: center; 
    text-decoration: none; 
    display: inline-block;
    font-size: 16px;
    margin: 2px 1px;
    cursor: pointer; 
    border-radius: 12px; 
    transition-duration: 0.4s; 
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
            <h2>View Statistics</h2>
            <table>
                <tr>
                    <th>Graduate Students</th>
                    <th>UnderGraduate Students </th>
                    <th>Majors</th>
                    <th>Minors</th>
                </tr>

                <?php
                $sql_course_sec = "SELECT * FROM course_section WHERE facultyid='$facultyid'";
                $result_course_sec = mysqli_query($conn1, $sql_course_sec) or die(mysqli_error($conn1));

                while ($det_course_sec = mysqli_fetch_assoc($result_course_sec)) {
                    $CRN = $det_course_sec['crn'];
                    $timeslotid = $det_course_sec['timeslotid'];

                    $sql_attendance = mysqli_query($conn, "SELECT * FROM attendance WHERE crn='$CRN'");
                    while ($row_attendance = mysqli_fetch_array($sql_attendance)) {
                        $crn = $row_attendance['crn'];
                        $studentid = $row_attendance['studentid'];
                        $courseid = $row_attendance['courseid'];
                        $attendance_date = $row_attendance['attendance_date'];
                        $section_number = $det_course_sec['section_number'];
                        $roomid = $det_course_sec['roomid'];

                        $sql_user = mysqli_query($conn, "SELECT * FROM user WHERE userid='$studentid'");
                        $row_user = mysqli_fetch_array($sql_user);
                        if (is_array($row_user)) {
                            $student_first_name = $row_user['first_name'];
                            $student_last_name = $row_user['last_name'];
                        }

                        $sql_course = mysqli_query($conn, "SELECT * FROM course WHERE courseid='$courseid'");
                        $row_course = mysqli_fetch_array($sql_course);
                        if (is_array($row_course)) {
                            $course_name = $row_course['course_name'];
                        }

                        $sql_ts_period = mysqli_query($conn, "SELECT * FROM timeslot_period WHERE timeslotid='$timeslotid'");
                        $row_ts_period = mysqli_fetch_array($sql_ts_period);
                        if (is_array($row_ts_period)) {
                            $periodid = $row_ts_period['periodid'];
                        }

                        $sql_period = mysqli_query($conn, "SELECT * FROM period WHERE periodid='$periodid'");
                        $row_period = mysqli_fetch_array($sql_period);
                        if (is_array($row_period)) {
                            $start_time = $row_period['start_time'];
                            $end_time = $row_period['end_time'];
                        }

                        
                        echo '<tr>';
                        echo '<td>' . $courseid . '</td>';
                        echo '<td>' . $course_name . '</td>';
                        echo '<td>' . $student_first_name . '</td>';
                        echo '<td>' . $student_last_name . '</td>';
                        echo '<td>' . $crn . '</td>';
                        echo '<td>' . $roomid . '</td>';
                        echo '<td>' . $section_number . '</td>';
                        echo '<td>' . $start_time . '</td>';
                        echo '<td>' . $end_time . '</td>';
                        echo '<td>' . $attendance_date . '</td>';
                        echo '</tr>';
                        }
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