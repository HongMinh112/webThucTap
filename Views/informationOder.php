
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
            $member=$_SESSION['username'];
            $reults=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM member WHERE username='$member'"));
            $ID=$reults['ID'];
            $account=mysqli_fetch_all((mysqli_query($conn,"SELECT * FROM oder WHERE idmember='$ID'")),MYSQLI_ASSOC);
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
        <form action="" method="post">
            <div style="background-color: white;width:500px;position: absolute;top:300px;margin-left:30px;">
            <div style="text-align: center; font-size:30px; margin-bottom:30px;"><span>Thông Tin Khách Hàng</span></div>
                <table style="width: 700px;" class="list">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Ma Don Hang</th>
                                <th>Ngay Dat</th>
                                <th>Tong Tien</th>
                                <th>Trang Thai</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $stt = 1;
                            foreach ($account as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $stt++ ?></td>
                                    <td><?php echo $value['ID'] ?></td>
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
                                        <button class="typesubmit"><a style="color: black;text-decoration: none;" href="../Views/oder_detail.php?ID=<?php echo $value['ID'] ?>">Xem Chi Tiet</a></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
        </div>
            
            </div>
        </form>
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