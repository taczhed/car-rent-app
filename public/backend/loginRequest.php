<?php
    require_once 'db.php';

    $sql = "SELECT user_id, password, account_type FROM users WHERE email='$_POST[email]' ";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();

    if (mysqli_num_rows($result) > 0) {

       if (password_verify($_POST['password'], $row[1])) {
          session_start();

          $_SESSION['user'] = $_POST['email'];
          $_SESSION['id'] = $row[0];
          $_SESSION['account_type'] = $row[2];

          $arr = array('result' => 'success',);
          echo json_encode($arr);


       } else {
          $arr = array('result' => 'error');
          echo json_encode($arr);
       }
    } else {
        $arr = array('result' => 'error');
        echo json_encode($arr);
    }

    mysqli_close($conn);

?>