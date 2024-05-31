<?php
// Start session
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "group28";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the booking details from the form
    $roomType = $_POST["room-type"];
    $totalPrice = $_POST["total-price"];
    $roommatesCount = $_POST["roommates-count"];
    $cardNumber = $_POST["card-number"];

    // Insert the booking details into the bookings table
    $sql = "INSERT INTO bookings (room_type, total_price, roommates_count, card_number)
            VALUES ('$roomType', '$totalPrice', '$roommatesCount', '$cardNumber')";

    if ($conn->query($sql) === TRUE) {
        echo "Booking successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
