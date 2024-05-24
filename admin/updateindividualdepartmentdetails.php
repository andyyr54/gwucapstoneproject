<?php
session_start();
    
if($_SESSION['user_type']=="admin") { 
                    
        include 'dbconfig.php';
     
        $departmentid= $_GET["departmentid"];
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
      $sql_department=mysqli_query($conn,"SELECT * FROM department where departmentid='$departmentid'");
      $row_department = mysqli_fetch_array($sql_department);
   
      if(is_array($row_department))
      {
       
    ?>
    <form action="updatingindividualdepartmentdetails.php" method="post">

    <label for="name">Department ID</label>
        <input type="text" id="departmentid" name="departmentid" value="<?php echo $row_department['departmentid']?>" required="required" readonly>

        <label for="name">ChairID</label>
        <input type="text" id="chairid" name="chairid" value="<?php echo $row_department['chairid']?>" required="required">

        <label for="name">Room ID</label>
        <input type="text" id="roomid" name="roomid" value="<?php echo $row_department['roomid']?>" required="required">
        
        <label for="name">Department Name</label>
        <input type="text" id="department_name" name="department_name" value="<?php echo $row_department['department_name']?>" required="required">
        
        <label for="name">Department Manager</label>
        <input type="text" id="department_manager" name="department_manager" value="<?php echo $row_department['department_manager']?>" required="required">
        <label for="name">Email</label>
        <input type="text" id="email" name="email" value="<?php echo $row_department['email']?>" required="required">
        <label for="name">Phone</label>
        <input type="text" id="phone" name="phone" value="<?php echo $row_department['phone']?>" required="required">
       
       
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
