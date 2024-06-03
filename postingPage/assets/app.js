var phone = document.getElementById("phone")
var laptop = document.getElementById("laptop")
var furniture = document.getElementById("furniture")
var clothing = document.getElementById("clothing")
var wearables = document.getElementById("wearables")


function phoneClicked() {
    alert("Phone category clicked, If your picture and description do not seems like a phone, post will be dismissed!");
}


var num = 4;
var addInputDescription = document.getElementById("simple-description" + num);

function hideAndShow() {
    if (num >=3 && num <=6) {
        addInputDescription.style.display = 'block';
        num++;
        console.log(num)
        
    }
       
}
