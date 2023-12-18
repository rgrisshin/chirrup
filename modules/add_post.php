<?php
// Подключение к базе данных
$db_host = "localhost"; // Адрес сервера базы данных
$db_name = "chirrup_ru"; // Имя базы данных
$db_user = "chirrup_ru"; // Имя пользователя базы данных
$db_password = "v3ws3GnRCzveynbE"; // Пароль базы данных

// Установка соединения с базой данных
try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Ошибка соединения с базой данных: " . $e->getMessage();
    exit;
}

// Проверка, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение введенных данных из формы
    $comment = $_POST["comment"];
    $audio = $_POST["audio"];
    $video_youtube = $_POST["youtube_video"];

    // Получение user_id из таблицы "users" по токену из COOKIE
    $token = $_COOKIE["token"];

    if (!empty($token)) {
        $query = "SELECT id FROM users WHERE token = :token";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":token", $token);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $user_id = $user["id"];
        }
    }

    // Вставка нового поста в таблицу "posts"
    $query = "INSERT INTO posts (user_id, text, audio, video_yt) VALUES (:user_id, :text, :audio, :video_yt)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":text", $comment);
    $stmt->bindParam(":audio", $audio);
    $stmt->bindParam(":video_yt", $video_youtube);

    try {
        $stmt->execute();
        echo "Пост успешно добавлен!";
        header('Location: https://chirrup.ru');
    } catch (PDOException $e) {
        echo "Ошибка при добавлении поста: " . $e->getMessage();
    }
}
?>