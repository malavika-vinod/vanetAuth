<?php
include 'db_config.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $streetAddress = $_POST["streetAddress"];
    $streetAddress2 = $_POST["streetAddress2"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $postalCode = $_POST["postalCode"];
    $country = $_POST["country"];
    $user = $_POST["username"];
    $password = $_POST["password"];
    $lno=$_POST["licenseNo"];
    $vno=$_POST["vehicleNo"];

    // Insert data into the 'users' table
    $sql = "INSERT INTO users (name, street_address_1, street_address_2, city, state, postal_code, country,username,password,vehicle_no,license_no)   VALUES ('$name', '$streetAddress', '$streetAddress2', '$city', '$state', '$postalCode', '$country','$user','$password','$vno','$lno')";
    $stmt = $conn->prepare($sql);
    if ($conn->query($sql) === TRUE) {
        // Registration successful
        $user_id = $conn->insert_id; // Get the last inserted user ID
        $pythonScriptPath = 'generate.py';  // Replace with the actual path
        $command = "python3 $pythonScriptPath $user_id '$user' '$password' '$lno','$vno'";
        $result = shell_exec($command);
        // Set session variables
        session_start();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;

        // Redirect to the user dashboard or another page
        header('Location: userdetails.php?user_id=' . $user_id);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
// Close the database connection
$conn->close();
?>
