<?php
session_start();
    
if($_SESSION['user_type']=="admin") { 
                    
        include 'dbconfig.php';
     
        $studentid= $_GET["studentid"];
        $holdid= $_GET["holdid"];
        $sql_drop = "delete from student_hold where holdid='$holdid' AND studentid='$studentid'";
        $res_drop = mysqli_query($conn1, $sql_drop) or die(mysqli_error($conn1));
        echo "Dropped";
?>
<?php
    }
    else {
    // Redirect if not logged in
    header("Location: login.html");
    }
?>