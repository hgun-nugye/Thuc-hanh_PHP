<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thống kê số lượng bán sữa</title>
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
            SUM(ct.So_luong) AS Tong_so_luong_ban
        FROM hang_sua h
        JOIN sua s ON h.Ma_hang_sua = s.Ma_hang_sua
        JOIN ct_hoadon ct ON s.Ma_sua = ct.Ma_sua
        JOIN hoa_don hd ON ct.So_hoa_don = hd.So_hoa_don
        WHERE h.Ten_hang_sua = 'ABBOTT'
          AND hd.Ngay_HD BETWEEN '2007-07-01' AND '2007-08-31';";

    // 3. Thực thi câu truy vấn
    $result = mysqli_query($conn, $sql);
    if (!$result) die("<br <br> Query failed");

    // 4. Hiển thị dữ liệu
    echo "<h3 style='text-align:center; font-size: 2rem'>Tổng số lượng sữa ABBOTT bán từ tháng 7 đến tháng 8 năm 2007</h3>";
    echo "<div class='table-flex'>";

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1' cellpadding='4' cellspacing='0' class='table table-striped'>";
        echo "<tr>";
        echo "<th>Tổng số lượng bán</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . ($row["Tong_so_luong_ban"] ?? 0) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>Không có dữ liệu phù hợp.</p>";
    }

    echo "</div>";

    ?>

</body>

</html>