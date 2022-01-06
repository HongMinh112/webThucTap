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
include '../conn.php';

$oder = "SELECT oder.*, member.fullname as 'Fullname' FROM oder JOIN member On oder.idmember=member.ID";

$queryOder = mysqli_query($conn, $oder);




$sql = "SELECT product.*,productcategory.name AS 'category_name' FROM product JOIN productcategory on product.catogeryID=productcategory.ID";
$productList = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Content/Css/oder.css">
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
                <div class="container">
                    <table style="width: 1000px;" class="list">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Ma Don Hang</th>
                                <th>Ten Khach Hang</th>
                                <th>Ngay Dat</th>
                                <th>Tong Tien</th>
                                <th>Trang Thai</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $stt = 1;
                            foreach ($queryOder as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $stt++ ?></td>
                                    <td><?php echo $value['ID'] ?></td>
                                    <td><?php echo $value['Fullname'] ?></td>
                                    <td><?php echo $value['createdDate'] ?></td>
                                    <td><?php echo number_format($value['total']) ?> VND</td>
                                    <td><?php if ($value['status'] == 'Processing') { ?>
                                            <span>Đang xác nhận</span>
                                        <?php } else if ($value['status'] == 'Processed') { ?>
                                            <span>Đã xác nhận</span>
                                        <?php }
                                        if ($value['status'] == 'Delivering') { ?>
                                            <span>Đang Giao Hàng</span>
                                        <?php } else if ($value['status'] == 'Completed') { ?>
                                            <span>Đã Giao Hàng</span>
                                        <?php } else if($value['status']=='Cancel'){?>
                                            <span>Đã hủy</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <button class="typesubmit"><a href="../Admin/oder_detail.php?ID=<?php echo $value['ID'] ?>">Xem Chi Tiet</a></button>
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