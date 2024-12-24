<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Complaint Form</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background:linear-gradient(45deg,#b0e0e6,#f5f5f5,#fff);
    }

    .container {
        width: 50%;
        margin: 50px auto;
        padding: 20px;
        border: 2px solid black;
        border-radius: 5px;
        background-color: #fff; 
    }

    label {
        font-weight: bold;
    }

    input[type="text"], select, textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 2px solid #ccc;
        border-radius: 5px;
    }

    button {
        padding: 10px 20px;
        background-color: #CBC3E3;
        color: black;
        border: 2px black solid;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #CBC3E3;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Complaint Form</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="form-group">
            <label for="type_id">Complaint Type:</label>
            <select id="type_id" name="type_id" required>
                <option value="">Select Complaint Type</option>
                <?php
                
                $servername = "localhost:3307";
                $username = "root";
                $password = "";
                $database = "girls";

                $conn = mysqli_connect($servername, $username, $password, $database);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $sql = "SELECT * FROM Complain_Register";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['type_id'] . "'>" . $row['type_name'] . "</option>";
                    }
                }
                mysqli_close($conn);
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="dates">Date:</label>
            <input type="date" id="dates" name="dates" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>
        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userID = isset($_POST['userID']) ? $_POST['userID'] : '';
            $type_id = $_POST['type_id'];
            $dates = $_POST['dates'];
            $description = $_POST['description'];

            
            if (!is_numeric($userID)) {
                die("Error: Invalid userID.");
            }

            $servername = "localhost:3307";
            $username = "root";
            $password = "";
            $database = "girls";

            $conn = mysqli_connect($servername, $username, $password, $database);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "INSERT INTO complaint (userID, type_id, dates, description) VALUES ('$userID', '$type_id', '$dates', '$description')";

            if (mysqli_query($conn, $sql)) {
                echo "<div>Complaint submitted successfully!</div>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
        }
        ?>
        <input type="hidden" name="userID" value="<?php echo isset($_GET['userID']) ? $_GET['userID'] : ''; ?>">
        <button type="submit">Submit Complaint</button>
    </form>
</div>

</body>
</html>