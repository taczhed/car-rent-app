<?php
    session_start();
    if(isset($_SESSION['user'])){
        $arr = array(
            'status' => 'loggedIn',
            'user' => $_SESSION['user'],
            'id' => $_SESSION['id'],
            'account_type' => $_SESSION['account_type']
        );
        echo json_encode($arr);
    } else {
        $arr = array(
            'status' => 'loggedOut',
        );
        echo json_encode($arr);
    }
?>