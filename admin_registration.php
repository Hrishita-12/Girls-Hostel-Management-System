<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 100;
            padding: 100;
            background-image: url('admin.jpeg'); 
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat; 
        }
        .container {
            width: 30%;
            margin: 100px auto;
            background-color: rgba(139, 113, 113, 0.8); 
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            border: 5px solid black; 
        }
        h2 {
            text-align: center;
        }
        .input-group {
            margin-bottom: 20px;
        }
        .input-group label {
            display: block;
            margin-bottom: 5px;
        }
        .input-group input {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #686464;
        }
        .btn-container {
            text-align: center;
        }
        .btn {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #0e0f0f;
            color: #e6e2e2;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #0c0d0d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Registration</h2>
        <form id="loginForm" action="register.php" method="post">
            <div class="input-group">
                <label for="admin_id">Admin ID:</label>
                <input type="text" id="admin_id" name="admin_id" required>
            </div>
            <div class="input-group">
                <label for="pass">Password:</label>
                <input type="password" id="pass" name="pass" required>
            </div>
            <div class="btn-container">
                <button type="button" onclick="validateLoginForm()" class="btn">Login</button>
            </div>
        </form>
    </div>

    <script>
        function validateLoginForm() {
            var admin_id = document.getElementById("admin_id").value;
            var pass = document.getElementById("pass").value;

            
            if (admin_id === "admin@gmail.com" && pass === "admin123") {
                
                document.getElementById("loginForm").submit();
            } else {
               
                alert("Invalid admin ID or password.");
            }
        }
    </script>
</body>
</html>