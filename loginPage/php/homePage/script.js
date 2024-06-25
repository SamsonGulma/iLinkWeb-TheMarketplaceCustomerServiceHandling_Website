function performSearch() {
    const query = document.getElementById("search-input").value.trim();
    if (query) {
        alert(`Searching for: ${query}`);
        // Implement the actual search functionality here
    } else {
        alert("Please enter a search term.");
    }
}

function showContent(contentId) {
    const contents = document.querySelectorAll("main .content");
    contents.forEach((content) => {
        // Hide currently visible content with a transition
        if (content.classList.contains("active")) {
            content.classList.remove("active");
            setTimeout(() => {
                content.style.display = "none";
            }, 250); // Delay to match the transition duration
        }
    });

    const activeContent = document.getElementById(contentId);
    if (activeContent) {
        // Show the new content with a delay to allow the transition to complete
        setTimeout(() => {
            activeContent.style.display = "block";
            activeContent.classList.add("active");
        }, 250);
    }

    const homeLinks = document.querySelectorAll(".home-links a");
    homeLinks.forEach((link) => {
        link.classList.remove("active");
    });

    const clickedLink = document.querySelector(
        `a[onclick="showContent('${contentId}')"]`
    );
    if (clickedLink) {
        clickedLink.classList.add("active");
    }

    // Ensure the home links and search bar remain visible
    // document.querySelector("home-links").style("hidden");
    // document.querySelector("search-container").remove("hidden");
}

function showItemDetails(item) {
    const modal = document.getElementById("item-modal");
    const modalBody = modal.querySelector(".modal-body");

    // Clone the clicked item and append to the modal body
    const itemClone = item.cloneNode(true);
    modalBody.innerHTML = "";
    modalBody.appendChild(itemClone);

    // Display the modal
    modal.style.display = "block";
}

function closeModal() {
    const modal = document.getElementById("item-modal");
    modal.style.display = "none";
}



// ================count cart page
document.addEventListener('DOMContentLoaded', (event) => {
    // Get all increment and decrement buttons
    const incrementButtons = document.querySelectorAll(".increment-btn");
    const decrementButtons = document.querySelectorAll(".decrement-btn");

    incrementButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            const itemId = button.getAttribute('data-id'); // Extract the unique ID
            const counterElement = document.getElementById(`counter-${itemId}`);
            let total = parseInt(counterElement.textContent);
            if (total != 10) {
                total += 1;
                counterElement.textContent = total;
            }
        });
    });

    decrementButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            const itemId = button.getAttribute('data-id'); // Extract the unique ID
            const counterElement = document.getElementById(`counter-${itemId}`);
            let total = parseInt(counterElement.textContent);
            if (total > 0) {
                total -= 1;
                counterElement.textContent = total;
            }
        });
    });
});

// ===================================================
document.addEventListener('DOMContentLoaded', (event) => {
    // Get all increment and decrement buttons
    const incrementButtons = document.querySelectorAll(".increment-btn");
    const decrementButtons = document.querySelectorAll(".decrement-btn");

    incrementButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            const itemId = button.getAttribute('data-id'); // Extract the unique ID
            const counterElement = document.getElementById(`counter-${itemId}-catagory`);
            let total = parseInt(counterElement.textContent);
            if (total != 10) {
                total += 1;
                counterElement.textContent = total;
            }
        });
    });

    decrementButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            const itemId = button.getAttribute('data-id'); // Extract the unique ID
            const counterElement = document.getElementById(`counter-${itemId}-catagory`);
            let total = parseInt(counterElement.textContent);
            if (total > 0) {
                total -= 1;
                counterElement.textContent = total;
            }
        });
    });
});




