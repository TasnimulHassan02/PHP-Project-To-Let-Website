<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Mafia Amount</title>
</head>
<body style="background-image: url('images/img.jpeg'); background-size: cover; background-position: center; font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh;">
    <a href="admin.php" style="position: absolute; top: 10px; left: 10px; padding: 10px 20px; background-color: green; color: white; text-decoration: none; border-radius: 5px;">Home</a>
    <div style="background-color: rgba(255, 255, 255, 0.7); padding: 20px; border-radius: 10px; text-align: center;">
        <?php

        // Assuming you've already established a connection to your database

        // Database connection parameters
        $servername = "localhost"; // Change this to your server name if it's different
        $username = "root"; // Change this to your database username
        $password = ""; // Change this to your database password
        $dbname = "db"; // Change this to your database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to calculate the sum of mafia_amount
        $sql = "SELECT SUM(mafia_amount) AS total_amount FROM booking";

        // Execute the query
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<h2>Total Mafia Amount: " . $row["total_amount"]. " Taka</h2>";
            }
        } else {
            echo "<h2>No results found</h2>";
        }

        // Close the connection
        $conn->close();

        ?>
    </div>
</body>
</html>