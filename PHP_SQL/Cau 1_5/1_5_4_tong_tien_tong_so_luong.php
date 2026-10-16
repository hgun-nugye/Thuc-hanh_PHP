<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thống kê tổng giá tiền và số sản phẩm của sữa </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>
<style>
    * {
        box-sizing: border-box;
    }

    body {
        width: 100%;
        padding: 40px;
        height: 100vh;

    }

    .table-flex {
        display: flex;
        justify-content: center;

    }

    table {
        width: 80%;
        max-width: 800px;
        margin-top: 20px;
    }
</style>

<body>

    <?php
    // 1. Kết nối CSDL
    $conn = mysqli_connect("localhost", "root", "", "quanly_ban_sua")
        or die("Không thể kết nối: " . mysqli_connect_error());

    mysqli_set_charset($conn, "UTF8");

    // 2. Chuẩn bị câu truy vấn
    $sql = "SELECT
            h.Ten_hang_sua AS Ten_hang_sua,
            SUM(s.Don_gia) AS Tong_gia_tien,
            COUNT(s.Ma_sua) AS So_san_pham
        FROM hang_sua h
        JOIN sua s ON h.Ma_hang_sua = s.Ma_hang_sua
        WHERE s.Trong_luong BETWEEN 400 AND 500
        GROUP BY h.Ma_hang_sua
        ORDER BY h.Ma_hang_sua;";

    // 3. Thực thi câu truy vấn
    $result = mysqli_query($conn, $sql);
    if (!$result) die("<br <br> Query failed");

    // 4. Hiển thị dữ liệu
    echo "<h3 style='text-align:center; font-size: 2rem'>Thống kê tổng giá tiền và số sản phẩm của sữa có trọng lượng trong khoảng 400gr và 500</h3>";
    echo "<div class='table-flex'>";

    if (mysqli_num_rows($result) != 0) {
        echo "<table border='1' cellpadding='4' cellspacing='0' class='table table-striped'";
        echo "<tr>";
        echo "<th>Tên hãng sữa</th>";
        echo "<th>Tổng giá tiền</th>";
        echo "<th>Số lượng</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_array($result)) {

            echo "<tr>";
            echo "<td>" . $row["Ten_hang_sua"] . "</td>";
            echo "<td>" . $row["Tong_gia_tien"] . "</td>";
            echo "<td>" . $row["So_san_pham"] . "</td>";
            echo "</tr>";
        }

        echo "</table> <br> <br>";
        echo "</div>";
    }

    ?>

</body>

</html>