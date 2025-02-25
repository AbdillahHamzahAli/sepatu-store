function setRating(rating) {
    document.getElementById("ratingValue").textContent = rating;
    document.getElementById("ratingValue").value = rating;
}
function showRatingModal() {
    document.getElementById("ratingModal").classList.remove("hidden");
    document.getElementById("ratingModal").classList.add("flex");
}

function closeRatingModal() {
    document.getElementById("ratingModal").classList.add("hidden");
    document.getElementById("ratingModal").classList.remove("flex");
}

function submitRating() {
    // Handle rating submission here
    closeRatingModal();
}

// Star rating functionality
const stars = document.querySelectorAll(".star");
stars.forEach((star, index) => {
    star.addEventListener("click", () => {
        stars.forEach((s, i) => {
            if (i <= index) {
                s.classList.add("text-yellow-400");
                s.classList.remove("text-gray-300");
            } else {
                s.classList.remove("text-yellow-400");
                s.classList.add("text-gray-300");
            }
        });
    });
});
