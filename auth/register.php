<?php
function generatePassword($length = 20) {
    // Символы, которые будут использоваться в пароле
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+';

    // Получаем количество символов в $chars
    $charsLength = strlen($chars);

    // Инициализируем переменную для хранения пароля
    $password = '';

    // Генерируем пароль
    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[rand(0, $charsLength - 1)];
    }

    // Возвращаем сгенерированный пароль
    return $password;
}

// Пример использования функции

$pass = generatePassword();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chirrup</title>

    <link rel="stylesheet" href="style_reg.css">
</head>
<body>
    <img class="form_image" src="Chirrup.png">

    <form class="form" action="https://chirrup.ru/auth/register.php" method="post">

        <h1 class="form_title">Регистрация</h1>

        <div class="form_group">
            <input class="form_input" type="text" name="input_text_username" id="input_text_username" placeholder=" " autocomplete="off" value="<?php echo 'user'.rand(99999999,9999999999);?>">
            <label class="form_label" for="input_text_username">Никнейм</label>
        </div>

        <div class="form_group">
            <input class="form_input" type="text" name="input_text_email" id="input_text_email" placeholder=" " autocomplete="off">
            <label class="form_label" for="input_text_email">Email</label>
        </div>

        <div class="form_group">
            <input class="form_input" type="text" name="input_text_password" id="input_text_password" placeholder=" " autocomplete="off" value="<?php echo $pass; ?>">
            <label class="form_label" for="input_text_password">Пароль</label>
        </div>

        <div class="form_group">
            <input class="form_input" type="password" name="input_text_password_confirm" id="input_text_password_confirm" placeholder=" " autocomplete="off" value="<?php echo $pass; ?>">
            <label class="form_label" for="input_text_password_confirm">Подтверждение пароля</label>
        </div>

        <div class="buttonContainer">
            <input class="form_button" type="submit" value="Зарегистрироваться">
            <br>
            <input class="form_button_return" type="button" onclick="document.location='https://chirrup.ru/auth/auth.php'" value="Вернуться ко входу">
        </div>
    
    </form>
</body>
</html>


<?php
    $_mail = $_POST['input_text_email'];

    if ($_POST['input_text_email'] != "") {
        echo "GGGGGGGG";

        $db_server = "1116079-cj39076.tmweb.ru";
        $db_user = "chirrup_ru";
        $db_pass = "v3ws3GnRCzveynbE";
        $db_name = "chirrup_ru";
        $conn = "";

        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

        $sql = "INSERT INTO users (token, username, email, 
                                    st_email, pass, avatar, status_or_user,
                                    last_seen)
                VALUES ('55555', 'Bill Cipher', '$_mail', 5, 'parolb', 
                        'sadad', 'dead inside', 'tomorrow')";
        
        try {
            mysqli_query($conn, $sql);
            echo "))";
        } catch (mysqli_sql_exception) {
            echo "Error";
        }

        mysqli_close($conn);

        header("Location: https://chirrup.ru/auth/auth.php");
    }
?>