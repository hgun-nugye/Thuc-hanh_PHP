<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả thi Đại học</title>
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
        background: linear-gradient(160deg, #c8d4f5, #ffece0);
    }

    form {
        width: 80%;
        max-width: 700px;
        background-color: white;
        padding: 30px;
        border: 2px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    h2 {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
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

    input[type="number"],
    input[type="text"] {
        line-height: 2;
        width: 70%;
    }
</style>

<body>
    <form action="ket_qua_thi_DH.php" method="post">
        <h2>Kết quả thi Đại học </h2>

        <div class="group">
            <label for="toan">Toán</label>
            <input type="number" name="toan" min="0" max="10" step="0.01" value="<?php if (isset($_POST['toan'])) {
                                                                                        echo $_POST["toan"];
                                                                                    } ?>" required>
        </div>

        <div class="group">
            <label for="ly">Lý</label>
            <input type="number" name="ly" min="0" max="10" step="0.01" value="<?php if (isset($_POST['ly'])) {
                                                                                    echo $_POST["ly"];
                                                                                } ?>" required>
        </div>

        <div class="group">
            <label for="hoa">Hóa</label>
            <input type="number" name="hoa" min="0" max="10" step="0.01" value="<?php if (isset($_POST['hoa'])) {
                                                                                    echo $_POST["hoa"];
                                                                                } ?>" required>
        </div>

        <div class="group">
            <label for="chuan">Điểm chuẩn</label>
            <input style="color:red; font-weight:bold"
                type="number" name="chuan" min="0" step="0.01" max="30" value="<?php if (isset($_POST['chuan'])) {
                                                                                    $chuan = $_POST["chuan"];
                                                                                    echo $chuan;
                                                                                } ?>" required>
        </div>

        <div class="group">
            <label for="tong">Tổng điểm</label>
            <input style="color:blue; font-weight:bold" type="number" name="tong" value="<?php if ((isset($_POST["toan"])) && isset($_POST["ly"]) && isset($_POST["hoa"])) {
                                                                                                $toan = $_POST["toan"];
                                                                                                $ly = $_POST["ly"];
                                                                                                $hoa = $_POST["hoa"];
                                                                                                $tong = $toan + $ly + $hoa;

                                                                                                echo $tong;
                                                                                            } ?>" readonly>
        </div>

        <div class="group">
            <label for="ketqua">Kết quả thi</label>
            <input style="color:green; font-weight:bold" type="text" name="ketqua" value="<?php if ((isset($_POST["toan"])) && isset($_POST["ly"]) && isset($_POST["hoa"]) && (isset($_POST["tong"]))) {
                                                                                                if ($toan > 0 && $ly > 0 && $hoa > 0 && $tong >= $chuan) {
                                                                                                    echo "Đậu";
                                                                                                } else echo "Rớt";
                                                                                            } ?>" readonly>
        </div>

        <input type="submit" value="Submit">

    </form>
</body>

</html>