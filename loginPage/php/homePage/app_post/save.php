<?php
require ("db_connection.php");
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to the login page
    header("Location: /index.html");
    exit();
}
$user_id = $_SESSION['user_id'];
$response = [];
// Assuming process.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle incoming POST request
    $description = $_POST['description'];
    $price = $_POST['price']; 
    $image1 = $_POST["image1"];
    $image2 = $_POST["image2"];
    $image3 = $_POST["image3"];
    $image4 = $_POST["image4"];
    $image5 = $_POST["image5"];
   
    $imageFields = ['image2', 'image3', 'image4', 'image5'];
  
    $catagory = $_POST["catagory"];
    $phone = $_POST["contact_address"]; // Assuming this field is also in the POST data
    $user_id = $_POST["user_id"]; // Assuming this field is also in the POST data
    $created_at = date('Y-m-d H:i:s');

    // Initialize an array to hold the images
    $images = array();

    // Process the main image
    if (!empty($_FILES['image1']['tmp_name'])) {
        $image = $_FILES['image1']['tmp_name'];
        $imgData = file_get_contents($image);

        // Insert main product data into product table
        $stmt = $conn->prepare("INSERT INTO product (category, photo, description, contact_address, user_id, created_at, price) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            $response['status'] = 'error';
            $response['message'] = 'Prepare failed: ' . htmlspecialchars($conn->error);
            echo json_encode($response);
            exit();
        }
        $stmt->bind_param("ssssisi", $catagory, $imgData, $description, $phone, $user_id, $created_at, $price);
        if ($stmt->execute() === false) {
            $response['status'] = 'error';
            $response['message'] = 'Execute failed: ' . htmlspecialchars($stmt->error);
            echo json_encode($response);
            exit();
        }
        $inserted_id = $conn->insert_id;
        $stmt->close();
        foreach ($imageFields as $field){
            if (!empty($_FILES[$field]['tmp_name'])){
                $image = $_FILES[$field]['tmp_name'];
                $imgData = file_get_contents($image);
                $stmt = $conn->prepare("INSERT INTO product_images (product_id,image) VALUES (?,?)");
                if ($stmt === false) {
                    $response['status'] = 'error';
                    $response['message'] = 'Prepare failed: ' . htmlspecialchars($conn->error);
                    echo json_encode($response);
                    exit();
                }
                $stmt->bind_param("is",$inserted_id, $imgData);
                if ($stmt->execute() === false) {
                    $response['status'] = 'error';
                    $response['message'] = 'Execute failed: ' . htmlspecialchars($stmt->error);
                    echo json_encode($response);
                    exit();
                }
                
                $stmt->close();
            }
        }
        $response['status'] = 'success';
        $response['message'] = 'Product and images uploaded successfully.';
    } else {
        
        $response['status'] = 'error';
        $response['message'] = 'Main image is required.';
    }

    // Process additional images
    
    $conn->close();
    echo json_encode($response);
}
 else {
    // Handle invalid request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>