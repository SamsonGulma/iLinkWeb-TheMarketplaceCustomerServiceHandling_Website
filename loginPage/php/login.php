<?php
// Include database connection code
include "db_connection.php";

// Start the session
session_start();

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare and execute SQL query to retrieve user information
$sql = "SELECT * FROM User WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // User found, verify password
    $row = $result->fetch_assoc();
    
    if (password_verify($password, $row['password'])) {
        // Store user ID and isAdmin in session
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['isAdmin'] = $row['isAdmin'];

        // Check if user is admin
        if ($row['isAdmin'] == 1) {
            // Redirect to admin page
            header("Location: admin/admin.php");
            exit();
        } else {
            // Redirect to user dashboard or home page
            header("Location: homePage/index.php");
            exit();
        }
    } else {
        echo "Invalid username or password";
    }
} else {
    echo "User not found";
}

// Close database connection
$stmt->close();
$conn->close();
?>
