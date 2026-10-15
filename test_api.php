<?php
$ketqua = "";
$text = "";
$ngonNguNhap = "en";
$ngonNguXuat = "vi";

// LẤY DANH SÁCH NGÔN NGỮ 
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://google-translator9.p.rapidapi.com/v2/languages",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "x-rapidapi-host: google-translator9.p.rapidapi.com",
        "x-rapidapi-key: 865eda1a47mshd67db37a0ed5cc2p1e9538jsnf73cc4c0dab3"
    ],
]);

$responseLanguages = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$danhSachNgonNgu = [];

if (!$err) {
    $dataLanguages = json_decode($responseLanguages, true);
    if (isset($dataLanguages['data']['languages'])) {
        $danhSachNgonNgu = $dataLanguages['data']['languages'];
    }
} else {
    echo "cURL Error #:" . $err;
}

// XỬ LÝ KHI BẤM NÚT DỊCH 
if (isset($_POST['dich'])) {
    $text = $_POST['text'] ?? "";
    $ngonNguNhap = $_POST['ngonNguNhap'] ?? "en";
    $ngonNguXuat = $_POST['ngonNguXuat'] ?? "vi";

    if (trim($text) == "") {
        $ketqua = "Vui lòng nhập câu cần dịch!";
    } else {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://google-translator9.p.rapidapi.com/v2/detect",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'q' => $text,
                // 'source' => $ngonNguNhap,
                // 'target' => $ngonNguXuat,
                // 'format' => 'text'
            ]),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "x-rapidapi-host: google-translator9.p.rapidapi.com",
                "x-rapidapi-key: 865eda1a47mshd67db37a0ed5cc2p1e9538jsnf73cc4c0dab3"
            ],
        ]);

        $responseDetect = curl_exec($curl);
        // $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $ngonNguNhap = "en"; // mặc định
        if (!$err) {
            $dataDetect = json_decode($responseDetect, true);
            if (isset($dataDetect['data']['detections'][0][0]['language'])) {
                $ngonNguNhap = $dataDetect['data']['detections'][0][0]['language'];
            }
        }

        // GỌI API DỊCH
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://google-translator9.p.rapidapi.com/v2",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'q' => $text,
                'source' => $ngonNguNhap,
                'target' => $_POST['ngonNguXuat'] ?? "vi",
                'format' => 'text'
            ]),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "x-rapidapi-host: google-translator9.p.rapidapi.com",
                "x-rapidapi-key: 865eda1a47mshd67db37a0ed5cc2p1e9538jsnf73cc4c0dab3"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);



        if (!$err) {
            $data = json_decode($response, true);
            if (isset($data['data']['translations'][0]['translatedText'])) {
                $ketqua = $data['data']['translations'][0]['translatedText'];
            } else {
                $ketqua = "Không thể dịch. API trả về: " . $response;
            }
        } else {
            $ketqua = "cURL Error #:" . $err;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dịch ngôn ngữ</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(165deg, #e1fff9 0%, #f5d1da 100%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            width: 800px;
            max-width: 90%;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 2rem;
        }

        label {
            font-weight: bold;
            color: #444;
            display: block;
            margin-top: 12px;
        }

        select,
        textarea {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        select:focus,
        textarea:focus {
            border: 2px solid #6a5acd;
        }

        .ngon-ngu {
            display: flex;
            gap: 15px;
        }

        .ngon-ngu div {
            flex: 1;
        }

        button {
            display: block;
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background: #6a5acd;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background: #483d8b;
        }


        .result {
            margin-top: 25px;
            padding: 15px;
            background: #f0f8ff;
            border-left: 5px solid #6a5acd;
            border-radius: 8px;
            font-size: 16px;
            color: #333;
            line-height: 1.5;
        }

        ---- .result strong {
            color: #6a5acd;
        }
    </style>

</head>

<body>

    <div class="container">
        <h1>Dịch văn bản</h1>
        <form method="post">
            <!-- CHỌN NGÔN NGỮ -->
            <div class="ngon-ngu">
                <div>
                    <label>Ngôn ngữ nhập:</label>
                    <select name="ngonNguNhap">
                        <?php foreach ($danhSachNgonNgu as $ngonNgu) { ?>
                            <?php
                            $ma = $ngonNgu['language']  ?? $ngonNgu['code'] ?? "";
                            $ten = $ngonNgu['name'] ?? $ma; ?>
                            <option
                                value="<?php echo ($ma); ?>"
                                <?php
                                if ($ma == $ngonNguNhap) {
                                    echo "selected";
                                }
                                ?>>
                                <?php echo ($ten); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div>
                    <label>Ngôn ngữ xuất:</label>
                    <select name="ngonNguXuat">
                        <?php foreach ($danhSachNgonNgu as $ngonNgu) { ?>
                            <?php
                            $ma = $ngonNgu['language'] ?? $ngonNgu['code'] ?? "";
                            $ten = $ngonNgu['name'] ?? $ma;
                            ?>
                            <option
                                value="<?php echo ($ma); ?>"
                                <?php
                                if ($ma == $ngonNguXuat) {
                                    echo "selected";
                                }
                                ?>>
                                <?php echo ($ten); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <!-- NHẬP VĂN BẢN -->
            <label>Nhập văn bản:</label>
            <textarea name="text" rows="5" placeholder="Nhập câu cần dịch..."><?php echo ($text); ?></textarea>
            <!-- NÚT DỊCH -->
            <button type="submit" name="dich"> Dịch </button>
        </form>

        <!-- KẾT QUẢ -->
        <?php if ($ketqua != "") { ?>
            <div class="result">
                <strong>Kết quả:</strong>
                <?php echo ($ketqua); ?>
            </div>
        <?php } ?>
    </div>
</body>

</html>