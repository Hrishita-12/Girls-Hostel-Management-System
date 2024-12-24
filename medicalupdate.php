<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$database = "girls";
$conn = mysqli_connect($servername, $username, $password, $database);  

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "<br>Connected successfully<br>"; 
}


if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userID = $_POST['userID'];
        $mid = $_POST['mid'];
        $dates = $_POST['dates'];
        $quantity = $_POST['quantity'];

        $update_sql = "INSERT INTO possess (userID, dates, mid, quantity) 
                       VALUES ('$userID', '$dates', '$mid', '$quantity')";

        if ($conn->query($update_sql) === TRUE) {
            echo "Record inserted successfully";
        } else {
            echo "Error inserting record: " . $conn->error;
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Insert Medical Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            text-align: center;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Insert Medical Record for User ID: <?php echo $userID; ?></h1>
        <form action="" method="post">
            <input type="hidden" name="userID" value="<?php echo $userID; ?>">
            Medicalkit ID: <input type="text" name="mid"><br>
            Issued on date: <input type="date" name="dates"><br>
            Quantity: <input type="text" name="quantity"><br>
            <input type="submit" value="Insert">
        </form>
    </div>
</body>
</html>
<?php
}
?>