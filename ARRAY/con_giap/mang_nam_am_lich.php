<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính năm âm lịch</title>
</head>
<style>
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
        padding: 30px 0;
    }

    form {
        margin: 0;
        width: 80%;
        max-width: 500px;
        height: fit-content;
        background-color: white;
        padding: 30px;
        border: 2px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    h2 {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        color: #154cd8;
        text-align: center;
        margin-bottom: 40px;
    }

    .group_nam {
        display: flex;
        align-items: flex-end;
        gap: 30px;
    }

    .group {
        flex: 1;
        margin-bottom: 20px;
        width: 100%;
        display: inline-block;
        align-items: center;

    }

    label {
        display: inline-block;
        width: 100%;
        font-weight: bold;
        margin-bottom: 20px;
    }

    input[type="submit"] {
        width: 70px;
        padding: 10px;
        border: none;
        border-radius: 6px;
        background-color: #008924;
        color: white;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        margin-bottom: 20px;
    }

    input[type="number"],
    input[type="text"] {
        line-height: 2;
        width: 100%;
        font-size: 16px;
        font-weight: bold;
    }

    .ketqua {
        font-weight: bold;
        color: green;
    }

    img {
        display: block;
        margin: auto;
        width: 200px;
        height: auto;
        max-height: 300px;
        border-radius: 14px;
    }
</style>

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

    if (isset($_POST['nam_duong'])) {
        $nam_duong = $_POST['nam_duong'];


        $can = $mang_can[($nam_duong - 4) % 10];
        $chi = $mang_chi[($nam_duong - 4) % 12];

        $nam_am = $can . " " . $chi;

        $hinh = $mang_hinh[($nam_duong - 4) % 12];
    }

    ?>
    <form action="" method="post">
        <h2>Tính năm âm lịch</h2>

        <div class="group_nam">
            <div class="group">
                <label for="nam_duong">Năm dương lịch</label>
                <input type="number" name="nam_duong" value="<?php echo $nam_duong; ?>" required>
            </div>
            <input type="submit" value="Tính">


            <div class="group">
                <label for="nam_am">Năm âm lịch</label>
                <input type="text" name="nam_am" value="<?php echo $nam_am; ?>" readonly>
            </div>
        </div>

        <img src="<?php echo $hinh ?? ''; ?>" alt="Năm">

    </form>
</body>

</html>