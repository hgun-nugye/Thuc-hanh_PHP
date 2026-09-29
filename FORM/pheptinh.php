<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phép tính</title>
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
        background: linear-gradient(70deg, #b7edac, #eef1b1);
    }

    form {
        width: 80%;
        max-width: 800px;
        background-color: white;
        padding: 30px;
        border: 2px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    h2 {
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        color: #154cd8;
        text-align: center;
        margin-bottom: 40px;
    }

    .group {
        margin-bottom: 20px;
        width: 100%;
        display: flex;
        align-items: center;

    }


    .group>label {
        display: inline-block;
        width: 30%;
        font-weight: bold;
        text-align: right;
        margin-right: 10px;

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

    input[type="number"],
    input[type="text"] {
        line-height: 2;
        width: 70%;
    }

    .group-radio>label:first-child {
        width: 30%;
        flex-shrink: 0;
        text-align: right;
        margin-right: 10px;
    }

    .radio-options {
        width: 70%;
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .radio-options label {
        width: auto;
        margin: 0;
        font-weight: normal;
        cursor: pointer;
        white-space: nowrap;
    }
</style>

<body>
    <?php
    $so1 = $_POST['so1'] ?? '';
    $so2 = $_POST['so2'] ?? '';
    $pheptinh = $_POST['pheptinh'] ?? '';
    ?>
    <form action="ket_qua_phep_tinh.php" method="post">
        <h2>PHÉP TÍNH TRÊN HAI SỐ</h2>

        <div class="group group-radio">
            <label for="pheptinh">Chọn phép tính</label>
            <div class="radio-options">
                <label><input type="radio" name="pheptinh" value="cong" required> Cộng</label>
                <label><input type="radio" name="pheptinh" value="tru" required> Trừ</label>
                <label><input type="radio" name="pheptinh" value="nhan" required> Nhân</label>
                <label><input type="radio" name="pheptinh" value="chia" required> Chia</label>
            </div>

        </div>

        <div class="group">
            <label for="so1">Số thứ nhất</label>
            <input type="number" name="so1" step="0.01" value="<?php if (isset($_POST['so1'])) {
                                                                    echo $_POST["so1"];
                                                                } ?>" required>
        </div>

        <div class="group">
            <label for="so2">Số thứ hai</label>
            <input type="number" name="so2" step="0.01" value="<?php if (isset($_POST['so2'])) {
                                                                    echo $_POST["so2"];
                                                                } ?>" required>
        </div>

        <input type="submit" value="Submit">
    </form>
</body>

</html>