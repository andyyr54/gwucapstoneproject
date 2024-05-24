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
    <h2>Adding New Major</h2>
    <form action="addingnewmajordetails.php" method="post">

    <label for="name">Major ID </label>
        <input type="text" id="majorid" name="majorid" value="" required="required" >

        <br><br>
<h3>Select Below Department to assign major</h3>
        <!-- Fetching All the available Major and Minor -->
        <select id="departmentid" name="departmentid">
        <?php
           $sql_major_all = "SELECT * FROM department  ";
           $result_major_all = mysqli_query($conn1, $sql_major_all) or die(mysqli_error($conn1));

           //looping through all major availanle
           while($det_major_all = mysqli_fetch_assoc($result_major_all)){
 
            echo '<option value="'.$det_major_all["departmentid"].'">'.$det_major_all["department_name"].'</option>';

        }

    ?>  </select><br><br>

    
        <label for="name">Major Name</label>
        <input type="text" id="major_name" name="major_name" value="" required="required">

        <label for="name">Credits Required</label>
        <input type="text" id="credits_required" name="credits_required" value="" required="required">

 
       
    <br><br>
    <button type="submit" name="save">Add New Major</button><br><br>
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
