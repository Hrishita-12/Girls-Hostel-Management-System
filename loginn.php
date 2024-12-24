<?php
session_start();


if (isset($_SESSION['userID'])) {
    header("Location: dashh.php");
    exit();
}

$hostname = "localhost:3307";
$dbuser = "root";
$dbPass = "";
$dbName = "girls";
$conn = mysqli_connect($hostname, $dbuser, $dbPass, $dbName);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userID = mysqli_real_escape_string($conn, $username);
    $s_password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM students WHERE userID = '$userID' AND s_password = '$s_password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['userID'] = $userID;
        header("Location: dashh.php");
        exit();
    } else {
        $error_message = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Girl's Hostel Management</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      
      background: linear-gradient(45deg,#00008B,white,#B0E0E6);
    }

    .navbar {
      padding: 10px;
      color: black;
      
      background-color:transparent;
      border: 0px;
    }

    .login-link {
      position: absolute;
      top: 10px;
      right: 10px;
      padding: 5px 10px;
      border: 1px solid black; 
      border-radius: 5px;
      background-color: #fff; 
      color: black; 
      text-decoration: none;
    }

    .login-link:hover {
      background-color: #007bff; 
      color: #fff; 
    }

    .login-link-container {
      text-align: right;
      
    }

    .wrapper {
      max-width: 400px;
      margin: 50px auto;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.8); 
      border-radius: 8px;
      border: 2px solid black;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .wrapper{
        width: 100vh;
        height: 100vh;
       
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    .input-box {
      margin-bottom: 20px;
    }

    .input-box input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      outline: none;
      font-size: 16px;
    }

    .input-box i {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: #666;
    }

    .btn {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: #007bff;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
    }
    

    .btn:hover {
      background-color: #0056b3;
    }

    .error-message {
      color: red;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

<div class="navbar">
    
    <div class="login-link-container">
      <a href="login.php" class="login-link">Go to Login Page</a>
    </div>
</div>

<div class="wrapper">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <h1>Login</h1>
      <?php if(isset($error_message)) { ?>
          <p style="color: red;"><?php echo $error_message; ?></p>
      <?php } ?>
      <div class="input-box">
        <input type="text" name="username" placeholder="UserID" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="password" name="password" placeholder="Password" required>
        <i class='bx bxs-lock-alt'></i>
      </div>
      <button type="submit" class="btn">Login</button>
    </form>
</div>

</body>
</html>