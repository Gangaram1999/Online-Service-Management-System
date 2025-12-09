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
$sql = "SELECT * FROM requests";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Customers Informations</title>
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
    </style>
</head>
<body>

<h2>ALL REQUESTED INFORMATIONS</h2>

<table>
    <tr>
        <th>Customer Name:</th>
        <th>Phone:</th>
        <th>Address:</th>
        <th>Email:</th>
        <th>Jobber Name:</th>
        <th>Work Details:</th>
        <th>Date:</th>
        <th>Time:</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['customer_name']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['address']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['jobber_name']}</td>
                     <td>{$row['work_details']}</td>
                    <td>{$row['date']}</td>
                    <td>{$row['time']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='10'>No request  found</td></tr>";
    }
    ?>

</table>

</body>
</html>

<?php
$conn->close();
?>
