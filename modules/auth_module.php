<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["input_text_email"];
    $password = $_POST["input_text_password"];

    $dsn = "mysql:host=localhost;dbname=chirrup_ru";
    $username = "chirrup_ru";
    $password_db = "v3ws3GnRCzveynbE";

    try {
        $pdo = new PDO($dsn, $username, $password_db);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);

        if (empty($email) || empty($password)) {
            header("Location: ../auth/auth.php?warn=0");
            exit();
        }
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $storedPassword = $row['pass'];

            if ($password == $storedPassword) {
                $_SESSION['login'] = $row['username'];
                $token_l = $row['token']; 
                header("Location: https://chirrup.ru");
                setcookie("token", $token_l, time() + 99999, '/');
            } else {
                // Неправильный логин и/или пароль
                header("Location: ../auth/auth.php?warn=3");
                exit();
            }
        } else {
            // Пользователь не найден
            header("Location: ../auth/auth.php?warn=4");
            exit();
        }
    } catch (PDOException $e) {
        echo "Ошибка подключения к базе данных: " . $e->getMessage();
    }
}
?>
