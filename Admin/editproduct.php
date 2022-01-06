<?php 
session_start();
if(!isset($_SESSION['user'])){
    header("loaction:index.php");
}
include '../conn.php';
//laays ds catogery
$sqltype="SELECT * FROM producttype";
$querytype=mysqli_query($conn,$sqltype);
//lay ds category 
$sqlCato="SELECT * FROM productcategory";
$queryCato=mysqli_query($conn,$sqlCato);

//lay ds san pham bằng ID
if(isset($_GET['ID'])){
    $ID=$_GET['ID'];
    $sql="SELECT * FROM product WHERE ID=$ID";
    $query=mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
}
//post 
if(isset($_POST['name'])){
    $name=$_POST['name'];
    $typeID=$_POST['typeID'];
    $trademark=$_POST['trademark'];
    $price=$_POST['price'];
    $discount=$_POST['discount'];
    $priceSale=$_POST['price']-(($_POST['price']*$_POST['discount'])/100);
    $description=$_POST['description'];
    $quantity=$_POST['quantity'];
    $status=$_POST['status'];
    $categoryId=$_POST['categeryId'];
    if(empty($_FILES['image']['name'])){
        //khong chon anh
        $image=$row['image'];
    }
    else{
        //chon anh
        $file=$_FILES['image'];
        $file_name=$file['name'];
        move_uploaded_file($file['tmp_name'],'../upload/'.$file_name);
        $image=$file_name;
    }
    //update
    $sqlProduct="UPDATE product SET name='$name', typeID='$typeID', trademark='$trademark',price='$price',discount='$discount',
    priceSale='$priceSale',  description='$description',quantity='$quantity',status='$status', catogeryID='$categoryId', image='$image' WHERE ID=$ID";
    $queryProduct=mysqli_query($conn,$sqlProduct);
    if($queryProduct){
        header("location:product.php");
    }
    else{
        echo"loix";
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
                        <input id="Tensanpham" name="name" type="text" value="<?php echo $row['name'] ?>">
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <label for="">Thương Hiệu</label>
                        <br>
                        <input id="thuonghieu" name="trademark" type="text" placeholder="Thương Hiệu"  value="<?php echo $row['trademark'] ?>">
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <label for="">Danh Mục</label>
                        <br>
                        <select name="categeryId" id="">
                            <option value="">Danh Mục</option>
                            <?php foreach ($queryCato as $key => $value) {?>
                                <option value="<?php echo $value['ID'] ?>" <?php echo ($value['ID']==$row['catogeryID']
                                ?'selected':'') ?>><?php echo $value ['name'] ?></option>
                            <?php } ?>
                        </select>
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <label for="">Loại sản phẩm</label>
                        <br>
                        <select name="typeID" id="">
                            <option value="">Loại sản phẩm</option>
                            <?php foreach ($querytype as $key => $value) {?>
                                <option value="<?php echo $value['ID'] ?>" <?php echo($value['ID']==$row['typeID'])
                                ?'selected':'' ?>><?php echo $value ['name'] ?></option>
                            <?php } ?>
                        </select>
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <label for="">Giá Sản Phẩm</label>
                        <br>
                        <input id="giasanpham" name="price" type="number" placeholder="Giá sản phẩm"  value="<?php echo $row['price'] ?>">
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <label for="">Giảm giá</label>
                        <br>
                        <input id="giamgia" name="discount" type="number" placeholder="Giảm giá"  value="<?php echo $row['discount'] ?>">
                        <span style="font-size:12px" class="form_message"></span>
                    </div> 
                    <div class="form_group">
                        <label for="">Hình Ảnh</label>
                        <br>
                        <input id="check" type="file" id="image1" name="image"  placeholder="Hình Ảnh ">
                        <img src="../upload/<?php echo $row['image'] ?>" alt="" width="100px";>
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <label for="">Mô Tả</label>
                        <br>
                        <textarea style="width:300px;" name="description" cols="5" rows="5" ><?php echo $row['description'] ?></textarea>
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <label for="">Số lượng</label>
                        <br>
                        <input id="soluong" name="quantity" type="number" placeholder="Số Lượng" value="<?php echo $row['quantity'] ?>">
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <div class="form_group">
                        <label for="">Trang Thai</label>
                        <br>
                        <label style="width:30px;" for="">
                            <input style="width:30px;" type="radio" name="status" value="0" <?php echo($row['status']==0?'checked':'') ?>>An
                        </label>
                       <label for="">
                           <input style="width:30px;" type="radio" name="status" value="1" <?php echo($row['status']==1?'checked':'') ?>>Hien
                       </label>
                        <span style="font-size:12px" class="form_message"></span>
                    </div>
                    <button name="editproduct">Sửa</button>
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
                    validator.isRequired('#Tensanpham'),
                    validator.isRequired('#giasanpham'),
                    validator.isRequired('#giamgia'),
                    validator.isRequired('#mota'),
                    validator.isRequired('#soluong'),
                ]
            });
    </script>
</body>
</html>