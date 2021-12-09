<?php
    require_once 'db.php';

    $sql = "
    SELECT reservations.id AS reservationId, reservations.car_id AS carId, brand, model, date_from AS dateFrom, date_to AS dateTo, cars.price AS price
    FROM reservations
    INNER JOIN users ON reservations.user_id=users.user_id
    INNER JOIN cars ON reservations.car_id=cars.car_id
    WHERE reservations.user_id='$_POST[user_id]'
    ";
    $result = mysqli_query($conn, $sql);

    $arr = array();

    while($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row;
    };

    echo json_encode($arr);
?>