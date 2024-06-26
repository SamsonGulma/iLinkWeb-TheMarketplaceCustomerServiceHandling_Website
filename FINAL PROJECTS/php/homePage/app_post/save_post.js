var image1 = document.getElementById('imageInput1');
var image2 = document.getElementById('imageInput2');
var image3 = document.getElementById('imageInput3');
var image4 = document.getElementById('imageInput4');
var image5 = document.getElementById('imageInput5');
var image_kyc = document.getElementById('imageInput');
var disc = document.getElementById('descriptionInput');
var phone = document.getElementById('phoneInput');
var price = document.getElementById('priceInput');
var catagory = document.getElementById("selected_catagory");
var verifed = 
document.getElementById('submitButton').addEventListener('click', function() {
    // Validate form fields
    event.preventDefault;
    
    if (validateForm()) {
        console.log("sameul");
        var formData = new FormData();
        formData.append('image1', image1.files[0]);
        formData.append('image2', image2.files[0]);
        formData.append('image3', image3.files[0]);
        formData.append('image4', image4.files[0]);
        formData.append('image5', image5.files[0]);
        formData.append('description', disc.value);
        formData.append('price', price.value);
        formData.append('catagory',catagory.value);
        
        $.ajax({
            url: '/homePage/app_post/save.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            
            
            success: function(response) {
                
                try {
                    // Parse the JSON response
                    var data = JSON.parse(response);
                    
                    // Display an alert based on the response status
                    if (data.status === 'success') {
                        alert(data.message);
                        window.location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                } catch (e) {
                    
                    alert('An unexpected error occurred.');
                }
                
            },
            error: function(xhr, status, error) {
                alert('An error occurred while processing your request.');
            }
        });

    }
});

// Function to validate form fields
function validateForm() {
    

    // Check if any required fields are empty
    if (document.getElementById('imageInput1').files.length === 0) {
        alert('Please select an image for Image 1.');
        return false
    }
    if (document.getElementById('imageInput2').files.length === 0) {
        alert('Please select an image for Image 2.');
        return false
    }
    if (document.getElementById('descriptionInput').value.trim() === ""){
        alert('Please enter a description.');
        return false;
    }
    if (document.getElementById('priceInput').value.trim() === ""){
        alert('Please enter a price.');
        return false
    }
    
    // Repeat similar checks for other required fields

    return true;
}


document.getElementById('submitButton_verified').addEventListener('click', function() {
    // Validate form fields
    event.preventDefault;
    
    if (validateFormKyc()) {
        
        var formData = new FormData();
        formData.append('kycImage', image_kyc.files[0]);
        formData.append('phone', phone.value);
        
        
        $.ajax({
            url: '/homePage/app_post/verifed.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            
            success: function(response) {
                try {
                    const jsonResponse = JSON.parse(response);
                    alert(jsonResponse.message);
                    if (jsonResponse.success) {
                        window.location.reload();
                    }
                } catch (e) {
                    
                    alert('An error occurred while processing your request.');
                }
                
            },
            error: function(xhr, status, error) {
                try {
                    const jsonResponse = JSON.parse(xhr.responseText);
                    alert(jsonResponse.message);
                } catch (e) {
                   
                    alert('An error occurred while processing your request.');
                }
                
            }
        });

    }
});

// Function to validate form fields
function validateFormKyc() {
    

    // Check if any required fields are empty
    if (document.getElementById('imageInput').files.length === 0) {
        alert('Please select an image for KYC.');
        return false
    }
    if (document.getElementById('phoneInput').value.trim() === ""){
        alert('Please enter a phone number.');
        return false
    }
    // Repeat similar checks for other required fields

    return true;
}
