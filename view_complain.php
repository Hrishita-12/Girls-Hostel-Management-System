<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Data</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h2>Complaint Data</h2>
    <?php
    $servername = "localhost:3307"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "girls"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT c.cid, c.userID, cr.type_name, c.dates, c.description FROM complaint c
            INNER JOIN Complain_Register cr ON c.type_id = cr.type_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Complaint ID</th><th>User ID</th><th>Complaint Type</th><th>Date</th><th>Description</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["cid"] . "</td><td>" . $row["userID"] . "</td><td>" . $row["type_name"] . "</td><td>" . $row["dates"] . "</td><td>" . $row["description"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</body>
</html>
