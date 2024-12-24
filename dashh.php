<?php
session_start();

if (!isset($_SESSION['userID'])) {
    
    header("Location: loginn.php");
    exit();
}


$hostname = "localhost:3307";
$dbuser = "root";
$dbPass = "";
$dbName = "girls";
$conn = mysqli_connect($hostname, $dbuser, $dbPass, $dbName);
if (!$conn) {
    die("Connection was not successful");
}


$userID = $_SESSION['userID'];
$sql = "SELECT * FROM students WHERE userID = '$userID'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $userID = $row['userID'];
    $name = $row['name'];
    $age = $row['age'];
    $address = $row['address'];
    $phoneNo = $row[ 'phoneNo'];
    $DOB = $row['DOB'];
    $email = $row['email'];
    $joining_yr = $row['joining_yr'];
    $programme = $row['programme'];
    $aadhar_no = $row['aadhar_no'];
    $s_password = $row['s_password'];
    
} else {
    
    $error_message = "Student details not found";
}


mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hosteller Profile Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background:linear-gradient(45deg,#b0e0e6,#f5f5f5,#fff);
        }

        .navbar {
            background:linear-gradient(45deg,#b0e0e6,#f5f5f5,#fff);
            color: #fff;
            padding: 40px;
            border: #171817 solid 3px;
            display: flex;
            justify-content: space-between; 
            align-items: center;
        }

        .navbar h1 {
            margin: 0;
            font-size: 24px;
            text-align: center;
            font-size: 40px;
            color: black;
        }

        .navbar button {
            background:linear-gradient(45deg,#b0e0e6,#f5f5f5,#fff);
            color: black;
            border: none;
            padding: 12px 20px; 
            border-radius: 40px;
            cursor: pointer;
            font-size: 20px; 
        }

        .navbar button:hover {
            background-color: rgb(19, 17, 17);
        }

        .sidebar {
            background:linear-gradient(45deg,#b0e0e6,#f5f5f5,#fff);
            height: 100vh;
            width: 200px;
            float: left;
            border: #171817 solid 3px;
            display:flex;
            flex-direction:column;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 10px;
        }

        .sidebar ul li a {
            text-decoration: rgb(67, 220, 138);
            font-size: 25px;
            color: #0e0e0f;
        }

        .main {
            margin-left: 220px;
            padding: 20px;
            font-size: 25px;
        }

        .profile-details {
            background:linear-gradient(45deg,#b0e0e6,#f5f5f5,#fff);
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .medical-kit {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        .medical-kit h1 {
            text-align: center;
            text-size-adjust: 50px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
  
<body>

<div class="navbar">
    <h1>Hosteller Profile</h1>
    <form method="post" action="logout.php">
    <button type="submit" name="logout">Logout</button>
</form>
    
</div>

    <div class="sidebar">
        <ul>
            <li><a href="mess.php">Mess</a></li>
            <li><a href="vehicle.php">Vehicle</a></li>
            <li><a href="room.php">Rooms</a></li>
            <li><a href="medicalkit.php">Medical Kit</a></li>
            <li><a href="laundary.php">Laundry Service</a></li>
            <li><a href="complaint_form.php?userID=<?php echo $userID ?>">File a Complaint</a></li>

        </ul>
    </div>

    <div class="main">
        <div class="profile-details">
            <div class="wrapper">
                <h2>Welcome, <?php echo $userID; ?></h2>
                <p>Student ID: <?php echo $userID; ?></p>
                <p>Name: <?php echo $name; ?></p>
                <p>Age: <?php echo $age; ?></p>
                <p>Address: <?php echo $address; ?></p>
                <p>Phone No.: <?php echo $phoneNo; ?></p>
                <p>Date of Birth: <?php echo $DOB; ?></p>
                <p>Email: <?php echo $email; ?></p>
                <p>Joining Year: <?php echo $joining_yr; ?></p>
                <p>Programme: <?php echo $programme; ?></p> 
                <p>Aadhar No.: <?php echo $aadhar_no; ?></p>
            </div>
        </div>
    </div>

<script>
    function logout() {
        
        window.location.href = "logout.php";
    }
</script>

</body>
</html>