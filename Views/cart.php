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
    <?php
    $cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];

    ?>
    <div>
        <div style="background-color: white; position: absolute;top:300px;margin-left:30px;">
            <table class="list" style="width: 1200px;">
                <tr>
                    <th>STT</th>
                    <th>Ten san pham</th>
                    <th>Hinh Anh</th>
                    <th>Gia</th>
                    <th>So Luong</th>
                    <th>Thanh Tien</th>
                    <td>Xóa</td>
                </tr>
                <?php $total = 0;
                    foreach ($cart as $key => $item) {
                        $total += intval($item['price']) * $item['quantity'];
                    }
                ?>
                <?php
                $stt = 1;
                
                foreach ($cart as $key => $value) { ?>
                    <tr>
                        <td><?php echo $stt++ ?></td>
                        <td><?php echo $value['name'] ?></td>
                        <td><img src="../upload/<?php echo $value['image'] ?>" alt="" width="150px" height="150px"></td>
                        <td><?php echo number_format($value['price'])  ?></td>
                        <td>
                            <form action="../Views/addcart.php">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="ID" value="<?php echo $value['ID'] ?>">
                                <input style="width: 50px;" type="number" name="quantity" value="<?php echo $value['quantity'] ?>">
                                <button type="submit">Cập nhật</button>
                            </form>
                        </td>
                        <td><?php echo number_format($value['quantity'] * $value['price'])  ?></td>
                        <td><a href="removeItemCart.php?ID=<?= $value['ID'] ?>"><i class="far fa-trash-alt"></i></a></td>
                    </tr>
                <?php } ?>
            </table>
            <div><a href="../Views/oder.php"><input type="Submit" value="Đặt Hàng"></a></div>
            
            <span>Tổng Giỏ Hàng: <?php echo number_format( $total)  ?> VND</span>
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