<?php
include '../conn.php';
if (isset($_GET['ID'])) {
    $query = "UPDATE oder SET status = 'Cancel' WHERE ID = '".$_GET['ID']."'";
    $mysqli_result = mysqli_query($conn, $query);
    if ($mysqli_result) {
        echo '<script type="text/javascript">alert("Thành công!"); history.back();</script>';
    } else {
        echo '<script type="text/javascript">alert("Thất bại!"); history.back();</script>';
    }
}