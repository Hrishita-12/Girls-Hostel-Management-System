<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$database = "girls";
$conn = mysqli_connect($servername, $username, $password, $database);


if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];
    $check_sql = "SELECT Room_no FROM Rooms_Alloted WHERE userID = $userID";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        $row = $check_result->fetch_assoc();
        $allocated_room = $row['Room_no'];
        echo "User ID $userID is already allocated Room No. $allocated_room.";
    } else {
        $unoccupied_rooms_sql = "SELECT Room_no FROM Rooms WHERE Room_no NOT IN (SELECT Room_no FROM Rooms_Alloted)";
        $unoccupied_rooms_result = $conn->query($unoccupied_rooms_sql);

        if ($unoccupied_rooms_result->num_rows > 0) {
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Allocate Room</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background:linear-gradient(45deg,#b0e0e6,#f5f5f5,#fff);
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
                        border: 3px solid black;
                        border-radius: 4px;
                        box-sizing: border-box;
                    }

                    input[type="submit"] {
                        background-color: #CBC3E3;
                        color: black;
                        padding: 14px 20px;
                        margin: 8px 0;
                        border: 2px solid black;
                        border-radius: 4px;
                        cursor: pointer;
                        width: 100%;
                    }

                    input[type="submit"]:hover {
                        background-color: #CBC3E3;
                    }
                </style>
            </head>
            <body>
                <h1>Allocate Room for User ID: <?php echo $userID; ?></h1>
                <form action="roominsert.php" method="post">
                    <input type="hidden" name="userID" value="<?php echo $userID; ?>">
                    <label for="room_no">Select Room:</label>
                    <select name="room_no" id="room_no">
                        <?php
                        while ($row = $unoccupied_rooms_result->fetch_assoc()) {
                            echo "<option value='" . $row['Room_no'] . "'>" . $row['Room_no'] . "</option>";
                        }
                        ?>
                    </select><br>
                    <input type="submit" value="Allocate Room">
                </form>
            </body>
            </html>
            <?php
        } else {
            echo "No unoccupied rooms available.";
        }
    }
}

$conn->close(); 
?>