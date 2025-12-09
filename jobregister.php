<?php
// Database connection details
$host = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if you have a DB password
$database = "service";

// Connect to MySQL
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // File upload handling
    $targetDir = "uploads/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    $fileName = basename($_FILES["profilePicture"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Allow only image file types
    $allowedTypes = ["jpg", "jpeg", "png", "gif"];
    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $targetFilePath)) {
            // Collect and sanitize form data
            $firstName = $conn->real_escape_string($_POST["firstName"]);
            $lastName = $conn->real_escape_string($_POST["lastName"]);
            $phone = $conn->real_escape_string($_POST["phone"]);
            $email = $conn->real_escape_string($_POST["email"]);
            $occupation = $conn->real_escape_string($_POST["occupation"]);
            $experience = $conn->real_escape_string($_POST["experience"]);
            $password = $conn->real_escape_string($_POST["password"]);
            $gender = $conn->real_escape_string($_POST["gender"]);
            $rate = $conn->real_escape_string($_POST["rate"]);

            // Insert data into database
            $sql = "INSERT INTO jobregister (profile_picture, first_name, last_name, phone, email, occupation, experience, password , gender, rate) 
                    VALUES ('$fileName', '$firstName', '$lastName', '$phone', '$email', '$occupation', '$experience', '$password', '$gender', '$rate')";

            if ($conn->query($sql) === TRUE) {
                header("location: success.html");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error uploading profile picture.";
        }
    } else {
        echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
    }
}

// Close connection
$conn->close();
?>
