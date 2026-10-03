<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính chu vi, diện tích hình tròn</title>
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
            background: linear-gradient(160deg, #aeeff9, #f1c6b1);
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
            font-weight: bold;
        }

        input[type="text"] {
            width: 65%;
            padding: 4px 6px;
            border: 1px solid #a9a9a9;
            font-size: 16px;
            outline: none;
        }

        .input-chuvi {
            background-color: #f0f0f0 !important;
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
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #d4d4d4;
        }

        .error {
            color: red;
            text-align: center;
            font-weight: bold;
            margin: 10px 0;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <?php
    define("PI", 3.14);
    $bankinh = $_POST["bankinh"] ?? "";
    $chuvi = "";
    $dientich = "";
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!is_numeric($bankinh)) {
            $error = "Bán kính phải là số";
        } elseif ($bankinh <= 0) {
            $error = "Bán kính phải lớn hơn 0";
        } else {
            $chuvi = 2 * PI * $bankinh;
            $dientich = PI * $bankinh * $bankinh;
        }
    }
    ?>

    <form action="" method="post">
        <h2>Diện tích và chu vi hình tròn</h2>

        <?php if (!empty($error)) { ?>
            <div class="error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php } ?>

        <div class="group">
            <label for="bankinh">Bán kính:</label>
            <input type="text" name="bankinh" id="bankinh" value="<?php echo ($bankinh); ?>" required>
        </div>

        <div class="group">
            <label for="chuvi">Chu vi:</label>
            <input type="text" class="input-chuvi" name="chuvi" id="chuvi" value="<?php echo $chuvi !== "" ? ($chuvi) : ""; ?>" readonly>
        </div>

        <div class="group">
            <label for="dientich">Diện tích:</label>
            <input type="text" class="input-dientich" name="dientich" id="dientich" value="<?php echo $dientich !== "" ? ($dientich) : ""; ?>" readonly>
        </div>

        <input type="submit" value="Tính">
    </form>
</body>

</html>