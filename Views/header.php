<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("loaction:index.php");
}
include '../conn.php';
$sqlProductCato = "SELECT * FROM productcategory";
$queryProductCato = mysqli_fetch_all(mysqli_query($conn, $sqlProductCato), MYSQLI_ASSOC);
// Get product category
$sqlProductCategory = "SELECT * FROM productcategory";
$list = mysqli_fetch_all(mysqli_query($conn, $sqlProductCategory), MYSQLI_ASSOC);
// Get product
$sqlProduct = "SELECT * FROM product";
$listProduct = mysqli_fetch_all(mysqli_query($conn, $sqlProduct), MYSQLI_ASSOC);
?>

    <header class="header">
        <div class="header_top">
            <div class="header_top-right">
                <div>
                    <div class="phonenumber">
                        <span><i class="fas fa-phone"></i>   0270 3815066 - 0270 3815077 - 093 855 8599</span>
                    </div>
                    <div>
                        <span class="email"><i class="far fa-envelope"></i>   bakhanh.bunphovietnam@gmail.com</span>
                        <span class="time"><i class="far fa-clock"></i>   Mở cửa từ 8:00 - 22:00</span>
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
                    <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
                    <a href="../Views/informationOder.php"><i class="fas fa-cart-arrow-down"></i></a>
                </div>
                <div class="search">
                    <form action="./search.php" method="get">
                        <input type="text" style="width: 200px;height: 20px;" name="name" placeholder="Tim Kiem...">
                        <input type="submit" name="search" value="tim kiem">
                    </form>
                </div>
            </div>
        </div>
        <div class="image">
            <div>
                <img src="../Content/Image/gioithieu_header.webp" alt="">
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