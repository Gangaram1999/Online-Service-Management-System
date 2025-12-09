<?php
$servername = "localhost"; // Change if your database is hosted remotely
$username = "root"; // Your database username
$password = ""; // Your database password (default is empty for local servers)
$dbname = "service"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Uncomment the line below to confirm successful connection
// echo "Connected successfully";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $customer_name = $_POST['customer'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $jobber_name = $_POST['jobername'];
    $work_details = $_POST['work'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Sanitize and escape data to prevent SQL injection
    $customer_name = mysqli_real_escape_string($conn, $customer_name);
    $phone = mysqli_real_escape_string($conn, $phone);
    $address = mysqli_real_escape_string($conn, $address);
    $email = mysqli_real_escape_string($conn, $email);
    $jobber_name = mysqli_real_escape_string($conn, $jobber_name);
    $work_details = mysqli_real_escape_string($conn, $work_details);
    $date = mysqli_real_escape_string($conn, $date);
    $time = mysqli_real_escape_string($conn, $time);

    // SQL query to insert the data into the database
    $sql = "INSERT INTO requests (customer_name, phone, address, email, jobber_name, work_details, date, time) 
            VALUES ('$customer_name', '$phone', '$address', '$email', '$jobber_name', '$work_details', '$date', '$time')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        header("location: conform.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


// Close the database connection
$conn->close();
?>
