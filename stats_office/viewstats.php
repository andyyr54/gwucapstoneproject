<?php
session_start();

if ($_SESSION['user_type'] == "Stats Office") {
    include 'dbconfig.php';
    $userid = $_SESSION["userid"];
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <style>
            button {
    background-color: grey; /* Green background */
    border: none; /* No borders */
    color: white; /* White text */
    padding: 1px 1px; /* Some padding */
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
                width: 500px;
                padding: 20px;
                background-color: light blue;
                margin: 0 auto;
                margin-top: 50px;
                border-radius: 4px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .detail-field {
                margin-bottom: 20px;
            }

            .detail-field span {
                font-weight: bold;
            }

            .navbar {
                background-color: #333;
                overflow: hidden;
                color: white;
                padding: 14px 16px;
            }

            .link {
                color: white;
                text-decoration: none;
                padding: 14px 16px;
                float: left;
            }

            .navbar a {
                color: white;
                text-decoration: none;
                padding: 14px 16px;
                float: left;
            }

            .button {
                display: inline-block;
                padding: 1px 1px; /* Smaller padding */
                font-size: 14px; /* Smaller font size */
                cursor: pointer;
                text-align: center;
                text-decoration: none;
                outline: none;
                color: #fff;
                background-color: #4CAF50;
                border: none;
                border-radius: 8px; /* Smaller border radius */
                box-shadow: 0 5px #999; /* Smaller box shadow */
            }

            .button:hover {
                background-color: #3e8e41
            }

            .button:active {
                background-color: #3e8e41;
                box-shadow: 0 3px #666; /* Smaller active box shadow */
                transform: translateY(2px); /* Smaller transform */
            }
        </style>
    </head>
    <body>

        <?php include 'navbar.html'; ?>
        <div class="container">
        <h2>View Statistics:</h2>

        <div class="detail-field">
        <span><button class="button"><a class="link" href="gradstudentsdetails.php">Graduate Students</a></button></span>
        </div>
        <div class="detail-field">
        <button class="button"><a class="link" href="undergradstudentsdetails.php">Under Graduate Students</a></button>
        </div>
        <div class="detail-field">
        <button class="button"><a class="link" href="majordetails.php">Majors</a></button>
        </div>
        <div class="detail-field">
        <button class="button"><a class="link" href="minordetails.php">Minors</a></button>
        </div>
        </div>
    </body>
    </html>

    <?php
} else {
    // Redirect if not logged in
    header("Location: ../login.html");
}
?>