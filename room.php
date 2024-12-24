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


$sql_room = "SELECT
                RA.Room_no AS room_no,
                R.floors AS floors,
                R.room_type AS room_type,
                RS.days AS days
            FROM Rooms_Alloted RA
            JOIN Rooms R ON RA.Room_no = R.Room_no
            LEFT JOIN Room_service RS ON RA.Room_no = RS.Room_no
            WHERE RA.userID = $userID";
$result_room = mysqli_query($conn, $sql_room);

if (mysqli_num_rows($result_room) == 1) {
    $row_room = mysqli_fetch_assoc($result_room);
    
    $room_no = $row_room['room_no'];
    $floors = $row_room['floors'];
    $room_type = $row_room['room_type'];
    $days = $row_room['days'];
} else {
    
    $error_message = "Room details not found";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Room Details</title>
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
    }

    .room-allotment {
      margin: 2vw auto; 
      padding: 2vw;
      background: linear-gradient(45deg,#ffb6c1,#f2f2f2,#fff);
      border-radius: 5px;
      border-color: #1a0101;
      max-width: 90%; 
    }

    .room-allotment h1 {
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
      font-size: 30px; 
    }

    table th {
      background-color: #7a7474;
    }

    table tbody tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    @media screen and (max-width: 768px) {
      .container {
        padding: 5vw;
      }

      .room-allotment {
        padding: 5vw;
        max-width: 100%;
      }

      .room-allotment h1 {
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
    <div class="room-allotment">
            <h3>Room Details</h3>
            <?php if (isset($error_message)) { ?>
                <p><?php echo $error_message; ?></p>
            <?php } else { ?>
                <p>Room No.: <?php echo $room_no; ?></p>
                <p>Floor: <?php echo $floors; ?></p>
                <p>Room Type: <?php echo $room_type; ?></p>
                <p>Service Day: <?php echo $days; ?></p>
            <?php } ?>
    </div>
</div>

</body>
</html>