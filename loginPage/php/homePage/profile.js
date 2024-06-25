// logout.js

function logout() {
    // Send an AJAX request to logout.php to delete sessions
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "logout.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Redirect to another page after logout
            window.location.href = "logout.php";
        }
    };
    xhr.send();
}
