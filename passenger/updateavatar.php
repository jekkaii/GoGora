<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Avatar</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to the external CSS -->
</head>
<body>

    <div class="avatar-page-container"> <!-- The container with the background color -->
        <div class="update-cont">
            <!-- Avatar -->
            <img src="GoGora/passenger/assets/profile.png" alt="Current Avatar" style="width: 150px; height: 150px; border-radius: 50%; margin-bottom: 20px;">
        
            <section class="update-cont">
                <!-- User Info -->
                <h2>Jane Doe</h2>
                <p>22234440</p>
            
                <!-- Buttons -->
                <form action="change_avatar.php" method="POST">
                    <button id="update-avatar-btn" class="submit-btn">Change Avatar</button>
                </form>

                <button id="save-avatar-btn" class="submit-btn">Save Changes</button>
                <button id="cancel-avatar-btn" class="btn-cancel" onclick="window.location.href='profile.php';">Cancel</button>
            </section>
        </div>
    </div>

</body>
</html>
