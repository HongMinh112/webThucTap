
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
    <div style="height: 700px;background-color: white;">
        <?php
        if(isset($_SESSION['username'])) {?>
        <?php
        if(isset($_GET['ID'])){
            $ID=$_GET['ID'];
            $IDoder = $_GET['ID'];
            $queryOder = mysqli_query($conn, "SELECT * FROM oder WHERE ID=$IDoder");
            $oder = mysqli_fetch_assoc($queryOder);
            
            $accountID = $oder['idmember'];
            $queryMember = mysqli_query($conn, "SELECT * FROM member WHERE ID=$accountID");
            $account = mysqli_fetch_assoc($queryMember);

            $productOder = mysqli_query($conn, "SELECT * FROM productoder WHERE oderID=$IDoder");
            $product = mysqli_fetch_all(($productOder), MYSQLI_ASSOC);
        }
        ?>
        <?php } else {
            echo "
            <script type=\"text/javascript\">
                alert('Bạn chưa đăng nhập nên không xem được đơn hàng');
                location.href = '../Views/signin.php';
            </script>
            "
            ;
            exit;
        }?>
        <h2 style="text-align: center;color:black;margin-top:170px;font-size:35px;">Thông Tin Đơn Hàng</h2>
        
        <div>
                <div style="display:flex;">
                    <div style="background-color: white; margin-top:50px;">
                        <h1>Thông Tin Khách Hàng</h1>
                        <div class="container">
                            <div>
                                <span style="color: red;">Tên Khách Hàng: <?php echo $account['fullname'] ?></span>
                            </div>
                            <div>
                                <span style="color: red;">Số điện thoại: <?php echo $account['phonenumber'] ?></span>
                            </div>
                            <div>
                                <span style="color: red;">Địa chỉ giao hàng: <?php echo $account['address'] ?></span>
                            </div>
                            <div>
                                <span style="color: red;">Tổng tiền: <?php echo number_format($oder['total'])  ?> VND</span>
                            </div>
                            <div>
                                <span style="color: red;">Ngày đặt hàng: <?php echo $oder['createdDate'] ?></span>
                            </div>
                        </div>
                    </div>
                    <div style="background-color: white; margin-top:50px;margin-left:44px;">
                        <h1>Thông Tin Đơn Hàng</h1>
                        <table style="width: 900px;text-align: center;" class="list">
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
                        <div>
                            <?php if($oder['status']=='Processing' || $oder['status']=='Processed') {?>
                                <button style="margin: 10px 0;">
                                    <a style="text-decoration: none;" href="../Views/cancel_oder.php?ID=<?php echo $oder['ID'] ?>">Hủy đơn hàng</a>
                                </button>
                            <?php } else if($oder['status']=='Cancel'){?>
                                <span>Đơn hàng đã hủy</span>
                            <?php } else if($oder['status']=='Delivering'){?>
                                <span>Đơn hàng đang được gia đến bạn</span>
                            <?php } else {?>
                                <span>Đơn hàng đã giao thành công</span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <footer style="position: absolute;bottom:-700px;" class="footer_news">
        <?php 
        require './footer.php';
        ?>
    </footer>
    <script src="../Content/Js/jquery-3.6.0.min.js"></script>
    <script src="../Content/Js/home.js"></script>
</body>
</html>