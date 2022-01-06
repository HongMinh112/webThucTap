<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Content/Css/style.css">
    <link rel="stylesheet" href="../Content/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../Content/Css/introduce.css">
    <link rel="stylesheet" href="../Content/Css/product.css">
    <title>Home</title>
</head>
<body>
    <?php 
    require './header.php';
    ?>
    <?php
        if(isset($_GET['ID'])){
            $ID=$_GET['ID'];
            $sql="SELECT * FROM product WHERE ID=$ID";
            $query=mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($query);
            $IDtype=$row['typeID'];
            $sqlTypeproduct="SELECT * FROM producttype WHERE ID=$IDtype";
            
            $queryType=mysqli_query($conn,$sqlTypeproduct);
            $rowType = mysqli_fetch_assoc($queryType);
        }
        $sqlProduct = "SELECT * FROM product";
        $listProduct = mysqli_fetch_all(mysqli_query($conn, $sqlProduct), MYSQLI_ASSOC);
    ?>
    <div class="detail">
        <div class="detail_top">
            
            <div class="detail_top-midlle">
                <div id="image_box1" class="block_img">
                    <img width="300px" height="400px" src="../upload/<?php echo $row['image'] ?>" alt="">
                </div>
            </div>
            <div class="detail_top-right">
                <h1 style="font-size: 50px; margin-bottom: 20px;"><?php echo $row['name'] ?></h1>
                <span style="display: flex;">
                    <p style="border-right: 2px solid green; padding-right: 10px;">Thương hiệu: <span style="color: red;"><?php echo $row['trademark'] ?></span></p>
                    <p style="padding-left: 10px;">Loại: <?php echo $rowType['name'] ?>
                    </p>
                </span>
                <del style="margin: 15px 0; color: greenyellow;font-size: 20px;"><span><?php echo number_format($row['price'])  ?></span><u>đ</u></del>
                <div style="margin: 15px 0; color: red;font-size: 20px;"><span>Giam <?php echo $row['discount'] ?></span><u>%</u></div>
                <div style="margin: 15px 0; color: greenyellow;font-size: 20px;"><span><?php echo number_format($row['priceSale'])  ?></span><u>đ</u></div>
                <div ><a href="../Views/addcart.php?ID=<?php echo $row['ID'] ?>"style="padding-bottom: 15px;">Thêm vào giỏ hàng</a></div>
                <div><i class="fas fa-phone"></i>  Hotline hỗ trợ 24/7: 0270 3815066 - 0270 3815077 - 093 855 8599 </div>
            </div>
        </div>
        <div class="detail_bottom">
            <div style="font-size: 30px; text-align: center;">
                <h1>Sản phẩm liên quan</h1>
            </div>
            <div class="product_left-list">
                <?php foreach ($row as $key => $value) { ?>
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
    <footer class="footer_productcategory">
        <div>
            <img width="100%" height="540px" src="../Content/Image/footer.webp" alt="">
            <div class="footer_logo">
                <img src="../Content/Image/logo.webp" alt="">
            </div>
            <div class="footer_list">
                <div class="footer_list-item">
                    <h2>LIÊN HỆ</h2>
                    <div class="footer_list-item--p">
                        <p><i class="fas fa-map-marker"></i> 24D, Tân Quới Tây, Trường An, TP Vĩnh Long, Vĩnh Long</p>
                        <p><i class="fas fa-phone"></i> 0270 3815066 - 0270 3815077 - 093 855 8599</p>
                        <p><i class="fas fa-envelope"></i> bakhanh.bunphovietnam@gmail.com</p>
                    </div>
                </div>
                <div class="footer_list-item">
                    <h2>HỖ TRỢ KHÁCH HÀNG</h2>
                    <ul>
                        <li><a href="">Trang Chủ</a></li>
                        <li><a href="">Về Ba Khánh</a></li>
                        <li><a href="">Sản phẩm</a></li>
                        <li><a href="">Tin tức</a></li>
                        <li><a href="">Góc bếp Ba Khánh</a></li>
                        <li><a href="">Liên Hệ</a></li>
                    </ul>
                </div>
                <div class="footer_list-item">
                    <h2>LIÊN KẾT NHANH</h2>
                    <ul>
                        <li><a href="">Tìm kiếm</a></li>
                        <li><a href="">Giới thiệu</a></li>
                    </ul>
                </div>
                <div class="footer_list-item">
                    <h2>GALLERY</h2>
                </div>
            </div>
        </div>
    </footer>
    <script src="../Content/Js/jquery-3.6.0.min.js"></script>
    <script src="../Content/Js/home.js"></script>
</body>
</html>