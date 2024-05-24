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
    <h2>Adding New Faculty</h2>
    <form action="addingnewfacultydetails.php" method="post">

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

         <!-- Faculty Table -->

         <label for="rank">Rank</label>
        <input type="text" id="rank" name="rank" value="" required="required">
        
        <label for="speciality">Speciality</label>
        <input type="text" id="speciality" name="speciality" value="" required="required">
        <label for="faculty_type">Faculty Type</label>
        <br><br>
        
        <select id="faculty_type" name="faculty_type">
        <option value="Full Time">Full Time</option>
    <option value="Part Time">Part Time</option>
    </select><br><br>

        <!-- <label for="faculty_type">Faculty Type</label>
        <input type="text" id="faculty_type" name="faculty_type" value="" required="required">
         -->

         <!-- Login Table -->
        <label for="attempts">No of Attempts</label>
        <input type="text" id="attempts" name="attempts" value="" required="required">
        <label for="locked">Locked</label>
        <input type="text" id="locked" name="locked" value="" required="required">
        
        <label for="email">Email</label><br>
        <input type="text" id="email" name="email"  value="" required="required">
        
        <label for="password">Password</label><br>
        <input type="text" id="password" name="password"  value="" required="required">
        <br>
   <!-- faculty full time or part time details -->
   <label for="no_of_classes">No. Of. Classes</label><br>
        <input type="text" id="no_of_classes" name="no_of_classes"  value="" required="required">
        <br>
        <label for="office">Office</label><br>
        <input type="text" id="office" name="office"  value="" required="required">
        <br>
        <button type="submit" name="save">Add New Faculty</button>
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
