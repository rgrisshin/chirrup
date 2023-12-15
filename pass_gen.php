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
echo generatePassword();
?>