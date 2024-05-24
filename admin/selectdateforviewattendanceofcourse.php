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

$sql_attendance_check=mysqli_query($conn,"SELECT * FROM attendance where crn ='$crn' ");
                     $row_attendance_check  = mysqli_fetch_array($sql_attendance_check);
                     if(is_array($row_attendance_check))
                         {   
                            
// $sql=mysqli_query($conn,"SELECT max(userid) FROM user;");
// $row  = mysqli_fetch_array($sql);
// if(is_array($row))
// {
//         $newuserid=$row['max(userid)']+1;
// }
    ?>
    <div class="container">
    <h2>For Viewing Attendance of Course Section <?php echo $crn?></h2>
    <form action="viewattendanceofcoursesection.php" method="GET">

    <label for="name">CRN  </label>
        <input type="text" id="crn" name="crn" value="<?php echo $crn?>" required="required" readonly>

        <br><br>
<h3>Select Date from below from already recorded dates</h3>
           <!-- Fetching All the available Minor and Minor -->
           <select id="attendance_date" name="attendance_date">
    <?php
       $sql_attendance = "SELECT distinct(attendance_date) FROM attendance where crn ='$crn'  ";
       $result_attendance = mysqli_query($conn1, $sql_attendance) or die(mysqli_error($conn1));

       //looping through all minor availanle
       while($det_attendance = mysqli_fetch_assoc($result_attendance)){
            $date = date('jS F Y', strtotime($det_attendance["attendance_date"]));
            echo '<option value="'.$det_attendance["attendance_date"].'">'.$date.'</option>';
        }
    ?>  
</select><br><br>


    
       
    <br><br>
    <button type="submit" name="save">View Attendace Logs </button><br><br>
    </form>
    <a class="link" href="assignfacultytocoursesection.php"><button >Cancel</button></a>
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
                         else
                         {
                            echo " No Attendance History! Please record atleast 1 class attendance to make this page active.";
                         }
    }
    else {
    // Redirect if not logged in
    header("Location: login.html");
    }
?>
