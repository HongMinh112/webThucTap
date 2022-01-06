<?php 
session_start();
include '../conn.php';
if(isset($_GET['ID'])){
    $ID=$_GET['ID'];
}

$action=isset($_GET['action'])?$_GET['action']:'add';


$quantity=isset($_GET['quantity'])?$_GET['quantity']:1;

$queryCart=mysqli_query($conn,"SELECT * FROM product WHERE ID=$ID");

$result=mysqli_fetch_assoc($queryCart);
$itemCart=[
    'ID'=>$result['ID'],
    'name'=>$result['name'],
    'image'=>$result['image'],
    'price'=>($result['discount']>0)?$result['priceSale']:$result['price'],
    'quantity'=>$quantity
];

//tăng quantity
if($action=='add'){
    if(isset($_SESSION['cart'][$ID])){
        echo "
            <script type=\"text/javascript\">
                alert('Đã có sản phẩm này rồi');
                location.href = './cart.php';
            </script>
            "
            ;
    }
    else{
        $_SESSION['cart'][$ID]=$itemCart;
    }
}
if($action=='update'){
    $_SESSION['cart'][$ID]['quantity']=$quantity;
    if($quantity==0){
        unset($_SESSION['cart'][$_GET['ID']]);
    }
    echo "
    <script type=\"text/javascript\">
        alert('Cập nhật số lượng thành công');
        location.href = './cart.php';
    </script>
    "
    ;
}
echo "
    <script type=\"text/javascript\">
        location.href = './cart.php';
    </script>
    "
    ;
?>