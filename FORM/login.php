<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            font-size: 30px;
        }

        body {
            margin: 0;
            background-color: #f2f4f7;

            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            width: 400px;
            background-color: white;

            padding: 30px;
            border-radius: 10px;

            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        h1 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 30px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            outline: none;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            background-color: #007bff;
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0167d5;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            font-size: 17px;
            font-weight: bold;
        }

        .success {
            color: red;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .error {
            color: green;
        }
    </style>
</head>

<body>

    <div class="card">
        <h1>Login</h1>
        <form action="Login.php" method="post">

            <div class="form-group">
                <label for="u-name">Username</label>
                <input type="text" name="u-name" id="u-name" placeholder="Enter username">
            </div>

            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" name="pass" id="pass" placeholder="Enter password">
            </div>

            <input type="submit" value="Login">

        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $name = $_POST["u-name"] ?? "";
            $pass = $_POST["pass"] ?? "";

            if ($name === "admin" && $pass === "12345") {
                echo "<div class='message success'>Welcome, admin!</div>";
            } elseif ($name !== "admin") {
                echo "<div class='message error'>Wrong username</div>";
            } elseif ($pass !== "12345") {
                echo "<div class='message error'>Wrong password</div>";
            }
        }
        ?>

    </div>

</body>

</html>