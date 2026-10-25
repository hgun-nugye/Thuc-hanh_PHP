<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Thông tin khách hàng</title>
</head>

<body>
    <?php
    // require('config.php');
    //$conn = mysqli_connect('localhost', 'root', '', 'quanly_ban_sua')
    $conn = mysqli_connect('localhost', 'root', '', 'quanly_ban_sua') or die('Không thể kết nối tới database' . mysqli_connect_error());
    mysqli_set_charset($conn, 'utf8');

    //phan trang
    $rowsPerPage = 10;
    if (! isset($_GET['page'])) {
        $_GET['page'] = 1;
    }

    $offset = ($_GET['page'] - 1) * $rowsPerPage;

    $query = "Select * from sua LIMIT $offset, $rowsPerPage";
    $result = mysqli_query($conn, $query);

    $numRows = mysqli_num_rows($result);
    $maxPage = ceil($numRows / $rowsPerPage);

    //print_r(mysqli_fetch_array($result));
    if ($numRows <> 0) {
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

        while ($rows = mysqli_fetch_array($result)) {
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

        $re = mysqli_query($conn, 'select * from sua');
        $numRows = mysqli_num_rows($re);
        $maxPage = ceil($numRows / $rowsPerPage);
        echo "<center>";
        if ($_GET['page'] > 1) {
            echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] - 1) . ">Back</a> "; //gắn thêm nút Back
        }
        for ($i = 1; $i <= $maxPage; $i++) {
            if ($i == $_GET['page']) {
                echo '<b>Trang' . $i . '</b> '; //trang hiện tại sẽ được bôi đậm
            } else echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . $i . ">Trang " . $i . "</a> ";
        }
        if ($_GET['page'] < $maxPage) {
            echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] + 1) . ">Next</a>";  //gắn thêm nút Next
        }
        echo "</center>";

        echo 'Tong so trang la: ' . $maxPage;
        // echo '<center>Tong so trang la: ' . $maxPage . "</center>";
    }
    mysqli_close($conn);
    ?>
</body>

</html>