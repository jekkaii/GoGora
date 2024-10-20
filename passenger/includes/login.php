<?php
require('db.php');  // Include database connection
session_start();    // Start the session to manage user login state

// Retrieve the username and password from the form submission
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Prepare an SQL statement to select user data where the username matches
$loginSQL = "SELECT user_id, password, username, role, user_type FROM users WHERE username = ?";

$loginstmt = $conn->prepare($loginSQL);  // Prepare the SQL statement
$loginstmt->bind_param("s", $username);  // Bind the username to the prepared statement
$loginstmt->execute();  // Execute the statement

$result = $loginstmt->get_result();  // Get the result of the query

// Check if the user exists in the database
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();  // Fetch the row of data for the user

    // Verify the input password matches the stored password (no hashing in your case)
    if ($password === $row['password']) {
        // Successful login, return success as JSON
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['user_type'] = $row['user_type'];
    
        echo json_encode(['success' => true, 'message' => 'Login successful!']);
    } else {
        // Invalid password, return failure as JSON
        echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
    }
} else {
    // User not found, return failure as JSON
    echo json_encode(['success' => false, 'message' => 'User not found']);
}

$loginstmt->close();  // Close the prepared statement
$conn->close();  // Close the database connection
?>
