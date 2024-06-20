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
// Assuming process.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle incoming POST request
    $description = $_POST['description'];
    $price = $_POST['price']; 
    $image1 = $_POST["image1"];
    $image2 = $_POST["image2"];
    $image3 = $_POST["image3"];
    $image4 = $_POST["image4"];
    $image5 = $_POST["image1"];
  
    $catagory = $_POST["catagory"];
    $created_at = date('Y-m-d H:i:s');
    

    // Process other fields as needed
    // ==============================================================add data to the table product
    $image = $_FILES['image1']['tmp_name'];
    $imgData = file_get_contents($image);
    $stmt = $conn->prepare("INSERT INTO product (category,photo,description,contact_address,user_id,created_at,price) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssisi", $catagory,$imgData,$description,$phone,$user_id,$created_at,$price);
    $stmt->execute();
    // Example response (JSON format)
    $response = array('status' => 'success', 'message' => 'Data received successfully.');
    echo json_encode($response);

} else {
    // Handle invalid request method
    http_response_code(405); // Method Not Allowed
    echo 'Invalid request method.';
}
?>