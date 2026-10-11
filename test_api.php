<?php

$ketqua = "";
$text = "";
$ngonNguNhap = "en";
$ngonNguXuat = "vi";

$apiKey = "865eda1a47mshd67db37a0ed5cc2p1e9538jsnf73cc4c0dab3";
$apiHost = "google-translator9.p.rapidapi.com";


// 1. LẤY DANH SÁCH NGÔN NGỮ

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
        "x-rapidapi-host: " . $apiHost,
        "x-rapidapi-key: " . $apiKey
    ],
]);

$responseLanguages = curl_exec($curl);
$errLanguages = curl_error($curl);

curl_close($curl);


// Mặc định danh sách rỗng
$danhSachNgonNgu = [];

if (!$errLanguages) {

    $dataLanguages = json_decode($responseLanguages, true);
    if (isset($dataLanguages['data']['languages'])) {
        $danhSachNgonNgu = $dataLanguages['data']['languages'];
    }
}

// 2. XỬ LÝ KHI BẤM NÚT DỊCH
if (isset($_POST['dich'])) {

    $text = $_POST['text'] ?? "";

    $ngonNguNhap = $_POST['ngonNguNhap'] ?? "en";
    $ngonNguXuat = $_POST['ngonNguXuat'] ?? "vi";


    if (trim($text) == "") {
        $ketqua = "Vui lòng nhập câu cần dịch!";
    } else {

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://google-translator9.p.rapidapi.com/v2",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",

            CURLOPT_POSTFIELDS => json_encode([
                "format" => "text",
                "q" => $text,
                "source" => $ngonNguNhap,
                "target" => $ngonNguXuat
            ]),

            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "x-rapidapi-host: " . $apiHost,
                "x-rapidapi-key: " . $apiKey
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {

            $ketqua = "Lỗi: " . $err;
        } else {

            $data = json_decode($response, true);

            if (isset($data['data']['translations'][0]['translatedText'])) {

                $ketqua =
                    $data['data']['translations'][0]['translatedText'];
            } else {

                $ketqua = "Không thể dịch. API trả về: " . $response;
            }
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
            background: linear-gradient(135deg,
                    #74ebd5 0%,
                    #9face6 100%);

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

            box-shadow:
                0 8px 20px rgba(0, 0, 0, 0.2);

            width: 600px;

            max-width: 90%;
        }


        h2 {
            text-align: center;

            color: #333;

            margin-bottom: 20px;
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

            border-color: #6a5acd;

            outline: none;
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
        }


        .result strong {

            color: #6a5acd;
        }
    </style>

</head>


<body>

    <div class="container">

        <h2>Dịch văn bản</h2>


        <form method="post">

            <!-- CHỌN NGÔN NGỮ -->

            <div class="ngon-ngu">

                <div>

                    <label>Ngôn ngữ nhập:</label>

                    <select name="ngonNguNhap">

                        <?php foreach ($danhSachNgonNgu as $ngonNgu) { ?>

                            <?php
                            $ma =
                                $ngonNgu['language']
                                ?? $ngonNgu['code']
                                ?? "";

                            $ten =
                                $ngonNgu['name']
                                ?? $ma;
                            ?>

                            <option
                                value="<?php echo htmlspecialchars($ma); ?>"
                                <?php
                                if ($ma == $ngonNguNhap) {
                                    echo "selected";
                                }
                                ?>>
                                <?php echo htmlspecialchars($ten); ?>
                            </option>

                        <?php } ?>

                    </select>

                </div>


                <div>

                    <label>Ngôn ngữ xuất:</label>

                    <select name="ngonNguXuat">

                        <?php foreach ($danhSachNgonNgu as $ngonNgu) { ?>

                            <?php
                            $ma =
                                $ngonNgu['language']
                                ?? $ngonNgu['code']
                                ?? "";

                            $ten =
                                $ngonNgu['name']
                                ?? $ma;
                            ?>

                            <option
                                value="<?php echo htmlspecialchars($ma); ?>"
                                <?php
                                if ($ma == $ngonNguXuat) {
                                    echo "selected";
                                }
                                ?>>
                                <?php echo htmlspecialchars($ten); ?>
                            </option>

                        <?php } ?>

                    </select>

                </div>

            </div>


            <!-- NHẬP VĂN BẢN -->

            <label>Nhập văn bản:</label>

            <textarea
                name="text"
                rows="5"
                placeholder="Nhập câu cần dịch..."><?php echo htmlspecialchars($text); ?></textarea>


            <!-- NÚT DỊCH -->

            <button
                type="submit"
                name="dich">
                Dịch
            </button>

        </form>


        <!-- KẾT QUẢ -->

        <?php if ($ketqua != "") { ?>

            <div class="result">

                <strong>Kết quả:</strong>

                <?php echo htmlspecialchars($ketqua); ?>

            </div>

        <?php } ?>


    </div>

</body>

</html>