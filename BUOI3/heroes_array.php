<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In danh sách Hero</title>
</head>

<body>
    <?php
    $superheroes = array(
        " spider - man " => array(
            " name " => " Peter ␣ Parker ",
            " email " => " peterparker@mail . com "
        ),
        "super - man" => array(
            " name " => " Clark ␣ Kent ",
            " email " => " clarkkent@mail .com "
        ),
        "iron - man " => array(
            " name " => " Tony ␣ Stark ",
            " email " => " tonystark@mail .com "
        )
    );

    echo "<pre>";
    foreach ($superheroes as $key => $value) {
        echo $key . "\n";
        foreach ($value as $key2 => $value2) {
            echo "\t" . $key2 . ": " . $value2 . "\n";
        }
        echo "\n";
    }
    echo "</pre>";

    ?>
</body>

</html>