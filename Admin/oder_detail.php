<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("loaction:index.php");
}
include '../conn.php';
if (isset($_GET['ID'])) {
    $IDoder = $_GET['ID'];
    $queryOder = mysqli_query($conn, "SELECT * FROM oder WHERE ID=$IDoder");
    $oder = mysqli_fetch_assoc($queryOder);

    $idmember = $oder['idmember'];
    $queryMember = mysqli_query($conn, "SELECT * FROM member WHERE ID=$idmember");
    $member = mysqli_fetch_assoc($queryMember);

    $productOder = mysqli_query($conn, "SELECT * FROM productoder WHERE oderID=$IDoder");
    $product = mysqli_fetch_all(($productOder), MYSQLI_ASSOC);
}

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
            <div style="background-color: white; margin-top:50px;">
                <h1>Thông Tin Khách Hàng</h1>
                <div class="container">
                    <div>
                        <span style="color: red;">Tên Khách Hàng: <?php echo $member['fullname'] ?></span>
                    </div>
                    <div>
                        <span style="color: red;">Số điện thoại: <?php echo $member['phonenumber'] ?></span>
                    </div>
                    <div>
                        <span style="color: red;">Địa chỉ giao hàng: <?php echo $member['address'] ?></span>
                    </div>
                    <div>
                        <span style="color: red;">Tổng tiền: <?php echo number_format($oder['total'])  ?> VND</span>
                    </div>
                    <div>
                        <span style="color: red;">Ngày đặt hàng: <?php echo $oder['createdDate'] ?></span>
                    </div>
                </div>
            </div>
            <div style="background-color: white; margin-top:50px;">
                <h1>Thông Tin Đơn Hàng</h1>
                <table style="width: 1000px;" class="list">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã Đơn Hàng</th>
                            <th>Mã Sản Phẩm</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Giá Bán</th>
                            <th>Hình Ảnh</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stt = 1;
                        foreach ($product as $key => $value) {
                        ?>
                            <tr>
                                <td><?php echo $stt++ ?></td>
                                <td><?php echo $IDoder ?></td>
                                <td><?php echo $value['productID'] ?></td>
                                <td><?php echo $value['name'] ?></td>
                                <td><?php echo $value['quantity'] ?></td>
                                <td><?php echo $value['priceProduct'] ?></td>
                                <td><img src="../upload/<?php echo $value['image'] ?>" alt="" width="100px" height="100px"></td>
                                <td><?php echo number_format($value['quantity'] * $value['priceProduct']) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php if ($oder['status'] == 'Processing') { ?>
                    <a href="processed_order.php?orderId=<?= $_GET['ID'] ?>">Xác nhận đơn hàng</a>
                <?php }
                if ($oder['status'] == 'Processed') { ?>
                    <a href="delivering_order.php?orderId=<?= $_GET['ID'] ?>">Giao hàng</a>
                <?php } 
                if ($oder['status'] == 'Delivering') { ?>
                    <a href="completed_oder.php?orderId=<?= $_GET['ID'] ?>">Đã giao hàng</a>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>