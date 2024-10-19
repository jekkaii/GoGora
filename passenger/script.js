// Switch between forms (register and login)
document.getElementById('show-login-form').addEventListener('click', function (event) {
    event.preventDefault();
    document.getElementById('register-form').style.display = 'none';
    document.getElementById('login-form').style.display = 'block';
});

document.getElementById('show-register-form').addEventListener('click', function (event) {
    event.preventDefault();
    document.getElementById('login-form').style.display = 'none';
    document.getElementById('register-form').style.display = 'block';
});

// Handle registration form submission
document.getElementById('registration-form').addEventListener('submit', function (event) {
    event.preventDefault();

    // Create a FormData object to collect the form data
    const formData = new FormData(this);

    // Send form data to register.php via AJAX
    fetch('includes/register.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())  // Expect a JSON response from PHP
        .then(data => {
            // Use default confirm dialog for messages
            if (data.success) {
                if (confirm(data.message)) {
                    // If registration is successful, redirect to the login page or another desired location
                    window.location.href = 'index.php';
                }
            } else {
                // Show error message in a confirm dialog
                confirm(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            confirm('Registration failed. Please try again.');
        });
});



// Handle login form submission
document.getElementById('login-form').addEventListener('submit', function (event) {
    event.preventDefault();
    // Simulate login process (you can handle form validation here)
    // After successful login, redirect to the photo upload form
    document.getElementById('login-form').style.display = 'none';
    document.getElementById('upload-photo-form').style.display = 'block';
});

// Handle photo upload form submission
document.getElementById('photo-upload-form').addEventListener('submit', function (event) {
    event.preventDefault();
    // You can add photo verification logic here before redirecting
    // Redirect to the verification page
    window.location.href = "verification.html";
});

// Verification page function to redirect to dashboard
function redirectToHome() {
    window.location.href = "dashboard.html"; // Redirect to dashboard or home page
}
