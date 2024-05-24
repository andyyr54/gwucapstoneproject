<?php
session_start();
    
if($_SESSION['user_type']=="admin") { 
                    
        include 'dbconfig.php';
   
       $facultyid=$_GET['facultyid'];
       $semesterid=$_GET['semesterid'];
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
    <h2>Add new course section</h2>
    <form action="addingnewcoursesectiondetails.php" method="post">
    <label for="name">CRN Will be AutoAssigned</label> <br><br>
      
    <label for="name">Faculty ID </label>
        <input type="text" id="facultyid" name="facultyid" value="<?php echo $facultyid?>" required="required" readonly>


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

<h3>Select Below Timeslot to assign timeslotID for Course Section</h3>
        <!-- Fetching All the available Major and Minor -->
        <select id="timeslotid" name="timeslotid">
        <?php
           $sql_timeslot = "SELECT * FROM timeslot order by timeslotid ASC  ";
           $result_timeslot= mysqli_query($conn1, $sql_timeslot) or die(mysqli_error($conn1));

           //looping through all major availanle
           while($det_timeslot = mysqli_fetch_assoc($result_timeslot)){
            $timeslotid=$det_timeslot["timeslotid"];
            $weekday="";
            //getting dayid from timeslot_day table and looping it
        $sql_timeslot_day = "SELECT * FROM timeslot_day where timeslotid='$timeslotid'";
        $row_timeslot_day = mysqli_query($conn1, $sql_timeslot_day) or die(mysqli_error($conn1));

        //looping through each dayid and getting details relevant
        while($det_timeslot_day = mysqli_fetch_assoc($row_timeslot_day)){

           
                $dayid=$det_timeslot_day["dayid"];
                $sql_day=mysqli_query($conn,"SELECT * FROM day where dayid='$dayid'");
                $row_day  = mysqli_fetch_array($sql_day);
                if(is_array($row_day))
                    {   
                        $weekday=$weekday." ".$row_day["weekday"];
                    }
            }

            //get timings start_time and end_time by querying timeslot_period -> period table
            $sql_timeslot_period=mysqli_query($conn,"SELECT * FROM timeslot_period where timeslotid='$timeslotid'");
            $row_timeslot_period  = mysqli_fetch_array($sql_timeslot_period);
            if(is_array($row_timeslot_period))
            {
                $periodid=$row_timeslot_period["periodid"];
                $sql_period=mysqli_query($conn,"SELECT * FROM period where periodid='$periodid'");
                $row_period  = mysqli_fetch_array($sql_period);
                if(is_array($row_period))
                    {   
                        $start_time=$row_period["start_time"];
                        $end_time=$row_period["end_time"];
                    }
            }
            
            // $facultyid=$det_faculty["facultyid"];
            // $sql_faculty_name=mysqli_query($conn,"SELECT * FROM user where userid='$facultyid'");
            //     $row_faculty_name = mysqli_fetch_array($sql_faculty_name);
            //     $faculty_first_name=$row_faculty_name["first_name"];
 
            echo '<option value="'.$det_timeslot["timeslotid"].'">'.$det_timeslot["timeslotid"]." - ".$weekday." , ".$start_time." - ".$end_time.'</option>';

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

<label for="name">Semester ID </label>
        <input type="text" id="semesterid" name="semesterid" value="<?php echo $semesterid?>" required="required" readonly>


    <br><br>
        <label for="name">Section Number</label>
        <input type="text" id="section_number" name="section_number" value="" required="required">

 
        <label for="name">Available Seats</label>
        <input type="text" id="available_seats" name="available_seats" value="" required="required">

    <br><br>
    <button type="submit" name="save">ADD NEW Course Section Details</button><br><br>
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
