
<?php
include "auth.php"; 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>iLINK Homepage</title>
        <link rel="stylesheet" href="styles.css" />
     
    </head>
    <body>
        <header>
            <div class="logo">
                <img
                    src="logo.png"
                    alt="I Link Text"
                />
            </div>
            <nav>
                <ul>
                    <li><a href="" class="active" id = "home_page">User</a></li>
                    <li><a href="" id = "cart_page">Product</a></li>
                    
                    <li><a href="" id = "profile_page">Profile</a></li>
                </ul>
            </nav>
        </header>
        <section id = "homepage">
        
            <?php
                include "auth.php"; // Include your authentication logic and session management
                include "db_connection.php"; // Include your database connection script

                // Query to fetch data from Verify_Admin and User tables
                $sql = "SELECT v.image, u.username, v.phone, v.id, v.user_id FROM Verify_Admin v JOIN User u ON v.user_id = u.id where u.is_verified = 0";
                $result = $conn->query($sql);

                // Check if there are results
                if ($result->num_rows > 0) {
                // Output data of each row
                echo "<div class = \"horizontal\">";
                while($row = $result->fetch_assoc()) {
                    echo '<div class="container">';
                    echo '<div class="content">';
                    // Display image
                    echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" alt="User Image" />';
                    // Display username
                    echo '<p>Username: '.$row['username'].'</p>';
                    // Display phone number
                    echo '<p>Phone: '.$row['phone'].'</p>';
                    // Verify button (you can design this as needed)
                    echo '<button onclick="verifyUser('.$row['user_id'].', '.$row['id'].')">Verify</button>';
                    echo '<button onclick="deleteUser('.$row['user_id'].', '.$row['id'].')" style = "background-color : red;">Delete</button>';
                    echo '</div>';
                    echo '</div>';
                }
                } else {
                
                    echo '<div class="container">';
                    echo '<div class="content">';
                    // Display image
                    echo "Thier is no user to verify";
                   
                    
                    echo '</div>';
                    echo '</div>';
                }
              
                echo "</div>";

                // Close database connection
                $conn->close();
            ?>
            
        </section>
        <section id = "productpage">
            <?php
                include "auth.php"; // Include your authentication logic and session management
                include "db_connection.php"; // Include your database connection script

                // Query to fetch data from Verify_Admin and User tables
                $sql = "SELECT * FROM product where is_validate = 0";
                $result = $conn->query($sql);

                // Check if there are results
                if ($result->num_rows > 0) {
                // Output data of each row
                echo "<div class = \"horizontal\">";
                while($row = $result->fetch_assoc()) {
                    echo '<div class="container">';
                    echo '<div class="content">';
                    // Display image
                    echo '<img src="data:image/jpeg;base64,'.base64_encode($row['photo']).'" alt="User Image" />';
                    // Display username
                    echo '<p>category: '.$row['category'].'</p>';
                    // Display phone number
                    echo '<p>price: '.$row['price'].'</p>';
                    // // Verify button (you can design this as needed)
                    echo '<button onclick="productVerify('.$row['id'].','.$row['id'].'.)">Verify</button>';
                    echo '<button onclick="deleteProduct('.$row['id'].'.)" style = "background-color : red;">Delete</button>';
                    echo '</div>';
                    echo '</div>';
                }
                } else {
                
                    echo '<div class="container">';
                    echo '<div class="content">';
                    // Display image
                    echo "Thier is no Product to verify";
                   
                    
                    echo '</div>';
                    echo '</div>';
                }
              
                echo "</div>";

                // Close database connection
                $conn->close();
            ?>
        </section>
        <script src="script.js"></script>
        <script src="image-input.js"></script>
        <script src = "home.js"></script>
        <!-- <script src="save_post.js"></script> -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        
        
    </body>
</html>
