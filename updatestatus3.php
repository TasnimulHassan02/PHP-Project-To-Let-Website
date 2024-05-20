<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if blog_id and action are set in $_POST
if (isset($_POST['blog_id']) && isset($_POST['action'])) {
    $blog_id = $_POST['blog_id'];
    $action = $_POST['action'];
    
    // Update status in the database
    $sql = "UPDATE blog SET status = '$action' WHERE id = $blog_id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: adminblog.php");
    } else {
        echo "Error updating status: " . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();

?>
