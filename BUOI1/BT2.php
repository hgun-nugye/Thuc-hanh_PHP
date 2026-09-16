<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng cửu chương</title>
</head>

<style>
    * {
        font-size: 24px;
        text-align: center;
    }

    h2 {
        text-align: center;
        font-size: 36px;
        text-transform: uppercase;
    }
</style>

<body>

    <h2> Bảng cửu chương</h2>
    <table border="1" width='full' cellspacing='0' cellpadding='10px' style="margin: 0 auto;">

        <tr>
            <?php
            for ($i = 1; $i <= 10; $i++) {
                echo "<th> Chương " . $i . "</th>";
            }
            ?>
        </tr>

        <?php
        echo "<tr>";
        for ($i = 1; $i <= 10; $i++) {
            echo "<td>";
            for ($j = 1; $j <= 10; $j++) {
                echo "$i " . "*" . " $j" . " = " .  $i * $j . "<br>";
            }
            echo "</td>";
        }
        echo "</tr>";
        ?>
        </tabl>
</body>

</html>