<?php
//Khai báo sử dụng session
session_start();
if(isset($_SESSION['user'])){
    header("location:product.php");
}
 
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');
 
//Xử lý đăng nhập
if (isset($_POST['dangnhap'])) 
{
    //Kết nối tới database
    include('../conn.php');
     
    //Lấy dữ liệu nhập vào
    $username = addslashes($_POST['user']);
    $password = addslashes($_POST['pass']);
    //Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
    if (!$username || !$password) {
        echo "
                    <script type=\"text/javascript\">
                    alert('Vui lòng nhập tên tài khoản và mật khẩu');
                    history.back();
                    </script>
                "
                ;
                exit;
    }
     
    // mã hóa pasword
    $password = md5($password);
     
    //Kiểm tra tên đăng nhập có tồn tại không
    $result="SELECT * FROM admin WHERE user='$username'";
    $query = mysqli_query($conn,$result);
    if (mysqli_num_rows($query) == 0) {
        echo "
                    <script type=\"text/javascript\">
                    alert('Tên đăng nhập không tồn tại');
                    history.back();
                    </script>
                "
                ;
                exit;
    }
     
    //Lấy mật khẩu trong database ra
    $row = mysqli_fetch_array($query);
     
    //So sánh 2 mật khẩu có trùng khớp hay không
    if ($password != $row['pass']) {
        echo "
                    <script type=\"text/javascript\">
                    alert('Mật khẩu không đúng, vui lòng nhập lại');
                    history.back();
                    </script>
                "
                ;
                exit;
    }
     
    //Lưu tên đăng nhập
    $_SESSION['user'] = $username;
    echo "
                    <script type=\"text/javascript\">
                    alert('Đăng Nhập thành công');
                    location.href = './product.php';
                    </script>
                "
                ;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Content/Css/admin.css">
    <title>Home</title>
</head>
<body>
    <div style="display: flex;">
        <div class="block_lefft">
            <p>Ba Khanh Admin</p>
            <p>Dashbord</p>
            <div class="menu">
                <ul class="menu_ul">
                    <li><a href="#">Quản Lí Sản Phẩm</a></li>
                    <li><a href="#">Quản Lí Đơn Hàng</a></li>
                    <li><a href="#">Theo Dõi Đơn Hàng</a></li>
                </ul>
            </div>
        </div>
        <div class="block_right">
            <div class="form_login">
                <div">
                    <img style="margin: 10px 20px;" width="100px" height="70px" src="../Content/Image/logo.webp" alt="">
                </div>
                <form class="form_login-item" action="<?=$_SERVER['PHP_SELF'];?>" method="post">
                    <h3>Login</h3>
                    <div>
                        <input name="user" type="text" placeholder="Tên đăng Nhập">
                        <input name="pass" type="password" placeholder="Mật Khẩu">
                        <div class="form_login-submit">
                            <input type="submit" name="dangnhap" value="Login">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>