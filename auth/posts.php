<?php
session_start();
$login = $_SESSION['login'];
if (isset($login)){
    echo 'Добро пожаловать, '.$login.'!';
}
else{
    header('Location: https://chirrup.ru/test1(form)/index.php?warn=2');
}
?>