<?php
    session_start();
    $page_title = "Password Reset Form";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('background.jpeg'); /* Replace 'your-image-url.jpg' with the URL or path to your image */
            background-size: cover; /* This ensures that the background image covers the entire viewport */
            background-repeat: no-repeat; /* This prevents the background image from repeating */
            background-position: center; /* This centers the background image */
            font-family: Arial, sans-serif;
            /* background-color: #f4f4f4; */
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            /* background-color: #fff; */
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 30px;
            text-align: center;
            color: #007bff;
        }
        .card-header {
            text-align: center;
        }
        .card-body {
            padding: 20px;
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
        .btn-primary {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
            text-align: center;
            text-decoration: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .alert {
            margin-bottom: 20px;
        }
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
        }
        .alert-success h5 {
            margin: 0;
        }
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
    </style>
    
</head>
<body>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Reset Password</h2>
            </div>

            <div class="card-body">
                <?php
                    if(isset($_SESSION['status'])) {
                        ?>
                        <div class="alert alert-success">
                            <h5><?php echo $_SESSION['status']; ?></h5>
                        </div>
                        <?php
                        unset($_SESSION['status']);
                    }
                ?>

                <form action="password-reset-code.php" method="post">
                    <div class="form-group">
                        <p>Please enter your  email address. You will receive a link to create a new password via email.</p>
                        <label>Email Address</label>
                        <input type="text" name="email" class="form-control" placeholder="Enter the email address" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="password_reset_link" class="btn btn-primary">Send Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Registration Form. All rights reserved.</p>
    </footer>

</body>
</html>
