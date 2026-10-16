<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Liệt kê các hóa đơn</title>
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
        max-width: 1200px;
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
    $sql = "select *, DATE_FORMAT(Ngay_HD, '%W - %d - %M - %Y') AS Ngay_HD from hoa_don;";

    // 3. Thực thi câu truy vấn
    $result = mysqli_query($conn, $sql);
    if (!$result) die("<br <br> Query failed");

    // 4. Hiển thị dữ liệu
    echo "<h3 style='text-align:center; font-size: 2rem'>Danh sách hóa đơn</h3>";
    echo "<div class='table-flex'>";

    if (mysqli_num_rows($result) != 0) {
        echo "<table border='1' cellpadding='4' cellspacing='0' class='table table-striped'>";
        echo "<tr>";
        echo "<th>Số Hóa đơn</th>";
        echo "<th>Ngày</th>";
        echo "<th>Mã khách hàng</th>";
        echo "<th>Trị giá</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_assoc($result)) {

            echo "<tr>";
            echo "<td>" . $row["So_hoa_don"] . "</td>";
            echo "<td>" . $row["Ngay_HD"] . "</td>";
            echo "<td>" . $row["Ma_khach_hang"] . "</td>";
            echo "<td>" . $row["Tri_gia"] . "</td>";
            echo "</tr>";
        }

        echo "</table> <br> <br>";
        echo "</div>";
    }

    ?>

</body>

</html>