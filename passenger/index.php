<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoGora</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <div class="container">
      <div class="left-section">
        <div class="promo-content">
          <img src="your-logo.png" alt="GoGora Logo" class="promo-logo">
          <h1 class="promo-title">GoGora</h1>
          <p class="promo-subtitle">Your journey, our pride!</p>
        </div>
      </div>
      <div class="right-section">
        <!-- Registration Form -->
        <form id="registration-form" action="includes/register.php" method="POST">
        <div class="form-container" id="register-form">
          <h2>Get Started Today</h2>
          <form id="registration-form">
            <div class="input-group name-group">
              <div class="first-name">
                <label for="first-name">First Name</label>
                <input type="text" id="first-name" placeholder="Enter your first name" required>
              </div>
              <div class="last-name">
                <label for="last-name">Last Name</label>
                <input type="text" id="last-name" placeholder="Enter your last name" required>
              </div>
            </div>
            <div class="input-group">
              <label for="email">Email address</label>
              <input type="email" id="email" placeholder="Enter your email" required>
            </div>
            <div class="input-group">
              <label for="username">Username</label>
              <input type="text" id="username" placeholder="Choose a username" required>
            </div>
            <div class="input-group">
              <label for="password">Password</label>
              <input type="password" id="password" placeholder="Enter a password" required>
            </div>
            <div class="input-group">
              <label for="user-type">Select user type</label>
              <select id="user-type" required>
                <option value="student">Student</option>
                <option value="teacher">Faculty</option>
                <option value="employee">Employee</option>
              </select>
            </div>
        <div class="input-group">
          <label for="user-type">User Type</label>
          <select id="user-type" name="userType" required>
            <option value="Regular">Regular</option>
            <option value="Priority">Priority</option>
          </select>
        </div>
            <button type="submit" class="register-btn">Register</button>
          </form>
          <p class="login-text">Already a member? <a href="#" id="show-login-form">Log in</a>
          </p>
        </div>
        <!-- Login Form -->
        <div class="login-container" id="login-form" style="display: none;">
        <form id="login-form-element" method="POST">
          <h2>Welcome Back</h2>
          <form id="login-form">
            <div class="input-group">
              <label for="login-email">Username</label>
              <input type="email" id="login-email" placeholder="Enter your username" required>
            </div>
            <div class="input-group">
              <label for="login-password">Password</label>
              <input type="password" id="login-password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="register-btn" id="login-btn">Log In</button>
          </form>
          <p class="login-text">Don't have an account? <a href="#" id="show-register-form">Sign Up</a>
          </p>
        </div>
        <!-- Photo Upload Form -->
        <div class="form-container" id="upload-photo-form" style="display: none;">
          <h2>Upload Your Photo</h2>
          <form id="photo-upload-form" action="verification.html" method="POST" enctype="multipart/form-data">
            <div class="input-group">
              <label for="photo">Choose Photo</label>
              <input type="file" name="photo" id="photo" accept="image/*" required>
            </div>
            <button type="submit" class="register-btn">Submit Photo</button>
          </form>
        </div>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>
