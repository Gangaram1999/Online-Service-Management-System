<?php
// Database connection details
$host = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if you have a database password
$database = "service";

// Connect to MySQL
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $firstName = $conn->real_escape_string($_POST["firstname"]);
    $lastName = $conn->real_escape_string($_POST["lastname"]);
    $phone = $conn->real_escape_string($_POST["phone"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $address = $conn->real_escape_string($_POST["address"]);
    $password = $conn->real_escape_string($_POST["password"]); // Ensure correct name

    // Insert data into database
    $sql = "INSERT INTO customerregister (first_name, last_name, phone, email, address, password) 
            VALUES ('$firstName', '$lastName', '$phone', '$email', '$address', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: success.html"); // Redirect to a success page
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
