<?php
// Include database connection code
include "db_connection.php";

// Get the POST data
$data = json_decode(file_get_contents("php://input"));

$fullname = $data->fullname;
$username_register = $data->username_register;
$email = $data->email;
$password_register = password_hash($data->password_register, PASSWORD_BCRYPT); // Hash the password

// Check if email or username already exist
$stmt_email = $conn->prepare("SELECT * FROM User WHERE email = ?");
$stmt_email->bind_param("s", $email);
$stmt_email->execute();
$stmt_email->store_result();

$stmt_username = $conn->prepare("SELECT * FROM User WHERE username = ?");
$stmt_username->bind_param("s", $username_register);
$stmt_username->execute();
$stmt_username->store_result();

if ($stmt_email->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "Email is already registered"]);
} elseif ($stmt_username->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "Username is already taken"]);
} else {
    // Prepare and bind insertion
    $valid = 1;
    $admin = 1;
    $stmt_insert = $conn->prepare("INSERT INTO User (fullname, username, email, password) VALUES (?, ?, ?,?)");
    $stmt_insert->bind_param("ssss", $fullname, $username_register, $email,$password_register);

    // Execute the statement and return response
    if ($stmt_insert->execute()) {
        echo json_encode(["status" => "success", "message" => "Registration successful!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $stmt_insert->error]);
    }

    // Close insertion statement
    $stmt_insert->close();
}

// Close email and username check statements
$stmt_email->close();
$stmt_username->close();

// Close connection
$conn->close();
?>
