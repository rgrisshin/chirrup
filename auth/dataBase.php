<!--Этот файл уже не используется, но удалять пока не стоит.-->

<?php
    $db_server = "1116079-cj39076.tmweb.ru";
    $db_user = "chirrup_ru";
    $db_pass = "v3ws3GnRCzveynbE";
    $db_name = "chirrup_ru";
    $conn = "";

    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
/*
    try {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    } catch (mysqli_sql_exception) {
        echo "No connection";
    }

    if ($conn) {
        echo "Connected". "<br>"."<br>";
    }

    echo $_POST['input_text_email'];
*/
?>