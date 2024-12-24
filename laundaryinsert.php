<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$database = "girls";
$conn = mysqli_connect($servername, $username, $password, $database);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_POST['userID'];
    $eid = $_POST['eid'];
    $cloth_no = $_POST['cloth_no'];
    $visiting_day = $_POST['visiting_day'];
    $returning_day = $_POST['returning_day'];

    
    $insert_sql_l = "INSERT INTO laundary_service (userID, eid, cloth_no, visiting_day, returning_day) 
                     VALUES ('$userID', '$eid', '$cloth_no', '$visiting_day', '$returning_day')";

    if ($conn->query($insert_sql_l) === TRUE) {
        echo "Laundry service added successfully";
    } else {
        echo "Error adding laundry service: " . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Laundry Service</title>
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
            border:5px solid black;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            text-align: center;
            border:3px solid black;
            display:inline-block;
            padding:10px;
            border-radius:5px;
        }

        input[type="text"] {
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
    <h1>Add Laundry Service</h1>
    <form action="" method="post">
        <input type="hidden" name="userID" value="<?php echo isset($_POST['userID']) ? $_POST['userID'] : ''; ?>">
        Emp ID: <input type="text" name="eid"><br>
        Cloth_no.: <input type="text" name="cloth_no"><br>
        Visiting Day: <input type="text" name="visiting_day"><br>
        Returning Day: <input type="text" name="returning_day"><br>
        <input type="submit" value="Insert">
    </form>
</div>
</body>
</html>