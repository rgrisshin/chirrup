<?php
    session_start();
    $login = $_POST["input_text_email"];
    $password = $_POST["input_text_password"];

    if (empty($login) || empty($password)) {
        header('Location: https://chirrup.ru/auth/auth.php?warn=1');
    }

    $db_server = "1116079-cj39076.tmweb.ru";
    $db_user = "chirrup_ru";
    $db_pass = "v3ws3GnRCzveynbE";
    $db_name = "chirrup_ru";
    $conn = "";

    if (!empty($login) && !empty($password)) {
        $sql = "Select pass FROM users WHERE email = '$login'";
    } else {
        header('Location: https://chirrup.ru/auth/auth.php?warn=1');
    }

    try {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
        $result = mysqli_query($conn, $sql);
    } catch (mysqli_sql_exception) {
        header('Location: https://chirrup.ru/auth/auth.php?warn=1');
    }

    $row = mysqli_fetch_assoc($result);

    if ($password == $row['pass']) {
        $_SESSION['login'] = $login;
        header('Location: https://chirrup.ru/index.php');
        $tokenValue = "c6d73ec37c081fafa129ffdbf7364a3a36a9ba90f15e9612bf59d6edced4386d1a230c315025d6bf86bbc27168ee214d";
        setcookie("token", $tokenValue, time() + 86400, "/");
    } else {
        header('Location: https://chirrup.ru/auth/auth.php?warn=1');
    }

/*
    if (($login == 'loh') AND ($password == 'loh')){
        $_SESSION['login'] = 'loh';
        header('Location: https://chirrup.ru/index.php');
        $tokenValue = "c6d73ec37c081fafa129ffdbf7364a3a36a9ba90f15e9612bf59d6edced4386d1a230c315025d6bf86bbc27168ee214d";
        setcookie("token", $tokenValue, time() + 86400, "/");
    }
    else{
        header('Location: https://chirrup.ru/auth/auth.php?warn=1');
    } */
    
?>