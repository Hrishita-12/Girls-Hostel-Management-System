<?php
$servername ="localhost:3307";
$username = "root";
$password = "";
$Database = "girls";
$conn = mysqli_connect($servername, $username, $password, $Database );  

if(isset($_GET['userID'])) {
    $userID = $_GET['userID'];

    
    $sql = "SELECT * FROM students WHERE userID = $userID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userID = $_POST['userID'];
            $name = $_POST['name'];
            $age = $_POST['age'];
            $address = $_POST['address'];
            $phoneNO = $_POST['phoneNo'];
            $DOB = $_POST['DOB'];
            $email = $_POST['email'];
            $joining_yr = $_POST['joining_yr'];
            $programme = $_POST['programme'];
            $aadhar_no = $_POST['aadhar_no'];

            $update_sql = "UPDATE students SET name='$name', age='$age', address='$address', phoneNo='$phoneNO', DOB = '$DOB', email='$email', joining_yr='$joining_yr', programme='$programme', aadhar_no='$aadhar_no' WHERE userID='$userID'";

            if ($conn->query($update_sql) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }

        $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Student Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(45deg,#00008B,white,#B0E0E6);
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Update Student Details</h1>
    <form action="" method="post">
        <input type="hidden" name="userID" value="<?php echo $row['userID']; ?>">
        Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
        Age: <input type="text" name="age" value="<?php echo $row['age']; ?>"><br>
        Address: <input type="text" name="address" value="<?php echo $row['address']; ?>"><br>
        PhoneNo: <input type="text" name="phoneNo" value="<?php echo $row['phoneNo']; ?>"><br>
        DOB: <input type="text" name="DOB" value="<?php echo $row['DOB']; ?>"><br>
        Email: <input type="email" name="email" value="<?php echo $row['email']; ?>"><br>
        Joining_year: <input type="text" name="joining_yr" value="<?php echo $row['joining_yr']; ?>"><br>
        Programme: <input type="text" name="programme" value="<?php echo $row['programme']; ?>"><br>
        Aadhar_No.: <input type="text" name="aadhar_no" value="<?php echo $row['aadhar_no']; ?>"><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>

<?php
    } else {
        echo "No student found with ID: $userID";
    }
} else {
    
    header("Location: select_user.php");
}
$conn->close();
?>