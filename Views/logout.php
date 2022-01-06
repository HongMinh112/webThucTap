<?php
session_start();
session_unset();
session_destroy();
$_SESSION['username']=null;
header("location:index.php");
?>