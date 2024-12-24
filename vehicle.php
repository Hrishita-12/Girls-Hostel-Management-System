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


$userID = $_SESSION['userID'];

$sql_vehicle = "SELECT owned.eid, staff.ename, staff.ephoneno, vehicle.veh_no, vehicle.veh_status 
                FROM owned 
                JOIN vehicle ON owned.veh_no = vehicle.veh_no 
                JOIN staff ON owned.eid = staff.eid";

$result_vehicle = mysqli_query($conn, $sql_vehicle);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vehicle Details</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-size: cover;
      background-position: center;
      border: 0px solid #1a0101; 
      background-repeat: no-repeat;
    }

    .container {
      padding: 1vw; 
      background: linear-gradient(45deg, #00008B, #f2f2f2, #fff);
    }

    .vehicle-allotment {
      margin: 2vw auto; 
      padding: 2vw;
      background: linear-gradient(45deg, #FFB6C1, #f2f2f2, #fff); 
      border-radius: 5px;
      border-color: #1a0101;
      max-width: 90%; 
    }

    .vehicle-allotment h1 {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 2vw;
      border: 5px solid #070707;
    }

    table th,
    table td {
      border: 5px solid #070707;
      padding: 1vw; 
      text-align: left;
      font-size: 3px; 
        }

    table th {
        background: linear-gradient(45deg, #FFB6C1, #f2f2f2, #fff);
    }

    table tbody tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    @media screen and (max-width: 768px) {
      .container {
        padding: 5vw;
      }

      .vehicle-allotment {
        padding: 5vw;
        max-width: 100%; 
      }

      .vehicle-allotment h1 {
        font-size: 1.5em;
      }

      table {
        font-size: 0.8em;
      }
    }

  </style>
</head>
<body>
<div class="container">
    <?php

    if (mysqli_num_rows($result_vehicle) > 0) {
        while ($row_vehicle = mysqli_fetch_assoc($result_vehicle)) {
            
            $eid = $row_vehicle['eid'];
            $ename = $row_vehicle['ename'];
            $ephoneno = $row_vehicle['ephoneno'];
            $veh_no = $row_vehicle['veh_no'];
            $veh_status = $row_vehicle['veh_status'];

            
            echo "<div class='vehicle-allotment'>";
            echo "<h3>Vehicle Details</h3>";
            echo "<p>Emp ID: $eid</p>";
            echo "<p>Employee Name: $ename</p>";
            echo "<p>Employee Phone Number: $ephoneno</p>";
            echo "<p>Vehicle Number: $veh_no</p>";
            echo "<p>Vehicle Status: $veh_status</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No vehicle details found</p>";
    }
    ?>
</div>

</body>
</html>