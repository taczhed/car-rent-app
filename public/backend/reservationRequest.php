<?php
    require_once 'db.php';

    $sql = "INSERT INTO reservations (id, car_id, user_id, status, date_from, date_to) VALUES (null, '$_POST[car_id]', '$_POST[user_id]', 'requested', '$_POST[date_from]', '$_POST[date_to]');";

    if (mysqli_query($conn, $sql)) {
        $arr = array('result' => 'success',);
        echo json_encode($arr);
    } else {
        $arr = array('result' => 'fail',);
        echo json_encode($arr);
    }

    mysqli_close($conn);

?>