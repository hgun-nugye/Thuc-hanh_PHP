<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính tiền điện</title>
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
            background: linear-gradient(70deg, #b7edac, #eef1b1);
        }

        form {
            width: 500px;
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

        input[type="number"],
        input[type="text"] {
            width: 60%;
            max-width: 250px;
            padding: 4px 6px;
            border: 1px solid #a9a9a9;
            font-size: 16px;
            outline: none;
        }

        .input-thanhtoan {
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

        .unit {
            margin-left: 5px;
            font-size: 14px;
            color: #555;
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
    $name = $_POST["name"] ?? "";
    $socu = $_POST["socu"] ?? "";
    $somoi = $_POST["somoi"] ?? "";
    $dongia = $_POST["dongia"] ?? 2000;
    $sotien = "";
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!is_numeric($socu) || !is_numeric($somoi) || !is_numeric($dongia)) {
            $error = "Chỉ số và đơn giá phải là số";
        } elseif ($socu < 0 || $somoi < 0 || $dongia < 0) {
            $error = "Giá trị nhập vào phải lớn hơn hoặc bằng 0";
        } elseif ($somoi < $socu) {
            $error = "Chỉ số mới phải lớn hơn hoặc bằng chỉ số cũ";
        } else {
            $sotien = ($somoi - $socu) * $dongia;
        }
    }
    ?>

    <form action="" method="post">
        <h2>Thanh toán tiền điện</h2>

        <?php if (!empty($error)) { ?>
            <div class="error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php } ?>

        <div class="group">
            <label for="name">Tên chủ hộ:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>" required>
        </div>

        <div class="group">
            <label for="socu">Chỉ số cũ:</label>
            <input type="number" name="socu" id="socu" min="0" step="1" value="<?php echo htmlspecialchars($socu); ?>" required>
            <span class="unit">(Kw)</span>
        </div>

        <div class="group">
            <label for="somoi">Chỉ số mới:</label>
            <input type="number" name="somoi" id="somoi" min="0" step="1" value="<?php echo htmlspecialchars($somoi); ?>" required>
            <span class="unit">(Kw)</span>
        </div>

        <div class="group">
            <label for="dongia">Đơn giá:</label>
            <input type="number" name="dongia" id="dongia" value="<?php echo htmlspecialchars($dongia); ?>">
            <span class="unit">(VNĐ)</span>
        </div>

        <div class="group">
            <label for="tien">Số tiền thanh toán:</label>
            <input type="text" class="input-thanhtoan" name="tien" id="tien" value="<?php echo $sotien !== "" ? number_format($sotien, 0, ",", " ") : ""; ?>" readonly>
            <span class="unit">(VNĐ)</span>
        </div>

        <input type="submit" value="Tính">
    </form>
</body>

</html>