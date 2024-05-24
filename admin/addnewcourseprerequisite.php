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
        textarea {
        width: 90%;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
        resize: vertical; /* Allows the user to resize the textarea vertically */
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
    <h2>Adding New Course Pre Requisite</h2>
    <form action="addingnewdcourseprerequisitedetails.php" method="post">

    <br><br>
<h3>Select Below Course which is to be pre requisite (PrerequisiteID)</h3>
        <!-- Fetching All the available Major and Minor -->
        <select id="prerequisiteid" name="prerequisiteid">
        <?php
           $sql_course = "SELECT * FROM course  order by courseid ASC";
           $result_course = mysqli_query($conn1, $sql_course) or die(mysqli_error($conn1));

           //looping through all major availanle
           while($det_course = mysqli_fetch_assoc($result_course)){
           
            echo '<option value="'.$det_course["courseid"].'">'.$det_course["courseid"]." -  ".$det_course["course_name"].'</option>';

        }

    ?>  </select><br><br>
        <br><br>
        <h3>Select Below Course for which pre-requisite to be added (CourseID)</h3>
        <!-- Fetching All the available Major and Minor -->
        <select id="courseid" name="courseid">
        <?php
           $sql_course = "SELECT * FROM course order by courseid ASC ";
           $result_course = mysqli_query($conn1, $sql_course) or die(mysqli_error($conn1));

           //looping through all major availanle
           while($det_course = mysqli_fetch_assoc($result_course)){
           
            echo '<option value="'.$det_course["courseid"].'">'.$det_course["courseid"]." -  ".$det_course["course_name"].'</option>';

        }

    ?>  </select><br><br>

    
        <label for="name">Minimum Grade</label>
        <input type="text" id="minimum_grade" name="minimum_grade" value="" required="required">
        
    <br><br>
    <button type="submit" name="save">Add New Course Pre requisite</button><br><br>
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
