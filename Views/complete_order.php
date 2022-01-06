<?php
include '../conn.php';
if (isset($_GET['orderId'])) {
    $query = "UPDATE oder SET status = 'Complete', receivedDate = '" . date('y/m/d') . "' WHERE ID = '".$_GET['orderId']."'";
    $mysqli_result = mysqli_query($conn, $query);
    if ($mysqli_result) {
        echo '<script type="text/javascript">alert("Thành công!"); history.back();</script>';
    } else {
        echo '<script type="text/javascript">alert("Thất bại!"); history.back();</script>';
    }
}
