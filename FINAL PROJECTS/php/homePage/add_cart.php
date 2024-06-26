<?php
require ("app_post/db_connection.php");
session_start();
$user_id = $_SESSION['user_id'];
// Retrieve data sent via Ajax
$itemId = $_POST['itemId'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$total = $price * $quantity;
$response = "";
if ($quantity > 0){
    $checkSql = "SELECT * FROM cart WHERE product_id = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("i", $itemId);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    
    if ($checkResult->num_rows > 0) {
        // If product_id exists, update the existing row
        $updateSql = "UPDATE cart SET quantity = quantity + ?, total_price = total_price + ? WHERE product_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("idi", $quantity, $totalPrice, $itemId);
        $updateResult = $updateStmt->execute();
        $updateStmt->close();
    } else {
        // If product_id does not exist, insert a new row
        $insertSql = "INSERT INTO cart (product_id, quantity, total_price, price, user_id) VALUES (?, ?, ?, ?,?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("iiidi", $itemId, $quantity, $totalPrice, $price,$user_id);
        $insertResult = $insertStmt->execute();
        $insertStmt->close();
    }

    $checkStmt->close();
    if (isset($updateResult) && $updateResult || isset($insertResult) && $insertResult) {
        $response = array(
            'success' => true,
            'message' => 'Item added to cart successfully.'
        );
        echo json_encode($response);
    } else {
        $response = array(
            'success' => false,
            'message' => 'Error: ' . $conn->error
        );
        echo json_encode($response);
    }
    
    $conn->close();
}
else{
    header('Content-Type: application/json');
    echo json_encode($response);
}
        
// Process the data as needed (e.g., add to cart, update session, etc.)

// Example response (optional): Send a response back to JavaScript

// Output JSON response

?>
