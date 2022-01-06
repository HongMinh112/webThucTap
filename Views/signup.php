

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
        //chuoi ket noi
        include('../conn.php');
        //xử lý đăng ký
        if(isset($_POST['username'])){
            $username=$_POST['username'];
            $fullname=$_POST['fullname'];
            $address=$_POST['address'];
            $phonenumber=$_POST['phonenumber'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $retype=$_POST['retype'];
            $sqlmember="SELECT * FROM member WHERE username='$username'";
            $query=mysqli_query($conn,$sqlmember);
            if(!$username|| !$fullname|| !$phonenumber|| !$address ||!$email||!$password||!$retype){
                echo "
                        <script type=\"text/javascript\">
                        alert('Bạn đang nhập thiếu thông tin');
                        history.back();
                        </script>
                    ";
                    exit;
            }
            else{
                if(mysqli_num_rows($query)>0){
                    echo "
                            <script type=\"text/javascript\">
                            alert('Bạn đãng ký với tên này rồi');
                            history.back();
                            </script>
                        ";
                        exit;
                }
                else{
                    $password=$_POST['password'];
                    $retype=$_POST['retype'];
                    if($password!=$retype){
                        echo "
                            <script type=\"text/javascript\">
                            alert('Nhập lại mật khẩu không trùng khớp');
                            history.back();
                            </script>
                        ";
                        exit;
                    }else{
                        $password=md5($password);
                        $account="INSERT member(username,email,password,fullname,phonenumber,address) VALUES ('$username','$email','$password','$fullname','$phonenumber','$address')";
                        $conn->query($account);
                            echo "
                                <script type=\"text/javascript\">
                                alert('Đăng ký tài khoản thành công');
                                location.href='../Views/Index.php';
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
            <h3 style="margin-left: 480px; width: 300px; border-bottom: 1px solid grey;">TẠO TÀI KHOẢN</h3>
            <form action="<?=$_SERVER['PHP_SELF'];?>" method="post" id="form1" onsubmit="if(repassWord.value!=passWord.value){
                alert('Nhập lại mật khẩu không trùng khớp'); return false;
            }">
                <div class="SignIn_content">
                    <div class="form_group">
                        <input id="name" type="text" name="username" placeholder="Tên đăng nhập">
                        <br>
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <input id="name" type="text" name="fullname" placeholder="Họ Và Tên">
                        <br>
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <input id="name" type="text" name="address" placeholder="Địa Chỉ">
                        <br>
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <input id="name" type="text" name="phonenumber" placeholder="Số điện thoại">
                        <br>
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <input id="email" type="email" name="email" placeholder="Email">
                        <br>
                        <span style="font-size:12px"class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <input id="password" type="password" name="password" placeholder="Mật Khẩu">
                        <br>
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <input id="nhap_password" type="password" name="retype" placeholder="Nhap Lai Mật Khẩu">
                        <br>
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                </div>
                <div class="SignIn_register-submit">
                    <button name="register" id="btn_register" style="color: black;">Đăng Ký</button>
                    <button id="btn_login"><a style="color: black;" href="../Views/signin.php">Đăng Nhập</a></button>
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
    <script src="../Content/Js/javacrip.js"></script>
    <script>
            validator ({
                form:'#form1',
                errorSelector:'.form_message',
                rules:[
                    validator.isRequired('#name'),
                    validator.isEmail('#email'),
                    validator.isRequired('#sdt'),
                    validator.isRequired('#password'),
                    validator.isRequired('#nhap_password'),
                ]
            });
    </script>
</body>
</html>