<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Test MySQL</title>
</head>

<body>

    <?php
    echo "<h3>Danh sách sinh viên và lớp</h3>";

    // 1. Kết nối CSDL
    $conn = mysqli_connect("localhost", "root", "", "65.cntt-2")
        or die("Không thể kết nối: " . mysqli_connect_error());

    // 2. Chuẩn bị câu truy vấn
    $sql_lop = "SELECT * FROM lop";

    // 3. Thực thi câu truy vấn
    $result = mysqli_query($conn, $sql_lop);

    // 4. Hiển thị dữ liệu
    echo "<table border='1' cellpadding='8' cellspacing='0'>";

    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Mã lớp</th>";
    echo "<th>Tên lớp</th>";
    echo "</tr>";

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["malop"] . "</td>";
        echo "<td>" . $row["tenlop"] . "</td>";
        echo "</tr>";
    }

    echo "</table> <br> <br>";


    $sql_sinhvien = "SELECT * FROM sinh_vien";
    $result_sinhvien = mysqli_query($conn, $sql_sinhvien);
    echo "<table border='1' cellpadding='8' cellspacing='0'>";

    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Tên</th>";
    echo "<th>MSSV</th>";
    echo "<th>Ngày sinh</th>";
    echo "<th>Lớp</th>";
    echo "</tr>";

    while ($row = mysqli_fetch_array($result_sinhvien)) {

        echo "<tr>";

        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["ten"] . "</td>";
        echo "<td>" . $row["mssv"] . "</td>";
        echo "<td>" . $row["dob"] . "</td>";
        echo "<td>" . $row["lop"] . "</td>";

        echo "</tr>";
    }

    echo "</table> <br> <br>";

    $sql_join = "
            SELECT sinh_vien.id,
                sinh_vien.ten,
                sinh_vien.mssv,
                sinh_vien.dob,
                lop.malop,
                lop.tenlop
            FROM sinh_vien
            INNER JOIN lop
            ON sinh_vien.lop = lop.id
        ";

    $result_join = mysqli_query($conn, $sql_join);

    echo "<table border='1' cellpadding='8' cellspacing='0'>";

    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Tên</th>";
    echo "<th>MSSV</th>";
    echo "<th>Ngày sinh</th>";
    echo "<th>Mã lớp</th>";
    echo "<th>Tên lớp</th>";
    echo "</tr>";

    while ($row = mysqli_fetch_array($result_join)) {

        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["ten"] . "</td>";
        echo "<td>" . $row["mssv"] . "</td>";
        echo "<td>" . $row["dob"] . "</td>";
        echo "<td>" . $row["malop"] . "</td>";
        echo "<td>" . $row["tenlop"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    // 5. Đóng kết nối
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>

</body>

</html>