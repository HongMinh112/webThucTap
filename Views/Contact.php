<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Content/Css/style.css">
    <link rel="stylesheet" href="../Content/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../Content/Css/news.css">
    <title>Home</title>
</head>
<body>
    <?php 
    require './header.php';
    ?>
    <div class="contact">
        <div class="contact_block">
            <div class="contact_block-item">
                <div class="block">
                    <i style="color: chartreuse;" class="fas fa-map-marker"></i>
                </div>
                <div class="content">
                    <p style="margin-bottom: 20px; color: black; font-size: 20px; font-weight: bold;">
                        ĐỊA CHỈ
                    </p>
                    <p>
                        24D, Tân Quới Tây, Trường An, TP Vĩnh Long, Vĩnh Long
                    </p>
                </div>
            </div>
            <div class="contact_block-item">
                <div class="block">
                    <i style="color: chartreuse;" class="fas fa-phone"></i>
                </div>
                <div class="content">
                    <p style="margin-bottom: 20px; color: black; font-size: 20px; font-weight: bold;">
                        SỐ ĐIỆN THOẠI:
                    </p>
                    <p>
                        0270 3815066 - 0270 3815077 - 093 855 8599
                    </p>
                </div>
            </div>
            <div class="contact_block-item">
                <div class="block">
                    <i style="color: chartreuse;" class="fas fa-envelope"></i>
                </div>
                <div class="content">
                    <p style="margin-bottom: 20px; color: black; font-size: 20px; font-weight: bold;">
                        EMAIL
                    </p>
                    <p>
                        bakhanh.bunphovietnam@gmail.com
                    </p>
                </div>
                
            </div>
        </div>
        <div class="contact_information">
            <h2>LIÊN HỆ</h2>
            <div class="contact_information-input">
                <input type="text" placeholder="Họ và tên của bạn">
                <input type="text" placeholder="Email của bạn">
                <input type="text" placeholder="Số điện thoại của bạn">
            </div>
            <div class="contact_information-content">
                <textarea name="" id="" rows="10" placeholder="Nội Dung"></textarea>
            </div>
            <div class="contact_information-button">
                <button>Gửi</button>
            </div>
        </div>
    </div>
    <footer style="position: absolute;bottom:-1350px;" class="footer_news">
        <?php 
        require './footer.php';
        ?>
    </footer>
    <script src="../Content/Js/jquery-3.6.0.min.js"></script>
    <script src="../Content/Js/home.js"></script>
</body>
</html>