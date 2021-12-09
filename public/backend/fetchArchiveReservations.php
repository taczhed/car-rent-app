<?php
    require_once 'db.php';

    $sql = "
    SELECT reservations_archive.id AS reservationId, reservations_archive.car_id AS carId, email AS user, brand, model, reservations_archive.date_from AS dateFrom, reservations_archive.date_to AS dateTo, reservations_archive.archive_time AS time, cars.price AS price
    FROM reservations_archive
    INNER JOIN users ON reservations_archive.user_id=users.user_id
    INNER JOIN cars ON reservations_archive.car_id=cars.car_id
    ";
    $result = mysqli_query($conn, $sql);

    $arr = array();

    while($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row;
    };

    echo json_encode($arr);
?>