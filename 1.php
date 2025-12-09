<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "service");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch job requests
$sql = "SELECT id,customer_name,phone,address,jobber_name,work_details,date,status FROM requests";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Requests</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background-color: #f4f4f4; margin: 20px; }
        .container { max-width: 900px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: green; color: white; }
        .accept-btn { background-color: green; color: white; padding: 5px 10px; border: none; cursor: pointer; border-radius: 5px; }
        .reject-btn { background-color: red; color: white; padding: 5px 10px; border: none; cursor: pointer; border-radius: 5px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Job Requests</h2>
    <table>
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Jobber Name</th>
                <th>Work Details</th>
                <th>Enter Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['customer_name']) ?></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                    <td><?= htmlspecialchars($row['address']) ?></td>
                    <td><?= htmlspecialchars($row['jobber_name']) ?></td>
                    <td><?= htmlspecialchars($row['work_details']) ?></td>
                    <td><?= htmlspecialchars($row['date']) ?></td>
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
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php $conn->close(); ?>
