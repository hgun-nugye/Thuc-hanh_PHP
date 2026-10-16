<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <title>Thông tin khách hàng</title>
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
            font-size: 2rem;
        }

        .first-tr {
            color: #980124;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    //1. ket noi csdl
    $conn = mysqli_connect("localhost", "root", "", "quanly_ban_sua") or die("Khong the ket noi" . mysqli_connect_error());

    mysqli_set_charset($conn, "UTF8");

    //2. chuan bi cau truy van
    $sql = "select * from khach_hang";

    //3. thuc thi cau truy van
    $result = mysqli_query($conn, $sql);
    if (!$result) die("Query failed!");

    //4. hien thi du lieu
    echo "<h3>THÔNG TIN KHÁCH HÀNG</h3>";

    echo "<div class='table-flex'>";
    if (mysqli_num_rows($result) != 0) {

        echo "<table border ='1'cellpadding='4' cellspacing='0'";
        echo "<tr>";
        echo "<td class ='first-tr' style='text-align:center'>Mã KH</td>";
        echo "<td class ='first-tr' style='text-align:center'>Tên khách hàng</td>";
        echo "<td class ='first-tr' style='text-align:center'>Giới tính</td>";
        echo "<td class ='first-tr' style='text-align:center'>Địa chỉ</td>";
        echo "<td class ='first-tr' style='text-align:center'>Điện thoại</td>";
        echo "</tr>";

        $count = 0;
        while ($row = mysqli_fetch_array($result)) {
            if ($count % 2 == 0) {
                echo "<tr style='background-color:#f8b262'>";
            } else {
                echo "<tr'>";
            }
            echo "<td>" . $row["Ma_khach_hang"] . "</td>";
            echo "<td>" . $row["Ten_khach_hang"] . "</td>";
            echo "<td style='text-align:center'>" . $row["Phai"] . "</td>";
            echo "<td>" . $row["Dia_chi"] . "</td>";
            echo "<td>" . $row["Dien_thoai"] . "</td>";
            echo "</tr>";

            $count++;
        }
        echo "</table>";
    }
    echo "</div>";


    ?>

</body>

</html>