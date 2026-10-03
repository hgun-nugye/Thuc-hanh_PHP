<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính tổng dãy số</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            background: white;
        }

        form {
            width: 700px;
            max-width: 95%;
            background-color: #cedbd1;
            border: 1px solid #ddd;
            padding-bottom: 20px;
        }

        h2 {
            text-align: center;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            font-weight: bold;
            font-size: 30px;
            font-style: italic;
            text-transform: uppercase;
            color: white;
            background-color: #299c94;
            margin: 0;
            padding: 8px 5px;
            margin-bottom: 20px;
        }

        .group {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .group>label {
            width: 180px;
            flex-shrink: 0;
            font-weight: normal;
            margin-left: 20px;
        }

        input[type="text"],
        input[type="number"] {
            width: 340px;
            max-width: 100%;
            height: 35px;
            font-family: inherit;
            font-size: 20px;
            padding: 3px 5px;
            border: 2px inset #ddd;
            border-radius: 0;
            margin: 0;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            outline: none;
        }

        .required {
            color: #c44b4b;
            margin: 0 0 0 8px;
        }

        input[type="submit"] {
            display: block;
            width: 195px;
            margin-left: 200px;
            margin-top: 20px;
            margin-bottom: 20px;
            font-family: inherit;
            font-size: 20px;
            font-weight: bold;
            padding: 4px;
            color: #665d22;
            background-color: #fff59b;
            border: 2px outset #e8dc78;
            border-radius: 0;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #f8e96e;
        }

        input[name="tong"] {
            background-color: #cafa9c;
            color: #a34d27;
        }

        .note {
            text-align: center;
            font-size: 18px;
            margin: 20px 0 0;
        }
    </style>
</head>

<body>

    <form action="tong_day_so.php" method="post">

        <h2>Nhập và tính trên dãy số</h2>

        <div class="group">
            <label for="dayso">Nhập dãy số:</label>

            <input type="text" name="dayso" id="dayso"
                value="<?php
                        if (isset($_POST['dayso'])) {
                            echo htmlspecialchars($_POST['dayso']);
                        }
                        ?>">

            <p class="required">(*)</p>
        </div>

        <input type="submit" name="submit" value="Tổng dãy số">

        <div class="group">
            <label for="tong">Tổng dãy số:</label>

            <input type="text" name="tong" id="tong"
                value="<?php
                        if (isset($_POST['dayso']) && trim($_POST['dayso']) !== '') {
                            $day = explode(",", $_POST['dayso']);
                            $tong = 0;

                            foreach ($day as $value) {
                                $tong += (float) trim($value);
                            }

                            echo $tong;
                        }
                        ?>"
                readonly>
        </div>

        <p class="note">
            <span class="required">(*)</span>
            Các số được nhập cách nhau bằng dấu ","
        </p>

    </form>

</body>

</html>