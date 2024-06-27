document.addEventListener("DOMContentLoaded", function() {
    // Button references
    const prodcutButton = document.getElementById('cart_page');
    const homeButton = document.getElementById('home_page');
    
    // Page references
    const homePage = document.getElementById('homepage');
    const productpage = document.getElementById('productpage');
    

    // Initial page setup


    // Event listener for postButton (add_product_page)
    prodcutButton.addEventListener("click", function(event) {
        event.preventDefault();
        prodcutButton.style.cssText = "background-color: #ddd; color: black; border-radius: 15px;";
        homeButton.style.cssText = "background: none; color: white;";
        homePage.style.display = 'none';
        productpage.style.display = 'block';
        
    });

    homeButton.addEventListener("click", function(event) {
        event.preventDefault();
        homeButton.style.cssText = "background-color: #ddd; color: black; border-radius: 15px;";
        prodcutButton.style.cssText = "background: none; color: white;";
        

        // Display home page
        homePage.style.display = 'block';
        productpage.style.display = 'none';
        
    });

    // Similarly, add event listeners for profileButton and other buttons if needed
});
