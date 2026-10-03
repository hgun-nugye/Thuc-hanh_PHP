<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính diện tích hình chữ nhật</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            width: 100%;
            height: 100vh;
            margin: 0;
            font-size: 18px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }

        form {
            width: 450px;
            background-color: #fff8d6;
            border: 1px solid #dcdcdc;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            font-style: italic;
            color: #d2691e;
            text-align: center;
            text-transform: uppercase;
            font-size: 20px;
            background-color: #ffd97d;
            padding: 12px;
            margin: 0 0 15px 0;
            font-weight: bold;
        }

        .group {
            padding: 5px 20px;
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        label {
            width: 35%;
            color: #333;
            font-size: 16px;
        }

        input[type="text"] {
            width: 65%;
            padding: 4px 6px;
            border: 1px solid #a9a9a9;
            font-size: 16px;
            outline: none;
        }

        .input-dientich {
            background-color: #ffe4e1 !important;
        }

        input[type="submit"] {
            width: 80px;
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
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php
    $dai = isset($_POST["dai"]) ? $_POST["dai"] : "";
    $rong = isset($_POST["rong"]) ? $_POST["rong"] : "";
    $dientich = "";
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!is_numeric($dai) || !is_numeric($rong)) {
            $error = "Chiều dài/rộng phải là số";
        } elseif ($dai <= 0 || $rong <= 0) {
            $error = "Chiều dài/rộng phải lớn hơn 0";
        } elseif ($dai < $rong) {
            $error = "Chiều rộng phải nhỏ hơn hoặc bằng chiều dài";
        } else {
            $dientich = $dai * $rong;
        }
    }
    ?>

    <form action="" method="post">
        <h2>Diện tích hình chữ nhật</h2>

        <?php if (!empty($error)) { ?>
            <div class="error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php } ?>

        <div class="group">
            <label for="dai">Chiều dài:</label>
            <input type="text" name="dai" id="dai" value="<?php echo htmlspecialchars($dai); ?>" required>
        </div>

        <div class="group">
            <label for="rong">Chiều rộng:</label>
            <input type="text" name="rong" id="rong" value="<?php echo htmlspecialchars($rong); ?>" required>
        </div>

        <div class="group">
            <label for="dientich">Diện tích:</label>
            <input type="text" class="input-dientich" name="dientich" id="dientich" value="<?php echo htmlspecialchars($dientich); ?>" readonly>
        </div>

        <input type="submit" value="Tính">
    </form>
</body>

</html>