<?php
// Database connection (same as in booking.php)
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

// Get the ride_id from the URL
if (isset($_GET['ride_id'])) {
    $ride_id = $_GET['ride_id'];
    
    // Fetch ride details
    $query = "SELECT * FROM rides WHERE ride_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $ride_id);
    $stmt->execute();
    $ride_details = $stmt->get_result()->fetch_assoc();

    // You can extract details to variables
    $route = $ride_details['route'];
    $time = $ride_details['time'];
    $seats_available = $ride_details['seats_available'];
    $ride_type = $ride_details['ride_type'];
    $plate_number = $ride_details['plate_number']; // Assuming this exists
    $total_fare = $ride_details['total_fare']; // Assuming this exists
    $capacity = $ride_details['capacity']; // Assuming this exists
} else {
    echo "No ride selected.";
    exit();
}

// Close the statement
$stmt->close();
$conn->close();
?>
