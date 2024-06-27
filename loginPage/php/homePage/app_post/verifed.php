<?php
// Include database connection code
include "db_connection.php";

// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to the login page
    header("Location: /index.html");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and process form data
    if (isset($_FILES['kycImage']) && isset($_POST['phone'])) {
        $kyc_image = $_FILES['kycImage']['tmp_name'];
        $phone = $_POST['phone'];
        
        // Read image data
        $imgData = file_get_contents($kyc_image);
        
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO kyc (image, user_id,phone) VALUES (?, ?, ?)");
        
        // Bind parameters
        $null = NULL; // Placeholder for BLOB
        $stmt->bind_param("bis", $null, $user_id, $phone);
        
        // Send BLOB data
        $stmt->send_long_data(0, $imgData);
        
        // Execute statement
        if ($stmt->execute()) {
            // Success response
            $response = array('success' => true, 'message' => 'Data received successfully. wait untile verification.');
            echo json_encode($response);
        } else {
            // Error response
            $response = array('success' => false, 'message' => 'Failed to insert data.');
            echo json_encode($response);
        }
        
        // Close statement
        $stmt->close();
    } else {
        // Invalid data received
        http_response_code(400); // Bad Request
        $response = array('success' => false, 'message' => 'Invalid data received.');
        echo json_encode($response);
    }
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    $response = array('success' => false, 'message' => 'Method not allowed.');
    echo json_encode($response);
}

// Close database connection (if necessary)
$conn->close();
?>
