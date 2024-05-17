<?php
$dbhost = "localhost:3306";
$dbuser = "root";
$dbpass = "111111";
$dbname = "csv_db 7";
$conn1 = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname) or die("Unable to connect to database");
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname) or die("Unable to connect to database");
// $sql1 = "SELECT * FROM booking ";
// $result1 = mysqli_query($conn1, $sql1) or die(mysqli_error($conn1));
?>