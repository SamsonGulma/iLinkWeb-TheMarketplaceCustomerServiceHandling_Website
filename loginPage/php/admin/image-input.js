// document.getElementById('imageInput').addEventListener('change', function(event) {
//     const imagePreview = document.getElementById('imagePreview');
//     const file = event.target.files[0];
//     const reader = new FileReader();

//     reader.onload = function(e) {
//         imagePreview.src = e.target.result;
//         imagePreview.style.display = 'block';
//         document.querySelector('.add-icon').style.display = 'none'; // Hide the add icon
//     };

//     if (file) {
//         reader.readAsDataURL(file);
//     }
// });
// function handleImageUpload(event, previewId, iconClass) {
//     const imagePreview = document.getElementById(previewId);
//     const file = event.target.files[0];
//     const reader = new FileReader();

//     reader.onload = function(e) {
//         imagePreview.src = e.target.result;
//         imagePreview.style.display = 'block';
//         document.querySelector(iconClass).style.display = 'none'; // Hide the add icon
//     };

//     if (file) {
//         reader.readAsDataURL(file);
//     }
// }

// document.getElementById('imageInput1').addEventListener('change', function(event) {
//     handleImageUpload(event, 'imagePreview1', '.image-upload:nth-child(1) .add-icon');
// });

// document.getElementById('imageInput2').addEventListener('change', function(event) {
//     handleImageUpload(event, 'imagePreview2', '.image-upload:nth-child(2) .add-icon');
// });

// document.getElementById('imageInput3').addEventListener('change', function(event) {
//     handleImageUpload(event, 'imagePreview3', '.image-upload:nth-child(3) .add-icon');
// });

// document.getElementById('imageInput4').addEventListener('change', function(event) {
//     handleImageUpload(event, 'imagePreview4', '.image-upload:nth-child(4) .add-icon');
// });

// document.getElementById('imageInput5').addEventListener('change', function(event) {
//     handleImageUpload(event, 'imagePreview5', '.image-upload:nth-child(5) .add-icon');
// });
