<?php
session_start();
    
if($_SESSION['user_type']=="admin") { 
                    
        include 'dbconfig.php';
     $userid=$_GET['userid'];
       
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
    <h2>Adding New Hold for Student</h2>
    <form action="addingstudenttohold.php" method="post">
    <label for="name">StudentID</label> <br> <br> 
        <input type="text" id="studentid" name="studentid" value="<?php echo $userid ?>" required="required" readonly>
    <h3>Select Below Hold for student</h3>
        <!-- Fetching All the available Major and Minor -->
        <select id="holdid" name="holdid">
   
        <?php
           $sql_hold = "SELECT * FROM hold ";
           $result_hold = mysqli_query($conn1, $sql_hold) or die(mysqli_error($conn1));

           //looping through all major availanle
           while($det_hold = mysqli_fetch_assoc($result_hold)){
            echo '<option value="'.$det_hold["holdid"].'">'.$det_hold["hold_type"].'</option>';

        }

    ?>

   
    </select><br><br>
    
        <label for="name">Date of Hold</label> <br> <br> 
        <input type="date" id="date_of_hold" name="date_of_hold" value="" required="required">
        <br><br> 
        
        <br><br>

        <br><br>
  
    <button type="submit" name="save">Add New Hold for Student</button><br><br>
    </form>
    <a class="link" href="addnewstudentonhold.php"><button >Cancel</button></a>
    </div>

</body>
</html>
<?php
    }
    else {
    // Redirect if not logged in
    header("Location: login.html");
    }
?>
