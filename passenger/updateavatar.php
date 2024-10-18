<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Avatar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F2F7FF;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center; 
            background-color: #F2F7FF; 
            padding: 20px;
            border-radius: 10px;
        
        }

        h2 {
            margin: 0;
            font-size: 1.5em;
            color: #0071CE;
        }

        p {
            margin: 5px 0;
            font-weight: bold;
            color: #0071CE;
            font-size: 1.2em;
        }

        button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            font-size: 1em;
            font-weight:bold;
            color: white;
            background-color: black;
            border: none;
            border-radius: 30px;
            cursor: pointer;
        }


        button:hover {
            background-color: #A7A4A4;
        }

        .btn-cancel {
            background-color: #000000;
        }

        .btn-cancel:hover {
            background-color: #A7A4A4;
        }

    </style>
</head>
<body>

    <div class="container">
        <!-- Avatar -->
        <img src="GoGora\passenger\assets\profile.png" alt="Current Avatar" style="width: 150px; height: 150px; border-radius: 50%; margin-bottom: 20px;">
        
        <!-- User Info -->
        <h2>Jane Doe</h2>
        <p>22234440</p>

        <!-- Buttons -->
        <form action="change_avatar.php" method="POST">
            <button type="submit">Change Avatar</button>
        </form>

        <button type="submit" class="btn-save">Save Changes</button>
        <button type="button" class="btn-cancel" onclick="window.location.href='profile.php';">Cancel</button>
    </div>

</body>
</html>
