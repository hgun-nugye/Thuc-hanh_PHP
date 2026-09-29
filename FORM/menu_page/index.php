<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Website của chúng tôi</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .menu {
            background: linear-gradient(180deg, #3a3af5, #031f83);
            text-align: center;
        }

        .menu a {
            display: inline-block;
            color: white;
            text-decoration: none;
            margin: 0 20px;
            font-weight: bold;
            padding: 15px;
        }

        .menu a:hover {
            color: #ffd700;
        }

        .menu a.active {
            color: #ffd700;
            background-color: #c2c1c1;
        }

        .content {
            padding: 30px;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php $page = $_GET['page'] ?? 'trangchu'; ?>

    <div class="menu">
        <a href="index.php?page=trangchu"
            class="<?php echo $page == 'trangchu' ? 'active' : ''; ?>">
            Trang chủ
        </a>

        <a href="index.php?page=gioithieu"
            class="<?php echo $page == 'gioithieu' ? 'active' : ''; ?>">
            Giới thiệu
        </a>

        <a href="index.php?page=tintuc"
            class="<?php echo $page == 'tintuc' ? 'active' : ''; ?>">
            Tin tức
        </a>

        <a href="index.php?page=lienhe"
            class="<?php echo $page == 'lienhe' ? 'active' : ''; ?>">
            Liên hệ
        </a>

        <a href="index.php?page=diendan"
            class="<?php echo $page == 'diendan' ? 'active' : ''; ?>">
            Diễn đàn
        </a>
    </div>

    <div class="content">
        <?php
        switch ($page) {
            case 'trangchu':
                include 'trangchu.php';
                break;

            case 'gioithieu':
                include 'gioithieu.php';
                break;

            case 'tintuc':
                include 'tintuc.php';
                break;

            case 'lienhe':
                include 'lienhe.php';
                break;

            case 'diendan':
                include 'diendan.php';
                break;

            default:
                include 'trangchu.php';
                break;
        }
        ?>
    </div>

</body>

</html>