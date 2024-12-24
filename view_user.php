<?php
$servername ="localhost:3307";
$username = "root";
$password = "";
$database = "girls";

$conn = mysqli_connect($servername, $username, $password, $database);  


if(isset($_GET['userID'])) {
    $userID = $_GET['userID'];

    
    $sql = "SELECT s.userID, s.name, s.age, s.address, s.phoneNo, s.DOB, s.email, s.joining_yr, s.programme, s.aadhar_no, o.mess_id, o.mess_fee_status,ra.Room_no,rs.days,rs.timing,l.cloth_no
            FROM students s
            LEFT JOIN opted o ON s.userID = o.userID
            LEFT JOIN rooms_alloted ra ON s.userID = ra.userID
            LEFT JOIN room_service rs ON rs.Room_no = ra.Room_no
            LEFT JOIN laundary_service l ON s.userID = l.userID
            WHERE s.userID = $userID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>View User Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(45deg,#00008B,white,#B0E0E6);
        }

        h1 {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 20px;
            color: #333; 
        }

        .details-container {
            display: flex;
            justify-content: space-between;
            margin: 20px auto;
            max-width: 800px;
            background-color: #fff; 
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1); 
        }

        .details {
            padding: 20px;
            width: 70%; 
        }

        .edit-links {
            padding: 20px;
            width: 30%; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd; 
        }

        tr:hover {
            background-color: #f2f2f2; 
        }

        a {
            display: block;
            padding: 10px;
            margin: 10px 0;
            text-align: center;
            background-color: #B0E0E6;
            color: black;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background-color:#B0E0E6 ; 
        }
    </style>
</head>
<body>
    <h1>User Details</h1>
    <div class="details-container">
        <div class="details">
            <table border="1">
                <tr>
                    <th>Attribute</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>User ID</td>
                    <td><?php echo $row['userID']; ?></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><?php echo $row['name']; ?></td>
                </tr>
                <tr>
                    <td>Age</td>
                    <td><?php echo $row['age']; ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?php echo $row['address']; ?></td>
                </tr>
                <tr>
                    <td>Phone No.</td>
                    <td><?php echo $row['phoneNo']; ?></td>
                </tr>
                <tr>
                    <td>DOB</td>
                    <td><?php echo $row['DOB']; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $row['email']; ?></td>
                </tr>
                <tr>
                    <td>Joining Year</td>
                    <td><?php echo $row['joining_yr']; ?></td>
                </tr>
                <tr>
                    <td>Programme</td>
                    <td><?php echo $row['programme']; ?></td>
                </tr>
                <tr>
                    <td>Aadhar No.</td>
                    <td><?php echo $row['aadhar_no']; ?></td>
                </tr>
            </table>
        </div>
        <div class="edit-links">
            <a href="profileupdate.php?userID=<?php echo $userID; ?>">Edit Profile Details</a>
            <a href="messupdate.php?userID=<?php echo $userID; ?>">Edit Mess Details</a>
            <a href="laundaryupdate.php?userID=<?php echo $userID; ?>">Edit Laundry Details</a>
            <a href="medicalupdate.php?userID=<?php echo $userID; ?>">Edit Medical Details</a>
            <a href="roomupdate.php?userID=<?php echo $userID; ?>">Edit Rooms Details</a>

        </div>
    </div>
</body>
</html>

<?php
    } else {
        echo "No student found with ID: $userID";
    }
} else {
    echo "userID parameter is missing";
}
$conn->close();
?>