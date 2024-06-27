<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "tolossa";
$dbname = "LinkMarket";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $id = $data['id'];

    // Fetch product details
    $sql_product = "SELECT * FROM product WHERE id = ?";
    $stmt_product = $conn->prepare($sql_product);
    if (!$stmt_product) {
        echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]);
        exit;
    }
    $stmt_product->bind_param("i", $id); // 'i' indicates integer parameter

    // Execute the product query
    $stmt_product->execute();

    // Get the product result
    $result_product = $stmt_product->get_result();
    if ($result_product->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'Product not found']);
        $stmt_product->close();
        $conn->close();
        exit;
    }

    // Fetch the product details (assuming only one row)
    $product = $result_product->fetch_assoc();
    $result_product->free(); // Free the product result set
    $stmt_product->close(); // Close the product statement

    // Fetch phone number from kyc table
    $sql_phone = "SELECT phone FROM kyc WHERE user_id = ?";
    $stmt_phone = $conn->prepare($sql_phone);
    if (!$stmt_phone) {
        echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]);
        $conn->close();
        exit;
    }
    $stmt_phone->bind_param("i", $product["user_id"]);
    $stmt_phone->execute();

    // Get the phone result
    $result_phone = $stmt_phone->get_result();
    if ($result_phone->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'User phone number not found']);
        $stmt_phone->close();
        $conn->close();
        exit;
    }

    // Fetch the phone number (assuming only one row)
    $phone = $result_phone->fetch_assoc()['phone'];
    $stmt_phone->close(); // Close the phone statement
    $result_phone->free(); // Free the phone result set

    // Fetch product images
    $encodedImages = [];
    $encodedImages[] = base64_encode($product['photo']); // Assuming 'photo' is the main product image

    $sql_images = "SELECT image FROM product_images WHERE product_id = ?";
    $stmt_images = $conn->prepare($sql_images);
    if (!$stmt_images) {
        echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]);
        $conn->close();
        exit;
    }
    $stmt_images->bind_param("i", $id); // 'i' indicates integer parameter

    // Execute the images query
    $stmt_images->execute();

    // Get the images result set
    $result_images = $stmt_images->get_result();
    while ($row = $result_images->fetch_assoc()) {
        if (!empty($row['image'])) {
            $encodedImages[] = base64_encode($row['image']);
        }
    }
    $result_images->free(); // Free the images result set
    $stmt_images->close(); // Close the images statement

    // Prepare response
    $response = [
        'status' => 'success',
        'detail' => $product["description"],
        'price' => $product["price"],
        'phone' => $phone,
        'images' => $encodedImages,
    ];

    echo json_encode($response);

} else {
    echo json_encode(['status' => 'error', 'message' => 'ID not provided']);
}

// Close the connection
$conn->close();
?>
