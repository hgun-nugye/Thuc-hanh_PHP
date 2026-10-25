<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

function h($value)
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function hienThi($ten, $code, $ketQua)
{
    echo "<div class='example'>";
    echo "<h3>" . h($ten) . "</h3>";
    echo "<pre class='code'>" . h($code) . "</pre>";
    echo "<strong>Kết quả:</strong>";
    echo "<pre>" . h(is_array($ketQua) ? print_r($ketQua, true) : var_export($ketQua, true)) . "</pre>";
    echo "</div>";
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tổng hợp hàm MySQL và PHP</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            padding: 25px;
            margin: 0;
            background: #f3f5f7;
        }

        main {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        h2 {
            color: #174a7e;
            border-bottom: 2px solid #ddd;
            padding-bottom: 8px;
            margin-top: 35px;
        }

        .example {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
        }

        .code {
            background: #20252b;
            color: white;
            padding: 12px;
            border-radius: 5px;
            white-space: pre-wrap;
            overflow-wrap: anywhere;
        }

        pre {
            background: #f1f3f5;
            padding: 12px;
            white-space: pre-wrap;
            overflow-wrap: anywhere;
        }

        .note {
            background: #fff5d6;
            border-left: 4px solid orange;
            padding: 12px;
            margin: 15px 0;
        }

        input,
        button {
            padding: 9px;
            margin: 5px 0;
            max-width: 100%;
        }

        button {
            cursor: pointer;
        }

        a {
            color: #075db5;
            margin-right: 15px;
        }

        .demo {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 15px 0;
        }

        .result {
            background: #eaf4ff;
            padding: 12px;
            min-height: 42px;
            overflow-wrap: anywhere;
        }

        @media (max-width: 600px) {
            body {
                padding: 8px;
            }

            main {
                padding: 12px;
            }
        }
    </style>
</head>

<body>
    <main>
        <h1>TỔNG HỢP HÀM MYSQL VÀ PHP</h1>

        <div class="note">
            <b>Lưu ý:</b> Ví dụ PHP hiển thị kết quả ngay trên trang.
            Các câu SQL MySQL là câu lệnh mẫu, cần chạy trong MySQL/phpMyAdmin
            và thay tên bảng, cột theo cơ sở dữ liệu thực tế.
        </div>

        <!-- PHẦN 1: MYSQL -->
        <h2>PHẦN 1. Các hàm và câu lệnh MySQL thông dụng</h2>

        <?php
        $mysql = [
            [
                "COUNT() - đếm số dòng",
                "SELECT COUNT(*) FROM sinh_vien;",
                "Đếm số sinh viên."
            ],
            [
                "SUM() - tính tổng",
                "SELECT SUM(SoLuong) FROM san_pham;",
                "Tính tổng số lượng sản phẩm."
            ],
            [
                "AVG() - tính trung bình",
                "SELECT AVG(Diem) FROM sinh_vien;",
                "Tính điểm trung bình."
            ],
            [
                "MAX() và MIN() - lớn nhất, nhỏ nhất",
                "SELECT MAX(DonGia), MIN(DonGia) FROM san_pham;",
                "Tìm giá cao nhất và thấp nhất."
            ],
            [
                "CONCAT() - nối chuỗi",
                "SELECT CONCAT(Ho, ' ', Ten) FROM sinh_vien;",
                "Nối họ và tên."
            ],
            [
                "UPPER() và LOWER() - đổi chữ hoa/thường",
                "SELECT UPPER(HoTen), LOWER(HoTen) FROM sinh_vien;",
                "Chuyển chuỗi thành chữ hoa hoặc chữ thường."
            ],
            [
                "LENGTH() - độ dài theo byte",
                "SELECT LENGTH(HoTen) FROM sinh_vien;",
                "Đếm số byte của chuỗi."
            ],
            [
                "CHAR_LENGTH() - đếm ký tự",
                "SELECT CHAR_LENGTH(HoTen) FROM sinh_vien;",
                "Đếm số ký tự của chuỗi."
            ],
            [
                "SUBSTRING() - cắt chuỗi",
                "SELECT SUBSTRING(HoTen, 1, 3) FROM sinh_vien;",
                "Lấy 3 ký tự từ vị trí đầu."
            ],
            [
                "REPLACE() - thay chuỗi",
                "SELECT REPLACE(HoTen, 'An', 'Anh') FROM sinh_vien;",
                "Thay An bằng Anh trong chuỗi."
            ],
            [
                "ROUND() - làm tròn",
                "SELECT ROUND(AVG(Diem), 2) FROM sinh_vien;",
                "Làm tròn điểm trung bình đến 2 chữ số thập phân."
            ],
            [
                "IFNULL() - thay giá trị NULL",
                "SELECT IFNULL(DiaChi, 'Chưa cập nhật') FROM sinh_vien;",
                "Nếu địa chỉ là NULL thì hiển thị Chưa cập nhật."
            ],
            [
                "COALESCE() - lấy giá trị đầu tiên khác NULL",
                "SELECT COALESCE(DiaChi, 'Chưa cập nhật') FROM sinh_vien;",
                "Trả về giá trị đầu tiên không phải NULL."
            ],
            [
                "CASE WHEN - phân loại theo điều kiện",
                "SELECT HoTen,\nCASE\n WHEN Diem >= 8 THEN 'Giỏi'\n WHEN Diem >= 6.5 THEN 'Khá'\n ELSE 'Trung bình hoặc yếu'\nEND AS XepLoai\nFROM sinh_vien;",
                "Phân loại sinh viên theo điểm."
            ],
            [
                "YEAR(), MONTH(), DAY() - lấy thành phần ngày",
                "SELECT YEAR(NgayLap), MONTH(NgayLap), DAY(NgayLap) FROM hoa_don;",
                "Lấy năm, tháng và ngày."
            ],
            [
                "DATE_FORMAT() - định dạng ngày",
                "SELECT DATE_FORMAT(NgayLap, '%d/%m/%Y') FROM hoa_don;",
                "Hiển thị ngày theo dạng ngày/tháng/năm."
            ],
            [
                "DATEDIFF() - khoảng cách giữa hai ngày",
                "SELECT DATEDIFF('2026-12-31', '2026-01-01');",
                "Tính số ngày giữa hai ngày."
            ],
            [
                "NOW() - ngày giờ hiện tại",
                "SELECT NOW();",
                "Lấy ngày giờ hiện tại của máy chủ MySQL."
            ],
            [
                "CURDATE() và CURTIME()",
                "SELECT CURDATE(), CURTIME();",
                "Lấy ngày hiện tại và giờ hiện tại."
            ],
            [
                "GROUP BY - gom nhóm",
                "SELECT MaKH, SUM(TongTien)\nFROM hoa_don\nGROUP BY MaKH;",
                "Tính tổng tiền theo từng khách hàng."
            ],
            [
                "HAVING - lọc nhóm",
                "SELECT MaKH, COUNT(*) AS SoHoaDon\nFROM hoa_don\nGROUP BY MaKH\nHAVING COUNT(*) >= 2;",
                "Chỉ lấy khách có ít nhất 2 hóa đơn."
            ],
            [
                "ORDER BY và LIMIT",
                "SELECT * FROM san_pham\nORDER BY DonGia DESC\nLIMIT 5;",
                "Lấy 5 sản phẩm có giá cao nhất."
            ],
            [
                "LIKE - tìm theo mẫu",
                "SELECT * FROM sinh_vien WHERE HoTen LIKE 'Nguyen%';",
                "Tìm tên bắt đầu bằng Nguyen. % đại diện cho chuỗi bất kỳ."
            ],
            [
                "IN và BETWEEN",
                "SELECT * FROM san_pham WHERE DonGia BETWEEN 10000 AND 50000;\nSELECT * FROM sinh_vien WHERE MaSV IN ('SV01', 'SV02');",
                "BETWEEN lọc khoảng; IN kiểm tra giá trị trong danh sách."
            ],
            [
                "IS NULL và IS NOT NULL",
                "SELECT * FROM sinh_vien WHERE DiaChi IS NULL;\nSELECT * FROM sinh_vien WHERE DiaChi IS NOT NULL;",
                "Kiểm tra giá trị NULL. Không viết = NULL."
            ],
            [
                "DISTINCT - loại giá trị trùng",
                "SELECT DISTINCT DiaChi FROM sinh_vien;",
                "Lấy danh sách địa chỉ không trùng."
            ]
        ];

        foreach ($mysql as $item) {
            hienThi($item[0], $item[1], $item[2]);
        }
        ?>

        <div class="note">
            Thứ tự thường gặp:
            <code>SELECT ... FROM ... WHERE ... GROUP BY ... HAVING ... ORDER BY ... LIMIT ...</code>.
            Đây là các từ khóa SQL, không phải tất cả đều là hàm.
        </div>

        <!-- PHẦN 2: STRING -->
        <h2>PHẦN 2. Các hàm xử lý chuỗi PHP</h2>

        <?php
        $chuoi = "  Nguyen Van An  ";

        hienThi(
            "strlen() - đếm số byte",
            "strlen('Hello')",
            strlen("Hello")
        );

        hienThi(
            "strtolower() - chuyển chữ thường",
            "strtolower('HELLO PHP')",
            strtolower("HELLO PHP")
        );

        hienThi(
            "strtoupper() - chuyển chữ hoa",
            "strtoupper('hello php')",
            strtoupper("hello php")
        );

        hienThi(
            "ucfirst() - viết hoa ký tự đầu",
            "ucfirst('xin chao')",
            ucfirst("xin chao")
        );

        hienThi(
            "ucwords() - viết hoa đầu mỗi từ",
            "ucwords('nguyen van an')",
            ucwords("nguyen van an")
        );

        hienThi(
            "trim() - xóa khoảng trắng hai đầu",
            "trim('  Nguyen Van An  ')",
            trim($chuoi)
        );

        hienThi(
            "ltrim() - xóa khoảng trắng bên trái",
            "ltrim('  Nguyen')",
            ltrim("  Nguyen")
        );

        hienThi(
            "rtrim() - xóa khoảng trắng bên phải",
            "rtrim('An  ')",
            rtrim("An  ")
        );

        hienThi(
            "substr() - cắt chuỗi",
            "substr('Hoc PHP', 4, 3)",
            substr("Hoc PHP", 4, 3)
        );

        hienThi(
            "str_replace() - thay chuỗi",
            "str_replace('PHP', 'HTML', 'Hoc PHP')",
            str_replace("PHP", "HTML", "Hoc PHP")
        );

        hienThi(
            "strpos() - tìm vị trí chuỗi con",
            "strpos('Hoc PHP', 'PHP')",
            strpos("Hoc PHP", "PHP")
        );

        hienThi(
            "str_contains() - kiểm tra có chứa chuỗi (PHP 8+)",
            "str_contains('Hoc PHP', 'PHP')",
            str_contains("Hoc PHP", "PHP")
        );

        hienThi(
            "explode() - tách chuỗi thành mảng",
            "explode(',', 'An,Binh,Chi')",
            explode(",", "An,Binh,Chi")
        );

        hienThi(
            "implode() - ghép mảng thành chuỗi",
            "implode(' - ', ['An', 'Binh', 'Chi'])",
            implode(" - ", ["An", "Binh", "Chi"])
        );

        hienThi(
            "strcmp() - so sánh hai chuỗi",
            "strcmp('abc', 'abc')",
            strcmp("abc", "abc")
        );

        hienThi(
            "htmlspecialchars() - hiển thị văn bản an toàn",
            "htmlspecialchars('<b>Xin chao</b>')",
            htmlspecialchars("<b>Xin chao</b>", ENT_QUOTES, "UTF-8")
        );
        ?>

        <div class="note">
            Với tiếng Việt, <code>strlen()</code> đếm byte.
            Muốn đếm ký tự Unicode nên dùng
            <code>mb_strlen($chuoi, 'UTF-8')</code> nếu extension mbstring được bật.
            Với <code>strpos()</code>, nên kiểm tra bằng <code>!== false</code>
            vì vị trí 0 cũng có nghĩa là tìm thấy.
        </div>

        <!-- PHẦN 3: ARRAY -->
        <h2>PHẦN 3. Các hàm xử lý mảng PHP</h2>

        <?php
        $mang = ["Cam", "Tao", "Chuoi"];
        $diem = [8, 6.5, 9, 4.5, 7];

        hienThi(
            "count() - đếm phần tử",
            "count(['Cam', 'Tao', 'Chuoi'])",
            count($mang)
        );

        $temp = $mang;
        array_push($temp, "Xoai");
        hienThi(
            "array_push() - thêm phần tử vào cuối",
            "\$temp = ['Cam', 'Tao', 'Chuoi'];\narray_push(\$temp, 'Xoai');",
            $temp
        );

        $temp = $mang;
        $xoa = array_pop($temp);
        hienThi(
            "array_pop() - xóa phần tử cuối",
            "\$xoa = array_pop(\$temp);",
            ["Mảng sau khi xóa" => $temp, "Phần tử bị xóa" => $xoa]
        );

        hienThi(
            "array_merge() - nối mảng",
            "array_merge(['Cam', 'Tao'], ['Chuoi'])",
            array_merge(["Cam", "Tao"], ["Chuoi"])
        );

        hienThi(
            "in_array() - kiểm tra phần tử tồn tại",
            "in_array('Tao', ['Cam', 'Tao', 'Chuoi'])",
            in_array("Tao", $mang)
        );

        hienThi(
            "array_search() - tìm khóa của phần tử",
            "array_search('Tao', ['Cam', 'Tao', 'Chuoi'])",
            array_search("Tao", $mang)
        );

        hienThi(
            "array_keys() - lấy danh sách khóa",
            "array_keys(['ten' => 'An', 'tuoi' => 20])",
            array_keys(["ten" => "An", "tuoi" => 20])
        );

        hienThi(
            "array_values() - lấy danh sách giá trị",
            "array_values(['ten' => 'An', 'tuoi' => 20])",
            array_values(["ten" => "An", "tuoi" => 20])
        );

        $temp = $mang;
        sort($temp);
        hienThi(
            "sort() - sắp xếp tăng dần",
            "sort(\$temp);",
            $temp
        );

        $temp = $mang;
        rsort($temp);
        hienThi(
            "rsort() - sắp xếp giảm dần",
            "rsort(\$temp);",
            $temp
        );

        hienThi(
            "array_sum() - tính tổng",
            "array_sum([8, 6, 9])",
            array_sum([8, 6, 9])
        );

        hienThi(
            "array_product() - tính tích",
            "array_product([2, 3, 4])",
            array_product([2, 3, 4])
        );

        hienThi(
            "array_map() - xử lý từng phần tử",
            "array_map(fn(\$x) => \$x * 2, [1, 2, 3])",
            array_map(fn($x) => $x * 2, [1, 2, 3])
        );

        hienThi(
            "array_filter() - lọc phần tử theo điều kiện",
            "array_filter([8, 6.5, 9, 4.5, 7], fn(\$x) => \$x >= 7)",
            array_values(array_filter($diem, fn($x) => $x >= 7))
        );

        hienThi(
            "array_unique() - loại phần tử trùng",
            "array_unique([1, 2, 2, 3, 1])",
            array_values(array_unique([1, 2, 2, 3, 1]))
        );

        hienThi(
            "array_slice() - lấy một phần mảng",
            "array_slice(['A', 'B', 'C', 'D'], 1, 2)",
            array_slice(["A", "B", "C", "D"], 1, 2)
        );

        hienThi(
            "min() và max() - nhỏ nhất, lớn nhất",
            "min([8, 6.5, 9]); max([8, 6.5, 9])",
            ["Nhỏ nhất" => min($diem), "Lớn nhất" => max($diem)]
        );
        ?>

        <!-- PHẦN 4: REGEX -->
        <h2>PHẦN 4. preg_match() - kiểm tra chuỗi</h2>

        <?php
        $ma = "ABC123";

        hienThi(
            "Chỉ cho phép chữ cái tiếng Anh và chữ số",
            "preg_match('/^[a-zA-Z0-9]+$/', 'ABC123')",
            preg_match('/^[a-zA-Z0-9]+$/', $ma)
        );

        hienThi(
            "Chỉ cho phép chữ số",
            "preg_match('/^[0-9]+$/', '12345')",
            preg_match('/^[0-9]+$/', "12345")
        );

        hienThi(
            "Kiểm tra email cơ bản",
            "filter_var('an@example.com', FILTER_VALIDATE_EMAIL) !== false",
            filter_var("an@example.com", FILTER_VALIDATE_EMAIL) !== false
        );

        hienThi(
            "Chỉ cho phép chữ cái và khoảng trắng",
            "preg_match('/^[a-zA-Z ]+$/', 'Nguyen Van An')",
            preg_match('/^[a-zA-Z ]+$/', "Nguyen Van An")
        );
        ?>

        <div class="note">
            Giải thích <code>/^[a-zA-Z0-9]+$/</code>:
            <ul>
                <li><code>^</code>: bắt đầu chuỗi.</li>
                <li><code>[a-zA-Z0-9]</code>: chữ thường, chữ hoa hoặc chữ số.</li>
                <li><code>+</code>: yêu cầu ít nhất một ký tự.</li>
                <li><code>$</code>: kết thúc chuỗi.</li>
            </ul>
            Nếu kiểm tra mảng, hãy duyệt từng phần tử:
            <pre class="code">$arr = ['ABC123', 'abc', 'abc@123'];

foreach ($arr as $item) {
    if (preg_match('/^[a-zA-Z0-9]+$/', $item)) {
        echo $item . ' hợp lệ<br>';
    } else {
        echo $item . ' không hợp lệ<br>';
    }
}</pre>
        </div>

        <!-- PHẦN 5: DATE TIME PHP -->
        <h2>PHẦN 5. Hàm ngày giờ trong PHP</h2>

        <?php
        hienThi(
            "date() - định dạng ngày giờ hiện tại",
            "date('d/m/Y H:i:s')",
            date("d/m/Y H:i:s")
        );

        hienThi(
            "date() - chỉ lấy ngày",
            "date('Y-m-d')",
            date("Y-m-d")
        );

        hienThi(
            "date() - chỉ lấy giờ",
            "date('H:i:s')",
            date("H:i:s")
        );

        hienThi(
            "time() - lấy timestamp hiện tại",
            "time()",
            time()
        );

        hienThi(
            "strtotime() - chuyển ngày thành timestamp",
            "date('d/m/Y', strtotime('2026-12-25'))",
            date("d/m/Y", strtotime("2026-12-25"))
        );

        $ngay1 = new DateTime("2026-01-01");
        $ngay2 = new DateTime("2026-12-31");
        $khoangCach = $ngay1->diff($ngay2)->days;

        hienThi(
            "DateTime và diff() - tính số ngày giữa hai ngày",
            "\$a = new DateTime('2026-01-01');\n\$b = new DateTime('2026-12-31');\necho \$a->diff(\$b)->days;",
            $khoangCach . " ngày"
        );
        ?>

        <div class="note">
            Ký hiệu ngày giờ thường dùng:
            <ul>
                <li><code>d</code>: ngày; <code>m</code>: tháng; <code>Y</code>: năm đủ 4 chữ số.</li>
                <li><code>H</code>: giờ 24 tiếng; <code>h</code>: giờ 12 tiếng.</li>
                <li><code>i</code>: phút; <code>s</code>: giây.</li>
                <li><code>date('d/m/Y')</code> cho dạng ngày/tháng/năm.</li>
                <li><code>date('Y-m-d')</code> thường dùng để lưu hoặc xử lý ngày theo định dạng SQL.</li>
            </ul>
        </div>

        <!-- PHẦN 6: INPUT DATE TIME -->
        <h2>PHẦN 6. Nhập ngày giờ bằng thẻ input</h2>

        <div class="demo">
            <h3>Ví dụ 1: input type="date"</h3>
            <p>Chọn ngày, kết quả sẽ hiển thị ngay bên dưới.</p>

            <input type="date" id="ngayNhap">

            <p id="ketQuaNgay" class="result">Ngày bạn chọn sẽ hiển thị ở đây.</p>

            <pre class="code">&lt;input type="date" id="ngayNhap"&gt;
&lt;p id="ketQuaNgay"&gt;&lt;/p&gt;

&lt;script&gt;
document.getElementById('ngayNhap').addEventListener('input', function() {
    document.getElementById('ketQuaNgay').textContent =
        this.value || 'Bạn chưa chọn ngày';
});
&lt;/script&gt;</pre>
        </div>

        <div class="demo">
            <h3>Ví dụ 2: input type="time"</h3>

            <input type="time" id="gioNhap">

            <p id="ketQuaGio" class="result">Giờ bạn chọn sẽ hiển thị ở đây.</p>

            <pre class="code">&lt;input type="time" id="gioNhap"&gt;
&lt;p id="ketQuaGio"&gt;&lt;/p&gt;

&lt;script&gt;
document.getElementById('gioNhap').addEventListener('input', function() {
    document.getElementById('ketQuaGio').textContent =
        this.value || 'Bạn chưa chọn giờ';
});
&lt;/script&gt;</pre>
        </div>

        <div class="demo">
            <h3>Ví dụ 3: input type="datetime-local"</h3>
            <p>Cho phép chọn cả ngày và giờ.</p>

            <input type="datetime-local" id="ngayGioNhap">

            <p id="ketQuaNgayGio" class="result">Ngày giờ bạn chọn sẽ hiển thị ở đây.</p>

            <pre class="code">&lt;input type="datetime-local" id="ngayGioNhap"&gt;
&lt;p id="ketQuaNgayGio"&gt;&lt;/p&gt;

&lt;script&gt;
document.getElementById('ngayGioNhap').addEventListener('input', function() {
    document.getElementById('ketQuaNgayGio').textContent =
        this.value || 'Bạn chưa chọn ngày giờ';
});
&lt;/script&gt;</pre>

            <p><b>Giải thích:</b> Thuộc tính <code>this.value</code> lấy giá trị hiện tại của ô nhập.</p>
        </div>

        <!-- PHẦN 7: CLICK A -->
        <h2>PHẦN 7. Nhấn thẻ a để hiển thị ngày giờ trong element</h2>

        <div class="demo">
            <h3>Ví dụ 1: Click vào liên kết để hiển thị nội dung</h3>

            <a href="#" data-value="Ngày: 25/12/2026"
                onclick="hienThiNoiDung(event, this)">Ngày Giáng sinh</a>

            <a href="#" data-value="Ngày: 01/01/2027"
                onclick="hienThiNoiDung(event, this)">Ngày đầu năm</a>

            <p id="noiDungLienKet" class="result">Bạn hãy nhấn một liên kết.</p>

            <pre class="code">&lt;a href="#" data-value="Ngày: 25/12/2026"
   onclick="hienThiNoiDung(event, this)"&gt;
   Ngày Giáng sinh
&lt;/a&gt;

&lt;p id="noiDungLienKet"&gt;&lt;/p&gt;

&lt;script&gt;
function hienThiNoiDung(event, element) {
    event.preventDefault();

    document.getElementById('noiDungLienKet').textContent =
        element.dataset.value;
}
&lt;/script&gt;</pre>

            <p>
                <b>Giải thích:</b>
                <code>data-value</code> lưu nội dung;
                <code>this</code> đại diện cho thẻ a vừa nhấn;
                <code>dataset.value</code> lấy giá trị đã lưu;
                <code>textContent</code> đưa nội dung vào phần tử p.
            </p>
        </div>

        <div class="demo">
            <h3>Ví dụ 2: Click thẻ a để hiển thị ngày giờ hiện tại</h3>

            <a href="#" onclick="hienThiThoiGian(event)">Xem ngày giờ hiện tại</a>

            <p id="thoiGianHienTai" class="result">Chưa hiển thị ngày giờ.</p>

            <pre class="code">&lt;a href="#" onclick="hienThiThoiGian(event)"&gt;
    Xem ngày giờ hiện tại
&lt;/a&gt;

&lt;p id="thoiGianHienTai"&gt;&lt;/p&gt;

&lt;script&gt;
function hienThiThoiGian(event) {
    event.preventDefault();

    const hienTai = new Date();

    document.getElementById('thoiGianHienTai').textContent =
        hienTai.toLocaleString('vi-VN');
}
&lt;/script&gt;</pre>

            <p>
                <b>Giải thích:</b>
                <code>new Date()</code> lấy thời gian hiện tại của trình duyệt.
                <code>toLocaleString('vi-VN')</code> định dạng để hiển thị theo cách thông dụng ở Việt Nam.
            </p>
        </div>

        <div class="demo">
            <h3>Ví dụ 3: Chọn ngày giờ rồi click thẻ a để hiển thị</h3>

            <label for="chonNgayGio">Chọn ngày giờ:</label><br>
            <input type="datetime-local" id="chonNgayGio">

            <p>
                <a href="#" onclick="hienThiNgayGioDaChon(event)">
                    Hiển thị ngày giờ đã chọn
                </a>
            </p>

            <p id="ngayGioDaChon" class="result">Chưa chọn ngày giờ.</p>

            <pre class="code">&lt;input type="datetime-local" id="chonNgayGio"&gt;

&lt;a href="#" onclick="hienThiNgayGioDaChon(event)"&gt;
    Hiển thị ngày giờ đã chọn
&lt;/a&gt;

&lt;p id="ngayGioDaChon"&gt;&lt;/p&gt;

&lt;script&gt;
function hienThiNgayGioDaChon(event) {
    event.preventDefault();

    const giaTri = document.getElementById('chonNgayGio').value;

    document.getElementById('ngayGioDaChon').textContent =
        giaTri ? giaTri : 'Bạn chưa chọn ngày giờ';
}
&lt;/script&gt;</pre>
        </div>

        <div class="demo">
            <h3>Ví dụ 4: Hiển thị ngày giờ theo định dạng Việt Nam</h3>

            <input type="datetime-local" id="chonNgayGioViet">

            <button type="button" onclick="dinhDangNgayGio()">
                Hiển thị theo định dạng Việt Nam
            </button>

            <p id="ketQuaDinhDang" class="result">Kết quả sẽ hiển thị ở đây.</p>

            <pre class="code">function dinhDangNgayGio() {
    const value = document.getElementById('chonNgayGioViet').value;

    if (!value) {
        document.getElementById('ketQuaDinhDang').textContent =
            'Bạn chưa chọn ngày giờ';
        return;
    }

    const date = new Date(value);

    document.getElementById('ketQuaDinhDang').textContent =
        date.toLocaleString('vi-VN');
}</pre>

            <p class="note">
                Lưu ý: <code>datetime-local</code> không chứa thông tin múi giờ.
                Khi chuyển thành đối tượng <code>Date</code>, trình duyệt hiểu giá trị theo giờ địa phương.
            </p>
        </div>

        <!-- PHẦN 8: KẾT NỐI MYSQL -->
        <h2>PHẦN 8. Ví dụ kết nối PHP với MySQL</h2>

        <pre class="code"><?php
                            echo h(
                                <<<'CODE'
<?php
$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'ten_co_so_du_lieu'
);

if (!$conn) {
    die('Kết nối thất bại: ' . mysqli_connect_error());
}

mysqli_set_charset($conn, 'utf8mb4');

$sql = "SELECT COUNT(*) AS SoSanPham,
               AVG(DonGia) AS GiaTrungBinh,
               MAX(DonGia) AS GiaCaoNhat
        FROM san_pham";

$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);

    echo 'Số sản phẩm: ' . $row['SoSanPham'] . '<br>';
    echo 'Giá trung bình: ' . $row['GiaTrungBinh'] . '<br>';
    echo 'Giá cao nhất: ' . $row['GiaCaoNhat'];
}

mysqli_close($conn);
?>
CODE
                            );
                            ?></pre>

        <div class="note">
            Đổi <code>ten_co_so_du_lieu</code>, <code>san_pham</code> và <code>DonGia</code>
            thành tên cơ sở dữ liệu, bảng và cột thật của bạn.
            Các câu SQL ở Phần 1 chỉ là ví dụ; chúng không tự chạy trong trang này.
        </div>
    </main>

    <script>
        function hienThiNoiDung(event, element) {
            event.preventDefault();

            document.getElementById('noiDungLienKet').textContent =
                element.dataset.value;
        }

        function hienThiThoiGian(event) {
            event.preventDefault();

            const hienTai = new Date();

            document.getElementById('thoiGianHienTai').textContent =
                hienTai.toLocaleString('vi-VN');
        }

        function hienThiNgayGioDaChon(event) {
            event.preventDefault();

            const giaTri = document.getElementById('chonNgayGio').value;

            document.getElementById('ngayGioDaChon').textContent =
                giaTri ? giaTri : 'Bạn chưa chọn ngày giờ';
        }

        function dinhDangNgayGio() {
            const value = document.getElementById('chonNgayGioViet').value;
            const ketQua = document.getElementById('ketQuaDinhDang');

            if (!value) {
                ketQua.textContent = 'Bạn chưa chọn ngày giờ';
                return;
            }

            const date = new Date(value);

            ketQua.textContent = date.toLocaleString('vi-VN');
        }

        document.getElementById('ngayNhap').addEventListener('input', function() {
            document.getElementById('ketQuaNgay').textContent =
                this.value || 'Bạn chưa chọn ngày';
        });

        document.getElementById('gioNhap').addEventListener('input', function() {
            document.getElementById('ketQuaGio').textContent =
                this.value || 'Bạn chưa chọn giờ';
        });

        document.getElementById('ngayGioNhap').addEventListener('input', function() {
            document.getElementById('ketQuaNgayGio').textContent =
                this.value || 'Bạn chưa chọn ngày giờ';
        });
    </script>

</body>

</html>