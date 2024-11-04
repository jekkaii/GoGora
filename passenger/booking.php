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

    // Initialize base query
    $query = "SELECT * FROM rides WHERE 1=1";
    $params = [];
    $types = '';

    // Search filter
    if (!empty($route)) {
        if (stripos($route, 'bakakeng') !== false && stripos($route, 'igorot') === false) {
            // 'Bakakeng', return 'Bakakeng to Igorot Park' route
            $query .= " AND LOWER(route) LIKE LOWER(?)";
            $params[] = '%bakakeng to igorot park%';  // Exact route format
        } elseif (stripos($route, 'igorot') !== false && stripos($route, 'bakakeng') === false) {
            // 'Igorot' or 'Igorot park', return 'Igorot Park to Bakakeng' route
            $query .= " AND LOWER(route) LIKE LOWER(?)";
            $params[] = '%igorot park to bakakeng%';
        } else {
            // Fallback for general or partial searches
            $query .= " AND LOWER(route) LIKE LOWER(?)";
            $params[] = '%' . $route . '%';
        }
        $types .= 's';
    }

    // Add Ride Type filter (if not "All")
    if ($ride_type !== 'All') {
        $query .= " AND ride_type = ?";
        $params[] = $ride_type;
        $types .= 's';
    }

   
    if ($time !== 'All') {
        // Extract the hour from the selected time and create a time range for that hour
        $start_time = date('H:i:s', strtotime($time)); 
        $end_time = date('H:i:s', strtotime('+59 minutes 59 seconds', strtotime($start_time))); 
        
        $query .= " AND TIME(time) BETWEEN ? AND ?";
        $params[] = $start_time;
        $params[] = $end_time;
        $types .= 'ss';
    }

    // Prepare the statement with dynamic parameters
    $stmt = $conn->prepare($query);

    // Bind parameters dynamically if there are any
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch filtered rides
    if ($result && $result->num_rows > 0) {
        $rides = $result->fetch_all(MYSQLI_ASSOC);
    }

    $stmt->close();
} else {
    // If the form is not submitted, show all rides by default
    $query = "SELECT * FROM rides";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $rides = $result->fetch_all(MYSQLI_ASSOC);
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
    <link rel="icon" type="image/png" href="assets/favicon.png"> 
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

            <!-- Time Selection with hourly intervals -->
            <label for="time">Select Time:</label>
            <select name="time" id="time">
                <option value="All">All Times</option>
                <?php
                    // Generate whole-hour intervals from 7:00 AM to 7:00 PM
                    for ($hour = 7; $hour <= 19; $hour++) {
                        $time_option = sprintf('%02d:00:00', $hour);  // Format as "HH:00:00"
                        $display_time = date('g:i A', strtotime($time_option));  // Display as "7:00 AM", etc.
                        echo "<option value='$time_option' ". (isset($_POST['time']) && $_POST['time'] === $time_option ? 'selected' : '') . ">$display_time</option>";
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
                            
                            <form method="POST" action="details.php"> <!-- Change action to the confirmation page -->
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
    </div>
</body>
</html>