<!DOCTYPE html>
<html>
<head>
    <title>Select User</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #B0E0E6; 
            color: white; 
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
            color: black; 
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            border:5px solid black;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid black;
            border-radius: 5px;
            margin-bottom: 20px;
            box-sizing: border-box;
            font size: 2px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: 2px solid black;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
            font-size: 3px;
        }
    </style>
</head>
<body>
    <h1>Select User</h1>
    <form action="view_user.php" method="get">
        <label for="userID">Enter UserID:</label>
        <input type="text" id="userID" name="userID" placeholder="Enter UserID" required>
        <input type="submit" value="Update">
    </form>
</body>
</html>