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
            max-width: 1200px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: auto;
            font-size: 18px;
            min-height: 100vh;
            background: linear-gradient(180deg, #e9ffe3, #cf99c6);
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }

        form {
            padding: 35px 40px;
            width: 450px;
            background-color: white;
            border-radius: 12px;
            border: 2px solid #ccc;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        form:hover {
            border-color: #aae3b5;
            box-shadow: 0 6px 20px rgba(135, 211, 155, 0.3);
        }

        h3 {
            text-align: center;
            font-weight: bold;
            font-size: 30px;
            margin: 0 0 5px 0;
            color: #021426;
        }

        .sub-title {
            text-align: center;
            font-style: italic;
            font-size: 15px;
            margin: 0 0 20px 0;
            color: #666;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
            color: #333;
        }

        input[type="time"],
        input[type="text"] {
            display: block;
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 18px;
            border: 2px solid #ccc;
            border-radius: 6px;
            font-family: inherit;
            font-size: 18px;
            outline: none;
            transition: all 0.3s ease;
        }

        input[type="text"] {
            font-weight: bold;
            font-size: 20px;
            background-color: #f8f9fa;
            color: #d9534f;
        }

        input[type="time"]:focus,
        input[type="text"]:focus {
            border-color: #01aa26;
            box-shadow: 0 0 6px rgba(1, 170, 38, 0.3);
        }

        .btn-group {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-top: 10px;
            width: 100%;
        }

        .btn {
            flex: 1;
            padding: 12px 0;
            font-weight: bold;
            font-size: 16px;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        .btn:active {
            transform: scale(0.98);
        }

        .btn-submit {
            background-color: #01aa26;
        }

        .btn-submit:hover {
            background-color: #088722;
        }

        .btn-reset {
            background-color: #7f8c8d;
        }

        .btn-reset:hover {
            background-color: #636e72;
        }

        .error-msg {
            color: #d9534f;
            font-size: 15px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    $time_start = "";
    $time_end = "";
    $total_display = "";
    $error = "";

    if (isset($_POST["reset-btn"])) {
        $time_start = "";
        $time_end = "";
        $total_display = "";
    } else if (isset($_POST["submit"])) {
        $time_start = $_POST['time-start'] ?? '';
        $time_end = $_POST['time-end'] ?? '';

        if (!empty($time_start) && !empty($time_end)) {
            $bd = strtotime($time_start);
            $kt = strtotime($time_end);

            if ($kt > $bd) {
                $hours = ($kt - $bd) / 3600;
                $total = $hours * 50000;
                $total_display = number_format($total, 0, ',', ' ') . " VNĐ";
            } else {
                $error = "Giờ kết thúc phải lớn hơn giờ bắt đầu!";
            }
        } else {
            $error = "Vui lòng chọn đủ giờ bắt đầu và kết thúc!";
        }
    }
    ?>

    <form action="" method="post">
        <h3>Tính tiền Karaoke</h3>
        <p class="sub-title">Đơn giá: 50.000 VNĐ / giờ</p>

        <?php if (!empty($error)): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <label for="time-start">Giờ bắt đầu</label>
        <input type="time" id="time-start" name="time-start" value="<?php echo htmlspecialchars($time_start); ?>">

        <label for="time-end">Giờ kết thúc</label>
        <input type="time" id="time-end" name="time-end" value="<?php echo htmlspecialchars($time_end); ?>">

        <label for="total">Tiền thanh toán</label>
        <input type="text" id="total" name="total" value="<?php echo $total_display; ?>" readonly placeholder="0 VNĐ">

        <div class="btn-group">
            <button type="submit" name="submit" class="btn btn-submit">Tính tiền</button>
            <button type="submit" name="reset-btn" class="btn btn-reset">Nhập lại</button>
        </div>
    </form>
</body>

</html>