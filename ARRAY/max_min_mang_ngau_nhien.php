<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm Max, Min của mảng</title>

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
            width: 1000px;
            max-width: 98%;
            background-color: white;
            padding: 0 0 10px;
            border: 1px solid #ccc;
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
            padding: 8px;
        }

        .group {
            width: 100%;
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            padding: 4px 15px;
        }

        label {
            display: inline-block;
            width: 38%;
            flex-shrink: 0;
            font-weight: normal;
            color: #555;
        }

        input[type="text"],
        input[type="text"] {
            width: 58%;
            min-width: 0;
            height: 40px;
            padding: 4px 6px;
            font-size: 20px;
            font-family: inherit;
            border: 2px inset #ddd;
            border-radius: 0;
            outline: none;
        }

        .group:first-of-type {
            background-color: #f9dff0;
        }

        .group:first-of-type input {
            background-color: white;
        }

        input[type="text"]:focus {
            border-color: #999;
        }

        input[type="submit"] {
            display: block;
            width: 38%;
            height: 45px;
            margin: 0 0 8px 38%;
            padding: 5px;
            font-family: inherit;
            font-size: 22px;
            font-weight: normal;
            color: black;
            background-color: #fff59b;
            border: 2px outset #e8dc78;
            border-radius: 0;
            cursor: pointer;
        }

        .submit-row {
            background-color: #f9dff0;
            padding: 4px 15px 8px;
        }

        .submit-row input[type="submit"] {
            margin: 0 0 0 38%;
        }

        input[type="submit"]:hover {
            background-color: #f6e06f;
        }

        .ketqua {
            background-color: #f6aaa5;
            color: #8c4444;
        }

        .error {
            text-align: center;
            color: red;
            font-weight: bold;
            margin: 8px;
        }

        .note {
            text-align: center;
            font-size: 20px;
            margin: 10px 0;
            color: #555;
        }
    </style>
</head>

<body>

    <?php
    $n = $_POST["n"] ?? "";
    $mang = "";
    $max = "";
    $min = "";
    $tong = "";
    $error = "";

    if (isset($_POST["submit"])) {
        if (
            trim($n) === "" ||
            !preg_match('/^\d+$/', trim($n)) ||
            (int)$n <= 0
        ) {
            $error = "n phải là số nguyên dương";
        } else {
            $n = (int)$n;

            $arr = [];

            for ($i = 0; $i < $n; $i++) {
                $arr[] = rand(0, 20);
            }

            $mang = implode(" ", $arr);
            $max = max($arr);
            $min = min($arr);
            $tong = array_sum($arr);
        }
    }
    ?>

    <form action="" method="post">

        <h2>PHÁT SINH MẢNG VÀ TÍNH TOÁN</h2>

        <?php if ($error != "") { ?>
            <div class="error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php } ?>

        <div class="group">
            <label for="n">Nhập số phần tử:</label>

            <input type="text" name="n" id="n"
                value="<?php echo htmlspecialchars((string)$n); ?>"
                min="1" step="1" required>
        </div>

        <div class="submit-row">
            <input type="submit" name="submit" value="Phát sinh và tính toán">
        </div>

        <div class="group">
            <label for="mang">Mảng:</label>

            <input type="text" id="mang" class="ketqua"
                value="<?php echo htmlspecialchars((string)$mang); ?>" readonly>
        </div>

        <div class="group">
            <label for="max">GTLN (MAX) trong mảng:</label>

            <input type="text" id="max" class="ketqua"
                value="<?php echo htmlspecialchars((string)$max); ?>" readonly>
        </div>

        <div class="group">
            <label for="min">GTNN (MIN) trong mảng:</label>

            <input type="text" id="min" class="ketqua"
                value="<?php echo htmlspecialchars((string)$min); ?>" readonly>
        </div>

        <div class="group">
            <label for="tong">Tổng mảng:</label>

            <input type="text" id="tong" class="ketqua"
                value="<?php echo htmlspecialchars((string)$tong); ?>" readonly>
        </div>

        <p class="note">
            (<span style="color: #a70d76; font-weight: bold;">Ghi chú:</span>
            Các phần tử trong mảng sẽ có giá trị từ 0 đến 20)
        </p>

    </form>

</body>

</html>