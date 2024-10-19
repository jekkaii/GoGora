<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'gogora';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all unique routes for the dropdown
$routes_result = $conn->query("SELECT DISTINCT route FROM rides");

// Initialize filtered rides variable
$rides = [];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $route = $_POST['route'];  // selected route 
    $ride_type = $_POST['ride_type']; // selected ride Type
    $time = $_POST['time'];  // selected specific time

    if ($route === 'All' && $ride_type === 'All' && $time === 'All') {
        // No filtering applied
        $query = "SELECT * FROM rides";
        $result = $conn->query($query);
    } elseif ($route === 'All' && $ride_type === 'All') {
        // Filter only by time
        $query = "SELECT * FROM rides WHERE TIME(time) = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $time);  
        $stmt->execute();
        $result = $stmt->get_result();

    } elseif ($route === 'All') {
        // Filter by ride type and optionally by time
        $query = "SELECT * FROM rides WHERE ride_type = ?". ($time !== 'All' ? " AND TIME(time) = ?" : "");
        $stmt = $conn->prepare($query);
        $stmt->bind_param($time !== 'All' ? 'ss' : 's', $ride_type, $time);
        $stmt->execute();
        $result = $stmt->get_result();

    } elseif ($ride_type === 'All') {
        // Filter by route and optionally by time
        $query = "SELECT * FROM rides WHERE route = ?". ($time !== 'All' ? " AND TIME(time) = ?" : "");
        $stmt = $conn->prepare($query);
        $stmt->bind_param($time !== 'All' ? 'ss' : 's', $route, $time);
        $stmt->execute();
        $result = $stmt->get_result();
        
    } else {
        // Filter by route, ride type, and optionally by time
        $query = "SELECT * FROM rides WHERE route = ? AND ride_type = ?". ($time !== 'All' ? " AND TIME(time) = ?" : "");
        $stmt = $conn->prepare($query);
        $stmt->bind_param($time !== 'All' ? 'sss' : 'ss', $route, $ride_type, $time);
        $stmt->execute();
        $result = $stmt->get_result();
    }

    // Fetch filtered rides
    if ($result->num_rows > 0) {
        $rides = $result->fetch_all(MYSQLI_ASSOC);
    }

    if (isset($stmt)) {
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoGora Booking</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body id="book-bod">
    <!-- Header Section -->
    <header class="book-head">
        <h1>GoGora</h1>
        <a href="#"><img src="assets/profile.png" alt="Profile"></a>
    </header>

    <!-- Main Content Section -->
    <div class="book-cont">
        <form method="POST" action="">
            <!-- Route Selection -->
            <label for="route">Select Route:</label>
            <select name="route" id="route">
                <option value="All">All Rides</option>
                <?php if ($routes_result->num_rows > 0): ?>
                    <?php while ($row = $routes_result->fetch_assoc()): ?>
                        <option value="<?= htmlspecialchars($row['route']); ?>">
                            <?= htmlspecialchars($row['route']); ?>
                        </option>
                    <?php endwhile; ?>
                <?php else: ?>
                    <option value="">No routes available</option>
                <?php endif; ?>
            </select>

            <!-- Ride Type Selection -->
            <label for="ride_type">Select Ride Type:</label>
            <select name="ride_type" id="ride_type">
                <option value="All">All types</option>
                <option value="Jeepney">Jeepney</option>
                <option value="Service">Service</option>
            </select>

            <!-- Time Selection with 30-minute intervals -->
            <label for="time">Select Time:</label>
            <select name="time" id="time">
                <option value="All">All Times</option>
                <?php
                    // time intervals of 30 minutes starting from 7:30 AM to 7:00 PM
                    $start = new DateTime('07:30');
                    $end = new DateTime('19:00');

                    while ($start <= $end) {
                        $time_option = $start->format('H:i:s');
                        $display_time = $start->format('g:i A');
                        echo "<option value='$time_option'>$display_time</option>";
                        $start->modify('+30 minutes');
                    }
                ?>
            </select>

            <!-- Submit Button -->
            <button type="submit">Select</button>
        </form>

        <!-- Display Available Rides -->
        <h1>Choose a Ride</h1>
        <section class="ride-list">
            <?php if (!empty($rides)): ?>
                <?php foreach ($rides as $ride): ?>
                    <div class="ride-item">
                        <div class="ride-info">
                            <p>Route: <?= htmlspecialchars($ride['route']); ?></p>
                            <p>Time: <?= date('g:i A', strtotime($ride['time'])); ?></p>
                            <p>Seats Available: <?= $ride['seats_available']; ?></p>
                            <p>Ride Type: <?= $ride['ride_type']; ?></p>
                            <button class="book-btn">Book</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No rides available at the moment.</p>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>
