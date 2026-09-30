<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính tích dãy số</title>
</head>
<style>
    body {
        max-width: 1200px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: auto;
        font-size: 20px;
        min-height: 100vh;
        background: linear-gradient(180deg, #fefefe, #fed4ce);
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    }

    form {
        padding: 40px;
        height: fit-content;
        width: 50%;
        max-width: 500px;
        background-color: white;
        border-radius: 8px;
        border: 2px solid #ccc;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    form:hover {
        border-color: #e4f8e8;
        box-shadow: 0 0 8px rgba(194, 252, 206, 0.4);
        outline: none;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 20px;
        margin: 0 auto;
    }

    input[type="text"],
    input[type="number"] {
        line-height: 2;
        margin: 20px auto;
        width: 100%;
        border: 2px solid #ccc;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        border-radius: 4px;
        font-size: 16px;
    }

    input[type="text"]:focus,
    input[type="number"] :focus {
        border-color: #068c21;
        box-shadow: 0 0 8px rgba(2, 102, 22, 0.4);
        outline: none;
    }

    input[type="submit"] {
        display: block;
        padding: 8px;
        width: 200px;
        margin: 20px auto 0px auto;
        font-weight: bold;
        font-size: 16px;
        color: white;
        background-color: #01aa26;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #098012;
    }

    p {
        text-align: center;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 30px;
        margin-top: 0;
        color: blue;
    }
</style>

<body>
    <form action="tich_day_so.php" method="post">
        <p>Tính tích dãy số</p>
        <label for="dayso">
            Nhập vào dãy số
        </label>
        <input type="text" name="dayso" value="<?php if (isset($_POST['dayso'])) echo  $_POST['dayso'] ?>">

        <label for="tich">
            Tích dãy số vừa nhập
        </label>
        <input type="number" name="tich" value="<?php if (isset($_POST['dayso'])) {
                                                    $day = explode(",", $_POST['dayso']);
                                                    $tich = 1;
                                                    foreach ($day as $value) {
                                                        $tich *= (float) $value;
                                                    }
                                                    echo $tich;
                                                }
                                                echo "" ?>" readonly>

        <input type="submit" name="submit" value="Tính tích">
    </form>
</body>

</html>