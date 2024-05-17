<?php
session_start();
    
            if($_SESSION['user_type']=="student") { 
                $userid=$_SESSION['userid'];

        include 'dbconfig.php';
       
       
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
            width: 80%;
            padding: 16px;
            background-color: white;
            margin: 0 auto;
            margin-top: 50px;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
<?php include 'navbar.html'; ?>
    <div class="container">
       
        <?php
                 $sql_student_hold_exists=mysqli_query($conn,"SELECT * FROM student_hold where studentid='$userid'");
                 $row_student_hold_exists = mysqli_fetch_array($sql_student_hold_exists);
                 if(is_array($row_student_hold_exists))
                 {
                    ?>
 <h2>View Holds</h2>
                    <?php
            $sql_studenthold = "SELECT * FROM student_hold where studentid='$userid'";
            $result_studenthold = mysqli_query($conn1, $sql_studenthold) or die(mysqli_error($conn1));

            while($det_studenthold = mysqli_fetch_assoc($result_studenthold)){
                $holdid=$det_studenthold["holdid"];
               
                $sql_hold=mysqli_query($conn,"SELECT * FROM hold where holdid='$holdid'");
                $row_hold  = mysqli_fetch_array($sql_hold);
                if(is_array($row_hold))
                {
    ?>
        <table>
            <tr>
            <th>Hold ID</th>
                <th>Hold's Date</th>
                <th>Hold Type</th>
                
            </tr>
          
            <tr>
                <td><?php echo $holdid; ?></td>
                <td><?php echo $det_studenthold["date_of_hold"];?></td>
                <td><?php echo $row_hold["hold_type"] ?></td>
                
            </tr>
           <?php
            }
        }
            
            ?>
            <!-- Add more rows as needed -->
        </table>
    </div>
    <?php
}
    else
    {
        ?>
<h2>There is no Hold  </h2>

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
