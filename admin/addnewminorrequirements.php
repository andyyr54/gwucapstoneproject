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
    <h2>Adding New Minor Requirement</h2>
    <form action="addingnewminorrequirementsdetails.php" method="post">

    <br><br>
<h3>Select Below Minor ID to assign minor requirement</h3>
        <!-- Fetching All the available Minor and Minor -->
        <select id="minorid" name="minorid">
        <?php
           $sql_minor_all = "SELECT * FROM minor  ";
           $result_minor_all = mysqli_query($conn1, $sql_minor_all) or die(mysqli_error($conn1));

           //looping through all minor availanle
           while($det_minor_all = mysqli_fetch_assoc($result_minor_all)){
 
            echo '<option value="'.$det_minor_all["minorid"].'">'.$det_minor_all["minorid"]." -  ".$det_minor_all["minor_name"].'</option>';

        }

    ?>  </select><br><br>
        <br><br>
<h3>Select Below Course to assign as minor Requirements</h3>
        <!-- Fetching All the available Minor and Minor -->
        <select id="courseid" name="courseid">
        <?php
           $sql_minor_all = "SELECT * FROM course  ";
           $result_minor_all = mysqli_query($conn1, $sql_minor_all) or die(mysqli_error($conn1));

           //looping through all minor availanle
           while($det_minor_all = mysqli_fetch_assoc($result_minor_all)){
 
            echo '<option value="'.$det_minor_all["courseid"].'">'.$det_minor_all["course_name"].'</option>';

        }

    ?>  </select><br><br>

    
        <label for="name">Minimum Grade Required</label>
        <input type="text" id="minimum_grade_required" name="minimum_grade_required" value="" required="required">

 
       
    <br><br>
    <button type="submit" name="save">Add New Minor</button><br><br>
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
