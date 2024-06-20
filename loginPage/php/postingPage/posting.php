<?php
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

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $category = $_POST['categories'];
    $simple_description1 = $_POST['simple_description1'];
    $price = $_POST['price'];
    $contact_address = $_POST['contact_address'];
    
    // Initialize product_image and product_image_id
    $product_image1 = null;
    $product_image2 = null;
    $product_image_id = null;
    
    // Handle file upload for product image 1
    if (isset($_FILES['chooseLicense']) && $_FILES['chooseLicense']['error'] == UPLOAD_ERR_OK) {
        $product_image1 = file_get_contents($_FILES['chooseLicense']['tmp_name']);
        
        // Insert into ProductImage table
        $stmt = $conn->prepare("INSERT INTO ProductImage (image) VALUES (?)");

        // Bind the parameter and execute the statement
        $stmt->bind_param("s", $product_image1);
        $current_id = $stmt->execute() or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_connect_error());
        $product_image_id = $stmt->insert_id;
        // Close the statement after execution
        $stmt->close();
    }
    else{
        echo "Error: Invalid request no images uploaded";
    }
    
    // Handle file upload for product image 2
    $file_tmp_name = $_FILES['product_image1']['tmp_name'];
    $file_name = $_FILES['product_image1']['name'];

    // Replace spaces with underscores in the file name
    $file_name = str_replace(' ', '_', $file_name);

    // Ensure file reading
    echo $file_name;
    $product_image2 = file_get_contents($file_tmp_name);
    
    
    
    $stmt = $conn->prepare("INSERT INTO product (category, photo, description, contact_address, user_id, created_at, product_image_id) VALUES (?, ?, ?, ?, ?, NOW(), ?)");

    // Assuming the first description as name for simplicity
    
    $user_id = 1; // Replace with actual user_id from session or context
    // echo $product_image_id;
    // Bind the parameters
    $stmt->bind_param("ssssii", $category, $product_image2, $simple_description1, $contact_address, $user_id, $product_image_id);
    // $stmt->bind_param("bssssii", $category, $product_image2, $description, $contact_address, $user_id, $product_image_id);



    if ($stmt->execute()) {
        
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();


    
}

$conn->close();
?>
