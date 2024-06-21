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
    
    // Check if user is verified
    if ($row['is_verified'] == 1) {
        // Check if the user ID is present in the KYC table
        $kyc_sql = "SELECT * FROM kyc WHERE user_id = ?";
        $kyc_stmt = $conn->prepare($kyc_sql);
        $kyc_stmt->bind_param('i', $user_id);
        $kyc_stmt->execute();
        $kyc_result = $kyc_stmt->get_result();
        
        if ($kyc_result->num_rows > 0) {
            // User KYC is present
            echo json_encode(array('is_valid' => true, 'user' => $user_id, 'kyc_present' => true));
        } else {
            // User KYC is not present
            echo json_encode(array('is_valid' => true, 'user' => $user_id, 'kyc_present' => false));
        }
        
        $kyc_stmt->close();
    } else {
        $kyc_sql = "SELECT * FROM kyc WHERE user_id = ?";
        $kyc_stmt = $conn->prepare($kyc_sql);
        $kyc_stmt->bind_param('i', $user_id);
        $kyc_stmt->execute();
        $kyc_result = $kyc_stmt->get_result();
        
        if ($kyc_result->num_rows > 0) {
            // User KYC is present
            echo json_encode(array('is_valid' => false, 'user' => $user_id, 'kyc_present' => true));
        } else {
            // User KYC is not present
            echo json_encode(array('is_valid' => false, 'user' => $user_id, 'kyc_present' => false));
        }
        
        $kyc_stmt->close();
        // User is not verified or any other criteria you want to check
        
    }
} else {
    // User not found
    
    echo json_encode(array('is_valid' => false, 'user' => $user_id, 'kyc_present' => false));

}

// Close database connection
$stmt->close();
$conn->close();
?>
