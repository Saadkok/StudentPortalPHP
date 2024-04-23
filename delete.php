<?php
if(isset($_GET["id"]))
 {

    $id = $_GET["id"];

    $hostName = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "students-detail";

    // Establish database connection
    $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

    
    // Construct and execute the delete query
    $sql = "DELETE FROM student WHERE id=$id";
    $conn->query($sql);
 
}

header("Location: /STUDENT/studentdmodule.php");
                exit;

?>
