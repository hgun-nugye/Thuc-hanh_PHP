<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thống kê số sản phẩm </title>
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
            hd.*,
            s.Ten_sua,
            SUM(ct.So_luong) AS Tong_so_luong
        FROM hoa_don hd
        JOIN ct_hoadon ct ON hd.So_hoa_don = ct.So_hoa_don
        JOIN sua s ON ct.Ma_sua = s.Ma_sua
        WHERE MONTH(hd.Ngay_HD) = 8
          AND YEAR(hd.Ngay_HD) = 2007
        GROUP BY s.Ma_sua, s.Ten_sua
        ORDER BY Tong_so_luong ASC;";

    // 3. Thực thi câu truy vấn
    $result = mysqli_query($conn, $sql);
    if (!$result) die("<br <br> Query failed");

    // 4. Hiển thị dữ liệu
    echo "<h3 style='text-align:center; font-size: 2rem'>Thống kê số sản phẩm bán được trong tháng 8 năm 2007</h3>";
    echo "<div class='table-flex'>";

    if (mysqli_num_rows($result) != 0) {
        echo "<table border='1' cellpadding='4' cellspacing='0' class='table table-striped'";
        echo "<tr>";
        echo "<th>Ngày hóa đơn</th>";
        echo "<th>Tên sữa</th>";
        echo "<th>Số lượng</th></th>";
        echo "</tr>";

        while ($row = mysqli_fetch_array($result)) {

            echo "<tr>";
            echo "<td>" . $row["Ngay_HD"] . "</td>";
            echo "<td>" . $row["Ten_sua"] . "</td>";
            echo "<td>" . $row["Tong_so_luong"] . "</td>";
            echo "</tr>";
        }

        echo "</table> <br> <br>";
        echo "</div>";
    }

    ?>

</body>

</html>