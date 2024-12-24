<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Girl's Hostel Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('rimage2.jpeg'); 
            background-size: cover; 
            background-position: center; 
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 50%;
            background-color: rgba(159, 183, 168, 0.8); 
            padding: 20px;
            border-radius: 8px;
            border: 5px solid #0d0e0f; 
            box-shadow: 10px 10px 10px 0px rgba(69, 44, 44, 0.1);
            display: flex;
            flex-direction: column;
        }
        h2 {
            text-align: center;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
        }
        .btn {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #121e2b;
            color: #b6aeae;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #233e6d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to the Login Page</h2>
        <div class="btn-container">
            <a href="loginn.php" class="btn">Student Login</a>
            <a href="admin_registration.php" class="btn">Admin Registration</a>
        </div>
    </div>
</body>
</html>