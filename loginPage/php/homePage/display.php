<?php
$servername = "localhost";
$username = "root";
$password = "tolossa";
$dbname = "LinkMarket";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
echo "Display.php included successfully.";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to select all data including photo from the product table
$sql = "SELECT id, category, photo, description, contact_address, user_id, created_at FROM product";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $photo_data = base64_encode($row["photo"]);
        echo "<div>";
        echo "<h2>" . $row["category"] . "</h2>";
        echo "<img src='data:image/jpeg;base64," . $photo_data . "' alt='Product Photo'>";
        echo "<p>Description: " . $row["description"] . "</p>";
        echo "<p>Contact Address: " . $row["contact_address"] . "</p>";
        echo "<p>User ID: " . $row["user_id"] . "</p>";
        echo "<p>Created At: " . $row["created_at"] . "</p>";
        echo "</div>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
