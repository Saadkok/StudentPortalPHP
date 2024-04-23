<?php
session_start(); 
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php"); 
    exit(); 
}
?>
<?php

// To connect with the database...!
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "students-detail";

// Establish database connection
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

$name = isset($_POST["name"]) ? $_POST["name"] : "";
$dob = isset($_POST["dob"]) ? $_POST["dob"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$contract = isset($_POST["contact"]) ? $_POST["contact"] : "";
$report = isset($_POST["report"]) ? $_POST["report"] : "";
$dept = isset($_POST["dept"]) ? $_POST["dept"] : ""; // Initialize department
$gender = isset($_POST["gender"]) ? $_POST["gender"] : ""; // Initialize gender
$address =isset($_POST["address"]) ? $_POST["address"] : "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = $_POST["name"];
    $dob = $_POST["dob"];
    $email = $_POST["email"];
    $contract = $_POST["contact"];
    $report = $_POST["report"];
    $dept = $_POST["dept"]; 
    $gender = $_POST["gender"]; 
    $address =$_POST["address"];

    do {
        // Check if the phone number contains only numbers and has exactly 10 digits
        if (!preg_match('/^[0-9]{10}$/', $contract)) {
            $errorMessage = "Phone number must contain exactly 10 digits and only numbers";
            break;
        }

        //all fields are filled or not 
        if (empty($name) || empty($dob) || empty($contract)) {
            $errorMessage = "All fields are required";
            break;
        }

        // Inserting into database would be done here
        $sql = "INSERT INTO stud (name, dob, email, phone, report, dept, gender,address) VALUES ('$name', '$dob', '$email', '$contract', '$report' ,'$dept','$gender','$address')";

        // Execute SQL query and store the result
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            $errorMessage = "Error: " . mysqli_error($conn);
            break;
        }

        // For now, just resetting the form fields
        $name = "";
        $dob = "";
        $email = "";
        $contract = "";
        $report = "";
        $dept="";
        $gender="";
        $address="";
        $successMessage = "Student added successfully";

        header("Location: /STUDENT/studentmodule.php");
        exit;
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        /* Footer styles */
        footer {
            background-color: #f8f9fa;
            color: #000;
            text-align: center;
            padding: 5px 0;
            margin: 0;
            /* position: fixed; */
            bottom: 0;
            width: 100%;
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
            background-color: rgba(255, 255, 255, 0.3);
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
        <a href="/student/index.php"  style=" margin-left: 40px;" >Sin up</a>
        <a href="/student/logout.php"  style=" margin-left: 40px;" >logout</a>
    </nav>
</header>
    <div class="container">
        <h2>Insert Student details</h2>

        <!-- Error message alert -->
        <?php if (!empty($errorMessage)) : ?>
            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <!-- Success message alert -->
        <?php if (!empty($successMessage)) : ?>
            <div class="alert alert-success"><?php echo $successMessage; ?></div>
        <?php endif; ?>

        <!-- Form for inserting student details -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <!-- Hidden input field for student ID -->
            <input type="hidden" value="<?php echo $id; ?>">

            <!-- Name input field -->
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
            </div>

            <!-- Date of Birth input field -->
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth:</label>
                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $dob; ?>" required>
            </div>

            <!-- Email input field -->
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>

            <!-- Contact Information input field -->
            <div class="mb-3">
                <label for="contact" class="form-label">Contact Information:</label>
                <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $contract; ?>" required>
            </div>

            <!-- Report input field -->
            <div class="mb-3">
                <label for="report" class="form-label">Report:</label>
                <input type="text" class="form-control" id="report" name="report" value="<?php echo $report; ?>" required>
            </div>


            <div class="mb-3">
                <label for="report" class="form-label">Dept</label>
                <input type="text" class="form-control" id="dept" name="dept" value="<?php echo $dept; ?>" required>
            </div>


            <!-- Gender input field -->
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







            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <footer>
        <p>&copy; 2024 Registration Form. All rights reserved.</p>
    </footer>
</body>

</html>
