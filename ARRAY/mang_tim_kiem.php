<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm</title>

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
            width: 800px;
            max-width: 98%;
            background-color: #cedbd1;
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
            display: flex;
            align-items: center;
            width: 100%;
            padding: 4px 10px;
            margin-bottom: 5px;
        }

        label {
            display: inline-block;
            width: 31%;
            flex-shrink: 0;
            font-weight: normal;
            font-size: 20px;
        }

        input[type="text"] {
            width: 64%;
            min-width: 0;
            height: 34px;
            padding: 3px 5px;
            font-family: inherit;
            font-size: 18px;
            border: 2px inset #ddd;
            border-radius: 0;
            outline: none;
        }

        .group:nth-of-type(2) {
            margin-bottom: 8px;
        }

        input[type="submit"] {
            display: block;
            width: 145px;
            height: 38px;
            margin: 0 0 10px 32%;
            font-family: inherit;
            font-size: 18px;
            color: #173c78;
            background-color: #83c5f5;
            border: 2px outset #8bbce5;
            border-radius: 0;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #65b3ed;
        }

        .ketqua {
            color: #a84b55;
            font-weight: bold;
            background-color: #d3f4f2;
        }

        .note {
            text-align: center;
            background-color: #40b8b0;
            font-size: 18px;
            margin: 0;
            margin-top: 20px;
            padding: 3px;
        }
    </style>
</head>

<body>

    <?php
    $mangNhap = $_POST["mang"] ?? "";
    $soNhap = $_POST["so"] ?? "";

    $mangHienThi = "";
    $ketqua = "";
    $error = "";

    if (isset($_POST["submit"])) {

        if (trim($mangNhap) === "" || trim($soNhap) === "") {
            $error = "Vui lòng nhập đầy đủ thông tin!";
        } elseif (!is_numeric(trim($soNhap))) {
            $error = "Số cần tìm phải là số!";
        } else {
            $mang = explode(",", $mangNhap);
            $mang = array_map('trim', $mang);

            // Kiểm tra các phần tử trong mảng
            $hopLe = true;

            foreach ($mang as $phanTu) {
                if ($phanTu === "" || !is_numeric($phanTu)) {
                    $hopLe = false;
                    break;
                }
            }

            if (!$hopLe) {
                $error = "Các phần tử trong mảng phải là số và cách nhau bằng dấu phẩy!";
            } else {
                $mangHienThi = implode(", ", $mang);

                // Tìm vị trí xuất hiện đầu tiên
                $viTri = array_search((string)$soNhap, $mang);

                if ($viTri !== false) {
                    $ketqua = "Tìm thấy $soNhap tại vị trí thứ "
                        . ($viTri + 1) . " của mảng";
                } else {
                    // So sánh dạng số để xử lý cả số nguyên và số thập phân
                    $viTri = false;

                    foreach ($mang as $i => $phanTu) {
                        if ((float)$phanTu == (float)$soNhap) {
                            $viTri = $i;
                            break;
                        }
                    }

                    if ($viTri !== false) {
                        $ketqua = "Tìm thấy $soNhap tại vị trí thứ "
                            . ($viTri + 1) . " của mảng";
                    } else {
                        $ketqua = "Không tìm thấy số $soNhap trong mảng";
                    }
                }
            }
        }
    }
    ?>

    <form action="" method="post">

        <h2>Tìm kiếm</h2>

        <?php if ($error !== "") { ?>
            <p style="color:red; text-align:center; margin:8px;font-size:16px">
                <?php echo htmlspecialchars($error); ?>
            </p>
        <?php } ?>

        <div class="group">
            <label for="mang">Nhập mảng:</label>

            <input type="text" name="mang" id="mang"
                value="<?php echo ($mangNhap); ?>" required>
        </div>

        <div class="group">
            <label for="so">Nhập số cần tìm:</label>

            <input type="text" name="so" id="so"
                value="<?php echo ($soNhap); ?>" required>
        </div>

        <input type="submit" name="submit" value="Tìm kiếm">

        <div class="group">
            <label for="mangHienThi">Mảng:</label>

            <input type="text" id="mangHienThi"
                value="<?php echo ($mangHienThi); ?>"
                readonly>
        </div>

        <div class="group">
            <label for="ketqua">Kết quả tìm kiếm:</label>

            <input class="ketqua" type="text" id="ketqua"
                value="<?php echo ($ketqua); ?>"
                readonly>
        </div>

        <p class="note">
            (Các phần tử trong mảng sẽ cách nhau bằng dấu ",")
        </p>

    </form>

</body>

</html>