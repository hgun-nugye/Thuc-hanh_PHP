<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm</title>
</head>
<style>
    body {
        width: 100%;
        height: 100vh;
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
        max-width: 700px;
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
        text-transform: uppercase;
        margin-bottom: 40px;
    }

    .group {
        margin-bottom: 20px;
        width: 100%;
        display: flex;
        align-items: center;

    }

    label {
        display: inline-block;
        width: 30%;
        font-weight: bold;
    }

    input[type="submit"] {
        width: 100px;
        padding: 10px;
        border: none;
        border-radius: 6px;
        background-color: #008924;
        color: white;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        display: block;
        margin: auto;
        margin-bottom: 20px;

    }

    input[type="number"],
    input[type="text"] {
        line-height: 2;
        width: 70%;
        font-size: 16px;
    }

    .ketqua {
        border: none;
        font-weight: bold;
        color: green;
    }
</style>

<body>
    <form action="" method="post">
        <h2>Tìm kiếm</h2>

        <div class="group">
            <label for="mang">Nhập mảng</label>
            <input type="text" name="mang" value="<?php if (isset($_POST['mang'])) {
                                                        $mang = $_POST["mang"];
                                                        echo $mang;
                                                    } ?>" required>
        </div>

        <div class="group">
            <label for="so">Nhập số cần tìm</label>
            <input type="number" name="so" value="<?php if (isset($_POST['so'])) {
                                                        echo $_POST["so"];
                                                    } ?>" required>
        </div>

        <input type="submit" value="Tìm kiếm">

        <div class="group">
            <label for="mang_da_co">Mảng</label>
            <input type="text" name="mang_da_co"
                value="<?php if (isset($_POST['mang'])) echo $_POST['mang']; ?>"
                readonly>
        </div>

        <div class="group">
            <label for="ketqua">Kết quả tìm kiếm</label>
            <input class="ketqua" type="text" name="ketqua"
                value="<?php
                        if (isset($_POST['mang'])) {
                            $mang = explode(',', $_POST['mang']);
                            $mang = array_map('trim', $mang);
                            if (isset($_POST['so'])) {
                                $so = $_POST['so'];
                                if (in_array($so, $mang)) {
                                    echo "Tìm thấy $so tại vị trí thứ " . (array_search($so, $mang) + 1) . " trong mảng";
                                } else {
                                    echo "Không tìm thấy số $so trong mảng";
                                }
                            }
                        }
                        ?>"
                readonly>
        </div>

    </form>
</body>

</html>