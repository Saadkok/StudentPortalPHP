<?php
session_start(); // Start session
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php"); 
    exit(); 
}

?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Module</title>
    <style>
        body {
            background-image: url('background.jpeg'); /* Replace 'your-image-url.jpg' with the URL or path to your image */
            background-size: cover; /* This ensures that the background image covers the entire viewport */
            background-repeat: no-repeat; /* This prevents the background image from repeating */
            background-position: center; /* This centers the background image */
            font-family: Arial, sans-serif;
            /* background-color: #f4f4f4; */
        }

        .container {
            background-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin: 20px 80px 20px 100px;
            padding: 20px;
            /* background-color: #fff; */
            border-radius: 5px;
        
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

        h1, h2 {
            color: #333;
            text-align: center;
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .add-btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

        .add-btn:hover {
            background-color: #218838;
        }

        /* Footer styles */
        footer {
            background-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            /* background-color:#f8f9fa; */
            color: #000;
            text-align: center;
            padding: 5px 0;
            margin: 10px;
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
        <!-- <h1>Student Module</h1> -->

        <!-- Section for viewing existing students -->
        <h2> Students details </h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Email</th>
                    <th>Contact Info</th>
                    <th>Report</th>
                    <th>Dept</th>
                    <th>Gender</th>
                    <th>Adress</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $hostName = "localhost";
                $dbUser = "root";
                $dbPassword = "";
                $dbName = "students-detail";

                // Establish database connection
                $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
                

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Read all rows from the database 
                $sql = "SELECT * FROM stud";

                 // Execute the query
                $result = $conn->query($sql);

                // If there's an error
                if (!$result) {
                    die("Invalid query: " . $conn->error);
                }

                // Display student records
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['name']}</td>
                            <td>{$row['dob']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['report']}</td>
                            <td>{$row['dept']}</td>
                            <td>{$row['gender']}</td>
                            <td>{$row['gender']}</td>
                            
                           
                            <td>
                                <form action='/STUDENT/edit.php' method='GET' style='display: inline;'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <button type='submit'>Edit</button>
                                </form>
                            </td>
                            <td>
                           

                            
                        </td>

                        </tr>";
                }
                

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>

        <!-- Section for adding a new student -->
        <a href='/STUDENT/add.php' class="add-btn">Add new  Student</a>

        
      
    </div>



    <footer>
        <p>&copy; 2024 Registration Form. All rights reserved.</p>
    </footer>
</body>
</html>

<!-- for deleting the student record  -->
<!-- 
<form action='/STUDENT/delete.php' method='GET' style='display: inline;'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <button type='submit'>delete</button>
                            </form> -->

                          
    <?php
    // // Check if photo data exists
    // if (!empty($row['photo'])) {
    //     // Output the base64-encoded image data
    //     echo '<img src="data:image/jpeg;base64,' . base64_encode($row['photo']) . '" alt="Student Photo" style="width: 100px; height: auto;">';
    // } else {
    //     // Output placeholder image or message
    //     echo 'No photo available';
    // }
    ?>
</td>
<!-- -->
<!-- // <td><img src='data:image/jpeg;base64," . base64_encode($row['photo']) . "' alt='Student Photo' style='width: 100px; height: auto;'></td> -->