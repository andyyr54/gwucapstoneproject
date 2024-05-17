<?php
session_start();
    
if($_SESSION['user_type']=="student") { 
                    
        include 'dbconfig.php';
    
        $userid= $_SESSION["userid"];
        ?>


<!DOCTYPE html>
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
        .detail-field {
            margin-bottom: 10px;
        }
        .detail-field span {
            font-weight: bold;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
            color: white;
            padding: 14px 16px;
        }
        .link {
            color: white;
            text-decoration: none;
            padding: 14px 16px;
            float: left;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 14px 16px;
            float: left;
        }
        .button {
            display: inline-block;
            padding: 8px 12px; /* Smaller padding */
            font-size: 14px; /* Smaller font size */
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 8px; /* Smaller border radius */
            box-shadow: 0 5px #999; /* Smaller box shadow */
        }

        .button:hover {background-color: #3e8e41}

        .button:active {
          background-color: #3e8e41;
          box-shadow: 0 3px #666; /* Smaller active box shadow */
          transform: translateY(2px); /* Smaller transform */
        }
    </style>
</head>
<body>

    <?php include 'navbar.html'; ?>

    <?php
     $sql=mysqli_query($conn,"SELECT * FROM login where userid='$userid'");
     $row  = mysqli_fetch_array($sql);
     $sql1=mysqli_query($conn,"SELECT * FROM user where userid='$userid'");
     $row_user_table  = mysqli_fetch_array($sql1);
     if(is_array($row))
      {
    ?>
    <div class="container">
    <div class="detail-field">
            <span>UserID:</span> <?php echo $row_user_table['userid']?>
        </div>
        <div class="detail-field">
            <span>First Name:</span> <?php echo $row_user_table['first_name']?>
        </div>
        <div class="detail-field">
            <span>Last Name:</span> <?php echo $row_user_table['last_name']?>
        </div>
        <div class="detail-field">
            <span>Gender:</span> <?php echo $row_user_table['gender']?>
        </div>
        <div class="detail-field">
            <span>DOB:</span> <?php echo $row_user_table['dob']?>
        </div>
        <div class="detail-field">
            <span>Street:</span> <?php echo $row_user_table['street']?>
        </div>
        <div class="detail-field">
            <span>Zipcode:</span> <?php echo $row_user_table['zipcode']?>
        </div>
        <div class="detail-field">
            <span>Phone:</span> <?php echo $row_user_table['phone']?>
        </div>

        <div class="detail-field">
            <span>Email ID:</span> <?php echo $row['email']?>
        </div>

        <div class="detail-field">
            <span>Password:</span> <?php echo $row['password']?>
        </div>
        <h3>Want to Update Details?</h3> <button class="button"><a class="link" href="updatestudentdetails.php">Click here to Update</a></button>
    </div>
    
    <?php
    }
    
    ?>
    
</body>
</html>

<?php
    }
    else {
    // Redirect if not logged in
    header("Location: login.html");
    }
?>