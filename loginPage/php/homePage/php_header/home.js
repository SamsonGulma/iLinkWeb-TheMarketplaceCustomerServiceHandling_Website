document.addEventListener("DOMContentLoaded", function() {
    // Button references
    const postButton = document.getElementById('add_product_page');
    const homeButton = document.getElementById('home_page');
    const profileButton = document.getElementById('profile_page');
    const cartButton = document.getElementById('cart_page');

    // Page references
    const homePage = document.getElementById('homepage_loder');
    const cartPage = document.getElementById('cart_page_display');
    const postPage = document.getElementById('post_product');
    const verifepage = document.getElementById('verifid_user');

    // Initial page setup


    // Event listener for postButton (add_product_page)
    postButton.addEventListener("click", function(event) {
        event.preventDefault();
        postButton.style.cssText = "background-color: #ddd; color: black; border-radius: 15px;";
        homeButton.style.cssText = "background: none; color: white;";
        profileButton.style.cssText = "background: none; color: white;";
        cartButton.style.cssText = "background: none; color: white;";

        // Call valid.php using fetch
        fetch('/homePage/php_header/valid_user.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Received data:', data);

                // Example: Update UI based on data
               
                if (data.is_valid) {
                    // Display post page if user is valid
                    postPage.style.display = 'block';
                    homePage.style.display = 'none';
                    cartPage.style.display = 'none';
                    verifepage.style.display = 'none';
                } else {
                    // Redirect or handle invalid user
                    homePage.style.display = 'none';
                    cartPage.style.display = 'none';
                    postPage.style.display = 'none';
                    verifepage.style.display = 'block';
                }
            })
            .catch(error => {
                alert("user_notlogin")
                console.error('Error fetching data:', error);
                // alert('Error fetching data from server.');
            });
    });

    // Event listener for cartButton (cart_page)
    cartButton.addEventListener("click", function(event) {
        event.preventDefault();
        cartButton.style.cssText = "background-color: #ddd; color: black; border-radius: 15px;";
        homeButton.style.cssText = "background: none; color: white;";
        profileButton.style.cssText = "background: none; color: white;";
        postButton.style.cssText = "background: none; color: white;";

        // Redirect to logout page
        homePage.style.display = 'none';
        cartPage.style.display = 'block';
        postPage.style.display = 'none';
        verifepage.style.display = 'none';// Example: Redirect to logout page
    });

    // Event listener for homeButton (home_page)
    homeButton.addEventListener("click", function(event) {
        event.preventDefault();
        homeButton.style.cssText = "background-color: #ddd; color: black; border-radius: 15px;";
        postButton.style.cssText = "background: none; color: white;";
        profileButton.style.cssText = "background: none; color: white;";
        cartButton.style.cssText = "background: none; color: white;";

        // Display home page
        homePage.style.display = 'block';
        cartPage.style.display = 'none';
        postPage.style.display = 'none';
        verifepage.style.display = 'none';
    });

    // Similarly, add event listeners for profileButton and other buttons if needed
});
