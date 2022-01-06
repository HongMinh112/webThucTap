<?php 
include '../conn.php';
$sql="SELECT product.*,producttype.name AS 'name_type' 
            FROM product JOIN producttype ON producttype.ID=product.typeID WHERE status=1";
            $query=mysqli_query($conn,$sql);
            $row = mysqli_fetch_all(($query),MYSQLI_ASSOC);
?>
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
    <div class="product">
        <div class="product_left">
            <div class="product_left-header">
                <h2>TẤT CẢ SẢN PHẨM</h2>
            </div>
            <div class="product_left-list">
                    <?php foreach ($row as $key => $value) { ?>
                        <a href="../Views/product_category.php?ID=<?php echo $value['ID'] ?>">
                            <div class="product_list-item insert">
                                <img src="../upload/<?php echo $value['image'] ?>" alt="">
                                <div class="product_list-item--content">
                                    <p><?php echo $value['name'] ?> - <?php echo $value['name_type']?></p>
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
        <div class="product_right">
            <div class="product_right-header">
                <h2>DANH MUC SAN PHAM</h2>
            </div>
            <div class="product_right-type">
                <h2>Loại Sản Phẩm</h2>
                <div>
                    <input type="checkbox" name="Bun Tuoi">
                    Bún Tươi
                </div>
                <div>
                    <input type="checkbox" name="Bun Tuoi">
                    Bún Tươi Ba Khánh
                </div>
                <div>
                    <input type="checkbox" name="Bun Tuoi">
                    Bánh Ướt
                </div>
                <div>
                    <input type="checkbox" name="Bun Tuoi">
                    Bánh Phở Tươi
                </div>
                <div>
                    <input type="checkbox" name="Bun Tuoi">
                    Bánh Canh Gạo
                </div>
            </div>
        </div>
    </div>
    <footer class="footer_product">
        <?php 
        require './footer.php'
        ?>
    </footer>
    <script src="../Content/Js/jquery-3.6.0.min.js"></script>
    <script src="../Content/Js/home.js"></script>
</body>
</html>