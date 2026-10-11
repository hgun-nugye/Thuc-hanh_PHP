<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thống kê tổng số sữa của mỗi loại sữa</title>
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
            l.*, s.*, count(s.Ma_loai_sua) as So_loai_sua
        FROM loai_sua l
        LEFT JOIN sua s ON l.Ma_loai_sua = s.Ma_loai_sua
        GROUP BY l.Ma_loai_sua";

    // 3. Thực thi câu truy vấn
    $result = mysqli_query($conn, $sql);
    if (!$result) die("<br <br> Query failed");

    // 4. Hiển thị dữ liệu
    echo "<h3 style='text-align:center; font-size: 2rem'>Thống kê tổng số sữa của mỗi loại sữa</h3>";
    echo "<div class='table-flex'>";

    if (mysqli_num_rows($result) != 0) {
        echo "<table border='1' cellpadding='4' cellspacing='0' class='table table-striped'";
        echo "<tr>";
        echo "<th>Tên loại sữa</th>";
        echo "<th>Tổng số sản phẩm</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_array($result)) {

            echo "<tr>";
            echo "<td>" . $row["Ten_loai"] . "</td>";
            echo "<td>" . $row["So_loai_sua"] . "</td>";
            echo "</tr>";
        }

        echo "</table> <br> <br>";
        echo "</div>";
    }

    ?>

</body>

</html>