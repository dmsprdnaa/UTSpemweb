document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("login-form");
    const usernameInput = document.getElementById("username");
    const passwordInput = document.getElementById("password");

    form.addEventListener("submit", function(event) {
        const username = usernameInput.value.trim();
        const password = passwordInput.value.trim();

        // Basic validation
        if (username === "" || password === "") {
            event.preventDefault(); // Prevent form submission if fields are empty
            alert("Please enter both username and password.");
        }
    });

    // Optional: Additional JS to add interactivity or animations
});
