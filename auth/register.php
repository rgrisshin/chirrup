<?php
function generatePassword($length = 20) {
    // Символы, которые будут использоваться в пароле
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

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

    <form class="form" action="../modules/reg_module.php" method="post">

        <h1 class="form_title">Регистрация</h1>
        <?php
        if (($_GET['warn']) == ('1')){
            echo '<p style="color:red; text-align: center;">Пароли не совпадают!</p><br>';
        }

        if (($_GET['warn']) == ('2')){
            echo '<p style="color:red; text-align: center;">Email не соответствует требованиям!</p><br>';
        }

        if (($_GET['warn']) == ('3')){
            echo '<p style="color:red; text-align: center;">Придумайте Ваш Ник-Нейм!</p><br>';
        }
        ?>

        <div class="form_group">
            <input class="form_input" type="text" name="input_text_username" id="input_text_username" placeholder=" " autocomplete="off" value="">
            <label class="form_label" for="input_text_username">Никнейм</label>
        </div>

        <div class="form_group">
            <input class="form_input" type="text" name="input_text_email" id="input_text_email" placeholder=" " autocomplete="off">
            <label class="form_label" for="input_text_email">Email</label>
        </div>

        <div class="form_group">
            <input class="form_input" type="text" name="input_text_password" id="input_text_password" placeholder=" " autocomplete="off" value="">
            <label class="form_label" for="input_text_password">Пароль</label>
        </div>

        <div class="form_group">
            <input class="form_input" type="password" name="input_text_password_confirm" id="input_text_password_confirm" placeholder=" " autocomplete="off" value="">
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