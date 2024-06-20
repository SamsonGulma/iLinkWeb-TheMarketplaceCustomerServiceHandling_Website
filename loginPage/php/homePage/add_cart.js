document.querySelectorAll('.add-to-cart-btn').forEach(function(button) {
    button.addEventListener('click', function(event) {
        // Prevent default action (e.g., form submission)
        event.preventDefault();

        // Retrieve data attributes from the clicked button
        var itemId = button.getAttribute('data-id');
        var price = button.getAttribute('data-price');
        var qu = button.getAttribute('data-quantity');
        const counterElement = document.getElementById(qu);
        var quantity = parseInt(counterElement.textContent);
        if (price === ''){
            price = 0.00;
        }
        console.log(quantity,itemId,price);
        // Prepare form data
        var formData = new FormData();
        formData.append('itemId', itemId);
        formData.append('price', price);
        formData.append('quantity', quantity);
        
        // Create an XMLHttpRequest object
        var xhr = new XMLHttpRequest();
        // Configure the request
        xhr.open('POST', 'add_cart.php', true);

        // Set up a handler for when the request finishes
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Request was successful
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert(response.message); // Alert success message
                } 
            } else {
                // Request failed
                console.error('Request failed. Status: ' + xhr.status);
                alert('Request failed. Please try again.');
            }
        };

        // Send the request with the form data
        xhr.send(formData);
    });
});
