<?php
// Start session
session_start(); 

if (isset($_POST["login"])) { 
    // Check if the login form is submitted && Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Include database connection, SQL query to retrieve user with matching email && Execute SQL query and store the result
    require_once "database.php";
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    
 
    //Retrieves a row from a database query result and returns it as an associative array where keys are column names.
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    // Check if user exists
    if ($user) 
    {
        // Verify password using password_verify function : if a given password matches its hashed counterpart. It compares a plain text password with its hashed version to determine if they correspond to each other.
        if (password_verify($password, $user["password"]))
        {
            // Store user ID and email in session
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_email"] = $email;

            // Redirect to user profile page && Terminate script execution
            header("Location: userprofile.php");
            exit();
        } 
        else 
        {
            // Display error message if password doesn't match
            echo "<div class='alert alert-danger'><p>Password does not match</p></div>";
        }
    }
    else 
    {
        // Display error message if email doesn't match
        echo "<div class='alert alert-danger'><p>Email does not match</p></div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
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
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin :0;
        }
          /* Footer styles */
          footer {
            background-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            /* background-color:#f8f9fa; */
            color: #000;
            text-align: center;
            /* padding: 5px 0; */
            /* margin: 0; */
            position :fixed;
            bottom: 0;
            width: 100%;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.7);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            /* background-color: #fff; */
            border-radius: 5px;
            
        }
        h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-btn {
            text-align: left;
        }
        .btn-primary {
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .alert {
            margin-bottom: 20px;
        }
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
        }
        .alert-danger p {
            margin: 0;
        }
        .alert-danger a {
            color: #721c24;
            font-weight: bold;
            text-decoration: none;
        }
        .alert-danger a:hover {
            text-decoration: underline;
        }
        .forget-password-link {
            display: inline-block;
            float: right;
            margin-top: 10px;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h2>Login to Continue</h2>
      
        <form action="login.php" method="post">

            <!-- Email input field -->
            <div class="form-group">
                <input type="email" placeholder="Enter Email" name="email" class="form-control" required>
            </div>

            <!-- Password input field -->
            <div class="form-group">
                <input type="password" placeholder="Enter Password" name="password" class="form-control" required>
            </div>

            <!-- Login button -->
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
                <a href="password-reset.php" class="forget-password-link">Forget your password?</a>
            </div>
        </form>      
        <br>
        <div>
            <p>Not registered yet? <a href="index.php">Register Here</a></p>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Registration Form. All rights reserved.</p>
    </footer>

</body>
</html>









