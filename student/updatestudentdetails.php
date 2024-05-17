<?php
session_start();
    
if($_SESSION['user_type']=="student") { 
                    
        include 'dbconfig.php';
     
        $userid= $_SESSION["userid"];
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
      $sql=mysqli_query($conn,"SELECT * FROM login where userid='$userid'");
      $row  = mysqli_fetch_array($sql);
      $sql1=mysqli_query($conn,"SELECT * FROM user where userid='$userid'");
      $row_user_table  = mysqli_fetch_array($sql1);
      if(is_array($row))
      {
    ?>
    <form action="updatingstudentdetails.php" method="post">
        <label for="name">First Name</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo $row_user_table['first_name']?>" required="required">

        <label for="name">Last Name</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $row_user_table['last_name']?>" required="required">
        
        <label for="name">Gender</label>
        <input type="text" id="gender" name="gender" value="<?php echo $row_user_table['gender']?>" required="required">
        
        <label for="name">Street</label>
        <input type="text" id="street" name="street" value="<?php echo $row_user_table['street']?>" required="required">
        
        <label for="name">Zipcode</label>
        <input type="number" id="zipcode" name="zipcode" value="<?php echo $row_user_table['zipcode']?>" required="required">
        <label for="name">Phone</label>
        <input type="text" id="zipcode" name="phone" value="<?php echo $row_user_table['phone']?>" required="required">
        
    
        <label for="password">Password</label><br>
        <input type="text" id="password" name="password"  value="<?php echo $row['password']?>" required="required">
        <br>

        <button type="submit" name="save">Update</button>
        <br><br>
        <?php
        }
    
    ?>
    </form>
    <a class="link" href="studentdetails.php"><button >Cancel</button></a>
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
