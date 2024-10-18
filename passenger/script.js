// Switch between forms (register and login)
document.getElementById('show-login-form').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('register-form').style.display = 'none';
    document.getElementById('login-form').style.display = 'block';
});

document.getElementById('show-register-form').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('login-form').style.display = 'none';
    document.getElementById('register-form').style.display = 'block';
});

// Handle registration form submission
document.getElementById('registration-form').addEventListener('submit', function(event) {
    event.preventDefault();
    // Simulate registration process (you can handle form validation and submit data here)

    // After registration, show the photo upload form
    document.getElementById('register-form').style.display = 'none';
    document.getElementById('upload-photo-form').style.display = 'block';
});

// Handle login form submission
document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();
    // Simulate login process (you can handle form validation here)

    // After successful login, redirect to the photo upload form
    document.getElementById('login-form').style.display = 'none';
    document.getElementById('upload-photo-form').style.display = 'block';
});

// Handle photo upload form submission
document.getElementById('photo-upload-form').addEventListener('submit', function(event) {
    event.preventDefault();
    // You can add photo verification logic here before redirecting

    // Redirect to the verification page
    window.location.href = "verification.html";
});

// Verification page function to redirect to dashboard
function redirectToHome() {
    window.location.href = "dashboard.html"; // Redirect to dashboard or home page
}