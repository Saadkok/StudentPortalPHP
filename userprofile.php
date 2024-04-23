<?php
session_start(); // Start session

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
        header("Location: login.php"); 
        exit(); 
    }

    // Include database connection
    $conn = require_once "database.php";

    // Fetch user information based on user ID from session
    $user_id = $_SESSION["user_id"];
    $query = "SELECT * FROM users WHERE id = '$user_id'";

    // Execute SQL query and store the result
    $result = mysqli_query($conn, $query);

    // Check if query was successful
    if (!$result) {
        die("Error retrieving user information: " . mysqli_error($conn));
    }

    // Fetch user data
    $user = mysqli_fetch_assoc($result);

    // Close the database connection
    mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-image: url('background.jpeg'); /* Replace 'your-image-url.jpg' with the URL or path to your image */
            background-size: cover; /* This ensures that the background image covers the entire viewport */
            background-repeat: no-repeat; /* This prevents the background image from repeating */
            background-position: center; /* This centers the background image */
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: auto;
            margin: 30px auto;
            padding: 20px; /* Increased padding */
            /* background-color: #fff; */
            border-radius: 10px;
            
        }
        h3 {
            margin-bottom: 30px;
            text-align: center;
            color: #007bff;
        }
        p {
            margin-bottom: 20px;
            font-size: 18px;
            color: #333;
            text-align: center; /* Center-align user information */
        }
        img {
            display: block;
            margin: 0 auto;
            width: 150px;
            border-radius: 50%;
        }
        .btn {
            margin-top: 20px; /* Increased margin */
            display: inline-block; /* Changed to inline-block */
            width: auto;
            padding: 12px 24px;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        .btn-warning {
            background-color:  #007bff;
            color: #fff;
            border: none;
        }
        .btn-warning:hover {
            background-color: #cce5ff; /* Light blue background color */
            color: #212529; /* Dark text color */
        }
       /* Header styles */
       header {
            display: inline;
            background-color: rgba(255, 255, 255, 0.7);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            /* background-color: #f8f9fa; */
            color: #000;
            text-align: center;
            padding: 7px 0;
            margin: 0;
        }
        /* Footer styles */
        footer {
            background-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            /* background-color:#f8f9fa; */
            color: #000;
            text-align: center;
            padding: 5px 0;
            margin: 0;
            position :fixed;
            bottom: 0;
            width: 100%;
        }
        /* Button container styles */
        .buttons {
            text-align: center;
            margin-top: 10px; /* Increased margin */
        }
        .buttons a {
            margin: 0 10px;
        }
    </style>
</head>
<body>

<header>
    <h4>#Discover Your Profile: Your Gateway to Personalized Experience</h4>
    <nav>
        <a href="#"  style=" margin-left: 10px;">Home</a>
        <a href="#"  style=" margin-left: 40px;" >About Us</a>
        <a href="#"  style=" margin-left: 40px;" >Contact</a>
        <a href="/student/logout.php"  style=" margin-left: 40px;" >Logout</a>
    </nav>
</header>

<div class="container">
    <div class="headline">
        <!-- <h3>Your Personal Hub: Navigate Your Experience</h3> -->
    </div>

    <img src="user-profile-icon-free-vector.jpg" alt="">

    <div>
        <p><strong>Full Name:</strong> <span style="font-size: 24px; text-transform: uppercase;"><?php echo $user['full_name']; ?></span></p>
        <p><strong>Email:</strong> <span style="font-size: 24px;"><?php echo $user['email']; ?></span></p>
    </div>

    <div class="buttons">
        <a href="./studentModule.php" class="btn btn-warning">STUDENT MODULE</a>
       
    </div>
    <div class="buttons">
    <!-- <a href="logout.php" class="btn btn-warning">Logout</a>  -->
    </div>
</div>     

<footer>
    <p>&copy; 2024 Registration Form. All rights reserved.</p>
</footer>

</body>
</html>
