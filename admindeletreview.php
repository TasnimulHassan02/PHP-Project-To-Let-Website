<?php

// Check if review_id is set and not empty
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $review_id = $_POST['review_id'];

    // Establish database connection
    $conn = new mysqli("localhost", "root", "", "db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute DELETE SQL query
    $sql = "DELETE FROM reviews_ratings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $review_id);
    $stmt->execute();

    // Close statement and database connection
    $stmt->close();
    $conn->close();

    // Redirect back to the page displaying all reviews
    header("Location: adminreview.php");
    exit;
} else {
    // If review_id is not set or empty, redirect back to the page displaying all reviews
    header("Location: adminreview.php");
    exit;
}
?>
