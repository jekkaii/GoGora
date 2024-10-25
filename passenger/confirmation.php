<?php
// Capture ride details from POST data
$ride_id = $_POST['ride_id'] ?? '';
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'gogora_db';

// Create a new database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    echo "Sorry, something went wrong. Please try again later.";
    exit();
}

// Initialize variables for ride details
$route = '';
$time = '';
$seats_available = '';
$ride_type = '';
$plate_number = '';
$total_fare = '';
$capacity = '';

// Fetch ride details from the database
if ($ride_id) {
    $stmt = $conn->prepare("SELECT route, time, seats_available, ride_type, plate_number, capacity FROM rides WHERE ride_id = ?");
    $stmt->bind_param("i", $ride_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if ride details were found
    if ($result->num_rows > 0) {
        $ride_details = $result->fetch_assoc();
        // Assign the retrieved values to variables
        $route = $ride_details['route'];
        $time = $ride_details['time'];
        $seats_available = $ride_details['seats_available'];
        $ride_type = $ride_details['ride_type'];
        $plate_number = $ride_details['plate_number'];
        $capacity = $ride_details['capacity'];
    } else {
        echo "No ride details found for the selected ride.";
        exit();
    }
}

// Close the statement and connection
$stmt->close();
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
