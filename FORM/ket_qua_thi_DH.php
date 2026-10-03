<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả thi Đại học</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            width: 100%;
            min-height: 100vh;
            margin: 0;
            font-size: 18px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(160deg, #c8d4f5, #ffece0);
        }

        form {
            width: 450px;
            max-width: 95%;
            background-color: #ffd6f9;
            border: 1px solid #dcdcdc;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            font-style: italic;
            color: #ffffff;
            text-align: center;
            text-transform: uppercase;
            font-size: 20px;
            background-color: #e6539d;
            padding: 12px;
            margin: 0 0 15px 0;
            font-weight: bold;
        }

        .group {
            padding: 4px 20px;
            display: flex;
            align-items: center;
            margin-bottom: 6px;
        }

        label {
            width: 35%;
            color: #333;
            font-size: 16px;
            flex-shrink: 0;
        }

        input[type="text"] {
            width: 65%;
            min-width: 0;
            padding: 4px 6px;
            border: 1px solid #a9a9a9;
            font-size: 16px;
            outline: none;
            background-color: #ffffff;
        }

        .input-chuan {
            color: red;
        }

        .input-result {
            background-color: #fff8da !important;
        }

        input[type="submit"] {
            width: 110px;
            padding: 4px 10px;
            background-color: #e1e1e1;
            border: 1px solid #767676;
            font-size: 15px;
            cursor: pointer;
            display: block;
            margin: 10px auto 15px auto;
            border-radius: 2px;
        }

        input[type="submit"]:hover {
            background-color: #d4d4d4;
        }

        .error {
            color: red;
            text-align: center;
            font-weight: bold;
            margin: 10px;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <?php
    $toan = $_POST["toan"] ?? "";
    $ly = $_POST["ly"] ?? "";
    $hoa = $_POST["hoa"] ?? "";
    $chuan = $_POST["chuan"] ?? "";

    $tong = "";
    $ketqua = "";
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (
            trim($toan) === "" ||
            trim($ly) === "" ||
            trim($hoa) === "" ||
            trim($chuan) === ""
        ) {
            $error = "Vui lòng nhập đầy đủ thông tin";
        } elseif (
            !is_numeric($toan) ||
            !is_numeric($ly) ||
            !is_numeric($hoa) ||
            !is_numeric($chuan)
        ) {
            $error = "Điểm phải là số";
        } elseif (
            $toan < 0 || $toan > 10 ||
            $ly < 0 || $ly > 10 ||
            $hoa < 0 || $hoa > 10
        ) {
            $error = "Điểm Toán, Lý, Hóa phải từ 0 đến 10";
        } elseif ($chuan < 0 || $chuan > 30) {
            $error = "Điểm chuẩn phải từ 0 đến 30";
        } else {
            $toan = (float) $toan;
            $ly = (float) $ly;
            $hoa = (float) $hoa;
            $chuan = (float) $chuan;

            $tong = $toan + $ly + $hoa;

            if ($tong >= $chuan && $toan > 0 && $ly > 0 && $hoa > 0) {
                $ketqua = "Đậu";
            } else {
                $ketqua = "Rớt";
            }
        }
    }
    ?>

    <form action="" method="post">

        <h2>Kết quả thi Đại học</h2>

        <?php if ($error != "") { ?>
            <div class="error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php } ?>

        <div class="group">
            <label for="toan">Toán:</label>
            <input type="text" name="toan" id="toan"
                value="<?php echo htmlspecialchars($toan); ?>" required>
        </div>

        <div class="group">
            <label for="ly">Lý:</label>
            <input type="text" name="ly" id="ly"
                value="<?php echo htmlspecialchars($ly); ?>" required>
        </div>

        <div class="group">
            <label for="hoa">Hóa:</label>
            <input type="text" name="hoa" id="hoa"
                value="<?php echo htmlspecialchars($hoa); ?>" required>
        </div>

        <div class="group">
            <label for="chuan">Điểm chuẩn:</label>
            <input type="text" class="input-chuan" name="chuan" id="chuan"
                value="<?php echo htmlspecialchars($chuan); ?>" required>
        </div>

        <div class="group">
            <label for="tong">Tổng điểm:</label>
            <input type="text" class="input-result" name="tong" id="tong"
                value="<?php echo $tong !== "" ? $tong : ""; ?>" readonly>
        </div>

        <div class="group">
            <label for="ketqua">Kết quả thi:</label>
            <input type="text" class="input-result" name="ketqua" id="ketqua"
                value="<?php echo htmlspecialchars($ketqua); ?>" readonly>
        </div>

        <input type="submit" value="Xem kết quả">

    </form>

</body>

</html>