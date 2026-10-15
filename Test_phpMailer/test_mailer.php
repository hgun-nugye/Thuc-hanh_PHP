<?php
// Bắt buộc: Load các lớp của PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load file autoload của Composer để nhận diện thư viện
require 'vendor/autoload.php';

// Khởi tạo đối tượng Mail, true để bật Exception (bắt lỗi)
$mail = new PHPMailer(true);

try {
    // --- 1. CẤU HÌNH SERVER GỬI MAIL (SMTP) ---
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Bỏ comment dòng này nếu muốn xem log lỗi chi tiết
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $mail->Username = $_ENV['mail_Username'];
    $mail->Password = $_ENV['mail_Password'];

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // --- 2. THÔNG TIN NGƯỜI GỬI & NHẬN ---
    // Email người gửi (Nên giống với $mail->Username)
    $mail->setFrom('thanhhuong10102005@gmail.com', 'Test gui mail qua PHPMailer');

    // Email người nhận (Bạn có thể điền email thứ 2 của bạn để test)
    $mail->addAddress('test.ntu@gmail.com', 'Giang');

    // --- 3. NỘI DUNG EMAIL ---

    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';


    $mail->Subject = '🦖 DINO GAME - Sẵn sàng vượt chướng ngại vật!';

    $mail->Body = '
<div style="
    margin: 0 auto;
    max-width: 600px;
    background-color: #f7fbe9;
    border: 3px solid #293d2b;
    border-radius: 16px;
    overflow: hidden;
    font-family: Arial, sans-serif;
    color: #293d2b;
">

    <!-- HEADER -->
    <div style="
        background-color: #293d2b;
        padding: 25px 20px;
        text-align: center;
        color: #ffffff;
    ">
        <p style="font-size: 13px; letter-spacing: 4px; margin: 0;">
            READY PLAYER ONE
        </p>

        <h1 style="font-size: 32px; margin: 15px 0 5px;">
            🦖 DINO RUN
        </h1>

        <p style="font-size: 14px; color: #c7f36b; margin: 0;">
            JUMP • RUN • SURVIVE
        </p>
    </div>

    <!-- HÌNH KHỦNG LONG -->
    <div style="
        padding: 30px 20px 10px;
        text-align: center;
        background-color: #e6f4c7;
    ">
        <div style="
            font-size: 85px;
            line-height: 1.4;
        ">
            🦖
        </div>

        <p style="
            font-family: monospace;
            font-size: 14px;
            color: #526b36;
            letter-spacing: 2px;
        ">
            [ LOADING ADVENTURE... ]
        </p>
    </div>

    <!-- NỘI DUNG -->
    <div style="padding: 25px 30px;">

        <h2 style="
            text-align: center;
            color: #2d632e;
            font-size: 25px;
        ">
            Chào chiến binh! 🎮
        </h2>

        <p style="font-size: 16px; line-height: 1.8;">
            Bạn đã sẵn sàng bước vào thế giới khủng long chưa?
            Một cuộc phiêu lưu tốc độ cao đang chờ bạn!
        </p>

        <div style="
            background-color: #ffffff;
            border: 2px dashed #719b42;
            padding: 18px;
            border-radius: 10px;
            margin: 22px 0;
        ">
            <h3 style="margin-top: 0; color: #2d632e;">
                🎯 NHIỆM VỤ CỦA BẠN
            </h3>

            <p style="line-height: 1.8; margin-bottom: 0;">
                🏃 Điều khiển khủng long vượt chướng ngại vật.<br>
                🌵 Né những cây xương rồng nguy hiểm.<br>
                ⭐ Chạy càng xa, điểm số càng cao!
            </p>
        </div>

        <p style="
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #293d2b;
        ">
            Bạn có thể phá kỷ lục của chính mình không?
        </p>

        <!-- NÚT CHƠI GAME -->
        <div style="text-align: center; margin: 30px 0;">
            <a href="https://chromedino.com/"
               style="
                   display: inline-block;
                   background-color: #8bc34a;
                   color: #20351e;
                   text-decoration: none;
                   padding: 16px 35px;
                   border: 3px solid #293d2b;
                   border-radius: 8px;
                   font-size: 18px;
                   font-weight: bold;
               ">
                ▶ CHƠI NGAY
            </a>
        </div>

        <p style="
            text-align: center;
            font-size: 13px;
            color: #66745a;
        ">
            Không bỏ cuộc! Hãy chạy đến giới hạn của bạn! 💚
        </p>
    </div>

    <!-- FOOTER -->
    <div style="
        background-color: #293d2b;
        padding: 20px;
        text-align: center;
        color: #ffffff;
    ">
        <p style="font-family: monospace; font-size: 13px; margin: 0;">
            GAME OVER? TRY AGAIN!
        </p>

        <p style="font-size: 11px; color: #c7d7bc; margin-bottom: 0;">
            Email game được gửi bằng PHP & PHPMailer.
        </p>
    </div>

</div>
';

    $mail->AltBody =
        'DINO RUN - Chào chiến binh! '
        . 'Hãy điều khiển khủng long né xương rồng, '
        . 'chạy thật xa và phá kỷ lục của chính mình. '
        . 'Chơi game tại https://chromedino.com/';


    // Nội dung dự phòng (nếu trình duyệt mail người nhận không hỗ trợ HTML)
    $mail->AltBody = 'Xin chào Giang! Thư viện PHPMailer đã được cấu hình thành công. Đây là email thử nghiệm được gửi từ ứng dụng PHP chạy trên XAMPP.';

    // Thực thi lệnh gửi
    $mail->send();
    echo 'Email đã được gửi thành công! Hãy kiểm tra hộp thư đến.';
} catch (Exception $e) {
    echo "<h3>Lỗi! Không thể gửi email.</h3>";
    echo "Chi tiết lỗi: {$mail->ErrorInfo}";
}
