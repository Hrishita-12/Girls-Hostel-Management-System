<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$database = "girls";
$conn = mysqli_connect($servername, $username, $password, $database);  




if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];

    
    $check_sql = "SELECT * FROM laundary_service WHERE userID = $userID";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userID = $_POST['userID'];
            $cloth_no = $_POST['cloth_no'];

            
            $update_sql = "UPDATE laundary_service SET cloth_no='$cloth_no' WHERE userID='$userID'";

            if ($conn->query($update_sql) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }

        $row = $check_result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Laundry Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
        }

        form {
            width: 300px;
            margin: 0 auto;
            text-align: center;
        }

        input[type="text"], select {
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
    <h1>Update Laundry Details for User ID: <?php echo $userID; ?></h1>
    <form action="" method="post">
        <input type="hidden" name="userID" value="<?php echo $row['userID']; ?>">
        Cloth_no.: <input type="text" name="cloth_no" value="<?php echo $row['cloth_no']; ?>"><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
<?php
    } else {
        echo "User ID $userID has not taken Laundry Service";
    }
}


if ($check_result->num_rows == 0) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Insert Laundry Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
        }

        form {
            width: 300px;
            margin: 0 auto;
            text-align: center;
            border:5px solid black;
        }

        input[type="text"], select {
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
            border:3px solid black;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Insert Laundry Service for User ID: <?php echo $userID; ?></h1>
    <form action="laundaryinsert.php" method="post">
        <input type="hidden" name="userID" value="<?php echo $userID; ?>">
        Emp ID: 
        <select name="eid">
            <option value="6">6</option>
            <option value="8">8</option>
        </select><br>
        Cloth_no.: <input type="text" name="cloth_no"><br>
        Visiting Day: 
        <select name="visiting_day">
            <option value="Monday">Monday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Saturday">Saturday</option>
        </select><br>
        Returning Day: 
        <select name="returning_day">
            <option value="Monday">Monday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Saturday">Saturday</option>
        </select><br>
        <input type="submit" value="Insert">
    </form>
</body>
</html>
<?php
}

$conn->close();
?>