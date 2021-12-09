<?php
    require_once 'db.php';

    $sql = "SELECT * FROM users WHERE email='$_POST[email]' ";
    $matching_rows = mysqli_query($conn, $sql);

    if (mysqli_num_rows($matching_rows) > 0) {
        $arr = array('result' => 'Błąd! Istnieje osoba o podanym adresie e-mail!');
        echo json_encode($arr);
    } else {
        $encrypted_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (user_id, email, password, account_type) VALUES (NULL, '$_POST[email]', '$encrypted_password', 'default')";
        $result = mysqli_query($conn, $sql);
        $arr = array('result' => 'Rejestracja przebiegła pomyślnie!');
        echo json_encode($arr);
    }
    mysqli_close($conn);
?>