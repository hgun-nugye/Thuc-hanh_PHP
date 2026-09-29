<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính tiền điện</title>
</head>
<style>
    body {
        width: 100%;
        height: 100vh;
        margin: 20px;
        font-size: 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(70deg, #b7edac, #eef1b1);
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
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        color: #154cd8;
        text-align: center;
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

    }

    input[type="number"],
    input[type="text"] {
        line-height: 2;
        width: 70%;
    }
</style>

<body>
    <form action="tinh_tien_dien.php" method="post">
        <h2>Thanh toán tiền điện </h2>

        <div class="group">
            <label for="name">Tên chủ hộ</label>
            <input type="text" name="name" value="<?php if (isset($_POST['name'])) {
                                                        echo $_POST["name"];
                                                    } ?>" required>
        </div>

        <div class="group">
            <label for="socu">Chỉ số cũ</label>
            <input type="number" name="socu" min="0" step="1" value="<?php if (isset($_POST['socu'])) {
                                                                            echo $_POST["socu"];
                                                                        } ?>" required>
        </div>

        <div class="group">
            <label for="somoi">Chỉ số mới</label>
            <input type="number" name="somoi" min="0" step="1" value="<?php if (isset($_POST['somoi'])) {
                                                                            echo $_POST["somoi"];
                                                                        } ?>" required>
        </div>

        <div class="group">
            <label for="dongia">Đơn giá</label>
            <input type="number" name="dongia" value="20000">
        </div>

        <div class="group">
            <label for="tien">Số tiền thanh toán</label>
            <input type="number" name="tien" value="<?php if ((isset($_POST["socu"])) && isset($_POST["somoi"]) && isset($_POST["name"])) {
                                                        $somoi = $_POST["somoi"];
                                                        $socu = $_POST["socu"];
                                                        $dongia = 20000;

                                                        echo ($somoi - $socu) * $dongia;
                                                    } ?>" readonly>
        </div>

        <input type="submit" value="Submit">

    </form>
</body>

</html>