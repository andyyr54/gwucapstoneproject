<?php
session_start();
    
if($_SESSION['user_type']=="admin") { 
                    
        include 'dbconfig.php';
     
       
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
    <?php
;
// $sql=mysqli_query($conn,"SELECT max(userid) FROM user;");
// $row  = mysqli_fetch_array($sql);
// if(is_array($row))
// {
//         $newuserid=$row['max(userid)']+1;
// }
    ?>
    <div class="container">
    <h2>Adding New Student</h2>
    <form action="addingnewstudentdetails.php" method="post">

    <label for="name">User ID - AutoAssigned Value</label>
        <input type="text" id="userid" name="userid" value="User ID - AutoAssigned Value" required="required" readonly>

        <label for="name">First Name</label>
        <input type="text" id="first_name" name="first_name" value="" required="required">

        <label for="name">Last Name</label>
        <input type="text" id="last_name" name="last_name" value="" required="required">
        
        <label for="gender">Gender</label>
        <br><br>
        
        <select id="gender" name="gender">
        <option value="Male">Male</option>
    <option value="Female">Female</option>
    </select><br><br>
        <label for="name">Street</label>
        <input type="text" id="street" name="street" value="" required="required">
        <label for="name">State</label>
        <input type="text" id="state" name="state" value="" required="required">
        <label for="name">City</label>
        <input type="text" id="city" name="city" value="" required="required">
        <label for="name">Zipcode</label>
        <input type="number" id="zipcode" name="zipcode" value="" required="required">
        <label for="name">Phone</label>
        <input type="text" id="phone" name="phone" value="" required="required">
        <label for="name">DOB</label> <br> <br> 
        <input type="date" id="dob" name="dob" value="" required="required">
        <br><br> 
        <label for="attempts">No of Attempts</label>
        <input type="text" id="attempts" name="attempts" value="" required="required">
        <label for="locked">Locked</label>
        <input type="text" id="locked" name="locked" value="" required="required">
        
        <label for="email">Email</label><br>
        <input type="text" id="email" name="email"  value="" required="required">
        
        <label for="password">Password</label><br>
        <input type="text" id="password" name="password"  value="" required="required">
        <br>

       
        <br><br>
        <label for="student_type">Select Student Type</label>
        <br><br>
        <!-- <select id="student_type" name="student_type" onchange="showExtraField(this)"> -->
        <select id="student_type" name="student_type" onchange="showOptions(this.value)">
        <option value="Graduate">Graduate</option>
        <option value="Undergraduate" selected>Undergraduate</option>
    </select><br><br>
    <label for="student_type_sub" id="student_type_sub" style="display: none;">Select Graduate Type</label>
        <br><br>
    <div id="graduate_options" style="display: none;">
    <select id="degree_type" name="degree_type">
        <option value="MS">MS</option>
        <option value="PhD">PhD</option>
    </select><br><br>
</div>
    <!-- <div id="extraField" style="display: none;">
        <label for="program">Program:</label><br>
        <input type="text" id="program" name="program"><br><br>
    </div>
    <label for="full_or_part_time">Select Full Time/Part Time</label> -->
        <br><br>
        
        <select id="full_or_part_time" name="full_or_part_time">
        <option value="Full Time">Full Time</option>
    <option value="Part Time">Part Time</option>
    </select><br><br>
    <button type="submit" name="save">Add New Student</button><br><br>
    </form>
    <a class="link" href="index.php"><button >Cancel</button></a>
    </div>
    <script>
function showOptions(value) {
    var graduateOptions = document.getElementById("graduate_options");
    var student_type_sub = document.getElementById("student_type_sub");
    if (value == "Graduate") {
        graduateOptions.style.display = "block";
        student_type_sub.style.display = "block";
    } else {
        graduateOptions.style.display = "none";
        student_type_sub.style.display = "none";
    }
}
</script>
</body>
</html>
<?php
    }
    else {
    // Redirect if not logged in
    header("Location: login.html");
    }
?>
