
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
        <link rel="stylesheet" href="app_post/style.css" />
        <link rel="stylesheet" href="cart_page/style.css" />
        <link rel="stylesheet" href="detailPage/style.css" />
        <link rel="stylesheet" href="profile.css" />
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
                    <li><a href="" class="active" id = "home_page">Home</a></li>
                    <li><a href="" id = "cart_page">Cart</a></li>
                    <li><a href="" id = "add_product_page">Add Product</a></li>
                    <li><a href="" id = "profile_detail">Profile</a></li>
                </ul>
            </nav>
        </header>

        <main>
        <section id = "homepage_loder">
            <section class="search-section">
                <div class="home-links">
                    <a href="#" onclick="showContent('home')">All</a>
                    <a href="#" onclick="showContent('furniture')">Furniture</a>
                    <a href="#" onclick="showContent('clothes')">Clothes</a>
                    <a href="#" onclick="showContent('phones')">Phones</a>
                    <a href="#" onclick="showContent('laptops')">Laptops</a>
                    <a href="#" onclick="showContent('other')">Other</a>
                </div>
            </section>
            <!-- ================================================== -->
            

                <section id="home" class="content active">
                    <h1 id="welcome-text">Welcome to Our iLINK Market Place</h1>
                    <p id="browse-text">
                        Browse through our categories to find what you need.
                    </p>

                    <div class="item_container">
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

                        // Query to select all data including photo from the product table
                        $sql = "SELECT * FROM product where is_validate = 1";
                        $result = $conn->query($sql);
                        ?>
                        
                        <?php
                        
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                    $photo_data = base64_encode($row["photo"]);
                                    $itemId = $row["id"];
                                    $description = $row["description"];
                                    $words = str_word_count($description, 1);
                                    $first_20_words = implode(' ', array_slice($words, 0, 5));
                                    
                                    echo "<div class=\"item\">";
                                    
                                    // echo "<button><img src='data:image/jpeg;base64," . $photo_data . "' alt='Product Photo'></button>";
                                    echo "<button onclick=\"detailProduct($itemId)\" class='image-button'>
                                    <img src='data:image/jpeg;base64," . $photo_data . "' alt='Product Photo'>
                                </button>";
                                    echo "<div class=\"description\">";
                                    echo "<p>" . $first_20_words . "</p>";
                                    echo "<p>" . $row["contact_address"] . "</p>";
                                    echo "<p>Price: " . $row["price"] . "</p>";
                                    echo "<p>" . $row["created_at"] . "</p>";
                                    echo "
                                        <div class=\"counter-container\">
                                            <div class=\"items-number\">
                                                <button class=\"decrement-btn\" data-id=\"$itemId\">-</button>
                                                <span id=\"counter-$itemId\">0</span>
                                                <button class=\"increment-btn\" data-id=\"$itemId\">+</button>
                                            </div>
                                            <div>
                                            <button class=\"add-to-cart-btn\" data-id=\"$itemId\" data-user-id=\"" . $row["user_id"] . "\" data-price=\"" . $row["price"] . "\" data-quantity=\"counter-$itemId\">Add to Cart</button>
                                            </div>
                                        </div>
                                        ";
                                    echo "</div>";
                                    
                                    echo "</div>";
                                
                            }
                        } else {
                            echo "0 results";
                        }
                        $conn->close();
                        ?>

                    </div>
                </section>

                <!-- Other sections for each category remain unchanged -->
                <section id="furniture" class="content">
                    <h1>Furniture</h1>
                    <div class="item_container">
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

                        // Query to select all data including photo from the product table
                        
                        $sql = "SELECT id, category, photo, description, contact_address, user_id, created_at FROM product WHERE category = 'furniture' && is_validate = 1";
                        $result = $conn->query($sql);

                        ?>
                        
                        <?php
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                $photo_data = base64_encode($row["photo"]);
                                    $itemId = $row["id"];
                                    $description = $row["description"];
                                    $words = str_word_count($description, 1);
                                    $first_20_words = implode(' ', array_slice($words, 0, 5));
                                    echo "<div class=\"item\">";
                                    echo "<button onclick=\"detailProduct($itemId)\" class='image-button'>
                                    <img src='data:image/jpeg;base64," . $photo_data . "' alt='Product Photo'>
                                </button>";
                                    echo "<div class=\"description\">";
                                    echo "<p>" . $first_20_words . "</p>";
                                    echo "<p>" . $row["contact_address"] . "</p>";
                                    echo "<p>User ID: " . $row["user_id"] . "</p>";
                                    echo "<p>" . $row["created_at"] . "</p>";
                                    echo "
                                        <div class=\"counter-container\">
                                            <div class=\"items-number\">
                                                <button class=\"decrement-btn\" data-id=\"$itemId\">-</button>
                                                <span id=\"counter-$itemId-catagory\">0</span>
                                                <button class=\"increment-btn\" data-id=\"$itemId\">+</button>
                                            </div>
                                            <div>
                                            <button class=\"add-to-cart-btn\" data-id=\"$itemId\" data-user-id=\"" . $row["user_id"] . "\" data-price=\"" . $row["price"] . "\" data-quantity=\"counter-$itemId\">Add to Cart</button>
                                            </div>
                                        </div>
                                        ";
                                    echo "</div>";
                                    
                                    echo "</div>";
                                
                            }
                        } else {
                            echo "0 results";
                        }
                        $conn->close();
                        ?>
                        </div>

                </section>

                <section id="clothes" class="content">
                    <h1>Clothes</h1>
                    <p>Browse our clothing selection.</p>
                    <div class="item_container">
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

                        // Query to select all data including photo from the product table
                        
                        $sql = "SELECT id, category, photo, description, contact_address, user_id, created_at FROM product WHERE category = 'clothes' && is_validate = 1";
                        $result = $conn->query($sql);

                        ?>
                        
                        <?php
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                $photo_data = base64_encode($row["photo"]);
                                    $itemId = $row["id"];
                                    $description = $row["description"];
                                    $words = str_word_count($description, 1);
                                    $first_20_words = implode(' ', array_slice($words, 0, 5));
                                    echo "<div class=\"item\">";
                                    
                                    echo "<button onclick=\"detailProduct($itemId)\" class='image-button'>
                                    <img src='data:image/jpeg;base64," . $photo_data . "' alt='Product Photo'>
                                </button>";
                                    echo "<div class=\"description\">";
                                    echo "<p>" . $first_20_words . "</p>";
                                    echo "<p>" . $row["contact_address"] . "</p>";
                                    echo "<p>User ID: " . $row["user_id"] . "</p>";
                                    echo "<p>" . $row["created_at"] . "</p>";
                                    echo "
                                        <div class=\"counter-container\">
                                            <div class=\"items-number\">
                                                <button class=\"decrement-btn\" data-id=\"$itemId\">-</button>
                                                <span id=\"counter-$itemId-catagory\">0</span>
                                                <button class=\"increment-btn\" data-id=\"$itemId\">+</button>
                                            </div>
                                            <div>
                                            <button class=\"add-to-cart-btn\" data-id=\"$itemId\" data-user-id=\"" . $row["user_id"] . "\" data-price=\"" . $row["price"] . "\" data-quantity=\"counter-$itemId\">Add to Cart</button>
                                            </div>
                                        </div>
                                        ";
                                    echo "</div>";
                                    
                                    echo "</div>";
                                
                            }
                        } else {
                            echo "0 results";
                        }
                        $conn->close();
                        ?>
                        </div>
                </section>

                <section id="phones" class="content">
                    <h1>Phones</h1>
                    <p>Discover the latest phones.</p>
                    <div class="item_container">
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

                        // Query to select all data including photo from the product table
                        
                        $sql = "SELECT id, category, photo, description, contact_address, user_id, created_at FROM product WHERE category = 'phones' && is_validate = 1";
                        $result = $conn->query($sql);

                        ?>
                        
                        <?php
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                $photo_data = base64_encode($row["photo"]);
                                    $itemId = $row["id"];
                                    $description = $row["description"];
                                    $words = str_word_count($description, 1);
                                    $first_20_words = implode(' ', array_slice($words, 0, 5));
                                    echo "<div class=\"item\">";
                                    
                                    echo "<button onclick=\"detailProduct($itemId)\" class='image-button'>
                                    <img src='data:image/jpeg;base64," . $photo_data . "' alt='Product Photo'>
                                </button>";
                                    echo "<div class=\"description\">";
                                    echo "<p>" . $first_20_words . "</p>";
                                    echo "<p>" . $row["contact_address"] . "</p>";
                                    echo "<p>User ID: " . $row["user_id"] . "</p>";
                                    echo "<p>" . $row["created_at"] . "</p>";
                                    echo "
                                        <div class=\"counter-container\">
                                            <div class=\"items-number\">
                                                <button class=\"decrement-btn\" data-id=\"$itemId\">-</button>
                                                <span id=\"counter-$itemId-catagory\">0</span>
                                                <button class=\"increment-btn\" data-id=\"$itemId\">+</button>
                                            </div>
                                            <div>
                                            <button class=\"add-to-cart-btn\" data-id=\"$itemId\" data-user-id=\"" . $row["user_id"] . "\" data-price=\"" . $row["price"] . "\" data-quantity=\"counter-$itemId\">Add to Cart</button>
                                            </div>
                                        </div>
                                        ";
                                    echo "</div>";
                                    
                                    echo "</div>";
                                
                            }
                        } else {
                            echo "0 results";
                        }
                        $conn->close();
                        ?>
                        </div>
                </section>

                <section id="laptops" class="content">
                    <h1>Laptops</h1>
                    <p>Check out our range of laptops.</p>
                    <div class="item_container">
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

                        // Query to select all data including photo from the product table
                        
                        $sql = "SELECT id, category, photo, description, contact_address, user_id, created_at FROM product WHERE category = 'Laptop' && is_validate = 1";
                        $result = $conn->query($sql);

                        ?>
                        
                        <?php
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                $photo_data = base64_encode($row["photo"]);
                                $itemId = $row["id"];
                                $description = $row["description"];
                                $words = str_word_count($description, 1);
                                $first_20_words = implode(' ', array_slice($words, 0, 5));
                                echo "<div class=\"item\">";
                                
                                echo "<button onclick=\"detailProduct($itemId)\" class='image-button'>
                                    <img src='data:image/jpeg;base64," . $photo_data . "' alt='Product Photo'>
                                </button>";
                                echo "<div class=\"description\">";
                                echo "<p>" . $first_20_words . "</p>";
                                echo "<p>" . $row["contact_address"] . "</p>";
                                echo "<p>User ID: " . $row["user_id"] . "</p>";
                                echo "<p>" . $row["created_at"] . "</p>";
                                echo "
                                    <div class=\"counter-container\">
                                        <div class=\"items-number\">
                                            <button class=\"decrement-btn\" data-id=\"$itemId\">-</button>
                                            <span id=\"counter-$itemId-catagory\">0</span>
                                            <button class=\"increment-btn\" data-id=\"$itemId\">+</button>
                                        </div>
                                        <div>
                                            <button class=\"add-to-cart-btn\" data-id=\"$itemId\" data-user-id=\"" . $row["user_id"] . "\" data-price=\"" . $row["price"] . "\" data-quantity=\"counter-$itemId\">Add to Cart</button>
                                            </div>
                                    </div>
                                    ";
                                echo "</div>";
                                
                                echo "</div>";
                            
                        }
                        } else {
                            echo "0 results";
                        }
                        $conn->close();
                        ?>
                        </div>
                    </div>
                </section>

                <section id="other" class="content">
                    <h1>Other</h1>
                    <p>Find various other products here.</p>

                    <div class="item_container">
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

                        // Query to select all data including photo from the product table
                        
                        $sql = "SELECT id, category, photo, description, contact_address, user_id, created_at FROM product WHERE category = 'other' && is_validate = 1";
                        $result = $conn->query($sql);

                        ?>
                        
                        <?php
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                $photo_data = base64_encode($row["photo"]);
                                $itemId = $row["id"];
                                $description = $row["description"];
                                $words = str_word_count($description, 1);
                                $first_20_words = implode(' ', array_slice($words, 0, 5));
                                echo "<div class=\"item\">";
                               
                                echo "<button onclick=\"detailProduct($itemId)\" class='image-button'>
                                    <img src='data:image/jpeg;base64," . $photo_data . "' alt='Product Photo'>
                                </button>";
                                echo "<div class=\"description\">";
                                echo "<p>" . $first_20_words . "</p>";
                                echo "<p>" . $row["contact_address"] . "</p>";
                                echo "<p>User ID: " . $row["user_id"] . "</p>";
                                echo "<p>" . $row["created_at"] . "</p>";
                                echo "
                                    <div class=\"counter-container\">
                                        <div class=\"items-number\">
                                            <button class=\"decrement-btn\" data-id=\"$itemId\">-</button>
                                            <span id=\"counter-$itemId-catagory\">0</span>
                                            <button class=\"increment-btn\" data-id=\"$itemId\">+</button>
                                        </div>
                                        <div>
                                            <button class=\"add-to-cart-btn\" data-id=\"$itemId\" data-user-id=\"" . $row["user_id"] . "\" data-price=\"" . $row["price"] . "\" data-quantity=\"counter-$itemId\">Add to Cart</button>
                                            </div>
                                    </div>
                                    ";
                                echo "</div>";
                                
                                echo "</div>";
                            
                        }
                        } else {
                            echo "0 results";
                        }
                        $conn->close();
                        ?>
                        </div>
                    </div>
                </section>
            </section>
            <!-- ============================================================detail bage============================================== -->
            <section id = "dtail_page">
                <div class="image-container">
                    <img src="logo.png" alt="Description of image" class="full-width-image" id="image">
                    <div class="hover-arrows">
                        <span class="left-arrow" id="left-arrow">&lt;</span>
                        <span class="right-arrow" id="right-arrow">&gt;</span>
                    </div>
                    <div class="note">
                        <div class="inside">
                            <p><strong>Description:</strong> 123</p>
                            <p><strong>Phone:</strong> nod ofdshoa</p>
                            <p><strong>Price:</strong> Description of the image</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ============================================================================post product ============================================== -->
            <section id = "post_product" >
                <div class = "container">
                <div>
                    <h1>Product Input</h1>
                </div>

                </div>
                <div class="container">
                    
                    
                    <div class="image-upload-container">
                        
                        <div class="image-upload">
                            <input type="file" id="imageInput1" accept="image/*" required />
                            <label for="imageInput1">
                                <img src="app_post/add-icon.png" alt="Add Icon" class="add-icon" />
                                <img id="imagePreview1" class="image-preview" />
                            </label>
                        </div>
                        <div class="image-upload">
                            <input type="file" id="imageInput2" accept="image/*" required />
                            <label for="imageInput2">
                                <img src="app_post/add-icon.png" alt="Add Icon" class="add-icon" />
                                <img id="imagePreview2" class="image-preview" />
                            </label>
                        </div>
                        <div class="image-upload">
                            <input type="file" id="imageInput3" accept="image/*" />
                            <label for="imageInput3">
                                <img src="app_post/add-icon.png" alt="Add Icon" class="add-icon" />
                                <img id="imagePreview3" class="image-preview" />
                            </label>
                        </div>
                        <div class="image-upload">
                            <input type="file" id="imageInput4" accept="image/*" />
                            <label for="imageInput4">
                                <img src="app_post/add-icon.png" alt="Add Icon" class="add-icon" />
                                <img id="imagePreview4" class="image-preview" />
                            </label>
                        </div>
                        <div class="image-upload">
                            <input type="file" id="imageInput5" accept="image/*" />
                            <label for="imageInput5">
                                <img src="app_post/add-icon.png" alt="Add Icon" class="add-icon" />
                                <img id="imagePreview5" class="image-preview" />
                            </label>
                        </div>
                        
                    </div>
                </div>
                <div class="container">
                
                    <div>
                        
                        <textarea id="descriptionInput" class="descriptionInput-field" placeholder="Enter Description" rows="4" required></textarea>
                    </div>
                    
                    <div class = "select">
                        <div><h4>Select Catagory</h4></div>
                        <select id = "selected_catagory">
                            <option value="other">Other</option>
                            <option value="clothes">Clothes</option>
                            <option value="phones">Phones</option>
                            <option value="furniture">Furniture</option>
                            <option value="Laptop">Laptop</option>

                        </select>
                    </div>
                    <div class="input-container">
                        <input type="number" id="priceInput" class="input-field" placeholder="Enter Price" required />
                        
                    </div>
                </div >
                
                <div class = "kyc-data">
                    <div class = "kyc_personal">
                        <div class="submit-container">
                            <button type="submit" id = "submitButton" class="submit-button">Submit</button>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ============================================================================================================================ -->

            <section id = "verifid_user">   
            
                <div class = "container">
                    <div>
                        <h1>KYC Input</h1>
                    </div>

                </div>
                <div class = "container">
                    <div>
                        <h1>To Post Product You Must Verify Your Account First</h1>
                    </div>

                </div>
                <div class = "kyc-data">
                    <div class = "container">
                        <div>
                            <h1>KYC Input</h1>
                        </div>

                    </div>
                    <div class = "kyc_personal">
                        
                        <div class="image-upload">
                            <input type="file" id="imageInput" accept="image/*" />
                            <label for="imageInput">
                                <img src="app_post/add-icon.png" alt="Add Icon" class="add-icon" />
                                <img id="imagePreview" class="image-preview" />
                            </label>
                        </div>
                        <div>
                        
                            <!-- <input type="tel" id="priceInput" class="input-field" placeholder="Enter Price" required /> -->
                            <input type="tel" id="phoneInput" class="input-field" placeholder="Enter Phone Number" required />
                        </div>
                        <div class="submit-container">
                            <button type="submit" id = "submitButton_verified" class="submit-button">Submit</button>
                        </div>
                    </div>
                </div>

            
               
            

            </section>
            <!-- =========================================user notify about the verification============================ -->
            <section id = "notify">
                <div class="overlay">
                    <div class="message-box">
                        <h1>Verification Pending</h1>
                        <p>We are verifying your information. Please wait, we will notify you once the process is complete.</p>
                    </div>
                </div>
            </section>
            <!-- =================================================================================cart section ============================================== -->
            <section id = "cart_page_display">
                <div class = "cart_title_main">
                    <div class = "my_cart">
                        <h1>My Cart</h1>
                    </div>
                </div>
                <div class = "cart_container">
                    <div class = "list_product">
                       <div class='product_display'>";
                            <div calss = "image_cart">
                                <h5>Product</h5>
                            </div>
                            <div class = "detail_item">
                                <h5>Price</h5>
                            </div>
                            <div class = "detail_item">
                                <h5>Quantity</h5>
                            </div>
                            <div class = "detail_item">
                                <h5>Total Pice</h5>
                            </div class = "detail_item">
                            <div class = "detail_item">
                                <h5>Delete</h5>
                            </div class = "detail_item">
                        </div>
                        <?php
                        require ("app_post/db_connection.php");
                        require ("cart_counter.php");
                        session_start();
                        $user_id = $_SESSION["user_id"];
                        $sql = "SELECT cart.id as cart_id, cart.quantity,cart.user_id, cart.total_price, product.photo, product.price
                                FROM cart
                                JOIN product ON cart.product_id = product.id where cart.user_id = $user_id";
    
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                // Process each row of data
                                $photo_data = base64_encode($row["photo"]);
                                $productPrice = $row["price"];
                            
                                $quantity = $row["quantity"];
                                $totalPrice = $quantity * $productPrice;
                                $cartId = $row["cart_id"];
                                $counter_cart += $quantity;
                                $total_price += $totalPrice;
                                echo "    <div class='product_display'>";
                                echo "        <div class='image_cart'>";
                                echo "            <img src='data:image/jpeg;base64," . $photo_data . "' alt='Product Photo'>";
                                echo "        </div>";
                                echo "        <div class='detail_item'>";
                                echo "            " . $productPrice . " ETB";
                                echo "        </div>";
                                echo "        <div class='detail_item'>";
                                echo "            " . $quantity;
                                echo "        </div>";
                                echo "        <div class='detail_item'>";
                                echo "            " . $totalPrice . " ETB";
                                echo "        </div>";
                                echo "        <div class='delate_cart'>";
                                echo "            <button class='delete-button' data-cart-id='" . $cartId . "' onclick=\"delete_cart(" . $cartId. ")\">Delete</button>";
                                echo "        </div>";
                                echo "    </div>";
                            }
                        } else {
                            echo "No items in the cart.";
                        }
                        
                        // Close database connection
                        $conn->close();
                        ?>

                        
                    </div>
                    <div calss = "summary">
                        <div class = "cart_summary">
                            <div class = "summary_title">
                                <h2>Total Product</h2>
                            </div>
                            <?php
                            echo "
                            <div class = \"summary_detail\">
                                <h2>$counter_cart</h2>
                            </div>"
                            ?>
                        </div>
                        <div class = "cart_summary">
                            <div class = "summary_title">
                                <h2>Price</h2>
                            </div>
                            <?php
                            echo "
                            <div class = \"summary_detail\" >
                                <h2>$total_price ETB</h2>
                            </div>";
                            ?>
                        </div>
                        <div class = "cart_summary">
                            <div class = "summary_title">
                                <h2>Discount</h2>
                            </div>
                            <?php
                            $discount *= $total_price;
                            echo "
                            <div class = \"summary_detail\" >
                                <h2>$discount ETB</h2>
                            </div>";
                            ?>
                        </div>
                        <div class = "cart_summary">
                            <div class = "summary_title">
                                <h2>Total Price</h2>
                            </div>
                            <?php
                            $after_discount = $total_price - $discount;
                            echo "
                            <div class = \"summary_detail\" >
                                <h2>$after_discount ETB</h2>
                            </div>";
                            ?>
                        </div>
                        <div class = "cart_summary" id = "buy_cart_button">
            
                            <div  class = "summary_detail">
                                <button class="buy-button"  onclick="PayByChap('.$after_discount.', '.$user_id.')">Buy</button>
                            </div>
                        
                </div>
            </section>
            <!-- ====================================================profile =============================================== -->
            <section id = "profile_page">
                <?php
                session_start();
                $fullname = $_SESSION['fullname'];
                $user_name = $_SESSION['username'];
                $email = $_SESSION['email'];
                $isAdmin = $_SESSION['isAdmin'];
                $isVerify = $_SESSION['is_verify'];
                $profile_pic = $_SESSION['profile_picture'];
                $is_admin = "Customer";
                if ($isAdmin == 1){
                    $is_admin = "Admin";
                }
                $is_verify = "Not Verified";
                if ($isVerify == 1){
                    $is_verify = "Verified";
                }
                
                
                echo '
                <div class="profile_cotainer">
                    <div class="profile-card">
                        <div class="head_profile">
                            <img src="' . $profile_pic . '" alt="Profile Picture" class="profile-picture">
                            <h1 class="name">' . $fullname . '</h1>
                        </div>
                        <div class="profile-body">
                            <div class="social-links">
                                <a href="#" class="social-link">' . $is_verify . '</a>
                                <a href="#" class="social-link">' . $is_admin . '</a>
                                <a href="logout.php" class="social-link" onclick = "logout()" >Logout</a>
                            </div>
                        </div>
                    </div>
                </div>';
                ?>
            </section>
        </main>

        <!-- Modal container -->
        <div id="item-modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <div class="modal-body"></div>
            </div>
        </div>
        
        <script src="script.js"></script>
        <script src="app_post/image-input.js"></script>
        <script src = "php_header/home.js"></script>
        <script src="app_post/save_post.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src ="add_cart.js"></script>
        <script src ="cart_page/delete_cart.js"></script>
        <script src ="payment/pay.js"></script>
        <script src ="detailPage/script.js"></script>
        <script src ="profile.js"></script>

        
    </body>
</html>
