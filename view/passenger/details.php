<?php
require_once('../../control/includes/db.php');

// Debug: Check if ride_id is sent
if (!isset($_POST['ride_id'])) {
    echo "No ride selected.";
    exit();
}

$ride_id = $_POST['ride_id'];

// Fetch ride details along with reservation details using LEFT JOIN
$query = "SELECT r.*, res.total_fare, res.payment_method, res.payment_status, res.status 
          FROM rides r 
          LEFT JOIN reservations res ON r.ride_id = res.ride_id 
          WHERE r.ride_id = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    echo "Database error: " . $conn->error;
    exit();
}

$stmt->bind_param('i', $ride_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $ride_details = $result->fetch_assoc();

    // Extract details to variables
    $route = $ride_details['route'];
    $departure = $ride_details['departure'];
    $plate_number = $ride_details['plate_number'];
    $capacity = $ride_details['capacity'];
    $total_fare = $ride_details['total_fare'] ?? 'N/A';
    $payment_method = $ride_details['payment_method'] ?? 'N/A';
    $payment_status = $ride_details['payment_status'] ?? 'N/A';
    $status = $ride_details['status'] ?? 'N/A';
} else {
    echo "No ride found with the selected ID.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body id="details-bod">
    <div class="details-cont">
        <h1>Review Your Ride Details</h1>
        <div class="ride-details">
            <div class="detail-item">
                <span class="label">Plate No.:</span> 
                <span class="value"><?= htmlspecialchars($plate_number); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Departure:</span> 
                <span class="value"><?= date('g:i A', strtotime($departure)); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Capacity:</span> 
                <span class="value"><?= htmlspecialchars($capacity); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Route:</span> 
                <span class="value"><?= htmlspecialchars($route); ?></span>
            </div>

            <div class="button-section">
                <form action="confirmation.php" method="POST">
                    <input type="hidden" name="ride_id" value="<?= htmlspecialchars($ride_id); ?>">
                    <button type="submit" class="confirm-btn">Confirm</button>
                </form>
                <form action="booking.php" method="GET">
                    <button type="submit" class="cancel-btn">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
