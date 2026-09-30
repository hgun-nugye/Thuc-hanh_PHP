<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xử lý mảng</title>

    <style>
        body {
            width: 100%;
            min-height: 100vh;
            margin: 0;
            font-size: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(200deg, #d3dcf6, #fff2ea);
        }

        form {
            width: 80%;
            max-width: 750px;
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
            text-transform: uppercase;
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

        input[type="number"],
        input[type="text"] {
            line-height: 2;
            width: 70%;
            font-size: 16px;
            padding: 0 8px;
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

        input[type="submit"]:hover {
            background-color: #087722;
        }

        .ketqua {
            border: 1px solid #777;
            color: green;
            font-weight: bold;
        }

        .error {
            color: red;
            text-align: center;
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <?php
    $n = "";
    $mang = "";
    $demChan = "";
    $demNho100 = "";
    $tongAm = "";
    $viTriSo0 = "";
    $mangTangDan = "";
    $error = "";

    if (isset($_POST["submit"])) {
        $n = $_POST["n"] ?? "";

        if (!filter_var($n, FILTER_VALIDATE_INT) || $n <= 0) {
            $error = "n phải là số nguyên dương";
        } else {
            $arr = [];

            for ($i = 0; $i < $n; $i++) {
                $arr[] = rand(-200, 200);
            }

            $demChan = 0;
            $demNho100 = 0;
            $tongAm = 0;
            $viTriSo0 = [];

            foreach ($arr as $i => $value) {
                if ($value % 2 == 0) {
                    $demChan++;
                }

                if ($value < 100) {
                    $demNho100++;
                }

                if ($value < 0) {
                    $tongAm += $value;
                }

                if ($value == 0) {
                    $viTriSo0[] = $i;
                }
            }

            $mang = implode(", ", $arr);

            if (!empty($viTriSo0)) {
                $viTriSo0 = implode(", ", $viTriSo0);
            } else {
                $viTriSo0 = "Không có";
            }

            $mangTangDan = $arr;
            sort($mangTangDan);
            $mangTangDan = implode(", ", $mangTangDan);
        }
    }

    if (isset($_POST["reset-btn"])) {
        $n = "";
        $mang = "";
        $demChan = "";
        $demNho100 = "";
        $tongAm = "";
        $viTriSo0 = "";
        $mangTangDan = "";
        $error = "";
    }
    ?>

    <form action="" method="post">

        <h2>XỬ LÝ MẢNG</h2>

        <?php if (!empty($error)) { ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php } ?>

        <div class="group">
            <label for="n">Nhập n</label>
            <input type="number" name="n" id="n" min="1" step="1" value="<?php echo htmlspecialchars($n); ?>" required>
        </div>

        <input type="submit" name="submit" value="Thực hiện">

        <div class="group">
            <label for="mang">Mảng</label>
            <input type="text" id="mang" value="<?php echo htmlspecialchars($mang); ?>" readonly>
        </div>

        <div class="group">
            <label for="demChan">Số phần tử chẵn</label>
            <input class="ketqua" type="text" id="demChan" value="<?php echo htmlspecialchars($demChan); ?>" readonly>
        </div>

        <div class="group">
            <label for="demNho100">Số phần tử < 100</label>
                    <input class="ketqua" type="text" id="demNho100" value="<?php echo htmlspecialchars($demNho100); ?>" readonly>
        </div>

        <div class="group">
            <label for="tongAm">Tổng phần tử âm</label>
            <input class="ketqua" type="text" id="tongAm" value="<?php echo htmlspecialchars($tongAm); ?>" readonly>
        </div>

        <div class="group">
            <label for="viTriSo0">Vị trí số 0</label>
            <input class="ketqua" type="text" id="viTriSo0" value="<?php echo htmlspecialchars($viTriSo0); ?>" readonly>
        </div>

        <div class="group">
            <label for="mangTangDan">Mảng tăng dần</label>
            <input class="ketqua" type="text" id="mangTangDan" value="<?php echo htmlspecialchars($mangTangDan); ?>" readonly>
        </div>

    </form>

</body>

</html>