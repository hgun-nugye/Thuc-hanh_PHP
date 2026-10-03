<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính tiền Karaoke</title>

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
            background: linear-gradient(200deg, #d3dcf6, #fff2ea);
        }

        form {
            width: 450px;
            max-width: 95%;
            background-color: #09c2a6;
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
            background-color: #007579;
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
            flex-shrink: 0;
            color: #000000;
            font-size: 16px;
        }

        input[type="text"] {
            width: 55%;
            min-width: 0;
            padding: 4px 6px;
            border: 1px solid #a9a9a9;
            font-size: 16px;
            outline: none;
            background-color: #ffffff;
        }

        .input-tien {
            background-color: #fffed8 !important;
            color: #333;
        }

        .unit {
            width: 10%;
            margin-left: 8px;
            font-size: 15px;
            color: #000000;
        }

        input[type="submit"] {
            width: 90px;
            padding: 4px 10px;
            background-color: #e1e1e1;
            border: 1px solid #767676;
            font-size: 15px;
            cursor: pointer;
            display: block;
            margin: 10px auto 15px auto;
            border-radius: 2px;
            font-weight: bold;
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
    $gioBatDau = $_POST["gioBatDau"] ?? "";
    $gioKetThuc = $_POST["gioKetThuc"] ?? "";

    $tien = "";
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (
            trim($gioBatDau) === "" ||
            trim($gioKetThuc) === ""
        ) {
            $error = "Vui lòng nhập đầy đủ giờ bắt đầu và giờ kết thúc!";
        } elseif (
            !preg_match('/^\d+$/', trim($gioBatDau)) ||
            !preg_match('/^\d+$/', trim($gioKetThuc))
        ) {
            $error = "Giờ phải là số nguyên!";
        } else {
            $gioBatDau = (int) $gioBatDau;
            $gioKetThuc = (int) $gioKetThuc;

            if ($gioBatDau < 10 || $gioBatDau >= 24) {
                $error = "Giờ bắt đầu phải từ 10 đến 23!";
            } elseif ($gioKetThuc <= $gioBatDau || $gioKetThuc > 24) {
                $error = "Giờ kết thúc phải lớn hơn giờ bắt đầu và không quá 24!";
            } else {
                $tongTien = 0;

                if ($gioBatDau < 17) {
                    $gio20k = min($gioKetThuc, 17) - $gioBatDau;

                    if ($gio20k > 0) {
                        $tongTien += $gio20k * 20000;
                    }
                }

                if ($gioKetThuc > 17) {
                    $gio45k = $gioKetThuc - max($gioBatDau, 17);

                    if ($gio45k > 0) {
                        $tongTien += $gio45k * 45000;
                    }
                }

                $tien = $tongTien;
            }
        }
    }
    ?>

    <form action="" method="post">

        <h2>TÍNH TIỀN KARAOKE</h2>

        <?php if ($error != "") { ?>
            <div class="error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php } ?>

        <div class="group">
            <label for="gioBatDau">Giờ bắt đầu:</label>

            <input type="text" name="gioBatDau" id="gioBatDau"
                value="<?php echo htmlspecialchars((string) $gioBatDau); ?>"
                required>

            <span class="unit">(h)</span>
        </div>

        <div class="group">
            <label for="gioKetThuc">Giờ kết thúc:</label>

            <input type="text" name="gioKetThuc" id="gioKetThuc"
                value="<?php echo htmlspecialchars((string) $gioKetThuc); ?>"
                required>

            <span class="unit">(h)</span>
        </div>

        <div class="group">
            <label for="tien">Tiền thanh toán:</label>

            <input type="text" class="input-tien" name="tien" id="tien"
                value="<?php echo $tien !== "" ? htmlspecialchars((string) $tien) : ""; ?>"
                readonly>

            <span class="unit">(VNĐ)</span>
        </div>

        <input type="submit" name="submit" value="Tính tiền">

    </form>

</body>

</html>