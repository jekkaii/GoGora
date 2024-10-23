<?php
// Capture ride details from POST data
$route = $_POST['route'];
$time = $_POST['time'];
$seats_available = $_POST['seats_available'];
$ride_type = $_POST['ride_type'];
$plate_number = $_POST['plate_number'];
$total_fare = $_POST['total_fare'];
$capacity = $_POST['capacity'];

// Retrieve reservation details based on ride_id and user_id
if (isset($_POST['ride_id']) && isset($_POST['user_id'])) {
    $ride_id = $_POST['ride_id'];
    $user_id = $_POST['user_id'];
    
    // Here you can fetch reservation details if needed.
    // For confirmation purposes, we will just display the ride details.
    
    $query = "SELECT * FROM rides WHERE ride_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $ride_id);
    $stmt->execute();
    $ride_result = $stmt->get_result();

    if ($ride_result->num_rows > 0) {
        $ride = $ride_result->fetch_assoc();
    } else {
        echo "Ride not found.";
        exit();
    }
}

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