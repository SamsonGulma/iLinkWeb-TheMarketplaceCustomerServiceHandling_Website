<?php
include "db_connection.php";

$data = json_decode(file_get_contents("php://input"));

$user_id = $data->user_id;
$table_id = $data->table_id;

// Example logic for deleting the admin
$sql = "DELETE FROM kyc WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $table_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "User KYC deleted successfully!"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to delete user KYC."]);
}

$stmt->close();
$conn->close();
?>
