<?php
if (isset($_POST['userType'])) {
    include('../../db/db_class.php');
    $db = new global_class();

    $userType = $_POST['userType'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result =  $db->login($username, $password, $userType);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        session_start();
        $_SESSION['user_id'] = $user['ID'];
        echo $userType;
    } else {
        echo 'Login Failed';
    }
}
