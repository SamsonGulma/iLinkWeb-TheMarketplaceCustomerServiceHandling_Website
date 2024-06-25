const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});


function submitLoginForm(event) {
    event.preventDefault(); // Prevent the default form submission

    const form = document.getElementById('loginForm');
    const formData = new FormData(form);

    fetch('/php/login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.includes('Invalid username or password') || data.includes('User not found')) {
            // Display the error message
            document.getElementById('errorMessage').innerText = data;
        } else {
            // Redirect to the homepage if login is successful
            window.location.href = '/php/homePage/index.php';
        }
    })
    .catch(error => console.error('Error:', error));
}


