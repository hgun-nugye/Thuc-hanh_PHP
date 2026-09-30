<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xuất số chẵn</title>
</head>

<style>
    * {
        font-size: 30px;
    }
</style>

<body>

    <?php
    $so = rand(1, 100);

    echo "<strong>Những số chẵn nằm trong khoảng 1 đến " . $so . " là </strong>";
    for ($i = 1; $i <= $so; $i++) {
        if ($i % 2 == 0) {
            echo "<strong>" . $i . " </strong>";
        }
    }
    ?>
</body>

</html>