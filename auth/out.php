<?php
session_start();
session_unset();
session_destroy();
unset($_COOKIE['token']);
$cookieParams = session_get_cookie_params();
//    foreach ($_COOKIE as $key => $value) {
//        setcookie($key, $value, time() - 86400, $cookieParams['path'], $cookieParams['domain']);
//    }
header('Location: https://chirrup.ru');
?>