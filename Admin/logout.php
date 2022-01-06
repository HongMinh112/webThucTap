<?php
session_start();
session_unset();
session_destroy();
$_SESSION['user']=null;
header("location:index.php");
?>