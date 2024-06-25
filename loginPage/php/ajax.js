document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("registerForms").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the default form submission

        const fullname = document.getElementById("fullname").value;
        const username = document.getElementById("username_register").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password_register").value;
        console.log(1234);
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "register.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    alert(response.message);
                    if (response.status !== "error"){
                    window.location.reload();
                    }
                } else {
                    alert('Error: ' + xhr.status);
                }
            }
        };

        const data = JSON.stringify({
            fullname: fullname,
            username_register: username,
            email: email,
            password_register: password
        });

        xhr.send(data);
    });
});



document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("login_pages").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the default form submission

        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "login.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    
                    if (response.status === "error") {
                        alert(response.message);
                    } else if (response.status === "success") {
                        
                        window.location.href = response.redirect;
                    }
                } else {
                    alert('Error: ' + xhr.status);
                }
            }
        };

        const data = JSON.stringify({
            username: username,
            password: password
        });

        xhr.send(data);
    });
});