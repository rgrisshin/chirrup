<?php
session_start();
$user_token = 'c6d73ec37c081fafa129ffdbf7364a3a36a9ba90f15e9612bf59d6edced4386d1a230c315025d6bf86bbc27168ee214d';
if (isset($_SESSION['PHPSESSID']) && isset($_COOKIE['token'])) {
    //ничего не делать
} elseif (isset($_COOKIE['token'])) {
    header('Location: https://chirrup.ru');
} else {
    setcookie("token", $user_token, time() + 99999, '/');
}
?>