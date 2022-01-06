
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
    <div>
        
        <?php
        $cart=(isset($_SESSION['cart']))?$_SESSION['cart']:[];
        if(isset($_SESSION['username'])) {?>
        <?php
            $usernameLogin=$_SESSION['username'];
            $sqlMember="SELECT * from member where username='$usernameLogin'";
            $query=mysqli_query($conn,$sqlMember);
            $member=mysqli_fetch_assoc($query);
            $total=0;
            if(isset($_POST['username'])){
              $idmember=$member['ID'];
                $total = 0;
                foreach ($cart as $key => $item) {
                    $total += intval($item['price']) * $item['quantity'];
                }
                $sqlOder=mysqli_query($conn,"INSERT INTO oder VALUES (NULL,'$idmember','$total','Processing','" . date('y/m/d') . "',NULL)");
               
                if($sqlOder){
                    $idOder=mysqli_insert_id($conn);
                    foreach($cart as $value){
                        $productID=$value['ID'];
                        $quantity=$value['quantity'];
                        $price=$value['price'];
                        $name=$value['name'];
                        $image=$value['image'];
                        $productOder=mysqli_query($conn,"INSERT INTO productoder(oderID,productID,quantity,priceProduct,name,image)
                        VALUES ('$idOder','$productID','$quantity','$price','$name','$image')");

                    }
                    if ($productOder) {
                        echo "
                        <script type=\"text/javascript\">
                        alert('Đặt Hàng Thành Công');
                        location.href='./informationOder.php';
                        </script>
                    "
                    ;
                    unset($_SESSION['cart']);
                    } else {
                        echo "Error: " . $conn->error;
                    }
                    
                }
            }
        ?>
        <form action="" method="post">
            <div style="background-color: white;width:200px;position: absolute;top:250px;margin-left:30px;">
                <div><span>Thông Tin Khách Hàng</span></div>
                <input type="hidden" name="username" placeholder="Ho ten" value="<?php echo $member['username'] ?>" >
                <input type="hidden" name="email" placeholder="Ho ten" value="<?php echo $member['email'] ?>">
                <input type="hidden" name="passWord" placeholder="Ho ten" value="<?php echo $member['passWord'] ?>">
                <div style="margin: 10px 10px;">
                    <label for="">Họ Và Tên</label>
                    <input type="text" name="fullname" placeholder="Ho ten" 
                    value="<?php echo $member['fullname'] ?>">
                </div>
                <div style="margin: 10px 10px;">
                    <label for="">Số điện thoại</label>
                    <input type="number" name="phonenumber" placeholder="So Dien Thoai"  
                    value="<?php echo $member['phonenumber'] ?>">
                </div>
                <div style="margin: 10px 10px;">
                    <label for="">Địa Chỉ</label>
                    <input type="text" name="address" placeholder="Dia Chi"  
                    value="<?php echo $member['address'] ?>">
                </div>
            </div>
        <?php }
        else{
            echo "
                    <script type=\"text/javascript\">
                    alert('Vui lòng đăng nhập hoặc tạo tài khoản');
                    location.href='./SignIn.php';
                    </script>
                "
            ;
        }
        ?>
    </div>
        <div style="background-color: white; position: absolute;top:250px;margin-left:250px;">
            <table class="list" style="width: 1000px;height:100%;">
                <tr>
                    <th>STT</th>
                    <th>Ten san pham</th>
                    <th>Hinh Anh</th>
                    <th>Gia</th>
                    <th>So Luong</th>
                    <th>Thanh Tien</th>
                </tr>
                <?php
                $stt=1;
                 foreach($cart as $key => $value) {?>
                    <tr>
                        <td><?php echo $stt++ ?></td>
                        <td><?php echo $value['name'] ?></td>
                        <td><img src="../upload/<?php echo $value['image'] ?>" alt="" width="100px" height="100px"></td>
                        <td><?php echo number_format($value['price'])  ?></td>
                        <td><?php echo $value['quantity'] ?></td>
                        <td><?php echo number_format($value['quantity']*$value['price'])  ?></td>
                    </tr>
                <?php } ?>
            </table>
            <div>
                <button>Xac Nhan</button>
                <?php $total = 0;
                    foreach ($cart as $key => $item) {
                        $total += intval($item['price']) * $item['quantity'];
                    }
                ?>
                <span style="color: red;">Tổng tiền: <?php echo number_format($total)  ?> VNĐ</span>
            </div>
        </div>
    </form>
    
    <footer style="position: absolute;bottom:-1350px;" class="footer_news">
        <?php 
        require './footer.php';
        ?>
    </footer>
    <script src="../Content/Js/jquery-3.6.0.min.js"></script>
    <script src="../Content/Js/home.js"></script>
</body>
</html>