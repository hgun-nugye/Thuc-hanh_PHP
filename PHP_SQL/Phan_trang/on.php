<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test phan trang</title>
</head>

<body>
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'quanly_ban_sua') or die('Không thể kết nối tới database' . mysqli_connect_error());

    // $row_per_page = 10;
    // if (! isset($_GET['page'])) {
    //     $_GET['page'] = 1;
    // }
    // $offset = ($_GET['page'] - 1) * $row_per_page;

    $row_per_page = 10;

    // Ép kiểu (int) để $_GET['page'] luôn là số nguyên
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) {
        $page = 1;
    }

    $offset = ($page - 1) * $row_per_page;

    $sql = "select * from sua LIMIT $offset, $row_per_page";
    $re = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($re);

    // $max_page = ceil($num_rows / $row_per_page);

    if ($num_rows <> 0) {
        echo "<p align='center'><font size='5' color='blue'> THÔNG TIN SUA</font></P>";
        echo "<table align='center' width='80%' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>";
        echo "<tr>
	    	<th>SO TT</th>
	     	<th>Tên Sua</th>
	    	<th>Hang Sua</th>
	    	<th>Loai Sua</th>
			<th>Trong Luong</th>
			<th>Don gia</th>
		
		</tr>";
        $bg = '#eeeeee';
        $bg2 = 'pink';
        $sel = 0;

        while ($rows = mysqli_fetch_array($re)) {
            $sel++;
            if ($sel % 2 == 0) {
                echo "<tr bgcolor='" . $bg . "'>";
                echo "<td>{$rows['Ma_sua']}</td>";
                echo "<td>{$rows['Ten_sua']}</td>";
                echo "<td>{$rows['Ma_hang_sua']}</td>";
                echo "<td>{$rows['Ma_loai_sua']}</td>";
                echo "<td>{$rows['Trong_luong']}</td>";
                echo "<td>{$rows['Don_gia']}</td>";
                echo "</tr>";
            } else {
                echo "<tr bgcolor='" . $bg2 . "'>";
                echo "<td>{$rows['Ma_sua']}</td>";
                echo "<td>{$rows['Ten_sua']}</td>";
                echo "<td>{$rows['Ma_hang_sua']}</td>";
                echo "<td>{$rows['Ma_loai_sua']}</td>";
                echo "<td>{$rows['Trong_luong']}</td>";
                echo "<td>{$rows['Don_gia']}</td>";
                echo "</tr>";
            }
        }
        echo "</table>";

        $result = mysqli_query($conn, "select * from sua");
        $numRows = mysqli_num_rows($result);
        $max_page = ceil($numRows / $row_per_page);
        echo "<center>";

        if ($_GET['page'] > 1) {
            echo "<a href = " . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] - 1) . ">Back</a>";
        }

        for ($i = 1; $i <= $max_page; $i++) {
            if ($i == $_GET['page']) echo "<b>Trang $i</b>";
            else {
                echo "<a href =" . $_SERVER['PHP_SELF'] . "?page=" . $i . ">Trang $i</a>";
            }
        }

        if ($_GET['page'] < $max_page) {
            echo "<a href = " . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] + 1) . ">Next</a>";
        }


        echo "</center>";
        echo "Tong so trang la $max_page";
    }
    ?>
</body>

</html>