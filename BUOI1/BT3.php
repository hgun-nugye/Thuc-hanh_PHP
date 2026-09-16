<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiểm tra số ngẫu nhiên</title>
</head>

<style>
    body {
        font-size: 24px;
        line-height: 1.5;
    }
</style>

<body><?php
        $so = rand(-100, 100);
        echo "<strong> Số ngẫu nhiên là: " . $so . " </strong></br>";
        if ($so > 0) {

            $so_uoc = 0;
            echo "Các ước số của " . $so . " la ";
            for ($i = 1; $i <= $so / 2; $i++) {
                if ($so % $i == 0) {
                    echo $i . " ";
                    $so_uoc++;
                }
            }
            echo "</br>";

            if ($so === 1) {
                echo $so . " không phải là số nguyên tố" . "</br>";
            }

            if ($so_uoc > 0) {
                echo $so . " không phải là số nguyên tố" . "</br>";
            } else {
                echo $so . " là số nguyên tố" . "</br>";
            }


            $snt = [];
            $dem = 0;
            for ($i = 2; $i < $so; $i++) {

                for ($j = 2; $j <= $i; $j++) {
                    if ($i % $j == 0) {
                        break;
                    } else {
                        $snt[] = $i;
                        $dem++;
                        break;
                    }
                }
            }
            if ($dem == 0) {
                echo "Không có số nguyên tố nào nhỏ hơn " . $so;
            } else {
                echo "Các số nguyên tố nhỏ hơn " . $so . " la: ";
                foreach ($snt as $value) {
                    echo "<strong>" . $value . "</strong> ";
                }
            }

            echo "</br>";
            if (sqrt($so) === floor(sqrt($so))) {
                echo $so . "là số nguyên tố.";
            } else {
                echo $so . " không phải là số chính phương.";
            }
        }

        ?></body>

</html>