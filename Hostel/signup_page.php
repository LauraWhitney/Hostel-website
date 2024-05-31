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

// Handle sign-up form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $id_number = $_POST["ID_number"]; 
    $dob = $_POST["dob"];
    $address = $_POST["address"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm-password"];

    

    // Check if passwords match
    if ($password != $confirm_password) {
        echo "Passwords do not match";
    } else {
        // Hash the password before storing it in the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user into the database
        $sql = "INSERT INTO users ( name, email, phone, id_number, dob, address, password)
                VALUES ('$name', '$email', '$phone', '$id_number', '$dob', '$address', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            // Redirect user to login page
            header("Location: login.html");
            exit(); // Ensure script execution stops after redirection
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>



