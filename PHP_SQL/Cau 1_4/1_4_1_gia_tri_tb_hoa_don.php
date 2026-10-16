<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trị giá trung bình của các hóa đơn</title>
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
    $sql = "SELECT avg(Tri_gia) as Tri_gia_tb FROM hoa_don";

    // 3. Thực thi câu truy vấn
    $result = mysqli_query($conn, $sql);
    if (!$result) die("<br <br> Query failed");

    // 4. Hiển thị dữ liệu 
    $tri_gia_tb = 0;
    if (mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_array($result);
        $tri_gia_tb = number_format($row['Tri_gia_tb'], 0, ',', ' ');
    }
    echo "<h4>Trị giá trung bình của các hóa đơn là: " . $tri_gia_tb . " VND </h4> ";
    ?>
</body>

</html>