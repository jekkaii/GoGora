<?php
session_start(); // Start session to access logged-in user data
require_once('../../control/includes/db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect ride_id and user_id from session
    $ride_id = $_POST['ride_id'] ?? NULL;
    $user_id = $_SESSION['user_id'] ?? NULL; // User ID from session

    if (!$ride_id || !$user_id) {
        echo "Invalid ride selection or user not logged in.";
        exit();
    }

    // Set default values
    $reservation_time = date('Y-m-d H:i:s');
    $status = 'Active';
    $payment_status = NULL;
    $total_fare = NULL;
    $payment_method = NULL;

    // Insert reservation into database
    $query = "
        INSERT INTO reservations (user_id, ride_id, reservation_time, status, payment_status, total_fare, payment_method)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Database error: " . $conn->error);
    }

    $stmt->bind_param("iisssis", $user_id, $ride_id, $reservation_time, $status, $payment_status, $total_fare, $payment_method);

    if ($stmt->execute()) {
        header("Location: confirmation_success.php");
        exit();
    } else {
        echo "Error: Could not store reservation. " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
    exit();
}
?>
