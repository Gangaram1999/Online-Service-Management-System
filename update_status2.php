<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "service");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = ($_POST['action'] == "Accept") ? "Accepted" : "Rejected";

    // Update status in the database
    $stmt = $conn->prepare("UPDATE customerregister SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        header("Location: displaycustomer.php"); // Redirect back to the main page
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
