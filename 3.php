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

// Fetch job seekers' data

$sql = "SELECT * FROM requests WHERE status = 'Rejected' ORDER BY Id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            text-align: center;
        }
        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: blue;
            color: white;
        }
        img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
        }
        h2 {
            color: darkblue;
        }
        .accept-btn {
            background-color: green;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
        }
        .reject-btn {
            background-color: red;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>ALL ACCEPTED REQUESTS</h2>

<table>
    <tr>
        <th>Customer Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Jobber Name</th>
        <th>Work Details</th>
        <th>Work Date</th>
        <th>Time</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { ?>
            <tr>
                    <td><?= htmlspecialchars($row['customer_name']) ?></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                    <td><?= htmlspecialchars($row['address']) ?></td>
                    <td><?= htmlspecialchars($row['jobber_name']) ?></td>
                    <td><?= htmlspecialchars($row['work_details']) ?></td>
                    <td><?= htmlspecialchars($row['date']) ?></td>
                    <td><?= htmlspecialchars($row['time']) ?></td>
                    <td><?= htmlspecialchars($row['status']) ?></td>
                    <td>
                        <?php if ($row['status'] == 'Pending') { ?>
                            <form action="update_status.php" method="POST" style="display: inline;">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <button type="submit" name="action" value="Accept" class="accept-btn">Accept</button>
                            </form><br>
                            <form action="update_status.php" method="POST" style="display: inline;">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <button type="submit" name="action" value="Reject" class="reject-btn">Reject</button>
                            </form>
                        <?php } else { ?>
                            <strong><?= htmlspecialchars($row['status']) ?></strong>
                        <?php } ?>
                    </td>
                </tr>
        <?php }
    } else {
        echo "<tr><td colspan='11'>No Any Rejected found</td></tr>";
    } ?>
</table>

</body>
</html>

<?php
$conn->close();
?>
