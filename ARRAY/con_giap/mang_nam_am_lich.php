<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính năm âm lịch</title>
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
            background-color: white;
            padding: 10px 0;
        }

        form {
            margin: 0;
            width: 80%;
            max-width: 700px;
            height: fit-content;
            background-color: #b4eafa;
            padding: 0 0 10px;
            border: 1px solid #ccc;
            border-radius: 0;
            box-shadow: none;
        }

        h2 {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            color: white;
            text-align: center;
            margin: 0 0 10px;
            text-transform: uppercase;
            font-style: italic;
            font-size: 36px;
            background-color: #0876d1;
            padding: 8px;
        }

        .group_nam {
            display: flex;
            align-items: flex-end;
            gap: 20px;
            padding: 0 30px;
        }

        .group {
            flex: 1;
            min-width: 0;
            margin-bottom: 10px;
            display: inline-block;
        }

        label {
            display: block;
            width: 100%;
            font-weight: normal;
            margin-bottom: 10px;
            color: #555;
        }

        input[type="submit"] {
            width: 50px;
            flex-shrink: 0;
            padding: 8px 4px;
            border-radius: 0;
            background-color: #fdffc0;
            color: #a65b37;
            border: 2px outset #e8dc78;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-bottom: 10px;
        }

        input[type="text"] {
            line-height: 1.8;
            width: 100%;
            min-width: 0;
            font-size: 16px;
            font-weight: normal;
            padding: 2px 5px;
            border: 2px inset #ddd;
            border-radius: 0;
            outline: none;
        }

        input[name="nam_am"] {
            background-color: #fff9c9;
            color: #b45c45;
        }

        img {
            display: block;
            margin: 20px auto;
            width: 200px;
            height: auto;
            max-height: 300px;
            border-radius: 14px;

        }
    </style>
</head>


<body>

    <?php

    $mang_can = array(
        "Giáp",
        "Ất",
        "Bính",
        "Đinh",
        "Mậu",
        "Kỷ",
        "Canh",
        "Tân",
        "Nhâm",
        "Quý"
    );

    $mang_chi = array(
        "Tý",
        "Sửu",
        "Dần",
        "Mão",
        "Thìn",
        "Tỵ",
        "Ngọ",
        "Mùi",
        "Thân",
        "Dậu",
        "Tuất",
        "Hợi"
    );

    $mang_hinh = array(
        "ty.png",
        "suu.png",
        "dan.png",
        "mao.png",
        "thin.png",
        "ti.png",
        "ngo.png",
        "mui.png",
        "than.png",
        "dau.png",
        "tuat.png",
        "hoi.png"
    );

    $nam_duong = "";
    $nam_am = "";
    $hinh = "";

    if (isset($_POST['nam_duong'])) {
        $nam_duong = trim($_POST['nam_duong']);

        if ($nam_duong === "" || !preg_match('/^\d+$/', $nam_duong)) {
            $nam_am = "Năm phải là số nguyên";
        } elseif ((int)$nam_duong < 4) {
            $nam_am = "Giá trị năm không hợp lệ";
        } else {
            $nam_duong = (int)$nam_duong;

            $can = $mang_can[($nam_duong - 4) % 10];
            $chi = $mang_chi[($nam_duong - 4) % 12];

            $nam_am = $can . " " . $chi;
            $hinh = $mang_hinh[($nam_duong - 4) % 12];
        }
    }


    ?>
    <form action="" method="post">
        <h2>Tính năm âm lịch</h2>

        <div class="group_nam">
            <div class="group">
                <label for="nam_duong">Năm dương lịch</label>
                <input type="text" name="nam_duong" value="<?php echo $nam_duong; ?>" required>
            </div>
            <input type="submit" value="=>">


            <div class="group">
                <label for="nam_am">Năm âm lịch</label>
                <input type="text" name="nam_am" style=" background-color: #fdffc0;color:red" value="<?php echo $nam_am; ?>" readonly>
            </div>
        </div>

        <img src="<?php echo $hinh ?? ''; ?>">

    </form>
</body>

</html>