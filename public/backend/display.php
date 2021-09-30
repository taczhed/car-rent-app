<?php
    require_once 'db.php';

    $sql = "SELECT * FROM samochody";
    $result = mysqli_query($conn, $sql);

    $arr = array();

    while($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row;
    };

    echo json_encode($arr);
?>