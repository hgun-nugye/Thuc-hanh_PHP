<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính chu vi, diện tích hình tròn</title>
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
        background: linear-gradient(160deg, #aeeff9, #f1c6b1);
    }

    form {
        width: 70%;
        max-width: 500px;
        background-color: white;
        padding: 30px;
        border: 2px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    h2 {
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
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

    }

    input[type="number"] {
        line-height: 1.5;
        width: 70%;
    }
</style>

<body>
    <?php const PI = 3.14; ?>
    <form action="chu_vi_dien_tich_hinhtron.php" method="post">
        <h2>Diện tích và Chu vi hình tròn</h2>

        <div class="group">
            <label for="dai">Bán kính</label>
            <input type="number" name="bankinh" min="0.01" step="0.01" value="<?php if (isset($_POST['bankinh'])) {
                                                                                    echo $_POST["bankinh"];
                                                                                } ?>" required>
        </div>

        <div class="group">
            <label for="chuvi">Chu vi</label>
            <input type="number" name="chuvi" value="<?php if (isset($_POST["bankinh"])) {
                                                            echo $_POST["bankinh"] * 2 * PI;
                                                        } ?>" readonly>
        </div>

        <div class="group">
            <label for="dientich">Diện tích</label>
            <input type="number" name="dientich" value="<?php if (isset($_POST["bankinh"])) {
                                                            echo $_POST["bankinh"] ** 2 * PI;
                                                        } ?>" readonly>
        </div>

        <input type="submit" value="Submit">

    </form>
</body>

</html>