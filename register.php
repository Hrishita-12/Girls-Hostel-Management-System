<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Registration Form</title>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image: url('rimage2.jpeg');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center; 
}
.container {
    width: 80%;
    max-width: 600px;
    margin: 100px auto;
    background-color: rgba(235, 221, 221, 0.8);
    padding: 20px;
    border-radius: 10px;
}
h2 {
    text-align: center;
}
.form-group {
    margin-bottom: 20px;
}
label {
    display: block;
    font-weight: bold;
}
input[type="text"],
input[type="number"],
input[type="email"],
input[type="tel"],
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #514e4e;
    border-radius: 5px;
}
input[type="date"] {
    width: calc(100% - 22px); 
    padding: 10px;
    border: 1px solid #554848;
    border-radius: 5px;
}
button {
    width: 100%;
    padding: 10px;
    background-color: #0d1f32;
    border: none;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
}
button:hover {
    background-color: #b6c9de;
}
.warning {
    color: red;
    font-size: 0.8em;
}
</style>
</head>
<body>
<div class="navbar">
    
    <h3><button onclick="update()" style="position: absolute; top: 20px; right: 20px; width:100px; padding:10px; background-color: #CBC3E3; color:black; ">Update</button></h3>
    <button onclick="viewAllData()" style="position: absolute; top: 20px; right: 140px; width:100px; padding:10px; background-color: #CBC3E3; color:black; ">View All Data</button>
    <button onclick="viewcomplain()" style="position: absolute; top: 20px; right: 260px; width:100px; padding:10px; background-color: #CBC3E3; color:black; ">View complain</button>

</div>
<div class="container">
    <h2>Registration Form</h2>
    <form action="#" method="POST" id="registrationForm" onsubmit="return validateForm()">
        <div class="form-group">
            <label for="userID">Student ID:</label>
            <input type="text" id="userID" name="userID" required />
        </div>
        <div class="form-group">
            <label for="name">Student Name:</label>
            <input type="text" id="name" name="name" required />
        </div>
        <div class="form-group">
            <label for="age">Student Age:</label>
            <input type="number" id="age" name="age" required />
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required />
        </div>
        <div class="form-group">
            <label for="phoneNo">Phone Number:</label>
            <input type="tel" id="phoneNo" name="phoneNo" required />
            <span id="phoneWarning" class="warning"></span>
        </div>
        <div class="form-group">
            <label for="DOB">Date of Birth:</label>
            <input type="date" id="DOB" name="DOB" required />
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required />
        </div>
        <div class="form-group">
            <label for="joining_yr">Joining Year:</label>
            <input type="text" id="joining_yr" name="joining_yr" required />
        </div>
        <div class="form-group">
            <label for="programme">Programme:</label>
            <select id="programme" name="programme" required>
                <option value="">Select Programme</option>
                <option value="B.Tech">B.Tech</option>
                <option value="M.Tech">M.Tech</option>
                <option value="Ph.D">Ph.D</option>
            </select>
        </div>
        <div class="form-group">
            <label for="aadhar_no">Aadhar Number:</label>
            <input type="text" id="aadhar_no" name="aadhar_no" required />
            <span id="aadharWarning" class="warning"></span>
        </div>
        <div class="form-group">
            <label for="s_password">Create Password:</label>
            <input type="password" id="s_password" name="s_password" required />
        </div>
        <button type="submit" class="btn">Submit</button>
    </form>
</div>

<?php
$success = false; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        isset($_POST['userID']) && isset($_POST['name']) && isset($_POST['age']) &&
        isset($_POST['address']) && isset($_POST['phoneNo']) && isset($_POST['DOB']) &&
        isset($_POST['email']) && isset($_POST['joining_yr']) && isset($_POST['programme']) &&
        isset($_POST['aadhar_no']) && isset($_POST['s_password'])
    ) {
        $userID = $_POST['userID'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $address = $_POST['address'];
        $phoneNo = $_POST['phoneNo'];
        $DOB = $_POST['DOB'];
        $email = $_POST['email'];
        $joining_yr = $_POST['joining_yr'];
        $programme = $_POST['programme'];
        $aadhar_no = $_POST['aadhar_no'];
        $s_password = $_POST['s_password'];

        $servername = "localhost:3307";
        $username = "root";
        $password = "";
        $Database = "girls";
        $conn = mysqli_connect($servername, $username, $password, $Database);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        } else {
            $sql = "INSERT INTO students (userID, name, age, address, phoneNo, DOB, email, joining_yr, programme, aadhar_no, s_password) VALUES ('$userID', '$name', '$age', '$address', '$phoneNo', '$DOB', '$email', '$joining_yr', '$programme', '$aadhar_no','$s_password')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $success = true; 
            }
        }
    }
}
?>


<?php if ($success) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You have been registered successfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
<?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST') : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Registration failed. Please try again.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
<?php endif; ?>

<script>
function update() {
    
    window.location.href = "profileupdate.php";
}
function viewAllData() {
    
    window.location.href = "alldata.php";
}
function viewcomplain() {
    
    window.location.href = "view_complain.php";
}

function validateForm() {
    var phoneNo = document.getElementById("phoneNo").value;
    var aadharNo = document.getElementById("aadhar_no").value;

   
    if (phoneNo.length !== 10) {
        document.getElementById("phoneWarning").innerText = "Phone number should be 10 digits.";
        return false;
    } else {
        document.getElementById("phoneWarning").innerText = "";
    }

   
    if (aadharNo.length !== 12) {
        document.getElementById("aadharWarning").innerText = "Aadhar number should be 12 digits.";
        return false;
    } else {
        document.getElementById("aadharWarning").innerText = "";
    }

    return true;
}
</script>
</body>
</html>
