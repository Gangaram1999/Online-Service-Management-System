<?php

// Fetch all pending requests
$sql = "SELECT * FROM requests WHERE status = 'Pending'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h3>Customer Name: " . $row['customer_name'] . "</h3>";
        echo "<p>Phone: " . $row['phone'] . "</p>";
        echo "<p>Work Details: " . $row['work_details'] . "</p>";
        echo "<p>Requested Date: " . $row['date'] . "</p>";
        echo "<p>Requested Time: " . $row['time'] . "</p>";

        // Form to accept or reject
        echo "<form action='jobber_response.php' method='POST'>";
        echo "<input type='hidden' name='request_id' value='" . $row['id'] . "'>";
        echo "<input type='submit' name='accept' value='Accept'>";
        echo "<input type='submit' name='reject' value='Reject'>";
        echo "</form>";
        echo "</div><hr>";
    }
} else {
    echo "No requests found.";
}


// Check if the jobber clicked accept or reject
if (isset($_POST['request_id'])) {
    $request_id = $_POST['request_id'];

    if (isset($_POST['accept'])) {
        // Update the status to accepted
        $sql = "UPDATE requests SET status = 'Accepted' WHERE id = $request_id";
    } elseif (isset($_POST['reject'])) {
        // Update the status to rejected
        $sql = "UPDATE requests SET status = 'Rejected' WHERE id = $request_id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Request updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
