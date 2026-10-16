<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sửa thông tin khách hàng</title>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">

    <?php
    // 1. Kết nối cơ sở dữ liệu
    $conn = mysqli_connect(
        "localhost",
        "root",
        "",
        "quanly_ban_sua"
    );

    if (!$conn) {
        die("Không thể kết nối: " . mysqli_connect_error());
    }

    mysqli_set_charset($conn, "utf8mb4");

    // 2. Lấy mã khách hàng từ URL
    $ma_kh = $_GET["ma_kh"] ?? "";

    // 3. Nếu nhấn nút Cập nhật
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $ma_kh = $_POST["Ma_khach_hang"];
        $ten = trim($_POST["Ten_khach_hang"]);
        $phai = $_POST["Phai"];
        $dia_chi = trim($_POST["Dia_chi"]);
        $dien_thoai = trim($_POST["Dien_thoai"]);
        $email = trim($_POST["Email"]);

        // Cập nhật thông tin khách hàng
        $sql_update = "UPDATE khach_hang
                   SET Ten_khach_hang = ?,
                       Phai = ?,
                       Dia_chi = ?,
                       Dien_thoai = ?,
                       Email = ?
                   WHERE Ma_khach_hang = ?";

        $stmt = mysqli_prepare($conn, $sql_update);

        mysqli_stmt_bind_param(
            $stmt,
            "sissss",
            $ten,
            $phai,
            $dia_chi,
            $dien_thoai,
            $email,
            $ma_kh
        );

        if (mysqli_stmt_execute($stmt)) {
            echo "<div class='alert alert-success'>
                Cập nhật thông tin khách hàng thành công!
              </div>";
        } else {
            echo "<div class='alert alert-danger'>
                Cập nhật thất bại!
              </div>";
        }

        mysqli_stmt_close($stmt);
    }

    // 4. Lấy thông tin khách hàng để hiển thị lên form
    $sql = "SELECT * FROM khach_hang WHERE Ma_khach_hang = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $ma_kh);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        die("Không tìm thấy khách hàng!");
    }
    ?>

    <h3 class="text-center mb-4">SỬA THÔNG TIN KHÁCH HÀNG</h3>

    <form method="post" class="mx-auto" style="max-width: 600px;">

        <div class="mb-3">
            <label class="form-label">Mã khách hàng</label>
            <input type="text" name="Ma_khach_hang"
                class="form-control"
                value="<?= htmlspecialchars($row['Ma_khach_hang']) ?>"
                readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Tên khách hàng</label>
            <input type="text" name="Ten_khach_hang"
                class="form-control"
                value="<?= htmlspecialchars($row['Ten_khach_hang']) ?>"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Phái</label>
            <select name="Phai" class="form-select">
                <option value="0"
                    <?= $row['Phai'] == 0 ? 'selected' : '' ?>>
                    Nam
                </option>

                <option value="1"
                    <?= $row['Phai'] == 1 ? 'selected' : '' ?>>
                    Nữ
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Địa chỉ</label>
            <input type="text" name="Dia_chi"
                class="form-control"
                value="<?= htmlspecialchars($row['Dia_chi'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Điện thoại</label>
            <input type="text" name="Dien_thoai"
                class="form-control"
                value="<?= htmlspecialchars($row['Dien_thoai'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="Email"
                class="form-control"
                value="<?= htmlspecialchars($row['Email'] ?? '') ?>">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">
                Cập nhật
            </button>

            <a href="connect_sql.php" class="btn btn-secondary">
                Quay lại
            </a>
        </div>

    </form>

    <?php
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    ?>

</body>

</html>