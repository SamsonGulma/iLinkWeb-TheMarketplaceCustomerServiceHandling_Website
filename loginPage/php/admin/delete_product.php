<?php
include "db_connection.php";

// Assuming JSON data is sent via POST
$data = json_decode(file_get_contents("php://input"));

if (!isset($data->table_id)) {
    echo json_encode(["success" => false, "message" => "Invalid input data."]);
    exit;
}


$table_id = $data->table_id;

// Delete associated product images first
$sql_images = "DELETE FROM product_images WHERE product_id = ?";
$stmt_images = $conn->prepare($sql_images);
$stmt_images->bind_param("i", $table_id);

if (!$stmt_images->execute()) {
    echo json_encode(["success" => false, "message" => "Failed to delete product images: " . $conn->error]);
    exit;
}

$stmt_images->close();

// Then delete the product itself
$sql_product = "DELETE FROM product WHERE id = ?";
$stmt_product = $conn->prepare($sql_product);
$stmt_product->bind_param("i", $table_id);

if ($stmt_product->execute()) {
    echo json_encode(["success" => true, "message" => "Product deleted successfully!"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to delete product: " . $stmt_product->error]);
}

$stmt_product->close();
$conn->close();
?>
