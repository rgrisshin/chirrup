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

    <form class="form" action="https://chirrup.ru" method="post">

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
            <input class="form_button_return" type="submit" value="Вернуться ко входу">
        </div>
    
    </form>
</body>
</html>