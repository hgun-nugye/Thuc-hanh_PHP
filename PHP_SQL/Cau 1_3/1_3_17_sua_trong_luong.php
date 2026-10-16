<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Liệt kê danh sách sữa</title>
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
        width: 90%;
        max-width: 1300px;
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
    $sql = "SELECT * FROM sua where Trong_luong=180 or Trong_luong=200 or Trong_luong=900";

    // 3. Thực thi câu truy vấn
    $result = mysqli_query($conn, $sql);
    if (!$result) die("<br <br> Query failed");

    // 4. Hiển thị dữ liệu
    echo "<h3 style='text-align:center; font-size: 2rem'>Danh sách sữa</h3>";
    echo "<div class='table-flex'>";

    if (mysqli_num_rows($result) != 0) {
        echo "<table border='1' cellpadding='4' cellspacing='0' class='table table-striped'";
        echo "<tr>";
        echo "<th>Tên sữa</th>";
        echo "<th>Mã hãng sữa</th>";
        echo "<th>Mã loại sữa</th>";
        echo "<th>Trọng lượng</th>";
        echo "<th>Đơn giá</th>";
        echo "<th>Thành phần Dinh dưỡng</th>";
        echo "<th>Lợi ích</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row["Ten_sua"] . "</td>";
            echo "<td>" . $row["Ma_hang_sua"] . "</td>";
            echo "<td>" . $row["Ma_loai_sua"] . "</td>";
            echo "<td>" . $row["Trong_luong"] . "</td>";
            echo "<td>" . $row["Don_gia"] . "</td>";

            echo "<td>" . $row["TP_Dinh_Duong"] . "</td>";
            echo "<td>" . $row["Loi_ich"] . "</td>";
            echo "</tr>";
        }

        echo "</table> <br> <br>";
        echo "</div>";
    }

    ?>

</body>

</html>