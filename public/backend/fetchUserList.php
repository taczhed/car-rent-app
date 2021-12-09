<?php
    require_once 'db.php';

    $sql = "SELECT user_id AS userId, email, account_type AS accountType FROM users;";

    $result = mysqli_query($conn, $sql);
    $arr = array();

    while($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row;
    };

    echo json_encode($arr);
?>