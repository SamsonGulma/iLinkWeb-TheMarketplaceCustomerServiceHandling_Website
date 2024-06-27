<?php
include "db_connection.php";

// Decode the incoming JSON data
$data = json_decode(file_get_contents("php://input"));

$user_id = $data->user_id;
$table_id = $data->table_id;

// Implement verification logic
// For example, setting a `verified` flag in the `Verify_Admin` table
$sql = "UPDATE User SET is_verified = 1 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "User with ID " . $user_id . " has been verified."]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to verify user."]);
}

$stmt->close();
$conn->close();
?>
