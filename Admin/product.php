<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo "
                    <script type=\"text/javascript\">
                    alert('Bạn Phải đăng nhập');
                    location.href = './index.php';
                    </script>
                "
                ;
}
else{
    header("loaction:index.php");
}
include '../conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['block'])) {
        $query = "UPDATE product SET status = 0 where id = ".$_POST['id']." ";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo '<script type="text/javascript">alert("Khóa sản phẩm thành công!");</script>';
        } else {
            echo '<script type="text/javascript">alert("Khóa sản phẩm thất bại!");</script>';
        }
    } else if (isset($_POST['active'])) {
        $query = "UPDATE product SET status = 1 where id = ".$_POST['id']." ";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo '<script type="text/javascript">alert("Kích hoạt sản phẩm thành công!");</script>';
        } else {
            echo '<script type="text/javascript">alert("Kích hoạt sản phẩm thất bại!");</script>';
        }
    } else {
        echo '<script type="text/javascript">alert("Có lỗi xảy ra!");</script>';
        die();
    }
}


$sql = "SELECT product.*,productcategory.name AS 'category_name' FROM product JOIN productcategory on product.catogeryID=productcategory.ID";
$productList = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Content/Css/admin.css">
    <title>Product</title>
</head>

<body>
    <div style="display: flex;">
        <div class="block_lefft">
            <p>Ba Khanh Admin</p>
            <p>Dashbord</p>
            <div class="menu">
                <ul class="menu_ul">
                    <li><a href="../Admin/product.php">Quản Lí Sản Phẩm</a></li>
                    <li><a href="../Admin/oder.php">Quản Lí Đơn Hàng</a></li>
                    <li><a href="">Theo Dõi Đơn Hàng</a></li>
                </ul>
            </div>
        </div>
        <div class="block_right">
            <div style="display:flex;" class="block_right-name">
                <div style="margin-left: 800px;display: inline-block;margin-top: 5px;"><?= $_SESSION['user'] ?></div>
                <div class="logout"><a style="text-decoration: none;" href="./logout.php">Dang Xuat</a></div>
            </div>
            <div class="block_right-product">
                <button><a href="../Admin/addproduct.php">Thêm sản phẩm</a></button>
                <div class="container">
                    <table class="list">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Loại sản phẩm</th>
                                <th>Thương Hiệu</th>
                                <th>Hình ảnh</th>
                                <th>Giá</th>
                                <th>Giảm giá</th>
                                <th>Gia Giam</th>
                                <th>Số lượng</th>
                                <th>Mô tả</th>
                                <th>Trang Thai</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $stt=1;
                            foreach ($productList as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $stt++ ?></td>
                                    <td><?php echo $value['name'] ?></td>
                                    <td><?php echo $value['category_name'] ?></td>
                                    <td><?php echo $value['trademark'] ?></td>
                                    <td><img src="../upload/<?php echo $value['image'] ?>" alt="" width=130; height=130;></td>
                                    <td><?php echo number_format($value['price'])  ?></td>
                                    <td><?php echo $value['discount'] ?>%</td>
                                    <td><?php echo number_format ($value['priceSale']) ?></td>
                                    <td><?php echo $value['quantity'] ?></td>
                                    <td><?php echo $value['description'] ?></td>
                                    <td><?php echo (($value['status'] == 0) ? 'An' : 'Hien') ?></td>
                                    <td>
                                        <a href="../Admin/editproduct.php?ID=<?php echo $value['ID'] ?>">Sửa</a>
                                        <br>
                                        <?php
                                        if ($value['status']) { ?>
                                            <form action="product.php" method="post">
                                                <input type="text" name="id" hidden value="<?= $value['ID'] ?>" style="display: none;">
                                                <input type="submit" value="Khóa" name="block">
                                            </form>
                                        <?php } else { ?>
                                            <form action="product.php" method="post">
                                                <input type="text" name="id" hidden value="<?= $value['ID'] ?>" style="display: none;">
                                                <input type="submit" value="Mở" name="active">
                                            </form>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>