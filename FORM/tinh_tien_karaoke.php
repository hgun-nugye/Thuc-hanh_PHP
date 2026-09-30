<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính tiền Karaoke</title>

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
            max-width: 650px;
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
            border-radius: 4px;
            border: 2px solid #CCC
        }

        input[type="number"]:focus {
            outline: none;
            border-color: #154cd8;
        }

        input[type="text"] {
            background-color: #fffed8;
            font-weight: bold;
            color: #333;
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
    $gioBatDau = "";
    $gioKetThuc = "";
    $tien = "";
    $error = "";

    if (isset($_POST["reset-btn"])) {

        $gioBatDau = "";
        $gioKetThuc = "";
        $tien = "";
        $error = "";
    } elseif (isset($_POST["submit"])) {

        $gioBatDau = $_POST["gioBatDau"] ?? "";
        $gioKetThuc = $_POST["gioKetThuc"] ?? "";

        if ($gioBatDau === "" || $gioKetThuc === "") {

            $error = "Vui lòng nhập đầy đủ giờ bắt đầu và giờ kết thúc!";
        } elseif (
            !filter_var($gioBatDau, FILTER_VALIDATE_INT) ||
            !filter_var($gioKetThuc, FILTER_VALIDATE_INT)
        ) {
            $error = "Giờ phải là số nguyên!";
        } elseif ($gioBatDau < 10 || $gioBatDau >= 24) {
            $error = "Giờ bắt đầu phải từ 10h đến trước 24h!";
        } elseif ($gioKetThuc <= $gioBatDau || $gioKetThuc > 24) {
            $error = "Giờ kết thúc phải lớn hơn giờ bắt đầu và không quá 24h!";
        } else {
            $tien = 0;

            if ($gioBatDau < 17) {
                $gio20k = min($gioKetThuc, 17) - $gioBatDau;

                if ($gio20k > 0) {
                    $tien += $gio20k * 20000;
                }
            }

            if ($gioKetThuc > 17) {
                $gio45k = $gioKetThuc - max($gioBatDau, 17);

                if ($gio45k > 0) {
                    $tien += $gio45k * 45000;
                }
            }

            $tien = number_format($tien, 0, ',', '.') . " VNĐ";
        }
    }

    ?>

    <form action="" method="post">

        <h2>TÍNH TIỀN KARAOKE</h2>

        <?php if (!empty($error)) { ?>
            <div class="error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php } ?>

        <div class="group">
            <label for="gioBatDau">Giờ bắt đầu:</label>
            <input type="number" name="gioBatDau" id="gioBatDau" min="10" max="23"
                value="<?php echo ($gioBatDau); ?>" required>
        </div>

        <div class="group">
            <label for="gioKetThuc">Giờ kết thúc:</label>
            <input type="number" name="gioKetThuc" id="gioKetThuc" min="11" max="24"
                value="<?php echo ($gioKetThuc); ?>" required>
        </div>

        <div class="group">
            <label for="tien">Tiền thanh toán:</label>
            <input type="text" name="tien" id="tien"
                value="<?php echo $tien; ?>" readonly>
        </div>

        <input type="submit" name="submit" value="Tính tiền">

    </form>

</body>

</html>