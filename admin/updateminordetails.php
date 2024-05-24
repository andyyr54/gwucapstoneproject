<?php
session_start();
    
if($_SESSION['user_type']=="admin") { 
                    
        include 'dbconfig.php';
     
        $minorid= $_GET["minorid"];
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
    <div class="container">
    <?php
      $sql_minor=mysqli_query($conn,"SELECT * FROM minor where minorid='$minorid'");
      $row_minor = mysqli_fetch_array($sql_minor);
   
      if(is_array($row_minor))
      {
       
    ?>
    <form action="updatingminordetails.php" method="post">

    <label for="name">Major ID</label>
        <input type="text" id="minorid" name="minorid" value="<?php echo $row_minor['minorid']?>" required="required" readonly>

        <label for="name">Department ID</label>
        <input type="text" id="departmentid" name="departmentid" value="<?php echo $row_minor['departmentid']?>" required="required" readonly>

        <label for="name">Major Name</label>
        <input type="text" id="minor_name" name="minor_name" value="<?php echo $row_minor['minor_name']?>" required="required">
        
        <label for="name">Credits Required</label>
        <input type="text" id="credits_required" name="credits_required" value="<?php echo $row_minor['credits_required']?>" required="required">
        
        <br>

        <button type="submit" name="save">Update</button>
        <br><br>
        <?php
        
    
    ?>
    </form>
    <a class="link" href="viewdepartmentdetails.php"><button >Cancel</button></a>
    </div>
    
</body>
</html>
<?php
    }
}
    else {
    // Redirect if not logged in
    header("Location: login.html");
    }
?>
