<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("loaction:index.php");
}
include '../conn.php';
$sqlProduct = "SELECT * FROM productcategory";
$queryProduct = mysqli_fetch_all(mysqli_query($conn, $sqlProduct), MYSQLI_ASSOC);
// Get product category
$sqlProductCategory = "SELECT * FROM productcategory";
$list = mysqli_fetch_all(mysqli_query($conn, $sqlProductCategory), MYSQLI_ASSOC);
// Get product
$sqlProduct = "SELECT * FROM product ";
$listProduct = mysqli_fetch_all(mysqli_query($conn, $sqlProduct), MYSQLI_ASSOC);


$queryProductNew=mysqli_fetch_all((mysqli_query($conn,"SELECT * FROM product WHERE status=1 and quantity>0 ORDER BY ID DESC LIMIT 4")),MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Content/Css/style.css">
    <link rel="stylesheet" href="../Content/fontawesome-free/css/all.min.css">
    <title>Home</title>
</head>

<body>
    <header class="header">
        <div class="header_top">
            <div class="header_top-right">
                <div>
                    <div class="phonenumber">
                        <span><i class="fas fa-phone"></i> 0270 3815066 - 0270 3815077 - 093 855 8599</span>
                    </div>
                    <div>
                        <span class="email"><i class="far fa-envelope"></i> bakhanh.bunphovietnam@gmail.com</span>
                        <span class="time"><i class="far fa-clock"></i> Mở cửa từ 8:00 - 22:00</span>
                    </div>
                </div>
            </div>
            <div class="header_top-left">
                <?php
                //kiểm tra username
                if (isset($_SESSION['username']) && $_SESSION['username']) { ?>
                    <li style="list-style: none; margin-right:20px;"><?= $_SESSION['username'] ?></li>
                    <li style="list-style: none;margin-right:10px;"><a style="color:white;" href="../Views/logout.php" id="signin">Đăng xuất</a></li>
                <?php } else { ?>
                    <div class="Login">
                        <a href="../Views/signin.php">Đăng Nhập</a>
                        <a href="../Views/signup.php">Đăng Ký</a>
                    </div>
                <?php } ?>

                <div class="cart">
                    <p></p>
                    <a href="../Views/cart.php"><i class="fas fa-shopping-cart"></i></a>
                    <a href="../Views/informationOder.php"><i class="fas fa-cart-arrow-down"></i></a>
                </div>
            </div>
            <div class="search">
                <form action="./search.php" method="get">
                    <input type="text" style="width: 200px;height: 20px;" name="name" placeholder="Tim Kiem...">
                    <input type="submit" name="search" value="tim kiem">
                </form>
            </div>
        </div>
        <div class="image">
            <div>
                <div onclick="ChangImg()" class="image_box">
                    <div class="image_slide1 active">
                        <img id="img" style="height: 600px;" src="../Content/Image/Img1.webp" alt="">
                    </div>
                </div>
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
        </div>
        <div class="menu">
            <div class="logo">
                <img style="height: 100px;width: 170px;" src="../Content/Image/logo.webp" alt="">
            </div>
            <div class="menu_list">
                <ul class="menu_list-ul">
                    <li class="menu_list-ul--li"><a href="../Views/Index.php">TRANG CHỦ</a></li>
                    <li class="menu_list-ul--li"><a href="../Views/gioithieu.php">VỀ BA KHÁNH</a></li>
                    <li class="menu_list-ul--li"><a class="menu_list-ul--a" href="../Views/product.php">SẢN PHẨM <i class="fas fa-angle-down"></i></a>
                        <ul class="menu_sanpham">
                            <?php foreach ($list as $key => $value) { ?>
                                <li><a href="./catogery.php?ID=<?php echo $value['ID'] ?>"><?php echo $value['name'] ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="menu_list-ul--li"><a href="../Views/news.php">TIN TỨC</a></li>
                    <li class="menu_list-ul--li"><a href="../Views/kitchen.php">GÓC BẾP BA KHÁNH</a></li>
                    <li class="menu_list-ul--li"><a href="../Views/Contact.php">LIÊN HỆ</a></li>
                </ul>
            </div>
        </div>
    </header>
    <div class="angle-double-up">
        <p><i class="fas fa-angle-double-up"></i></p>
    </div>
    <div class="middlepart">
        <div class="middlepart_thefirst">
            <h1>Vì Sao Bạn Nên Chọn Sản Phẩm Ba Khánh?</h1>
        </div>
        <div class="middlepart_reason">
            <div class="middlepart_reason-top">
                <div class="middlepart_reason-top--item">
                    <img src="../Content/Image/icoin1.webp" alt="">
                    <h2>Nâng tầm thực phẩm tươi</h2>
                    <p>Đúng chuẩn quốc tế ISO</p>
                    <p>22000:2005</p>
                </div>
                <div class="middlepart_reason-top--item">
                    <img src="../Content/Image/icoin2.webp" alt="">
                    <h2>An toàn</h2>
                    <p>Không sử dụng hoá chất độc hại, bao bì 2 lớp</p>
                </div>
            </div>
            <div class="middlepart_image">
                <img src="../Content/Image/hab_center_img.png" alt="">
            </div>
            <div class="middlepart_reason-bottom">
                <div class="middlepart_reason-bottom--item">
                    <img src="../Content/Image/icoin3.webp" alt="">
                    <h2>Sạch</h2>
                    <p>Nguyên liệu chọn lựa, quy trình sản xuất, công nghệ hiện đại</p>
                </div>
                <div class="middlepart_reason-bottom--item">
                    <img src="../Content/Image/icoin4.webp" alt="">
                    <h2>Tiện dụng</h2>
                    <p>Nhiều trọng lượng, nhiều cách thức bảo quản, hạn dùng lâu</p>
                </div>
            </div>
        </div>
    </div>
    <script src="../Content/Js/jquery-3.6.0.min.js"></script>
    <script src="../Content/Js/home.js"></script>
    <div class="slogan">
        <a href="">
            <div>
                <img src="../Content/Image/hbanner1_bg_down.png" alt="">
                <div class="slogan_content">
                    <div class="slogan_content-list">
                        <h1>BA KHÁNH</h1>
                        <h3>Chất Lượng Cuộc Sống</h3>
                        <p>THỰC PHẨM CỦA CHÚNG TÔI LUÔN TƯƠI MỚI, KHÔNG CHẤT ĐỘC HẠI</p>
                    </div>
                    <div class="slogan_content-submit"><a href="#">Xem Ngay</a></div>
                </div>
            </div>
        </a>
    </div>
    <div class="product">
        <div class="product_box">
            <h2>Sản Phẩm Của Chúng Tôi</h2>
            <div class="product_list">
                <div style="display: flex;">
                    <?php foreach ($queryProductNew as $key => $value) { ?>
                        <a href="../Views/product_category.php?ID=<?php echo $value['ID'] ?>">
                            <div class="product_list-item insert">
                                <img src="../upload/<?php echo $value['image'] ?>" alt="">
                                <div class="product_list-item--content">
                                    <p><?php echo $value['name'] ?></p>
                                    <del><p><?php echo number_format($value['price'])  ?><u>đ</u></p></del>
                                    <span style="color: red;"><p> Giảm <?php echo $value['discount'] ?>%</p></span>
                                    <span><p> Giảm còn <?php echo number_format(($value['discount'])>0?$value['priceSale']:$value['price'])  ?><u>đ</u></p></span>
                                    <div class="product_list-item--submit">
                                        <a href="../Views/addcart.php?ID=<?php echo $value['ID'] ?>"><i class="fas fa-cart-plus"></i></a>
                                        <a href=""><i class="fas fa-search-plus"></i></a>
                                        <a href="">Mua Ngay</a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="featuredproducts">
        <div class="featuredproducts_shade">
            <h2>Sản Phẩm Nổi Bật</h2>
            <div class="featuredproducts_list">
                <div class="featuredproducts_list-image">
                    <img src="../Content/Image/spdacbiet.webp" alt="">
                </div>
                <div class="featuredproducts_list-content">
                    <h3>BÚN TƯƠI BA KHÁNH</h3>
                    <br>
                    <span style="color: rgb(52, 87, 0);">0<U>đ</U></span>
                    <br>
                    <br>
                    <span>
                        <p>Hơn 20 năm sản xuất thực phẩm tuơi truyền thống theo phương thức hiện đại,
                            BA KHÁNH tận tuỵ mang nguồn thực phẩm DINH DƯỠNG, TƯƠI NGON,
                            SẠCH & AN TOÀN lan toả rộng khắp đến từng bữa ăn ngon của gia đình.</p>
                    </span>
                    <br>
                    <ul style="margin-left: 20px;">
                        <li><i>+ <b>Bún tươi BA KHÁNH sợi nhuyễn/nhỏ:</b>Chế biến với nước chấm: bún thịt nướng,
                                bún chả, bún đậu mắm tôm, bún cuốn bánh tráng tôm thịt,…</li>
                        </li>
                        <li>
                            <p>
                                + <b>Bún tươi BA KHÁNH sợi trung:</b>Chế biến các món ăn với nước dùng: bún riêu,
                                bún thang, bún mọc, bún ốc, bún mắm,… hoặc các món ăn khô với nước chấm: bún thịt nướng,
                                bún chả, bún đậu mắm tôm, bún cuốn bánh tráng tôm thịt,…
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="testimonials">
        <span style="font-size: 40px;margin-left: 120px;">Các Sản Phẩm BA KHÁNH Luôn Đáp Ứng 3 Tiêu Chí Gắt Gao</span>
        <div class="testimonials_block">
            <div class="circle"></div>
            <div class="testimonials_block-item">
                <div class="testimonials_block-item--span"><span>TƯƠI NGON</span></div>
                <p>Có mùi thơm tự nhiên của sản phẩm nguyên chất tự gạo nấu chín, không có
                    mùi chua nồng, không có mùi mốc, vị mặn nhẹ, không có mùi...
                </p>
            </div>
            <div class="testimonials_block-item">
                <div class="testimonials_block-item--span"><span>SẠCH</span></div>
                <p>
                    Bún có sợi bún khô, bông, tơi xốp, bóng sợi, có độ giòn và dai, sợi không dễ đứt gãy khi...
                </p>
            </div>
            <div class="testimonials_block-item">
                <div class="testimonials_block-item--span"><span>AN TOÀN</span></div>
                <p>
                    Chất liệu bao bì đóng gói phải được chứng nhận là có thể dùng
                    cho trong bao gói thực phẩm và không gây nhiễm độc khi tiếp xúc trực tiếp...
                </p>
            </div>
        </div>
    </div>
    <div class="sharecooking">
        <div style="background-color: white;">
            <div class="sharecooking_head">
                <h2>Chia Sẻ Giải Pháp Nấu Ăn Thông Minh Cho Gia Đình</h2>
            </div>
            <div class="sharecooking_block">
                <div class="sharecooking_block-left">
                    <img style="height: 300px;width: 400px;" src="../Content/Image/share_left.png" alt="">
                    <div class="sharecooking_block-left--item">
                        <h3>Đã miệng với 10 món bánh canh siêu ngon ở Sài Gòn</h3>
                        <p>Từ sáng đến tối, bạn đều có thể thưởng thức bánh canh với các vị khác nhau,
                            vừa ngon vừa lạ miệng ở Sài Gòn như bánh canh ghẹ, bò viên, cá lóc...</p>
                        <div class="sharecooking_block-left--itema">
                            <a href="">Xem Thêm</a>
                        </div>
                    </div>
                </div>
                <div class="sharecooking_block-right">
                    <div class="sharecooking_block-right--top">
                        <img style="height: 300px;width: 400px;" src="../Content/Image/share_right-top.png" alt="">
                        <div class="sharecooking_block-left--item">
                            <h2>Miến gà ngon miệng cho gia đình</h2>
                            <p>Chỉ mất ít thời gian chuẩn bị,
                                bạn vẫn có thể chế biến món miến
                                gà ngon miệng cho các thành viên trong gia đình.
                            </p>
                            <div class="sharecooking_block-right--itema">
                                <a href="">Xem Thêm</a>
                            </div>
                        </div>
                    </div>
                    <div class="sharecooking_block-right--bottom">
                        <img style="height: 300px;width: 400px;" src="../Content/Image/hteamus_3.png" alt="">
                        <div class="sharecooking_block-left--item">
                            <h2>Cách nấu phở ngon</h2>
                            <p>Phở là món ăn truyền thống của người Việt Nam,
                                cũng có thể coi phở là món ăn đặc trưng nhất của ẩm thực Việt Nam.
                                Thành phần chính của một bát phở gồm có: bánh phở, nước dùng, thịt bò, hành và các loại rau thơm.
                            </p>
                            <div class="sharecooking_block-right--itema">
                                <a href="">Xem Thêm</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="banner">
        <div class="bannerBehind">
            <img src="../Content/Image/hbanner2.webp" alt="">
        </div>
        <div class="bannerBefore">
            <h1>Từ TRUYỀN THỐNG đến HIỆN ĐẠI
                CHẶNG ĐƯỜNG HƠN 25 NĂM</h1>
            <p>Và không ngừng phát triển</p>
            <div class="bannerBefore_a"><a href="">Xem Thêm</a></div>
        </div>
    </div>
    <div class="news">
        <h1>Tin Tức</h1>
        <div class="news_block">
            <div class="news_left">
                <img src="../Content/Image/news_left.png" alt="">
                <div class="news_left-list">
                    <h2>CƠ SỞ BA KHÁNH ỨNG DỤNG HT XỬ LÝ NƯỚC RO TRONG SX BÚN - PHỞ TƯƠI SẠCH</h2>
                    <h3>Ky Thuat</h3>
                    <p>Trung Tâm khuyến công và tư vấn phát triển CN hỗ trợ thiết bị sản xuất cho cơ sở sản xuất
                        BA KHÁNH CƠ SỞ BA KHÁNH ỨNG DỤNG HT XỬ LÝ NƯỚC RO TRONG SX BÚN - PHỞ TƯƠI SẠCH</p>
                </div>
                <div class="news_left-video">
                    <iframe src="https://www.youtube.com/embed/xV6hGiKn69g" frameborder="0"></iframe>
                    <div class="news_left-video--a"><a href="">Xem Thêm <i class="fas fa-long-arrow-alt-right"></i></a></div>
                </div>
            </div>
            <div class="news_right">
                <div class="news_right-item">
                    <div class="news_right-item--img">
                        <img src="../Content/Image/news_right.png" alt="">
                    </div>
                    <div class="news_right-item--list">
                        <h2>Chuyên đề kinh tế - Sản xuất thực phẩm trước yêu cầu xây dựng tiêu chuẩn</h2>
                        <h3>Ky Thuat</h3>
                        <p>Sản xuất thực phẩm trước yêu cầu xây dụng tiêu chuẩn</p>
                        <div class="news_right-video--a"><a href="">Xem Thêm <i class="fas fa-long-arrow-alt-right"></i></a></div>
                    </div>
                </div>
                <div class="news_right-item">
                    <div class="news_right-item--img">
                        <img src="../Content/Image/news_right_xuan.webp" alt="">
                    </div>
                    <div class="news_right-item--list">
                        <h2>Ba Khánh - Chúc Xuân</h2>
                        <h3>Ky Thuat</h3>
                        <p>BA KHÁNH kính chúc quý khách hàng và quý đối
                            tác có một năm mới AN KHANG THỊNH VƯỢNG, TẤN...</p>
                        <div class="news_right-video--a"><a href="">Xem Thêm <i class="fas fa-long-arrow-alt-right"></i></a></div>
                    </div>
                </div>
                <div class="news_right-item">
                    <div class="news_right-item--img">
                        <img src="../Content/Image/xuan.png" alt="">
                    </div>
                    <div class="news_right-item--list">
                        <h2>THVL Nhịp sống đồng bằng - Đổi mới nghề bún</h2>
                        <h3>Ky Thuat</h3>
                        <div class="news_right-video--a"><a href="">Xem Thêm <i class="fas fa-long-arrow-alt-right"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div style="position: absolute;bottom: -5360px;z-index: 200;width:100%;">
            <?php
            include './footer.php';
            ?>
        </div>
    </footer>

</body>

</html>