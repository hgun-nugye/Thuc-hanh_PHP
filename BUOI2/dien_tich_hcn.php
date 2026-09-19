<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính diện tích hình chữ nhật</title>
</head>
<style>
    body {
        margin: 20px;
        font-size: 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        justify-content: center;
        width: full;
    }

    .group {
        margin-bottom: 20px;
        width: 100%;

    }

    label {
        display: inline-block;
        width: 120px;
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

    }

    input[type="number"] {
        line-height: 1.5;
    }
</style>

<body>
    <form action="Shcn.php" method="post">
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