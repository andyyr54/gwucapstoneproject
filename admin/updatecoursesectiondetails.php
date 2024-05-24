<?php
session_start();
    
if($_SESSION['user_type']=="admin") { 
                    
        include 'dbconfig.php';
     $crn=$_GET['crn'];
       
        ?><!DOCTYPE html>
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
            width: 400px;
            padding: 16px;
            background-color: white;
            margin: 0 auto;
            margin-top: 50px;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="text"], input[type="password"],input[type="number"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: none;
            background-color: #5C6BC0;
            color: white;
        }
        .link { 
            color: white;
            text-decoration: none;
            /* padding: 14px 16px; */
            float: center;
        }
    </style>
</head>
<body>
    <?php
;
// $sql=mysqli_query($conn,"SELECT max(userid) FROM user;");
// $row  = mysqli_fetch_array($sql);
// if(is_array($row))
// {
//         $newuserid=$row['max(userid)']+1;
// }

                
    ?>
    <div class="container">
    <h2>Updating Course Section Details for CRNID - <?php echo $crn;?></h2>
    <form action="updatingcoursesectiondetails.php" method="post">
    <label for="name">CRN</label>
        <input type="text" id="crn" name="crn" value="<?php echo $crn?>" required="required" readonly>

    <br><br>
<h3>Select Below Course to assign CourseID for Course Section</h3>
        <!-- Fetching All the available Major and Minor -->
        <select id="courseid" name="courseid">
        <?php
           $sql_course = "SELECT * FROM course  ";
           $result_course = mysqli_query($conn1, $sql_course) or die(mysqli_error($conn1));

           //looping through all major availanle
           while($det_course = mysqli_fetch_assoc($result_course)){
 
            echo '<option value="'.$det_course["courseid"].'">'.$det_course["courseid"]." -  ".$det_course["course_name"].'</option>';

        }

    ?>  </select><br><br>
       <h3>Select Below Faculty to assign FacultyID for Course Section</h3>
        <!-- Fetching All the available Major and Minor -->
        <select id="facultyid" name="facultyid">
        <?php
           $sql_faculty = "SELECT * FROM faculty  ";
           $result_faculty = mysqli_query($conn1, $sql_faculty) or die(mysqli_error($conn1));

           //looping through all major availanle
           while($det_faculty = mysqli_fetch_assoc($result_faculty)){
            $facultyid=$det_faculty["facultyid"];
            $sql_faculty_name=mysqli_query($conn,"SELECT * FROM user where userid='$facultyid'");
                $row_faculty_name = mysqli_fetch_array($sql_faculty_name);
                $faculty_first_name=$row_faculty_name["first_name"];
 
            echo '<option value="'.$det_faculty["facultyid"].'">'.$det_faculty["facultyid"]." -  ".$faculty_first_name.'</option>';

        }

    ?>  </select><br><br>
 <h3>Select Below Timeslot to assign timeslotID for Course Section</h3>
        <!-- Fetching All the available Major and Minor -->
        <select id="timeslotid" name="timeslotid">
        <?php
           $sql_timeslot = "SELECT * FROM timeslot order by timeslotid ASC  ";
           $result_timeslot= mysqli_query($conn1, $sql_timeslot) or die(mysqli_error($conn1));

           //looping through all major availanle
           while($det_timeslot = mysqli_fetch_assoc($result_timeslot)){
            // $facultyid=$det_faculty["facultyid"];
            // $sql_faculty_name=mysqli_query($conn,"SELECT * FROM user where userid='$facultyid'");
            //     $row_faculty_name = mysqli_fetch_array($sql_faculty_name);
            //     $faculty_first_name=$row_faculty_name["first_name"];
 
            echo '<option value="'.$det_timeslot["timeslotid"].'">'.$det_timeslot["timeslotid"].'</option>';

        }

    ?>  </select><br><br>

<h3>Select Below Room to assign RoomID for Course Section</h3>
        <!-- Fetching All the available Major and Minor -->
        <select id="roomid" name="roomid">
        <?php
           $sql_room = "SELECT * FROM room   ";
           $result_room= mysqli_query($conn1, $sql_room) or die(mysqli_error($conn1));

           //looping through all room availanle
           while($det_room = mysqli_fetch_assoc($result_room)){
            $roomid=$det_room["roomid"];
            $sql_room=mysqli_query($conn,"SELECT * FROM room where roomid='$roomid'");
                $row_room = mysqli_fetch_array($sql_room);
                $roomtype=$row_room["room_type"];
 
            echo '<option value="'.$det_room["roomid"].'">'.$det_room["roomid"]." -  ".$roomtype.'</option>';

        }

    ?>  </select><br><br>

    
<h3>Select Below Semester to assign SemesterID for Course Section</h3>
        <!-- Fetching All the available Major and Minor -->
        <select id="semesterid" name="semesterid">
        <?php
           $sql_semester = "SELECT * FROM semester   ";
           $result_semester= mysqli_query($conn1, $sql_semester) or die(mysqli_error($conn1));

           //looping through all room availanle
           while($det_semester = mysqli_fetch_assoc($result_semester)){
          
           
 
            echo '<option value="'.$det_semester["semesterid"].'">'.$det_semester["semesterid"].'</option>';

        }

    ?>  </select><br><br>
        <label for="name">Section Number</label>
        <input type="text" id="section_number" name="section_number" value="" required="required">

 
        <label for="name">Available Seats</label>
        <input type="text" id="available_seats" name="available_seats" value="" required="required">

    <br><br>
    <button type="submit" name="save">Updating Course Section Details</button><br><br>
    </form>
    <a class="link" href="index.php"><button >Cancel</button></a>
    </div>
    <!-- <script>
    function showExtraField(select) {
        var extraField = document.getElementById('extraField');

        if (select.value == 'Graduate') {
            extraField.style.display = 'block';
        } else {
            extraField.style.display = 'none';
        }
    }
    </script> -->
</body>
</html>
<?php
    }
    else {
    // Redirect if not logged in
    header("Location: login.html");
    }
?>
