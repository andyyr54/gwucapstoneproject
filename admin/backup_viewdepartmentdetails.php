<?php
session_start();
    
            if($_SESSION['user_type']=="admin") { 
                

        include 'dbconfig.php';
       
       
        ?>
        <!DOCTYPE html>
<html>
<head>
    <style>
        /* body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 50px;
        } */

        h1 {
            text-align: center;
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #fff;
            margin-bottom: 10px;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        a {
            text-decoration: none;
            color: #333;
        }

        a:hover {
            color: #007BFF;
        }
    </style>
</head>
<body>
<?php include 'navbar.html'; ?>
<h1>Departments</h1>
<?php   
            $sql_department = "SELECT * FROM department";
            $result_department = mysqli_query($conn1, $sql_department) or die(mysqli_error($conn1));

            while($det_department = mysqli_fetch_assoc($result_department)){
                $linkfordepartment="viewindividualdepartment.php?departmentid=".$det_department['departmentid'];
                ?>
   
    <ul>
        <li><a href="<?php echo $linkfordepartment;?>"><?php echo $det_department['department_name'];?></a></li>
       
    </ul>
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
