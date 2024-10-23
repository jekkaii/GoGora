<?php
// Capture ride details from POST data
$route = $_POST['route'];
$time = $_POST['time'];
$seats_available = $_POST['seats_available'];
$ride_type = $_POST['ride_type'];
$plate_number = $_POST['plate_number'];
$total_fare = $_POST['total_fare'];
$capacity = $_POST['capacity'];
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'gogora_db';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    echo "Sorry, something went wrong. Please try again later.";
    exit();
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book-btn'])) {
    // Get the ride details from the form
    $ride_id = $_POST['ride_id'];
    $user_id = 1; // Assuming a user ID of 1; this should come from the session or user login
    $route = $_POST['route'];
    $time = $_POST['time'];
    $ride_type = $_POST['ride_type'];
    
    // Prepare and bind the statement
    $stmt = $conn->prepare("INSERT INTO reservations (user_id, ride_id, reservation_time, status, payment_status) VALUES (?, ?, ?, ?, ?)");
    $status = 'confirmed'; // or whatever logic you want for status
    $payment_status = 'pending'; // or whatever logic you want for payment status
    $reservation_time = date('Y-m-d H:i:s'); // Current time as reservation time

    $stmt->bind_param("iisss", $user_id, $ride_id, $reservation_time, $status, $payment_status);
    
    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Reservation successful!";
        // Optionally redirect to a confirmation page or back to booking
        header("Location: confirmation_success.php"); // Create this page for success message
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body id="confirm-bod">
    <div class="confirm-cont">
        <h1>Booking Confirmed!</h1>
        <img src="assets/confirm.png" alt="Confirmation">
        <span class="label">Thank you for booking! Your queue number is:</span> <span class="value">07</span>
        <p>Please be ready at your pickup location. You are currently no. <span class="value">7</span> in queue.</p>

        <div class="ride-details">
            <h1>Ride Details</h1>
            <div class="detail-item">
                <span class="label">Plate No.:</span> <span class="value"><?= htmlspecialchars($plate_number); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Departure:</span> <span class="value"><?= date('g:i A', strtotime($time)); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Capacity:</span> <span class="value"><?= htmlspecialchars($capacity); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Status:</span> <span class="value"><?= htmlspecialchars($seats_available); ?> seats available</span>
            </div>
            <div class="detail-item">
                <span class="label">Route:</span> <span class="value"><?= htmlspecialchars($route); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Total Fare:</span> <span class="value">₱<?= htmlspecialchars($total_fare); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Payment Method:</span> <span class="value">Cash</span>
            </div>
            <div class="detail-item">
                <span class="label">Payment Status:</span> <span class="value">Pay on Arrival</span>
            </div>
        </div>
    </div>
</body>
</html>