<?php
// Include database connection code
include "db_connection.php";

// Start the session
session_start();

// Check if user_id is set in session
if (!isset($_SESSION['user_id'])) {
  
    // User is not logged in
    echo json_encode(array('is_valid' => false));
    exit();
}

$user_id = $_SESSION['user_id'];

// Prepare and execute SQL query to retrieve user information
$sql = "SELECT * FROM User WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // User found
    $row = $result->fetch_assoc();
    
    // Example: Check if user is verified (adjust this condition as per your needs)
    if ($row['is_verified'] == 1) {
        // User is valid
        echo json_encode(array('is_valid' => true,'user' =>$user_id));
    } else {
        // User is not verified or any other criteria you want to check
        echo json_encode(array('is_valid' => false, 'user' =>$user_id));
    }
} else {
    // User not found
    
    echo json_encode(array('is_valid' => false, 'user' =>$user_id));
}

// Close database connection
$stmt->close();
$conn->close();
?>
