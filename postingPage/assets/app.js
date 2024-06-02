var num = 1;
const addInputDescription = document.getElementsByClassName("simple-decription" + {num});

var display = 0;

function hideAndShow() {
    if (display == 0) {
        addInputDescription.style.display = 'block';
        display = 1;
    }
    else {
        display = 0;
    }
        
}