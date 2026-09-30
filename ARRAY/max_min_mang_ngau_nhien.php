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
            background: linear-gradient(200deg, #d3dcf6, #fff2ea);
        }

        form {
            width: 80%;
            max-width: 750px;
            background-color: white;
            padding: 30px 40px;
            border: 2px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h2 {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            color: #154cd8;
            text-align: center;
            text-transform: uppercase;
            margin-top: 0;
            margin-bottom: 40px;
        }

        .group {
            width: 100%;
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        label {
            display: inline-block;
            width: 30%;
            font-weight: bold;
        }

        input[type="number"],
        input[type="text"] {
            width: 70%;
            padding: 8px 10px;
            font-size: 16px;
            line-height: 1.5;
            border: 1px solid #777;
        }

        input[type="number"]:focus,
        input[type="text"]:focus {
            outline: none;
            border-color: #154cd8;
        }

        input[type="submit"] {
            width: 125px;
            padding: 10px;
            border: none;
            border-radius: 6px;
            background-color: #008924;
            color: white;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            display: block;
            margin: 5px auto 25px;
        }

        input[type="submit"]:hover {
            background-color: #087722;
        }

        .ketqua {
            background-color: #f8fff9;
            font-weight: bold;
            color: green;
        }

        .error {
            width: 100%;
            text-align: center;
            color: red;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <?php

    $n = "";
    $mang = "";
    $max = "";
    $min = "";
    $tong = "";
    $error = "";

    if (isset($_POST["submit"])) {

        $n = $_POST["n"] ?? "";

        if (!filter_var($n, FILTER_VALIDATE_INT) || $n <= 0) {
            $error = "n phải là số nguyên dương";
        } else {
            // Sinh mảng
            $arr = [];
            for ($i = 0; $i < $n; $i++) {
                $arr[] = rand(0, 20);
            }
            // Chuyển mảng thành chuỗi
            $mang = implode(", ", $arr);
            // Tìm MAX
            $max = max($arr);
            // Tìm MIN
            $min = min($arr);
            // Tính tổng
            $tong = array_sum($arr);
        }
    }
    ?>

    <form action="" method="post">
        <h2>TÌM MAX, MIN CỦA MẢNG</h2>
        <?php if (!empty($error)): ?>
            <div class="error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <div class="group">
            <label for="n">Nhập n</label>
            <input
                type="number" name="n" id="n" min="1" step="1"
                value="<?php echo $n; ?>"
                required>
        </div>
        <input type="submit" name="submit" value="Thực hiện">
        <div class="group">
            <label for="mang">Mảng</label>
            <input type="text" id="mang" value="<?php echo $mang; ?>" readonly>
        </div>
        <div class="group">
            <label for="max">GTLN (MAX)</label>
            <input class="ketqua" type="text" id="max" value="<?php echo $max; ?>" readonly>
        </div>
        <div class="group">
            <label for="min">GTNN (MIN)</label>
            <input class="ketqua" type="text" id="min" value="<?php echo $min; ?>" readonly>
        </div>
        <div class="group">
            <label for="tong">Tổng mảng</label>
            <input class="ketqua" type="text" id="tong" value="<?php echo $tong; ?>" readonly>
        </div>
    </form>
</body>

</html>