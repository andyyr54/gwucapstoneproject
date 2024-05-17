<?php
session_start();
    
            if($_SESSION['user_type']=="Stats Office") { 
                    
        include 'dbconfig.php';
        $userid = $_SESSION['userid'];
       
       
        ?>
<!DOCTYPE html>
<html>
<head>
    <style>
        /* body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        */
        .navbar {
            background-color: #333;
            overflow: hidden;
            color: white;
            padding: 14px 16px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 14px 16px;
            float: left;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        #welcome-message {
            text-align: center;
            padding: 50px;
            font-size: 2em;
            color: white;
        }

        #college-image {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
        body{
            background-image: url('../img/thumbnail.jpg');
           background-size: cover;
            background-repeat: no-repeat;
            
        }
    </style>
</head>
<body>

    <?php
                $sql_user = "SELECT * FROM user WHERE userid='$userid'";
                $result_user = mysqli_query($conn1, $sql_user) or die(mysqli_error($conn1));

                while ($det_user = mysqli_fetch_assoc($result_user)) {
                    $Name = $det_user["first_name"];
                }
                    ?>
  

    <?php include 'navbar.html'; ?>
    <div class="container">
        <div id="welcome-message">Hi, Welcome <?php echo $Name;?> </div>
        <img id="college-image" src="../img/college.jpg" alt="College Image">
    </div>
</body>
</html>
<?php
    }
    else {
    // Redirect if not logged in
    header("Location: ../login.html");
    }
?>