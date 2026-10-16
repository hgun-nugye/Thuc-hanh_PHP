<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <title>Thông tin hãng sữa</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .table-flex {
            display: flex;
            justify-content: center;
        }

        h3 {
            text-align: center;
            line-height: 2;
            color: #2f71f4;
        }
    </style>
</head>

<body>
    <?php
    //1. ket noi csdl
    $conn = mysqli_connect("localhost", "root", "", "quanly_ban_sua") or die("Khong the ket noi" . mysqli_connect_error());

    mysqli_set_charset($conn, "UTF8");

    //2. chuan bi cau truy van
    $sql = "select * from hang_sua";

    //3. thuc thi cau truy van
    $result = mysqli_query($conn, $sql);
    if (!$result) die("Query failed!");

    //4. hien thi du lieu
    echo "<h3>THÔNG TIN HÃNG SỮA</h3>";

    echo "<div class='table-flex'>";
    if (mysqli_num_rows($result) != 0) {

        echo "<table border ='1'cellpadding='4' cellspacing='0'";
        echo "<tr>";
        echo "<td style='text-align:center'>Mã hãng</td>";
        echo "<td style='text-align:center'>Tên hãng</td>";
        echo "<td style='text-align:center'>Địa chỉ</td>";
        echo "<td style='text-align:center'>Điện thoại</td>";
        echo "<td style='text-align:center'>Email</td>";
        echo "</tr>";

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row["Ma_hang_sua"] . "</td>";
            echo "<td>" . $row["Ten_hang_sua"] . "</td>";
            echo "<td>" . $row["Dia_chi"] . "</td>";
            echo "<td>" . $row["Dien_thoai"] . "</td>";
            echo "<td>" . $row["Email"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    echo "</div>";


    ?>

</body>

</html>