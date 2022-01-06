<?php
include '../conn.php';
if (isset($_GET['orderId'])) {
    $query = "UPDATE oder SET status = 'Processed' WHERE ID = '" . $_GET['orderId'] . "'";
    $mysqli_result = mysqli_query($conn, $query);
    if ($mysqli_result) {

        $sql = "UPDATE oder SET receivedDate = '" . Date('y/m/d', strtotime('+3 days')) . "' WHERE ID = '" . $_GET['orderId'] . "'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo '<script type="text/javascript">alert("Thành công!"); history.back();</script>';
        }
    } else {
        echo '<script type="text/javascript">alert("Thất bại!"); history.back();</script>';
    }
}
?>
