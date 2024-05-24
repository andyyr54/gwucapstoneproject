<?php
session_start();
    
if($_SESSION['user_type']=="admin") { 
                    
        include 'dbconfig.php';
        extract($_POST);
    //   echo $holdid;
        $sql3 = "INSERT INTO student_hold(studentid,holdid,date_of_hold) values('$studentid','$holdid','$date_of_hold')";
        $res3 = mysqli_query($conn1, $sql3) or die(mysqli_error($conn1));
      
        echo "Added Student to hold";
?>
<?php
    }
    else {
    // Redirect if not logged in
    header("Location: login.html");
    }
?>
