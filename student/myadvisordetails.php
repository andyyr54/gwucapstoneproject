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
        button {
    background-color: grey; /* Green background */
    border: none; /* No borders */
    color: white; /* White text */
    padding: 7px 15px; /* Some padding */
    text-align: center; /* Centered text */
    text-decoration: none; /* No underline */
    display: inline-block;
    font-size: 16px;
    margin: 2px 1px;
    cursor: pointer; /* Mouse pointer on hover */
    border-radius: 12px; /* Rounded corners */
    transition-duration: 0.4s; /* Transition effects on hover */
}

button:hover {
    background-color: #45a049; /* Green background on hover */
    color: white; /* White text on hover */
}

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
        <h2>Viewing My Advisor Details</h2>
        <table>
            <tr>
         
                <th>FacultyID</th>
                <th>Faculty First Name</th>
                <th>Faculty Last Name</th>
                <th>Date of Advising</th>
                <th>Faculty Phone</th>
                <th>Faculty Email</th>

           
            </tr>
        <?php

          
                $sql_advising=mysqli_query($conn,"SELECT * FROM advising where studentid='$userid'");
                $row_advising  = mysqli_fetch_array($sql_advising);
                if(is_array($row_advising))
                {
                        $facultyid=$row_advising['facultyid'];
                        $date_of_advising=$row_advising['date_of_advising'];
                 
                }
              

                
                $sql_faculty_name=mysqli_query($conn,"SELECT * FROM user where userid='$facultyid'");
          $row_faculty_name  = mysqli_fetch_array($sql_faculty_name);
          if(is_array($row_faculty_name))
          {
            $faculty_first_name=$row_faculty_name['first_name'];
            $faculty_last_name=$row_faculty_name['last_name'];
            $faculty_phone=$row_faculty_name['phone'];
            
          }
          $sql_login=mysqli_query($conn,"SELECT * FROM login where userid='$facultyid'");
          $row_login  = mysqli_fetch_array($sql_login);
          if(is_array($row_login))
          {
            $faculty_email=$row_login['email'];
      
            
          }
   
              
                
    ?>
        
          
            <tr>
              
  

                <td><?php echo $facultyid ?></td>
                <td><?php echo $faculty_first_name ?></td>
                <td><?php echo $faculty_last_name ?></td>
                <td><?php echo $date_of_advising ?></td>
                <td><?php echo $faculty_phone ?></td>
                <td><?php echo $faculty_email ?></td>
               
            </tr>
           <?php
            
        
            
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
    header("Location: ../login.html");
    }
?>
