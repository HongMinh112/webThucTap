
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Content/Css/style.css">
    <link rel="stylesheet" href="../Content/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../Content/Css/Register.css">
    <title>Home</title>
</head>
<body>
    <?php 
    require './header.php';
    ?>
    <?php
        
        
        //Xử lý đăng nhập
        if (isset($_POST['dangnhap'])) 
        {
            //Kết nối tới database
            include('../conn.php');
            
            //Lấy dữ liệu nhập vào
            $username = addslashes($_POST['username']);
            $password = addslashes($_POST['passWord']);
            
            //Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
            if (!$username || !$password) {
                echo "
                    <script type=\"text/javascript\">
                    alert('Vui long nhap thong tin dang nhap');
                    history.back();
                    </script>
                "
                ;
            }
            else{
                    // mã hóa pasword
                $password = md5($password);
                
                //Kiểm tra tên đăng nhập có tồn tại không
                $result="SELECT * FROM member WHERE username='$username'";
                $query = mysqli_query($conn,$result);
                if (mysqli_num_rows($query) == 0) {
                    echo "
                        <script type=\"text/javascript\">
                        alert('Tài khoản không tồn tại');
                        history.back();
                        </script>
                    "
                    ;
                }
                else{
                        //Lấy mật khẩu trong database ra
                    $row = mysqli_fetch_array($query);
                    
                    //So sánh 2 mật khẩu có trùng khớp hay không
                    if ($password != $row['passWord']) {
                        echo "
                            <script type=\"text/javascript\">
                            alert('Mật khẩu không đúng, vui lòng nhập lại');
                            history.back();
                            </script>
                        "
                        ;
                    }
                    else{
                            //Lưu tên đăng nhập
                        $_SESSION['username'] = $username;
                    echo "
                            <script type=\"text/javascript\">
                            alert('Đăng Nhập thành công');
                            location.href = './index.php';
                            </script>
                        "
                        ;
                    }
                }
            }
            
            
        }
    ?>
    <div class="SignIn">
        <div class="SignIn_register">
            <h3 style="margin-left: 480px; width: 300px; border-bottom: 1px solid grey;">ĐĂNG NHẬP</h3>
            <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
                <div class="SignIn_content">
                    <div>
                        <input name="username" type="text" placeholder="Ho Ten">
                    </div>
                    <div>
                        <input name="passWord" type="password" placeholder="Mật Khẩu">
                    </div>
                </div>
                <div class="SignIn_register-submit">
                    <button id="btn_register"><a style="color: black;" href="../Views/signup.php">Đăng Ký</a></button>
                    <button name="dangnhap" id="btn_login">Đăng Nhập</button>
                </div>
            </form>
            
        </div>
    </div>
    <footer class="footer_SignIn">
        <div>
            <img width="100%" height="540px" src="../Content/Image/footer.webp" alt="">
            <div class="footer_logo">
                <img src="../Content/Image/logo.webp" alt="">
            </div>
            <div class="footer_list">
                <div class="footer_list-item">
                    <h2>LIÊN HỆ</h2>
                    <div class="footer_list-item--p">
                        <p><i class="fas fa-map-marker"></i> 24D, Tân Quới Tây, Trường An, TP Vĩnh Long, Vĩnh Long</p>
                        <p><i class="fas fa-phone"></i> 0270 3815066 - 0270 3815077 - 093 855 8599</p>
                        <p><i class="fas fa-envelope"></i> bakhanh.bunphovietnam@gmail.com</p>
                    </div>
                </div>
                <div class="footer_list-item">
                    <h2>HỖ TRỢ KHÁCH HÀNG</h2>
                    <ul>
                        <li><a href="">Trang Chủ</a></li>
                        <li><a href="">Về Ba Khánh</a></li>
                        <li><a href="">Sản phẩm</a></li>
                        <li><a href="">Tin tức</a></li>
                        <li><a href="">Góc bếp Ba Khánh</a></li>
                        <li><a href="">Liên Hệ</a></li>
                    </ul>
                </div>
                <div class="footer_list-item">
                    <h2>LIÊN KẾT NHANH</h2>
                    <ul>
                        <li><a href="">Tìm kiếm</a></li>
                        <li><a href="">Giới thiệu</a></li>
                    </ul>
                </div>
                <div class="footer_list-item">
                    <h2>GALLERY</h2>
                </div>
            </div>
        </div>
    </footer>
    <script src="../Content/Js/jquery-3.6.0.min.js"></script>
    <script src="../Content/Js/home.js"></script>
</body>
</html>