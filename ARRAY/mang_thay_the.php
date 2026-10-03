<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thay thế</title>

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
            background-color: white;
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
            background-color: #a70d76;
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
            width: 38%;
            flex-shrink: 0;
            font-weight: normal;
            color: #555;
        }

        input[type="text"] {
            width: 58%;
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
            background-color: #f9dff0;
        }

        .input-row input {
            background-color: white;
        }

        .submit-row {
            background-color: #f9dff0;
            padding: 4px 10px 8px;
        }

        input[type="submit"] {
            display: block;
            width: 130px;
            height: 38px;
            margin: 0 0 0 38%;
            padding: 4px;
            font-family: inherit;
            font-size: 18px;
            background-color: #fff59b;
            border: 2px outset #e8dc78;
            border-radius: 0;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #f6e06f;
        }

        .ketqua {
            background-color: #f6aaa5;
            color: #8c4444;
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
    $socu = $_POST["socu"] ?? "";
    $somoi = $_POST["somoi"] ?? "";

    $mangCu = "";
    $mangMoi = "";
    $error = "";

    if (isset($_POST["submit"])) {
        if (
            trim($mangNhap) === "" ||
            trim($socu) === "" ||
            trim($somoi) === ""
        ) {
            $error = "Vui lòng nhập đầy đủ thông tin!";
        } elseif (
            !is_numeric(trim($socu)) ||
            !is_numeric(trim($somoi))
        ) {
            $error = "Giá trị cần thay thế và giá trị thay thế phải là số!";
        } else {
            $arr = explode(",", $mangNhap);
            $arr = array_map('trim', $arr);

            $hopLe = true;

            foreach ($arr as $phanTu) {
                if ($phanTu === "" || !is_numeric($phanTu)) {
                    $hopLe = false;
                    break;
                }
            }

            if (!$hopLe) {
                $error = "Các phần tử trong mảng phải là số, cách nhau bằng dấu phẩy!";
            } else {
                $mangCu = implode(" ", $arr);

                // Thay thế tất cả phần tử bằng giá trị cần thay
                foreach ($arr as $i => $phanTu) {
                    if ((float)$phanTu == (float)$socu) {
                        $arr[$i] = $somoi;
                    }
                }

                $mangMoi = implode(" ", $arr);
            }
        }
    }
    ?>

    <form action="" method="post">

        <h2>Thay thế</h2>

        <?php if ($error !== "") { ?>
            <div class="error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php } ?>

        <div class="group input-row">
            <label for="mang">Nhập các phần tử:</label>

            <input type="text" name="mang" id="mang"
                value="<?php echo ($mangNhap); ?>"
                required>
        </div>

        <div class="group input-row">
            <label for="socu">Giá trị cần thay thế:</label>

            <input type="text" name="socu" id="socu"
                style="width: 28%;"
                value="<?php echo ($socu); ?>"
                required>
        </div>

        <div class="group input-row">
            <label for="somoi">Giá trị thay thế:</label>

            <input type="text" name="somoi" id="somoi"
                style="width: 28%;"
                value="<?php echo ($somoi); ?>"
                required>
        </div>

        <div class="submit-row">
            <input type="submit" name="submit" value="Thay thế">
        </div>

        <div class="group">
            <label for="mang_cu">Mảng cũ:</label>

            <input type="text" id="mang_cu" class="ketqua"
                value="<?php echo ($mangCu); ?>"
                readonly>
        </div>

        <div class="group">
            <label for="mang_moi">Mảng sau khi thay thế:</label>

            <input type="text" id="mang_moi" class="ketqua"
                value="<?php echo ($mangMoi); ?>"
                readonly>
        </div>

        <p class="note">
            (<span style="color: #a70d76; font-weight: bold;">Ghi chú:</span>
            Các phần tử trong mảng sẽ cách nhau bằng dấu ",")
        </p>

    </form>

</body>

</html>