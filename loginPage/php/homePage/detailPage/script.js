let currentImageIndex = 0;
let productImages = [];

// Function to fetch and display product details
function detailProduct(id) {
  
    // Send the product ID to the PHP file using fetch API
    fetch('detailPage/read.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: id })
    })
    .then(response => {
        if (!response.ok) {
            
            throw new Error('Network response was not ok');
        }
        if (response.status == "error"){
            console.log(response.user_id);
            console.log(1234);
            alert("error");
        }
        return response.json();
    })
    .then(data => {
        if (data.status === 'success') {
            // Show the detail page and hide other pages
            document.getElementById('dtail_page').style.display = 'block';
            document.getElementById('homepage_loder').style.display = 'none';
            document.getElementById('cart_page_display').style.display = 'none';
            document.getElementById('post_product').style.display = 'none';
            document.getElementById('verifid_user').style.display = 'none';
            document.getElementById('notify').style.display = 'none';

           
            productImages = data.images;
            const detail = data.description;
            const price = data.price;
            const phone = data.phone
            console.log(productImages.length);

            // Display product details and the first image
            document.getElementById('dtail_page').innerHTML = `
                <div class="image-container">
                    <button id = "back_to_home" onclick = "back_to_home()"><img src="data:image/jpeg;base64,${productImages[0]}" alt="Product Image" class="full-width-image" id="image"></button>
                    <div class="hover-arrows">
                        <button  onclick = "showPreviousImage()" class="left-arrow" id="left-arrow"><div class = "left_button">&lt;</div></button>
                        <button onclick = "showNextImage()" class="right-arrow" id="right-arrow"><div class = "left_button">&gt;</div></button>
                    </div>
                    <div class="note">
                        <div class="inside">
                            <p><strong>Price:</strong> ${detail}</p>
                            <p><strong>Phone:</strong> ${phone}</p>
                            <p><strong>Description:</strong> ${price}</p>
                        </div>
                    </div>
                </div>
            `;

            // Store product images for navigation
            // productImages = data.images.map(image => `data:image/jpeg;base64,${image}`);

            // Add event listeners for image navigation arrows
            document.getElementById('left-arrow').addEventListener('click', showPreviousImage);
            document.getElementById('right-arrow').addEventListener('click', showNextImage);
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error fetching product details');
    });
}

// Function to show previous image
function showPreviousImage() {
    if (currentImageIndex > 0) {
        currentImageIndex--;
    } else {
        currentImageIndex = productImages.length - 1;
    }

    // Set the src attribute with the correct base64 prefix
    document.getElementById('image').src = 'data:image/jpeg;base64,' + productImages[currentImageIndex];
}

// Function to show next image
function showNextImage() {
    if (currentImageIndex < productImages.length - 1) {
        currentImageIndex++;
    } else {
        currentImageIndex = 0;
    }
    document.getElementById('image').src = 'data:image/jpeg;base64,' + productImages[currentImageIndex];
}

// Example usage (replace with actual event triggering this function)
// Fetch and display product details for product with ID 1

function back_to_home(){
    document.getElementById('dtail_page').style.display = 'none';
    document.getElementById('homepage_loder').style.display = 'block';
    document.getElementById('cart_page_display').style.display = 'none';
    document.getElementById('post_product').style.display = 'none';
    document.getElementById('verifid_user').style.display = 'none';
    document.getElementById('notify').style.display = 'none';

}