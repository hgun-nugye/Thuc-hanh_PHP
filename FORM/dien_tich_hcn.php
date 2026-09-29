<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính diện tích hình chữ nhật</title>
</head>
<style>
    body {
        width: 100%;
        height: 100vh;
        margin: 20px;
        font-size: 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(160deg, #f2e7b3, #9aea9b);
    }

    form {
        width: 60%;
        max-width: 500px;
        background-color: white;
        padding: 30px;
        border: 2px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    h2 {
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        color: #a2560a;
        text-align: center;
    }

    .group {
        margin-bottom: 20px;
        width: 100%;
        display: flex;
        align-items: center;
    }

    label {
        display: inline-block;
        width: 30%;
        font-weight: bold;
    }

    input[type="submit"] {
        width: 100px;
        padding: 10px;
        border: none;
        border-radius: 6px;
        background-color: #008924;
        color: white;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        display: block;
        margin: auto;
        margin-bottom: 20px;

    }

    input[type="number"] {
        line-height: 2;
        width: 70%;
    }
</style>

<body>
    <form action="dien_tich_hcn.php" method="post">
        <h2>Diện tích hình chữ nhật</h2>

        <div class="group">
            <label for="dai">Chiều dài</label>
            <input type="number" name="dai" min="0.01" step="0.01" value="<?php if (isset($_POST['dai'])) {
                                                                                echo $_POST["dai"];
                                                                            } ?>" required>
        </div>

        <div class="group">
            <label for="rong">Chiều rộng</label>
            <input type="number" name="rong" min="0.01" step="0.01" value="<?php if (isset($_POST['rong'])) {
                                                                                echo $_POST["rong"];
                                                                            } ?>" required>
        </div>

        <div class="group">
            <label for="dientich">Diện tích</label>
            <input type="number" name="dientich" value="<?php if (isset($_POST["dai"]) && isset($_POST["rong"])) {
                                                            echo $_POST["dai"] * $_POST["rong"];
                                                        } ?>" readonly>
        </div>

        <input type="submit" value="Submit">

    </form>
</body>

</html>