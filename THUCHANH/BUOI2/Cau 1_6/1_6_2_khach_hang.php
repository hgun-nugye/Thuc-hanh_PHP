<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Liệt kê các khách hàng chưa mua hàng</title>
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
            kh.Ma_khach_hang,
            kh.Ten_khach_hang
        FROM khach_hang kh
        WHERE NOT EXISTS (
            SELECT *
            FROM hoa_don hd
            WHERE hd.Ma_khach_hang = kh.Ma_khach_hang
        );";

    // 3. Thực thi câu truy vấn
    $result = mysqli_query($conn, $sql);
    if (!$result) die("<br <br> Query failed");

    // 4. Hiển thị dữ liệu
    echo "<h3 style='text-align:center; font-size: 2rem'>Liệt kê các khách hàng chưa mua hàng</h3>";
    echo "<div class='table-flex'>";

    if (mysqli_num_rows($result) != 0) {
        echo "<table border='1' cellpadding='4' cellspacing='0' class='table table-striped'";
        echo "<tr>";
        echo "<th>Mã khách hàng</th>";
        echo "<th>Tên khách hàng</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_array($result)) {

            echo "<tr>";
            echo "<td>" . $row["Ma_khach_hang"] . "</td>";
            echo "<td>" . $row["Ten_khach_hang"] . "</td>";
            echo "</tr>";
        }

        echo "</table> <br> <br>";
        echo "</div>";
    }

    ?>

</body>

</html>