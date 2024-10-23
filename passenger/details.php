<?php
// Capture ride details from POST data
$route = $_POST['route'];
$time = $_POST['time'];
$seats_available = $_POST['seats_available'];
$ride_type = $_POST['ride_type'];
$plate_number = $_POST['plate_number'];
$total_fare = $_POST['total_fare'];
$capacity = $_POST['capacity'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ride Details</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="details-cont">
        <h1>Review Your Ride Details</h1>
        <div class="ride-details">
            <div class="detail-item">
                <span class="label">Plate No.:</span> <span class="value"><?= htmlspecialchars($plate_number); ?></span>
            </div>
            <!-- <div class="detail-item">
                <span class="label">Departure:</span> <span class="value"><?= date('g:i A', strtotime($time)); ?></span>
            </div> -->
            <div class="detail-item">
                <span class="label">Capacity:</span> <span class="value"><?= htmlspecialchars($capacity); ?></span>
            </div>
            <!-- <div class="detail-item">
                <span class="label">Status:</span> <span class="value"><?= htmlspecialchars($seats_available); ?> seats available</span>
            </div> -->
            <div class="detail-item">
                <span class="label">Route:</span> <span class="value"><?= htmlspecialchars($route); ?></span>
            </div>
            <!-- <div class="detail-item">
                <span class="label">Total Fare:</span> <span class="value">₱<?= htmlspecialchars($total_fare); ?></span>
            </div> -->

            <!-- Confirmation Form -->
            <form action="confirmation.php" method="POST">
                <input type="hidden" name="route" value="<?= htmlspecialchars($route); ?>">
                <input type="hidden" name="time" value="<?= htmlspecialchars($time); ?>">
                <input type="hidden" name="seats_available" value="<?= htmlspecialchars($seats_available); ?>">
                <input type="hidden" name="ride_type" value="<?= htmlspecialchars($ride_type); ?>">
                <input type="hidden" name="plate_number" value="<?= htmlspecialchars($plate_number); ?>">
                <input type="hidden" name="total_fare" value="<?= htmlspecialchars($total_fare); ?>">
                <input type="hidden" name="capacity" value="<?= htmlspecialchars($capacity); ?>">
                <button type="submit" class="confirm-btn">Confirm</button>
            </form>

            <!-- Cancel Button (Redirects back to booking.php) -->
            <form action="booking.php" method="GET">
                <button type="submit" class="cancel-btn">Cancel</button>
            </form>
        </div>
    </div>
</body>
</html>