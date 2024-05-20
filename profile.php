<?php
session_start(); // Start the session to access session variables

// Include the database connection file
$servername = "localhost"; // Replace with your MySQL server address
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "db"; // Replace with your MySQL database name

// Create connection
$mysqli = new mysqli($servername, $username, $password, $database);

// Check if the database connection was successful
if (!$mysqli) {
    // Error connecting to the database
    echo "Error connecting to the database. Please try again later.";
    exit;
}

// Query to get the latest email from the userinfo table
$emailQuery = "SELECT email FROM userinfo ORDER BY id DESC LIMIT 1";

// Execute the query to get the latest email
$result = $mysqli->query($emailQuery);

if ($result) {
    $row = $result->fetch_assoc();
    $latestEmail = $row['email'];

    // Query to retrieve user data based on the latest email
    $userDataQuery = "SELECT * FROM user WHERE email = '$latestEmail'";

    // Execute the query to retrieve user data
    $userDataResult = $mysqli->query($userDataQuery);

    if ($userDataResult && $userDataResult->num_rows > 0) {
        $user = $userDataResult->fetch_assoc();

        // Now you can use $user array to access user information

        // Example usage:
        $name = $user['name'];
        $email=$user['email'];

        // and so on...
    } else {
        // No user found with the latest email
        echo "No user found with the latest email.";
        exit; // Stop execution if no user is found
    }
} else {
    // Error executing the query
    echo "Error executing query: " . $mysqli->error;
    exit; // Stop execution on error
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #333;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        p {
            margin: 5px 0;
            color: #666;
            text-align: left;
        }

        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 8px;
        }

        .button:hover {
            background-color: #45a049;
        }

        .logout-btn {
            background-color: #f44336; /* Red */
        }
        body {
        background-image: url('images/img.jpeg');
        background-size: cover;
        background-repeat: no-repeat;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>User Profile</h1>
        <div class="user-info">
            <p><strong>Name:</strong> <?php echo $name; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
        </div>

        <!-- Add more profile information here as needed -->

        <!-- Button to redirect to loginhome.html -->
        <button class="button" onclick="location.href='loginhome.html';">Exit</button>

        <!-- Button for logout -->
        <form method="post" action="logout.php" style="display: inline;">
            <button class="button logout-btn" type="submit">Logout</button>
        </form>
    </div>
</body>
</html>