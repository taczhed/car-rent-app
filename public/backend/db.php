<?php
    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'car_rent_app_db';

    $conn = mysqli_connect($server, $user, $pass, $db) or die('db connection filed!');
?>