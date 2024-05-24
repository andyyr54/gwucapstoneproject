<?php
session_start();
    
if($_SESSION['user_type']=="admin") { 
                    
        include 'dbconfig.php';
     $studentid=$_GET['studentid'];
       
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
    <h2>For Enrolling/Viewing Student's Course Section</h2>
    <form action="showcurrentcoursesectionofstudent.php" method="GET">

    <label for="name">Student ID </label>
        <input type="text" id="studentid" name="studentid" value="<?php echo $studentid?>" required="required" readonly>

        <br><br>
<h3>Select Below Semester to View/Assign Course Section</h3>
        <!-- Fetching All the available Minor and Minor -->
        <select id="semesterid" name="semesterid">

 
            <option value="FALL2023">FALL2023</option>
            <option value="SPRING2024">SPRING2024</option>
         </select><br><br>

    
       
    <br><br>
    <button type="submit" name="save">View/Assign Course </button><br><br>
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
    else {
    // Redirect if not logged in
    header("Location: login.html");
    }
?>
