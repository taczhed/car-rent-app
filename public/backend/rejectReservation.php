<?php
    require_once 'db.php';

    $sql = "DELETE FROM reservations WHERE id='$_POST[reservation_id]';";

    if (mysqli_query($conn, $sql)) {
        $arr = array('result' => 'success',);
        echo json_encode($arr);
    } else {
        $arr = array('result' => 'fail',);
        echo json_encode($arr);
    }

    mysqli_close($conn);

?>