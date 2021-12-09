<?php
    require_once 'db.php';

    $sql = "UPDATE users SET account_type='admin' WHERE user_id='$_POST[user_id]';";

    if (mysqli_query($conn, $sql)) {
        $arr = array('result' => 'success',);
        echo json_encode($arr);
    } else {
        $arr = array('result' => 'fail',);
        echo json_encode($arr);
    }

    mysqli_close($conn);

?>