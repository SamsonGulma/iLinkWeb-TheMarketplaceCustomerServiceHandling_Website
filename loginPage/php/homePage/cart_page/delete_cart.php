<?php
require "db_connection.php";

$data = json_decode(file_get_contents("php://input"));

$table_id = $data->table_id;

// Example logic for deleting the admin
$sql = "DELETE FROM cart WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $table_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Cart Item deleted successfully!"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to delete cart Items"]);
}

$stmt->close();
$conn->close();
?>
