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


$sql_mess = "SELECT * FROM opted WHERE userID = '$userID'";
$result_mess = mysqli_query($conn, $sql_mess);

if (mysqli_num_rows($result_mess) == 1) {
    $row_mess = mysqli_fetch_assoc($result_mess);
    
    $userID = $row_mess['userID'];
    $mess_id = $row_mess['mess_id'];
    $mess_fee_status = $row_mess['mess_fee_status'];
} else {
    $error_message = "Mess details not found";
}




mysqli_close($conn);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mess Details</title>
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
      padding: 0vw; 
    }
    .wrapper{
      width:100vh;
      height:100vh;
    }

    .mess-allotment {
      margin: 2vw auto; 
      padding: 2vw;
      background: linear-gradient(45deg,#ffb6c1,#f2f2f2,#fff); 
      border-radius: 5px;
      border-color: #1a0101;
      max-width: 90%; 
    }

    .mess-allotment h1 {
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

      .mess-allotment {
        padding: 5vw;
        max-width: 100%; 
      }

      .mess-allotment h1 {
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
    <div class="mess-allotment">
            <h3>Mess Details</h3>
            <p>User ID: <?php echo $userID; ?></p>
            <p>Mess ID: <?php echo $mess_id; ?></p>
            <p>Paid Status: <?php echo $mess_fee_status; ?></p>
    </div>
</div>

</body>
</html>