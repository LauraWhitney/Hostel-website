<?php
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
    // Get the username and password from the form
    $uname = $_POST["uname"];
    $psw = $_POST["psw"];

    // Call the verifyUser function to check if the user exists in the database
    function verifyUser($name, $password, $conn) {
        $sql = "SELECT * FROM users WHERE name = '$name'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $row['password'])) {
                return true;
            }
        }

        return false;
    }

    // Verify the user
    if (verifyUser($uname, $psw, $conn)) {
        // User is verified, redirect to bookings.html
        header("Location: bookings.html");
        exit();
    } else {
        // User not found or incorrect password
        echo "Invalid username or password.";
    }
}

// Close the database connection
$conn->close();
?>