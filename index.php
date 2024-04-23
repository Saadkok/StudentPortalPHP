<?php   
    //#1 Check if the form is submitted    
    if (isset($_POST["submit"])) 
    {
        // Retrieve form data
        $fullName = $_POST["fullname"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // #2 Encrypting the password using the default hashing algorithm
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Array to store validation errors
        $errors = array();

        // Check if every field is filled
        if (empty($fullName) || empty($email) || empty($password)) {
            array_push($errors, "All fields are required");
        }

        // #3 Email validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
        }

        // Password validation that it must contain 8 or more than 8 characters
        if (strlen($password) < 8) {
            array_push($errors, "Password must be at least 8 characters long");
        }

        // Database included...!
        require_once "database.php";

        // Avoiding duplicate emails by checking if the email already exists in the database
        // Simple SQL query to get the details of the user with matching email and execute a SQL query and store the result.
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        // Counts the number of rows returned by the query.
        $rowCount = mysqli_num_rows($result);

        // If row counts are more than one, it means Email already exists
        if ($rowCount > 0) {
            array_push($errors, "Email already exists!");
        }

        // Display errors 
        if (count($errors) > 0) {
            // If there are any errors present in the $errors array, they are displayed one by one in red-colored alert boxes. Each error message is shown inside a separate box.
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        }

        // Insert the user data into the database
        else {

            // Prepare SQL statement to insert user data into the database
            // The question marks (?, ?, ?) act as placeholders for the values.
            // The values will be provided later using prepared statements, which is a way to execute SQL queries safely by separating the query structure from the data.
            $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";

            // This line sets up a safe way to run database commands.
            // This approach helps prevent security vulnerabilities like SQL injection.
            $stmt = mysqli_stmt_init($conn);

            // Get the statement ready to execute with the given SQL query.
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
            if ($prepareStmt)
            {
                // #5 Bind parameters and execute the statement
                mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                // Display success message and redirect to login page
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
                header("Location: login.php");
                exit(0);
            } 
            else {
                die("Something went wrong");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <!-- Style for the page -->
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
        }
        .container {
            background-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 30px auto;
            padding: 15px;
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
            display: inline;
        }
        .btn-primary {
            padding: 10px 10px;
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
        /* Header styles */
        header {
            display: inline;
            background-color: rgba(255, 255, 255, 0.3   );
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            /* background-color: #f8f9fa; */
            color: #000;
            text-align: center;
            padding: 7px 0;
            margin: 0;
        }
        /* Footer styles */
        footer {
            background-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            /* background-color:#f8f9fa; */
            color: #000;
            text-align: center;
            padding: 5px 0;
            margin: 0;
            /* position :fixed; */
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- header -->
    <header style="text-align: center;">
        <h4 style="display: inline-block; margin-left: 80px;">Join Us Today and Unlock Exclusive Benefits!</h4>
        <a href="#" style="display: inline-block; margin-left: 260px;">Home</a>
        <a href="#" style="display: inline-block; margin-left: 40px;">About Us</a>
        <a href="#" style="display: inline-block; margin-left: 40px;">Contact</a>
        <a href="#" style="display: inline-block; margin-left: 40px;">Support</a>
    </header>
    <div class="container">

        <!-- Registration form -->
        <h3>User Registration</h3>
        <form action="index.php" method="post">

            <!-- name input field -->
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name" required>
            </div>

            <!-- Email input field -->
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>

            <!-- passwaord input field -->
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>

            <div>
            <p>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our <a href="privacy-policy.php">privacy policy</a>.</p>
             </div>

            <!-- button -->
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
                <br> <br>
                  <!-- Link to the login page -->
                <div><p>Already registered? <a href="login.php">Login Here</a></p></div>
            </div>            
        </form>                 
    </div>
       
    <footer>
        <p>&copy; 2024 Registration Form. All rights reserved.</p>
    </footer>

</body>
</html>


<!-- n my code, Bootstrap is used to make the registration form and other elements look nice and organized. For example, it helps with things like styling the buttons, input fields, and alerts with predefined classes like 'form-control' and 'btn btn-primary'. Bootstrap also provides responsive design features, ensuring that the form adjusts nicely on different screen sizes, like on mobile devices. -->


<!--  #1 
isset: Checks if a variable has a value.,  $_POST: holds data sent to the server using the HTTP POST method.["submit"]:accessing the value associated with the form field named "submit". -->
           
 <!-- #2
 If someone gains unauthorized access to the database, they should not be able to view the passwords stored within it.
$passwordHash: This variable stores the hashed version of the user's password. Hashing is a process of converting plain text (like a password) into a unique string of characters using a mathematical algorithm. The hashed password is what gets stored in the database instead of the plain text password.
password_hash(): This is a PHP function used to generate a hash of a given password. It takes the plain text password as its input and returns a hashed version of that password.
PASSWORD_DEFAULT ensures that the algorithm used for hashing will be updated automatically if a better one becomes available in future PHP versions.           -->

<!-- #3
 filter_var($email, FILTER_VALIDATE_EMAIL): This PHP function checks if the provided email address ($email) is in a valid format according to the rules for email addresses. It returns true if the email is valid and false otherwise. -->

 <!-- #4
 mysqli_query() is a PHP function that performs a query on the database. It takes two parameters: the database connection ($conn) and the SQL query ($sql).
 After execution, $result holds the outcome of the query. For SELECT queries, it typically contains a result set of rows returned by the query.           -->

 <!-- #5
This line sets the values of placeholders in the prepared SQL statement. It's like filling in the blanks with actual data. The "sss" specifies that the placeholders expect three string values, and $fullName, $email, and $passwordHash provide those values. This line runs the prepared SQL statement with the provided values. It's like pressing the "submit" button on a form. The statement is executed with the filled-in data, performing the desired database operation.-->