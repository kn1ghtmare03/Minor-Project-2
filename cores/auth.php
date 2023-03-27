<?php

    ini_set('session.gc_maxlifetime',86400);
    ini_set('session.gc_probability',0);
    ini_set('session.gc_divisor',100);
    session_set_cookie_params(86400);
    session_start();

    if (!isset($_SESSION["$sys_session"]) || $_SESSION["$sys_session"] !== true) {
        header("Location: $sys_link/index.php");
        exit;
    }

    $userId = $_SESSION['userId'];
    $userFirstname = $_SESSION['f_name'];
    $userLastName = $_SESSION['l_name'];
    $userEmail = $_SESSION['email'];
    $userMobile = $_SESSION['mobile'];
    $userImage = $_SESSION['image'];
    $userRole = $_SESSION['role'];
    $userTeam = $_SESSION['team'];

?>