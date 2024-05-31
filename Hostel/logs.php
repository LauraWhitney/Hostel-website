<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostel_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to check if the user exists and password is correct
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

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["uname"]) && isset($_POST["psw"])) {
    $username = $_POST["uname"];
    $password = $_POST["psw"];

    // Call the verifyUser function
    if (verifyUser($username, $password, $conn)) {
        // User found and password is correct, redirect to bookings.php
        header("Location: bookings.php");
        exit();
    } else {
        echo "Invalid username or password";
    }
}

$conn->close();
?>

