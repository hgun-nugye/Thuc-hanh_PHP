<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phiếu nhập thông tin</title>
</head>
<style>
    body {
        box-sizing: border-box;
        padding: 20px;
        line-height: 2;
        font-size: 20px;
    }

    a {
        width: fit-content;
        padding: 10px;
        border: none;
        border-radius: 6px;
        background-color: #9e9703bd;
        color: white;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        margin: 20px 0px;
        text-decoration: none;
    }
</style>

<body>
    <?php
    $fullname = $_POST['fullname'] ?? '';
    $address = $_POST['address'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $country = $_POST['country'] ?? '';
    $study = $_POST['study'] ?? [];
    $note = $_POST['note'] ?? '';

    echo "Bạn đã nhập thành công, dưới đây là những thông tin bạn đã nhập:<br>";

    echo "<b>Họ tên:</b> " . $fullname . "<br>";
    echo "<b>Address:</b> " . $address . "<br>";
    echo "<b>Phone:</b> " . $phone . "<br>";

    if ($gender == "nam")
        echo "<b>Gender:</b> Nam<br>";
    else
        echo "<b>Gender:</b> Nữ<br>";

    echo "<b>Country:</b> " . $country . "<br>";

    echo "<b>Study:</b> ";

    if (!empty($study)) {
        echo implode(", ", $study);
    } else {
        echo "Không chọn";
    }

    echo "<br>";

    echo "<b>Note:</b> " . $note;
    ?>
    <br>

    <a href="javascript:window.history.back(-1); ">Quay lại trang trước</a>
</body>

</html>