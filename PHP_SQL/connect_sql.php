<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Test MySQL</title>
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

    th {
        text-align: center;
    }
</style>

<body>

    <?php
    // 1. Kết nối CSDL
    $conn = mysqli_connect("localhost", "root", "", "quanly_ban_sua")
        or die("Không thể kết nối: " . mysqli_connect_error());

    mysqli_set_charset($conn, "UTF8");
    if ($conn) echo "Ket noi thanh cong <br>";

    // 2. Chuẩn bị câu truy vấn
    $sql = "SELECT * FROM khach_hang";
    // $sql = "SELECT * FROM khach_hang WHERE Dien_thoai % 2=0";

    // 3. Thực thi câu truy vấn
    $result = mysqli_query($conn, $sql);
    if (!$result) die("<br <br> Query failed");

    // 4. Hiển thị dữ liệu
    echo "<h3>Danh sách khách hàng</h3>";
    echo "<div class='table-flex'>";

    if (mysqli_num_rows($result) != 0) {
        echo "<table border='1' cellpadding='4' cellspacing='0' class='table table-striped'";
        echo "<tr>";
        echo "<th>Mã KH</th>";
        echo "<th>Tên KH</th>";
        echo "<th>Phái</th>";
        echo "<th>Địa chỉ</th>";
        echo "<th>Điện thoại</th>";
        echo "<th>Email</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_array($result)) {
            if ((int)($row["Dien_thoai"]) % 2 == 0) {

                echo "<tr>";
                echo "<td>" . $row["Ma_khach_hang"] . "</td>";
                echo "<td>" . $row["Ten_khach_hang"] . "</td>";

                if ($row["Phai"] == 0)
                    echo "<td>" . "Nam" . "</td>";
                else
                    echo "<td>" . "Nữ" . "</td>";

                echo "<td>" . $row["Dia_chi"] . "</td>";


                echo "<td>" . $row["Dien_thoai"] . "</td>";
                echo "<td>" . $row["Email"] . "</td>";
                echo "</tr>";
            }
        }

        echo "</table> <br> <br>";
        echo "</div>";
    }

    ?>

</body>

</html>