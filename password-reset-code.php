<?php

include('database.php');


if(isset($_POST['password_reset_link'])){
    // $email = mysqli_real_escape_string($conn,$_post['email']);

    // $token=md5(rand());

    // $check_email ="SELECT email from users where email='$email' limit 1 ";

    // $check_email_run =mysqli_query($conn,$check_email);


    // if(mysqli_num_rows($check_email_run) >0)
    // {
    //     $row =mysqli_fetch_array($check_email_run);
    //     $get_name=$row['full_name'];
    //     $get_email=$row['emial'];

    // }
    // else{
    //     $_SESSION['status']="No email found ";
    //     header("Location :password-reset.php");
    //     exit(0);
    // }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Request Received</title>
    <style>
        body {
            background-image: url('background.jpeg'); /* Replace 'your-image-url.jpg' with the URL or path to your image */
            background-size: cover; /* This ensures that the background image covers the entire viewport */
            background-repeat: no-repeat; /* This prevents the background image from repeating */
            background-position: center; /* This centers the background image */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            /* background-color: #f4f4f4; */
            /* margin: 0;
            padding: 0; */
        }
        .container {
            background-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 50px auto;
            /* background-color: #fff; */
            border-radius: 5px;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
            padding: 20px;
        }
        h2 {
            color: #007bff;
        }
        p {
            margin-bottom: 15px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        footer {
            background-color: rgba(255, 255, 255, 0.9);
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Password Reset Request Received</h2>
        <p>Thank you for submitting your email address. If it's associated with an account, we've sent instructions on how to reset your password to that email.</p>
        <p>Please check your inbox (and your spam or junk folder, just in case) for an email from us. If you don't receive an email within a few minutes, please try submitting your email address again or contact our support team for further assistance.</p>
    </div>
    <footer>
        <p>&copy; 2024 Registration Form. All rights reserved.</p>
    </footer>
</body>
</html>
