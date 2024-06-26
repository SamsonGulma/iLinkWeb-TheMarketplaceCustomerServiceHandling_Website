<?php
include "db_connection.php";

// Decode the incoming JSON data
$data = json_decode(file_get_contents("php://input"));

$product_id = $data->product_id;

// Implement verification logic
// For example, setting a `verified` flag in the `Verify_Admin` table
$sql = "UPDATE product SET is_validate = 1 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Product has been verified."]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to verify product."]);
}

$stmt->close();
$conn->close();
?>
