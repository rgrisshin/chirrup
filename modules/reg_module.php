<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["input_text_username"];
    $email = $_POST["input_text_email"];
    $password = $_POST["input_text_password"];
    $passwordConfirm = $_POST["input_text_password_confirm"];

    $token = hash('sha256', $username);
    $st_email = 0;
    $avatar = 'images/standart_profile_image.jpg';
    $status_or_user = 'Hi!';
    $last_seen = date("Y-m-d H:i:s");

    $dsn = "mysql:host=localhost;dbname=chirrup_ru";
    $username = "chirrup_ru";
    $password_db = "v3ws3GnRCzveynbE";

    try {
        $pdo = new PDO($dsn, $username, $password_db);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $username = htmlspecialchars($username);
        $email = htmlspecialchars($email);

        // Проверяем, существует ли пользователь с таким email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Пользователь с таким email уже существует
            header("Location: ../auth/auth.php?warn=5");
            exit();
        } else {
            // Проверяем, совпадают ли пароли
            if ($password !== $passwordConfirm) {
                // Пароли не совпадают
                header("Location: ../auth/register.php?warn=1");
                exit();
            }
            
            if (!empty($user)) {
                // Проверка на корректность имейла (корректировка!)
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    header("Location: ../auth/register.php?warn=2");
                    exit();
                } 
                //else {
                //    header("Location: ../auth/register.php?warn=2");
                //    exit();
                //}

                // Регистрируем нового пользователя
                $stmt = $pdo->prepare("INSERT INTO users (username, email, pass, token, st_email, avatar, status_or_user, last_seen) VALUES (:username, :email, :password, :token, :st_email, :avatar, :status_or_user, :last_seen)");
                $stmt->bindParam(':username', $user);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':token', $token);
                $stmt->bindParam(':st_email', $st_email);
                $stmt->bindParam(':avatar', $avatar);
                $stmt->bindParam(':status_or_user', $status_or_user);
                $stmt->bindParam(':last_seen', $last_seen);
                
                $stmt->execute();
                
                setcookie("token", $token, time() + 99999, '/');

                $_SESSION['login'] = $username;
                header("Location: https://chirrup.ru");
            } else {
                header("Location: ../auth/register.php?warn=3");
                exit();
            }
        }
    } catch (PDOException $e) {
        echo "Ошибка подключения к базе данных: " . $e->getMessage();
    }
}

?>

