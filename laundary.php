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


$sql_laundary = "SELECT * FROM laundary_service WHERE userID = '$userID'";
$result_laundary = mysqli_query($conn, $sql_laundary);

if (mysqli_num_rows($result_laundary) == 1) {
    $row_laundary = mysqli_fetch_assoc($result_laundary);
    
    $userID = $row_laundary['userID'];
    $eid = $row_laundary['eid'];
    $cloth_no = $row_laundary['cloth_no'];
    $visiting_day = $row_laundary['visiting_day'];
    $returning_day = $row_laundary['returning_day'];
} else {
  $error_message = "The laundry details do not exist for this user ID.";
  $userID = $eid = $cloth_no = $visiting_day = $returning_day = "N/A";
}


mysqli_close($conn);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laundry Services Records</title>
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

    .laundry-allotment {
      margin: 2vw auto; 
      padding: 2vw;
      background:linear-gradient(45deg,#b0e0e6,white,#00008b); 
      border-radius: 5px;
      border-color: #1a0101;
      max-width: 90%; 
    }

    .laundry-allotment h1 {
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

      .laundry-allotment {
        padding: 5vw;
        max-width: 100%; 
      }

      .laundry-allotment h1 {
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
    <div class="laundry-allotment">
    <?php if (isset($error_message)) { ?>
            <p><?php echo $error_message; ?></p>
        <?php } else { ?>
            <h3>Laundry Services Records</h3>
            <p>User ID: <?php echo $userID; ?></p>
            <p>Emp ID: <?php echo $eid; ?></p>
            <p>Amount of clothes: <?php echo $cloth_no; ?></p>
            <p>Visiting Day: <?php echo $visiting_day; ?></p>
            <p>Returning Day: <?php echo $returning_day; ?></p>
        <?php } ?>
    </div>
</div>

</body>
</html>