<?php
    require_once 'db.php';

    $sql = "UPDATE reservations SET status='$_POST[new_status]' WHERE id='$_POST[reservation_id]';";

    if (mysqli_query($conn, $sql)) {
        $arr = array('result' => 'success',);
        echo json_encode($arr);
    } else {
        $arr = array('result' => 'fail',);
        echo json_encode($arr);
    }

    mysqli_close($conn);

?>