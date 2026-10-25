<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Mặc định ô thời gian sẽ để trống hoặc thông báo
$timeDisplay = "Chưa bấm";

// Kiểm tra nếu người dùng đã click vào link (có tham số ?action=get_time)
if (isset($_GET['action']) && $_GET['action'] === 'get_time') {
    $timeDisplay = date('H:i:s d/m/Y');
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Không dùng Script</title>
    <style>
        table,
        th,
        td {
            border: 1px solid #ccc;
            border-collapse: collapse;
            padding: 8px;
        }
    </style>
</head>

<body>

    <!-- Click vào dòng chữ sẽ load lại trang kèm tham số action -->
    <p>
        <a href="?action=get_time">👉 Bấm vào đây để lấy thời gian</a>
    </p>

    <table>
        <tr>
            <th>Thời gian (Time Now)</th>
        </tr>
        <tr>
            <td><?php echo $timeDisplay; ?></td>
        </tr>
    </table>

</body>

</html>