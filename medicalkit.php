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


$sql_medical = "SELECT p.pid, p.mid, p.userID, p.dates, p.quantity, m.m_name
                FROM possess p
                INNER JOIN medical_kit m ON p.mid = m.mid
                WHERE p.userID = '$userID'";
$result_medical = mysqli_query($conn, $sql_medical);

if ($result_medical && mysqli_num_rows($result_medical) > 0) {
    $medical_details = array();
    while ($row_medical = mysqli_fetch_assoc($result_medical)) {
        $medical_details[] = $row_medical;
    }
} else {
    
    $error_message = "Medical details not found";
}


mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Medical Details</title>
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

    .medical-allotment {
      margin: 2vw auto; 
      padding: 2vw;
      background: linear-gradient(45deg, #FFB6C1, #f2f2f2, #fff); 
      border-radius: 5px;
      border-color: #1a0101;
      background-size: 20px;
      max-width: 90%; 
    }

    .medical-allotment h1 {
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
      color: #070707;
    }

    table th {
      background-color:#e53939 ;
    }

    table tbody tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    @media screen and (max-width: 768px) {
      .container {
        padding: 5vw;
      }

      .medical-allotment {
        padding: 5vw;
        max-width: 100%; 
      }

      .medical-allotment h1 {
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
    <div class="medical-allotment">
            <h3>Medical Details</h3>
            <?php if (isset($error_message)) { ?>
                <p><?php echo $error_message; ?></p>
            <?php } else { ?>
                <table>
                    <tr>
                        <th>UserID</th>
                        <th>PID</th>
                        <th>MID</th>
                        <th>Medicine Name</th>
                        <th>Issue Date</th>
                        <th>Quantity</th>
                    </tr>
                    <?php foreach ($medical_details as $medical) { ?>
                        <tr>
                            <td><?php echo $medical['userID']; ?></td>
                            <td><?php echo $medical['pid']; ?></td>
                            <td><?php echo $medical['mid']; ?></td>
                            <td><?php echo $medical['m_name']; ?></td>
                            <td><?php echo $medical['dates']; ?></td>
                            <td><?php echo $medical['quantity']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
    </div>
</div>

</body>
</html>