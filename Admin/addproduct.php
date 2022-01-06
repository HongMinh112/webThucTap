<?php 
session_start();
if(!isset($_SESSION['user'])){
    header("loaction:index.php");
}
include '../conn.php';
$sql="SELECT * FROM producttype ";
$query=mysqli_query($conn,$sql);


$sqlCato="SELECT * FROM productcategory";
$queryCato=mysqli_query($conn,$sqlCato);
if(isset($_POST['addproduct'])){
    $name=$_POST['name'];
    $typeID=$_POST['typeID'];
    $trademark=$_POST['trademark'];
    $price=$_POST['price'];
    $discount=$_POST['discount'];
    $description=$_POST['description'];
    $quantity=$_POST['quantity'];
    $status=isset($_POST['status'])?$_POST['status']:'0';
    $categoryId=$_POST['categeryId'];
    $sqlproduct=mysqli_query($conn,"SELECT * FROM product WHERE name='$name'");

    //upload image
    if(isset($_FILES['image'])){
        $file=$_FILES['image'];
        $file_name=$file['name'];
        move_uploaded_file($file['tmp_name'],'../upload/'.$file_name);
    }
    if(!$name||!$typeID||!$trademark||!$price||!$description||!$quantity||!$status||!$categoryId||!$file_name){
        echo "
                    <script type=\"text/javascript\">
                    alert('Bạn chưa nhập đầy đủ thông tin thông tin');
                    history.back();
                    </script>
                "
                ;
    }
    else{
        if(mysqli_num_rows($sqlproduct)!=0){
            echo "
                        <script type=\"text/javascript\">
                        alert('Tên sản phẩm đã tồn tại');
                        history.back();
                        </script>
                    "
                    ;
        }else{
            $priceSale=$_POST['price']-(($_POST['price']*$_POST['discount'])/100);
            $sqlProduct="INSERT INTO product(name,typeID,status,trademark,price,priceSale,quantity,image,description,discount,catogeryID) VALUES
            ('$name','$typeID','$status','$trademark','$price','$priceSale','$quantity','$file_name','$description','$discount','$categoryId')";
            $queryProduct=mysqli_query($conn,$sqlProduct);
            if($queryProduct){
                echo "
                            <script type=\"text/javascript\">
                            alert('Thêm Thành công');
                            location.href = './product.php';
                            </script>
                        "
                        ;
            }
            else {
                echo "
                    loi
                "
                ;
            }
        }
    }
    
    
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
                    <li><a href="../Admin/product.php">Quản Lí Sản Phẩm</a></li>
                    <li><a href="">Quản Lí Đơn Hàng</a></li>
                    <li><a href="">Theo Dõi Đơn Hàng</a></li>
                </ul>
            </div>
        </div>
        <div class="block_right">
            <div style="display:flex;" class="block_right-name">
                <div style="margin-left: 800px;display: inline-block;margin-top: 5px;"><?=$_SESSION['user']?></div>
                <div class="logout"><a style="text-decoration: none;" href="./logout.php">Dang Xuat</a></div>
            </div>
            <div class="insertProduct">
                <form action="" method="post" id="form1" enctype= "multipart/form-data">
                    <h3>Thêm sản phẩm</h3>
                    <div class="form_group">
                        <label for="">Tên sản phẩm</label>
                        <br>
                        <input id="Tensanpham" name="name" type="text" placeholder="Tên sản phẩm">
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <label for="">Thương Hiệu</label>
                        <br>
                        <input id="thuonghieu" name="trademark" type="text" placeholder="Thương Hiệu">
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <label for="">Danh Mục</label>
                        <br>
                        <select name="categeryId" id="">
                            <option value="">Danh Mục</option>
                            <?php foreach ($queryCato as $key => $value) {?>
                                <option value="<?php echo $value['ID'] ?>"><?php echo $value ['name'] ?></option>
                            <?php } ?>
                        </select>
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <label for="">Loại sản phẩm</label>
                        <br>
                        <select name="typeID" id="">
                            <option value="">Loại sản phẩm</option>
                            <?php foreach ($query as $key => $value) {?>
                                <option value="<?php echo $value['ID'] ?>"><?php echo $value ['name'] ?></option>
                            <?php } ?>
                        </select>
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <label for="">Giá Sản Phẩm</label>
                        <br>
                        <input id="giasanpham" name="price" type="number" placeholder="Giá sản phẩm">
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <label for="">Sale</label>
                        <br>
                        <input id="giamgia" name="discount" type="number" placeholder="Giảm giá">
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <label for="">Hình Ảnh</label>
                        <br>
                        <input id="check" type="file" id="image1" name="image"  placeholder="Hình Ảnh ">
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <label for="">Mô Tả</label>
                        <br>
                        <textarea style="width:300px;" name="description" id="" rows="5" placeholder="Nội Dung"></textarea>
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <label for="">Số lượng</label>
                        <br>
                        <input id="soluong" name="quantity" type="number" placeholder="Số Lượng">
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <label for="">Trang Thai</label>
                        <br>
                        <label style="width:30px;" for="">
                            <input style="width:30px;" type="radio" name="status" value="0" >An
                        </label>
                       <label for="">
                           <input style="width:30px;" type="radio" name="status" value="1">Hien
                       </label>
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <button name="addproduct">Thêm</button>
                </form>
            </div>
        </div>
    </div>
    <script src="../Content/Js/javacrip.js"></script>
    <script src="../Content/Js/jquery-3.6.0.min.js"></script>
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
                    validator.isRequired('#thuonghieu'),
                    validator.isRequired('#Tensanpham'),
                    validator.isRequired('#giasanpham'),
                    validator.isRequired('#loaisanpham'),
                    validator.isRequired('#giamgia'),
                    validator.isRequired('#mota'),
                    validator.isRequired('#soluong'),
                ]
            });
    </script>
</body>
</html>