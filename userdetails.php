<?php
include 'db_config.php'; // Make sure to include your database configuration file

// Check if the user ID is provided in the URL
if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    // Fetch user details from the database based on the user ID
    $sql = "SELECT * FROM users WHERE id = $userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $username = $row['username'];
        $vehicleNo = $row['vehicle_no'];
        $licenseNo = $row['license_no'];
        // Add more fields as needed
    } else {
        echo "User not found";
        exit;
    }
} else {
    echo "User ID not provided";
    exit;
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .user-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: left;
        }

        .user-details h2 {
            color: #e8491d;
        }

        .user-details p {
            font-size: 16px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="user-details">
        <h2>User Details</h2>
        <p>Name: <?php echo $name; ?></p>
        <p>Username: <?php echo $username; ?></p>
        <p>Vehicle No: <?php echo $vehicleNo; ?></p>
        <p>License No: <?php echo $licenseNo; ?></p>
        <!-- Add more details as needed -->
    </div>
</body>
</html>
