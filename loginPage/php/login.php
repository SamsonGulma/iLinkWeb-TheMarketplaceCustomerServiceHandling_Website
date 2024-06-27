<?php
// Include database connection code
include "db_connection.php";

// Start the session
session_start();

// Retrieve form data
$data = json_decode(file_get_contents("php://input"));

$username = $data->username;
$password = $data->password;

// Prepare and execute SQL query to retrieve user information
$sql = "SELECT * FROM User WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

$response = [];

if ($result->num_rows > 0) {
    // User found, verify password
    $row = $result->fetch_assoc();
    
    if (password_verify($password, $row['password'])) {
        // Store user ID and isAdmin in session
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['isAdmin'] = $row['isAdmin'];
        $_SESSION['is_verify'] = $row["is_verified"];
        $_SESSION['email'] = $row['email'];
        $_SESSION['fullname'] = $row["fullname"];
        $_SESSION['username'] = $row["username"];
        $profilePictureSql = "SELECT image FROM profilePicture WHERE userId = ?";
        $profilePictureStmt = $conn->prepare($profilePictureSql);
        $profilePictureStmt->bind_param("i", $row['id']);
        $profilePictureStmt->execute();
        $profilePictureResult = $profilePictureStmt->get_result();

        if ($profilePictureResult->num_rows > 0) {
            $profilePictureRow = $profilePictureResult->fetch_assoc();
            $_SESSION['profile_picture'] = base64_encode($profilePictureRow['image']);
        } else {
            $_SESSION['profile_picture'] = "pp.png";
        }
        // Prepare success response
        $response['status'] = 'success';
        $response['message'] = 'Login successful';
        $response['redirect'] = $row['isAdmin'] == 1 ? 'admin/admin.php' : 'homePage/index.php';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Invalid username or password';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'User not found';
}

// Close database connection
$stmt->close();
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
