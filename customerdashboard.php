<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "service";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if search is submitted
if (isset($_POST['search'])) {
    $searchQuery = $_POST['searchQuery'];

    // Query the database based on the search term
    $sql = "SELECT * FROM jobregister WHERE  status = 'Accepted' and first_name LIKE '%$searchQuery%' OR last_name LIKE '%$searchQuery%' OR occupation LIKE '%$searchQuery%' OR experience LIKE '%$searchQuery%'";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Search  jobber with Sidebar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        /* Sidebar styling */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #333;
            color: #fff;
            position: fixed;
            padding-top: 20px;
            padding-left: 20px;
        }

        .sidebar input[type="text"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 4px;
        }

        .sidebar button {
            width: 98%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            color: white;
        }

        .sidebar button:hover {
            background-color: #45a049;
        }

        .content {
            margin-left: 270px;
            padding: 20px;
            flex: 1;
        }

        .student {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 3px solid black;
            background-color: #f9f9f9;
            display: flex;
            align-items: center;
        }

        .student img {
            width: 150px;
            height: 150px;
            border-radius: 70%;
            border: 3px solid black;
            margin-right: 20px;
        }

        .student h3 {
            margin: 0;
        }

        .student p {
            margin: 5px 0;
        }

        .student strong {
            color: #333;
        }

        hr {
            margin: 20px 0;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Search Here</h2>
        <!-- Search Form -->
        <form action="customerdashboard.php" method="POST">
            <input type="text" name="searchQuery" placeholder="Search for Works..." required>
            <button type="submit" name="search">Search</button><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            
        </form>
        <a href="logout.php"><button>logout</button></a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h1>RESULT FROM YOUR SEARCH</h1>


        <!-- Display search results -->
         <table>
            <tr>
              <th>
                <div class="Dashboard">
                    <div class="Card">
                   <?php
                      if (isset($result)) {
                           if ($result->num_rows > 0) {
                              while ($row = $result->fetch_assoc()) {
                                 echo"<td>";
                                 echo "<div class='student'>";
                                 // Display Profile Picture, if exists
                                 if (!empty($row['profile_picture']) && file_exists("uploads/" . $row['profile_picture'])) {
                                    echo "<img src='uploads/" . $row['profile_picture'] . "' alt='Profile Picture'>";
                                } else {
                                    echo "<img src='uploads/default.jpg' alt='Profile Picture'>";
                                }
                                

                           echo "<div>";
                          echo "<h3>" . $row['first_name'] . " " . $row['last_name'] . "</h3>";
                          echo "<p><strong>Phone:</strong> " . $row['phone'] . "</p>";
                           echo "<p><strong>Occupation:</strong> " . $row['occupation'] . "</p>";
                           echo "<p><strong>Experience:</strong> " . $row['experience'] . "</p>";
                           echo "<p><strong>Per Day Rate:</strong> " . $row['rate'] . "</p>";
                           echo"<br>";
                          echo "<strong><a href='sendrequest.html'><button type='button'>SEND REQUEST</button></a></strong>";
                          echo "</div>";
                         echo "</div>";

 
                }
            } else {
                echo "<p>No results found!</p>";
            }
        }
        ?>
        
        </td>
    </div>
    </div>
    </th
    </tr>
    </table>
    </div>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
