<?php
session_start();
    
if($_SESSION['user_type']=="admin") { 
                    
        include 'dbconfig.php';
     
       
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
            width: 300px;
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
    <h2>Adding New Department</h2>
    <form action="addingnewdepartmentdetails.php" method="post">

    <label for="name">Department ID </label>
        <input type="text" id="departmentid" name="departmentid" value="" required="required" >

        <br><br>
<h3>Select Below Faculty to add for ChairID</h3>
        <!-- Fetching All the available Major and Minor -->
        <select id="chairid" name="chairid">
        <?php
           $sql_major_all = "SELECT * FROM faculty  ";
           $result_major_all = mysqli_query($conn1, $sql_major_all) or die(mysqli_error($conn1));

           //looping through all major availanle
           while($det_major_all = mysqli_fetch_assoc($result_major_all)){
            $facid=$det_major_all["facultyid"];
            $sql_faculty_name=mysqli_query($conn,"SELECT * FROM user where userid='$facid'");
      $row_faculty_name  = mysqli_fetch_array($sql_faculty_name);
      $faculty_first_name=$row_faculty_name['first_name'];
            echo '<option value="'.$det_major_all["facultyid"].'">'.$det_major_all["facultyid"]." -  ".$faculty_first_name.'</option>';

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

        <label for="name">Department Name</label>
        <input type="text" id="department_name" name="department_name" value="" required="required">

        <label for="name">Department Manager</label>
        <input type="text" id="department_manager" name="department_manager" value="" required="required">
       
        <label for="name">Email</label>
        <input type="text" id="email" name="email" value="" required="required">

        <label for="name">Phone</label>
    <input type="text" id="phone" name="phone" value="" required="required">
       
       
    <br><br>
    <button type="submit" name="save">Add New Department</button><br><br>
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
