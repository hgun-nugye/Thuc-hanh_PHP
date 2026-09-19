<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        min-height: 100vh;
        background: linear-gradient(160deg, #032574, #4e025f);
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        font-size: 14px;

    }

    .card {
        width: 600px;
        padding: 20px;
        border-radius: 10px;
        line-height: 1.5;
        background-color: white;
    }

    h2 {
        font-size: 20px;
        position: relative;
    }

    h2::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -4px;
        width: 4%;
        height: 3px;
        background: linear-gradient(90deg, #527bda, #c937ea);
        border-radius: 2px;
    }

    .grid {
        columns: 2;
        gap: 50px;
    }

    label {
        display: block;
        font-weight: bold;
    }

    .group {
        display: block;
        margin-bottom: 20px;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"] {
        width: 96%;
        padding: 4px;
        border: 1px solid #81049d;
        border-radius: 6px;
        outline: none;
        line-height: 1.5;
    }

    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="email"]:focus {
        border: 2px solid #81049d;
    }

    input[type="radio"]:checked {
        accent-color: #81049d;
    }

    input[type="submit"] {
        width: 100%;
        background: linear-gradient(160deg, #527bda, #c937ea);
        color: white;
        border: none;
        padding: 8px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .noti {
        color: #81049d;
        font-weight: bold;
        margin-bottom: 20px;
    }
</style>

<body>
    <div class="card">
        <h2>Registration</h2>
        <form action="signup.php" method="post">
            <div class="grid">
                <div class="group">
                    <label for="fname">Full Name</label>
                    <input type="text" name="fname" value="<?php if (isset($_POST['fname'])) {
                                                                echo $_POST["fname"];
                                                            } ?>" required>
                </div>

                <div class="group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="<?php if (isset($_POST['email'])) {
                                                                echo $_POST["email"];
                                                            } ?>" required>
                </div>

                <div class="group">
                    <label for="pass">Password</label>
                    <input type="password" name="pass" value="<?php if (isset($_POST['pass'])) {
                                                                    echo $_POST["pass"];
                                                                } ?>" required>
                </div>

                <div class="group">
                    <label for="uname">Username</label>
                    <input type="text" name="uname" value="<?php if (isset($_POST['uname'])) {
                                                                echo $_POST["uname"];
                                                            } ?>" required>
                </div>

                <div class="group">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" value="<?php if (isset($_POST['phone'])) {
                                                                echo $_POST["phone"];
                                                            } ?>" required>
                </div>

                <div class="group">
                    <label for="cpass">Confirm Password</label>
                    <input type="password" name="cpass" value="<?php if (isset($_POST['cpass'])) {
                                                                    echo $_POST["cpass"];
                                                                } ?>" required>
                </div>
            </div>

            <div class="noti">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $pass = isset($_POST["pass"]) ? trim($_POST["pass"]) : "";
                    $cpass = isset($_POST["cpass"]) ? trim($_POST["cpass"]) : "";

                    if ($pass != $cpass) {
                        echo "Incorrect confirm password!";
                    } elseif ($pass == $cpass) {
                        $fname = isset($_POST["fname"]) ? trim($_POST["fname"]) : "";
                        $email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
                        echo "Thanks $fname, please confirm registration in your email $email";
                    }
                }
                ?>
            </div>

            <div class="group">
                <label for="gender">Gender</label>
                <input type="radio" name="gender" value="Male"
                    <?php if (isset($_POST['gender']) && $_POST['gender'] == "Male") echo "checked"; ?> required> Male

                <input type="radio" name="gender" value="Female"
                    <?php if (isset($_POST['gender']) && $_POST['gender'] == "Female") echo "checked"; ?>> Female

                <input type="radio" name="gender" value="Prefer not to say"
                    <?php if (isset($_POST['gender']) && $_POST['gender'] == "Prefer not to say") echo "checked"; ?>> Prefer not to say

            </div>

            <input type="submit" name="Register">
        </form>
    </div>
</body>

</html>