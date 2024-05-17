<?php
session_start();
    
if($_SESSION['user_type']=="student") { 
                    
        include 'dbconfig.php';
 
        $userid= $_SESSION["userid"];
        if(isset($_POST['save']))
{
    extract($_POST);
}

$sql1 = "SELECT * FROM courseavailable where semester='$semester'";
$result1 = mysqli_query($conn1, $sql1) or die(mysqli_error($conn1));
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
    <div class="container">
        <h2>Currently Viewing Master Schedule for <?php echo $semester ?>  </h2>
        <table>
            <tr>
                <th>CRN</th>
                <th>Course Name</th>
                <th>Professor Name</th>
                <th>Department Name</th>
                <th>Room Number</th>
                <th>Timeslot</th>
                <th>Available Seats</th>
                <th>Days</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Year</th>
            </tr>
            <?php while($det = mysqli_fetch_assoc($result1)){
                ?>
            <tr>
                <td><?php  echo $det["crn"]; ?></td>
                <td><?php  echo $det["course_name"]; ?></td>
                <td><?php  echo $det["professor_name"]; ?></td>
                <td><?php  echo $det["department"]; ?></td>
                <td><?php  echo $det["room_number"]; ?></td>
                <td><?php  echo $det["timeslot"]; ?></td>
                <td><?php  echo $det["available_seats"]; ?></td>
                <td><?php  echo $det["days"]; ?></td>
                <td><?php  echo $det["start_time"]; ?></td>
                <td><?php  echo $det["end_time"]; ?></td>
                <td><?php  echo $det["year"]; ?></td>
            </tr>
            <?php
            }
            ?>
            <!-- Add more rows as needed -->
        </table>
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
