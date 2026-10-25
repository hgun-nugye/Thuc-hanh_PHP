<?php
// 1. Tao mang sinh vien
$sinhVien = [
    ["ten" => "  nguyen van an  ", "ma" => "SV2026001", "sdt" => "0912345678"],
    ["ten" => "TRAN THI BINH",     "ma" => "SV2026002", "sdt" => "123456"],
    ["ten" => "le van cuong",      "ma" => "SV2026003", "sdt" => "0987654321"],
    ["ten" => "Pham Thi Dung",     "ma" => "SV-2026004", "sdt" => "0911222333"]
];

echo "<h2>1. Danh sach sinh vien</h2>";

// 2. Duyet mang
foreach ($sinhVien as $sv) {

    // Chuan hoa ho ten
    $ten = trim($sv["ten"]);
    $ten = strtolower($ten);
    $ten = ucwords($ten);

    echo "Ho ten: " . htmlspecialchars($ten) . "<br>";

    // 3. Kiem tra ma sinh vien
    if (preg_match("/^SV\d{7}$/", $sv["ma"])) {
        echo "Ma sinh vien hop le<br>";
    } else {
        echo "Ma sinh vien khong hop le<br>";
    }

    // 4. Kiem tra so dien thoai
    if (preg_match("/^0\d{9}$/", $sv["sdt"])) {
        echo "So dien thoai hop le<br>";
    } else {
        echo "So dien thoai khong hop le<br>";
    }

    echo "<hr>";
}

// 5. Dem so sinh vien
echo "<h2>2. Thong ke</h2>";
echo "Tong so sinh vien: " . count($sinhVien) . "<br>";

// 6. Loc sinh vien co ma hop le
$svHopLe = array_filter($sinhVien, function ($sv) {
    return preg_match("/^SV\d{7}$/", $sv["ma"]) === 1;
});

echo "So sinh vien co ma hop le: " . count($svHopLe) . "<br>";

// 7. Lay danh sach ma sinh vien hop le
$dsMa = array_map(function ($sv) {
    return $sv["ma"];
}, $svHopLe);

echo "Danh sach ma hop le: ";
echo implode(", ", $dsMa);
