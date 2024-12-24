<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Database</title>
    <style>
        body {
            background-image: linear-gradient(45deg, #b0b0b0, #f5f5f5, #fff); 
            margin: 0;
            padding: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background: linear-gradient(45deg,#B0E0E6,#F5F5F5,#fff); 
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h2>Student Database</h2>

<table>
    <tr>
        <th>User ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>Address</th>
        <th>Phone Number</th>
        <th>Date of Birth</th>
        <th>Email</th>
        <th>Joining Year</th>
        <th>Programme</th>
        <th>Aadhar Number</th>
        <th>Room No</th>
        <th>Roommate Name</th>
    </tr>
    <?php
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $database = "girls";
    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT s.userID, s.name, s.age, s.address, s.phoneNo, s.DOB, s.email, s.joining_yr, s.programme, s.aadhar_no, ra.Room_no, IFNULL(s2.name, 'Single Room') AS roommate_name
    FROM students s
    LEFT JOIN Rooms_Alloted ra ON s.userID = ra.userID
    LEFT JOIN Rooms_Alloted ra2 ON ra.Room_no = ra2.Room_no AND ra.userID != ra2.userID
    LEFT JOIN students s2 ON ra2.userID = s2.userID";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error executing the query: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['userID'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['age'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . $row['phoneNo'] . "</td>";
            echo "<td>" . $row['DOB'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['joining_yr'] . "</td>";
            echo "<td>" . $row['programme'] . "</td>";
            echo "<td>" . $row['aadhar_no'] . "</td>";
            echo "<td>" . $row['Room_no'] . "</td>";
            echo "<td>" . $row['roommate_name'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='12'>0 results</td></tr>";
    }

    mysqli_close($conn);
    ?>
</table>

</body>
</html>