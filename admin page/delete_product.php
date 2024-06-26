<?php
require_once "db_connection.php"; // Include the database connection

// Decode the JSON data received via POST
$data = json_decode(file_get_contents("php://input"));

// Check if the required table_id field is present
if (!isset($data->table_id)) {
    echo json_encode(["success" => false, "message" => "Invalid input data."]);
    exit;
}

$table_id = $data->table_id;

// Delete product images associated with the given product ID
$sql_images = "DELETE FROM product_images WHERE product_id = ?";
$stmt_images = $conn->prepare($sql_images);
$stmt_images->bind_param("i", $table_id);

if (!$stmt_images->execute()) {
    echo json_encode(["success" => false, "message" => "Failed to delete product images: " . $conn->error]);
    exit;
}

$stmt_images->close();

// Delete the product record from the database
$sql_product = "DELETE FROM product WHERE id = ?";
$stmt_product = $conn->prepare($sql_product);
$stmt_product->bind_param("i", $table_id);

if ($stmt_product->execute()) {
    echo json_encode(["success" => true, "message" => "Product deleted successfully!"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to delete product: " . $stmt_product->error]);
}

$stmt_product->close();
$conn->close(); // Close the database connection
?>
