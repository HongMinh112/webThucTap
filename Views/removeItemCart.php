<?php 
session_start();
include '../conn.php';
if(isset($_GET['ID'])){
    $ID=$_GET['ID'];
}
unset($_SESSION['cart'][$_GET['ID']]);
header("location: cart.php");
?>