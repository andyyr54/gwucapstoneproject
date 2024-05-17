<?php
session_start();
    
if($_SESSION['user_type']=="faculty") { 
                    
        include 'dbconfig.php';
     
        $userid= $_GET["studentid"];
        $crn=$_GET['crn'];
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
        <h2>Updating Grades</h2>
   
    <form action="updatinggrades.php" method="post">

    <label for="name">Student ID</label>
        <input type="text" id="studentid" name="studentid" value="<?php echo $userid;?>" required="required" readonly>

        <label for="name">CRN</label>
        <input type="text" id="crn" name="crn" value="<?php echo $crn;?>" required="required" readonly>

        <label for="name">Grade</label>
        <input type="text" id="grade" name="grade" value="" required="required" >
       


      <br><br><button type="submit" name="save">Update</button>
        <br><br>
    </form>
    <a class="link" href="index.php"><button >Cancel</button></a>
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
