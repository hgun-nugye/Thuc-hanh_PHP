<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sắp xếp mảng</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            width: 100%;
            min-height: 100vh;
            margin: 0;
            font-size: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background: white;
        }

        form {
            width: 850px;
            max-width: 98%;
            background-color: #b8dece;
            padding: 0 0 5px;
            border: none;
        }

        h2 {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            color: white;
            text-align: center;
            text-transform: uppercase;
            margin: 0 0 5px;
            font-style: italic;
            font-size: 36px;
            background-color: #299c94;
            padding: 5px;
        }

        .group {
            width: 100%;
            display: flex;
            align-items: center;
            padding: 4px 10px;
            margin-bottom: 5px;
        }

        label {
            display: inline-block;
            width: 31%;
            flex-shrink: 0;
            font-weight: normal;
            color: #555;
        }

        input[type="text"] {
            width: 64%;
            min-width: 0;
            height: 34px;
            padding: 3px 5px;
            font-size: 18px;
            font-family: inherit;
            border: 2px inset #ddd;
            border-radius: 0;
            outline: none;
        }

        .input-row {
            background-color: #a2f8e99d;
        }

        .input-row input {
            background-color: white;
        }

        .dau-sao {
            margin: 0 0 0 8px;
            color: #c74757;
            font-weight: bold;
        }

        .submit-row {
            padding: 4px 10px 8px;
        }

        input[type="submit"] {
            display: block;
            width: 290px;
            max-width: 64%;
            height: 38px;
            margin: 0 0 0 31%;
            padding: 4px;
            font-family: inherit;
            font-size: 18px;
            color: #333;
            background-color: #eeeeea;
            border: 2px outset #aaa;
            border-radius: 0;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #ddd;
        }

        .tieude-ketqua {
            padding: 5px;
            color: #bd3f4b;
            font-weight: bold;
        }

        .ketqua {
            background-color: #c9f3f3;
            color: #555;
        }

        .note {
            text-align: center;
            font-size: 18px;
            margin: 8px 0 0;
            color: #555;
        }

        .error {
            text-align: center;
            color: red;
            font-size: 16px;
            margin: 5px;
        }
    </style>
</head>

<body>

    <?php
    $mangNhap = $_POST["mang"] ?? "";
    $mangCu = "";
    $tangdan = "";
    $giamdan = "";
    $error = "";

    if (isset($_POST["submit"])) {
        if (trim($mangNhap) === "") {
            $error = "Vui lòng nhập mảng!";
        } else {
            // Tách mảng bằng dấu phẩy
            $arr = explode(",", $mangNhap);
            $arr = array_map('trim', $arr);

            // Kiểm tra các phần tử
            $hopLe = true;

            foreach ($arr as $phanTu) {
                if ($phanTu === "" || !is_numeric($phanTu)) {
                    $hopLe = false;
                    break;
                }
            }

            if (!$hopLe) {
                $error = "Vui lòng nhập các số hợp lệ, cách nhau bằng dấu phẩy!";
            } else {
                // Chuyển các phần tử thành số
                $arr = array_map('floatval', $arr);

                // Mảng ban đầu
                $mangCu = implode(", ", $arr);

                // Sắp xếp tăng dần
                $arrTang = $arr;
                sort($arrTang, SORT_NUMERIC);
                $tangdan = implode(", ", $arrTang);

                // Sắp xếp giảm dần
                $arrGiam = $arr;
                rsort($arrGiam, SORT_NUMERIC);
                $giamdan = implode(", ", $arrGiam);
            }
        }
    }
    ?>

    <form action="" method="post">

        <h2>Sắp xếp mảng</h2>

        <?php if ($error !== "") { ?>
            <div class="error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php } ?>

        <div class="group">
            <label for="mang">Nhập mảng:</label>

            <input type="text" name="mang" id="mang"
                value="<?php echo htmlspecialchars($mangNhap); ?>"
                required>

            <span class="dau-sao">(*)</span>
        </div>

        <div class="submit-row">
            <input type="submit" name="submit"
                value="Sắp xếp tăng/giảm">
        </div>

        <p class="tieude-ketqua input-row">Sau khi sắp xếp:</p>

        <div class="group input-row">
            <label for="tangdan">Tăng dần:</label>

            <input type="text" id="tangdan" class="ketqua"
                value="<?php echo htmlspecialchars($tangdan); ?>"
                readonly>
        </div>

        <div class="group input-row ">
            <label for="giamdan">Giảm dần:</label>

            <input type="text" id="giamdan" class="ketqua"
                value="<?php echo htmlspecialchars($giamdan); ?>"
                readonly>
        </div>

        <p class="note">
            <span style="color:#c74757; font-weight:bold;">(*)</span>
            Các số được nhập cách nhau bằng dấu ","
        </p>

    </form>

</body>

</html>