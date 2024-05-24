<?php
session_start();
    
if($_SESSION['user_type']=="admin") { 
                    
        include 'dbconfig.php';
        $facultyid=$_GET['facultyid'];
        $userid=$facultyid;
       
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

    <h2>Assign New Department to Faculty</h2>
    <form action="addingnewfacultytodepartment.php" method="post">

    <label for="name">Faculty ID</label>
        <input type="text" id="facultyid" name="facultyid" value="<?php echo $facultyid?>" required="required" readonly>


        <br><br>
<h3>Select Below Department to add for faculty</h3>
        <!-- Fetching All the available Major and Minor -->
        <select id="departmentid" name="departmentid">
        <?php
           $sql_major_all = "SELECT * FROM department  ";
           $result_major_all = mysqli_query($conn1, $sql_major_all) or die(mysqli_error($conn1));

           //looping through all major availanle
           while($det_major_all = mysqli_fetch_assoc($result_major_all)){
           
            echo '<option value="'.$det_major_all["departmentid"].'">'.$det_major_all["departmentid"].'</option>';

        }

    ?>  </select><br><br>

    

        <label for="name">Percentage of Time Spent</label>
        <input type="number" id="percentage_of_time_spent" name="percentage_of_time_spent" value="" required="required">
<br><br>
        <label for="name">Date of assignment</label><br><br>
        <input type="date" id="Date_of_assignment" name="Date_of_assignment" value="" required="required">
       
    <br><br>
    <button type="submit" name="save">Add New Department to Faculty</button><br><br>
    </form>
    <a class="link" href="viewfacultydetails.php"><button >Cancel</button></a>
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
