<?php
// Database connection
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

// Initialize filtered rides variable
$rides = [];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $route = $_POST['route'];  // typed route from search bar
    $ride_type = $_POST['ride_type']; // selected ride Type
    $time = $_POST['time'];  // selected specific time

    // Determine the time range for filtering (from selected time to one hour later)
    if ($time !== 'All') {
        $start_time = $time;  // Start time is the time selected by the user
        $end_time = date('H:i:s', strtotime('+1 hour', strtotime($time))); // Add one hour to the selected time
    }

    // Handle different combinations of route, ride_type, and time
    if (empty($route) && $ride_type === 'All' && $time === 'All') {
        // No filtering applied
        $query = "SELECT * FROM rides";
        $result = $conn->query($query);

    } elseif (empty($route) && $ride_type === 'All') {
        // Filter only by time range
        $query = "SELECT * FROM rides WHERE TIME(time) BETWEEN ? AND ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $start_time, $end_time);
        $stmt->execute();
        $result = $stmt->get_result();

    } elseif (empty($route)) {
        // Filter by ride type and optionally by time range
        if ($time !== 'All') {
            $query = "SELECT * FROM rides WHERE ride_type = ? AND TIME(time) BETWEEN ? AND ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sss', $ride_type, $start_time, $end_time);
        } else {
            $query = "SELECT * FROM rides WHERE ride_type = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $ride_type);
        }
        $stmt->execute();
        $result = $stmt->get_result();

    } elseif ($ride_type === 'All') {
        // Filter by route (search) and optionally by time range
        if ($time !== 'All') {
            if (stripos($route, 'igorot') !== false && stripos($route, 'bakakeng') === false) {
                // If the user types "igorot", return "Igorot to Bakakeng"
                $query = "SELECT * FROM rides WHERE LOWER(route) = LOWER(?) AND TIME(time) BETWEEN ? AND ?";
                $route_param = "igorot to bakakeng";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('sss', $route_param, $start_time, $end_time);
            } elseif (stripos($route, 'bakakeng') !== false && stripos($route, 'igorot') === false) {
                // If the user types "bakakeng", return "Bakakeng to Igorot"
                $query = "SELECT * FROM rides WHERE LOWER(route) = LOWER(?) AND TIME(time) BETWEEN ? AND ?";
                $route_param = "bakakeng to igorot";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('sss', $route_param, $start_time, $end_time);
            } else {
                // Full match for "Igorot to Bakakeng" or "Bakakeng to Igorot"
                $query = "SELECT * FROM rides WHERE LOWER(route) = LOWER(?) AND TIME(time) BETWEEN ? AND ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('sss', $route, $start_time, $end_time);
            }
        } else {
            if (stripos($route, 'igorot') !== false && stripos($route, 'bakakeng') === false) {
                // If the user types "igorot", return "Igorot to Bakakeng"
                $query = "SELECT * FROM rides WHERE LOWER(route) = LOWER(?)";
                $route_param = "igorot to bakakeng";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('s', $route_param);
            } elseif (stripos($route, 'bakakeng') !== false && stripos($route, 'igorot') === false) {
                // If the user types "bakakeng", return "Bakakeng to Igorot"
                $query = "SELECT * FROM rides WHERE LOWER(route) = LOWER(?)";
                $route_param = "bakakeng to igorot";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('s', $route_param);
            } else {
                // Full match for "Igorot to Bakakeng" or "Bakakeng to Igorot"
                $query = "SELECT * FROM rides WHERE LOWER(route) = LOWER(?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('s', $route);
            }
        }
        $stmt->execute();
        $result = $stmt->get_result();

    } else {
        // Filter by route, ride type, and optionally by time range
        if ($time !== 'All') {
            if (stripos($route, 'igorot') !== false && stripos($route, 'bakakeng') === false) {
                // Filter for "Igorot to Bakakeng" with ride type and time
                $query = "SELECT * FROM rides WHERE LOWER(route) = LOWER(?) AND ride_type = ? AND TIME(time) BETWEEN ? AND ?";
                $route_param = "igorot to bakakeng";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('ssss', $route_param, $ride_type, $start_time, $end_time);
            } elseif (stripos($route, 'bakakeng') !== false && stripos($route, 'igorot') === false) {
                // Filter for "Bakakeng to Igorot" with ride type and time
                $query = "SELECT * FROM rides WHERE LOWER(route) = LOWER(?) AND ride_type = ? AND TIME(time) BETWEEN ? AND ?";
                $route_param = "bakakeng to igorot";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('ssss', $route_param, $ride_type, $start_time, $end_time);
            } else {
                // Full match for "Igorot to Bakakeng" or "Bakakeng to Igorot" with ride type and time
                $query = "SELECT * FROM rides WHERE LOWER(route) = LOWER(?) AND ride_type = ? AND TIME(time) BETWEEN ? AND ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('ssss', $route, $ride_type, $start_time, $end_time);
            }
        } else {
            if (stripos($route, 'igorot') !== false && stripos($route, 'bakakeng') === false) {
                // Filter for "Igorot to Bakakeng" with ride type
                $query = "SELECT * FROM rides WHERE LOWER(route) = LOWER(?) AND ride_type = ?";
                $route_param = "igorot to bakakeng";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('ss', $route_param, $ride_type);
            } elseif (stripos($route, 'bakakeng') !== false && stripos($route, 'igorot') === false) {
                // Filter for "Bakakeng to Igorot" with ride type
                $query = "SELECT * FROM rides WHERE LOWER(route) = LOWER(?) AND ride_type = ?";
                $route_param = "bakakeng to igorot";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('ss', $route_param, $ride_type);
            } else {
                // Full match for "Igorot to Bakakeng" or "Bakakeng to Igorot" with ride type
                $query = "SELECT * FROM rides WHERE LOWER(route) = LOWER(?) AND ride_type = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('ss', $route, $ride_type);
            }
        }
        $stmt->execute();
        $result = $stmt->get_result();
    }

} else {
    // If the form is not submitted, show all rides by default
    $query = "SELECT * FROM rides";
    $result = $conn->query($query);
}

// Fetch filtered rides
if ($result && $result->num_rows > 0) {
    $rides = $result->fetch_all(MYSQLI_ASSOC);
}

if (isset($stmt)) {
    $stmt->close();
}



$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoGora Booking</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body id="book-bod">
    <!-- Header Section -->
    <header class="book-head">
        <h1>GoGora</h1>
        <a href="#"><img src="assets/profile.png" alt="Profile"></a>
        <div class="logout-link">
            <a href="includes/logout.php"><img src="assets/logout.png"></a>
        </div>
    </header>

    <!-- Main Content Section -->
    <div class="book-cont">
        <form method="POST" action="">
            <!-- Route Search Bar -->
            <label for="route">Search Route:</label>
            <input type="text" name="route" id="route" placeholder="Enter route name" value="<?= isset($_POST['route']) ? htmlspecialchars($_POST['route']) : ''; ?>">

            <!-- Ride Type Selection -->
            <label for="ride_type">Select Ride Type:</label>
            <select name="ride_type" id="ride_type">
                <option value="All">All types</option>
                <option value="Jeepney" <?= (isset($_POST['ride_type']) && $_POST['ride_type'] === 'Jeepney') ? 'selected' : ''; ?>>Jeepney</option>
                <option value="Service" <?= (isset($_POST['ride_type']) && $_POST['ride_type'] === 'Service') ? 'selected' : ''; ?>>Service</option>
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
                        echo "<option value='$time_option' ". (isset($_POST['time']) && $_POST['time'] === $time_option ? 'selected' : '') . ">$display_time</option>";
                        $start->modify('+30 minutes'); // for interval
                    }
                ?>
            </select>

            <!-- Submit Button -->
            <button type="submit">Search</button>
            <!-- Clear Filter Button (reset the form and reload the page) -->
            <button type="button" onclick="window.location.href='booking.php';">Clear Filter</button>
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
        
        <form method="POST" action="confirmation.php"> <!-- Change action to the confirmation page -->
            <input type="hidden" name="ride_id" value="<?= $ride['ride_id']; ?>">
            <input type="hidden" name="route" value="<?= htmlspecialchars($ride['route']); ?>">
            <input type="hidden" name="time" value="<?= $ride['time']; ?>">
            <input type="hidden" name="ride_type" value="<?= $ride['ride_type']; ?>">
            <button type="submit" class="book-btn" name="book-btn">Book</button>
        </form>
</div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No rides available at the moment.</p>
            <?php endif; ?>
        </section>
        <script>
        function bookRide(rideId) {
            window.location.href = 'confirmation.php?ride_id=' + rideId; // Redirect to confirmation page with ride ID
            }</script>
    </div>
</body>
</html>