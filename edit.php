<?php
session_start(); 

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php"); 
    exit(); 
}
?>
<?php

// Start session

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "students-detail";

// Establish database connection
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

// initializing the variables
$id = "";
$name = "";
$dob = "";
$email = "";
$contract = "";
$report = "";
$dept = ""; // Initialize department
$gender = ""; // Initialize gender
$address="";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //GET METHOD: SHOW THE DATA OF THE CLIENT
    if (!isset($_GET["id"])) {
        header("Location: /STUDENT/studentModule.php");
        exit;
    }

    $id = $_GET["id"];

    //sql query && Execute SQL query and store the result
    $sql = "SELECT * FROM stud WHERE id = $id";
    $result = $conn->query($sql);

    // fetches the next row from the result
    $row = $result->fetch_assoc();

    //if row is empty...!return to student module page...!
    if (!$row) {
        header("Location: /STUDENT/studentModule.php");
        exit;
    }

    // retrieve the student information from the database query result and store it in variables for use in the HTML form:
    $name = $row["name"];
    $dob = $row["dob"];
    $email = $row["email"]; // Retrieve email
    $contract = $row["phone"];
    $report = $row["report"];
    $dept = $row["dept"]; // Retrieve department
    $gender = $row["gender"]; // Retrieve gender
    $address=$row["address"];
} else {
    //Retrieving the updated student information from the form submitted via POST request
    $id = $_POST["id"];
    $name = $_POST["name"];
    $dob = $_POST["dob"];
    $email = $_POST["email"];
    $contract = $_POST["contact"]; // Fix variable name
    $report = $_POST["report"];
    $dept = $_POST["dept"]; // Retrieve department
    $gender = $_POST["gender"]; // Retrieve gender
    $address=$_POST["address"];

    do {
        // Check if the phone number contains only numbers and has exactly 10 digits
        if (!preg_match('/^[0-9]{10}$/', $contract)) {
            $errorMessage = "Phone number must contain exactly 10 digits and only numbers";
            break;
        }

        // To check all fields are filled or not
        if (empty($name) || empty($dob) || empty($contract)) {
            $errorMessage = "All fields are required";
            break;
        }

        // sql query to update and execute the sql query and store the result in &result variable....
        $sql = "UPDATE stud SET name='$name', dob='$dob', phone='$contract', email='$email', report='$report', dept='$dept', gender='$gender', address='$address' WHERE id=$id"; // Fix field name
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            $errorMessage = "Error updating student details: " . $conn->error;
            break;
        }

        $successMessage = "Student details updated successfully";
        header("Location: /STUDENT/studentModule.php");
        exit;

    } while (false); // loop will run only once...!
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
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

        body {
            background-image: url('background.jpeg');
            /* Replace 'your-image-url.jpg' with the URL or path to your image */
            background-size: cover;
            /* This ensures that the background image covers the entire viewport */
            background-repeat: no-repeat;
            /* This prevents the background image from repeating */
            background-position: center;
            /* This centers the background image */
            font-family: Arial, sans-serif;
            /* background-color: #f4f4f4; */
        }

        .container {
            background-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin-top: 50px;
        }

        .error-message {
            color: red;
        }

        .success-message {
            color: green;
        }

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
<header>
    <h4>#Discover Your Profile: Your Gateway to Personalized Experience</h4>
    <nav>
        <a href="/student/userprofile.php"  style=" margin-left: 10px;">Home</a>
        <a href="/student/login.php"  style=" margin-left: 40px;" >login</a>
        <a href="/stydent/index.php"  style=" margin-left: 40px;" >Sin up</a>
        <a href="/student/logout.php"  style=" margin-left: 40px;" >logout</a>
    </nav>
</header>
    <div class="container">

    

        <!-- Headline -->
        <h2>Update Student details</h2>

        <!-- displaying error Message -->
        <?php if (!empty($errorMessage)) : ?>
            <!-- Display error message if there is any -->
            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
        <?php endif; ?>


        <!-- displaying success Message -->
        <?php if (!empty($successMessage)) : ?>
            <!-- Display success message if there is any -->
            <div class="alert alert-success"><?php echo $successMessage; ?></div>
        <?php endif; ?>



        <!-- Form for updating student details -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <!-- Hidden input field to store the student ID -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <!-- Input field for updating student name -->
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
            </div>

            <!-- Input field for updating student date of birth -->
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth:</label>
                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $dob; ?>" required>
            </div>

            <!-- Input field for updating student email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>

            <!-- Input field for updating student contact information -->
            <div class="mb-3">
                <label for="phone" class="form-label">Contact Information:</label>
                <input type="text" class="form-control" id="phone" name="contact" value="<?php echo $contract; ?>" required>
            </div>

            <!-- Input field for updating student report -->
            <div class="mb-3">
                <label for="report" class="form-label">Report:</label>
                <input type="text" class="form-control" id="report" name="report" value="<?php echo $report; ?>" required>
            </div>

            <!-- Input field for updating student department -->
            <div class="mb-3">
                <label for="dept" class="form-label">Department:</label>
                <input type="text" class="form-control" id="dept" name="dept" value="<?php echo $dept; ?>" required>
            </div>

            <!-- Input field for updating student gender -->
                        <!-- Input field for updating student gender -->
            <div class="mb-3">
                <label class="form-label">Gender:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="male" name="gender" value="Male" <?php if($gender === "Male") echo "checked"; ?>>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="female" name="gender" value="Female" <?php if($gender === "Female") echo "checked"; ?>>
                    <label class="form-check-label" for="female">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="other" name="gender" value="Other" <?php if($gender === "Other") echo "checked"; ?>>
                    <label class="form-check-label" for="other">Other</label>
                </div>
            </div>



            <div class="mb-3">
                <label for="dept" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" required>
            </div>



            <!-- Button to submit the form for updating student details -->
            <button type="submit" class="btn btn-primary">Update</button>

        </form>

    </div>
    <footer>
        <p>&copy; 2024 Registration Form. All rights reserved.</p>
    </footer>

</body>

</html>
