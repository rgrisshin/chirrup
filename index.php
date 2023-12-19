<head>

<meta name="viewport" content="width=device-width, initial-scale=1" />

<style>
@font-face {
    font-family: 'Boomboom';
    src: local('Boomboom'), url('fonts/boomboom.woff2') format('woff2'), url('fonts/boomboom.woff') format('woff'), url('fonts/boomboom.ttf') format('truetype');
    font-weight: 400;
    font-style: normal;
}

a{
color:black;
}

.post{
    display: block;
    border: 1px solid black;
    max-width: 700px;
    border-radius: 10px;
}

.chirrup_logo{
font-family: "Arial";
position:fixed;
height: 50px;
font-size: 40px;
letter-spacing: 1px;
color: #EE82EE;
left: 0px;
padding-left: 10px;
background: none;
border: none;
outline: none;
cursor: pointer;
transition: 0.3s;
}

.chirrup_logo:hover {
    color: #E6E6FA;
}

.out_button{
font-size: 19px;
background: none;
border: none;
position:fixed;
right: 10px;
cursor: pointer;
outline: none;
transition: 0.3s;
}

.out_button:hover{
    color: white;
    border-bottom: 1px solid white;
}

.header{
display: flex;
align-items: center;
position:fixed;
top:0px;
left:0px;
background-color: #5e31ff;
height:60px;
width:100%;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding-top: 60px; /* Учитывая фиксированный header */
}

a {
    color: black;
    text-decoration: none; /* Убрать подчёркивание */
}

.post {
    display: block;
    border: 1px solid #ddd;
    max-width: 700px;
    margin: auto; /* Центрирование */
    border-radius: 10px;
    padding: 15px;
    background-color: white;
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    overflow-x: auto;
}

.chirrup_logo {
    font-family: 'BoomBoom', sans-serif; 
    height: 50px;
    font-size: 40px;
    letter-spacing: 1px;
    color: white;
    background: none;
    border: none;
    outline: none;
    cursor: pointer;
    transition: 0.3s;
}

.chirrup_logo:hover {
    color: #e6e6fa;
}

.out_button {
    font-family: 'BoomBoom', sans-serif;
    font-size: 19px;
    color: white; /* Для лучшей видимости на фоне */
    background: none;
    border: none;
    cursor: pointer;
    outline: none;
    transition: 0.3s;
}

.out_button:hover {
    color: white;
    border-bottom: 1px solid white;
}

.header {
    display: flex;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #5e31ff;
    height: 60px;
    width: 100%;
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
}

textarea, input[type="text"], input[type="submit"], input[type="reset"] {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
}

input[type="submit"], input[type="reset"] {
    background-color: #5e31ff;
    color: white;
    border: none;
    cursor: pointer;
    transition: 0.2s;
}

input[type="submit"]:hover, input[type="reset"]:hover {
    background-color: #3d7df7;
}
</style>
</head>
<div class="header">
    <button class="chirrup_logo" onclick="document.location='https://chirrup.ru/index.php'">Chirrup</button>
    <button class="out_button" onclick="document.location='https://chirrup.ru/auth/out.php'">Выйти</button>
</div>
<br><br><br>
<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('Location: https://chirrup.ru/auth/auth.php?warn=2');
    exit;
}

$upload_post = $_POST['comment'];

$dbHost = 'localhost';
$dbName = 'chirrup_ru';
$dbUser = 'chirrup_ru';
$dbPass = 'v3ws3GnRCzveynbE';

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Установка символьной кодировки
    $pdo->exec("SET character_set_results = 'utf8',
                character_set_client = 'utf8',
                character_set_connection = 'utf8',
                character_set_database = 'utf8',
                character_set_server = 'utf8'");

    echo '<center><div class="post_form_adder"><form name="upload_post" method="post" action="modules/add_post.php">
  <p>Добавить пост:<Br>
   <textarea name="comment" cols="40" rows="3"></textarea></p>
   
   <p>Аудио: <br><input name="browser" type="text" size="40"></p>
   <p>Видео с YouTube: <br><input name="youtube_video" type="text" size="40"></p>

   <p><input type="submit" value="Отправить">
   <input type="reset" value="Очистить"></p>
 </form></div></center>';

    $stmt = $pdo->prepare("SELECT posts.*, users.username 
                            FROM posts 
                            JOIN users ON posts.user_id = users.id 
                            ORDER BY posts.time DESC");
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($posts as $post) {
        $post_text = $post['text'];
        $post_username = $post['username'];
        $post_time = $post['time'];
        $post_audio = $post['audio'];
        $post_video_yt = $post['video_yt'];
        
        // Преобразование даты публикации
        $post_time = strtotime($post_time);
        $current_time = time();
        $time_diff = $current_time - $post_time;
        $time_string = '';

        if ($time_diff < 60) {
            $time_string = 'только что';
        } elseif ($time_diff < 3600) {
            $time_minutes = floor($time_diff / 60);
            $time_string = $time_minutes . ' мин. назад';
        } elseif ($time_diff < 86400) {
            $time_hours = floor($time_diff / 3600);
            $time_string = $time_hours . ' ч. назад';
        } elseif ($time_diff < 2592000) {
            $time_days = floor($time_diff / 86400);
            $time_string = $time_days . ' д. назад';
        } elseif ($time_diff < 31536000) {
            $time_months = floor($time_diff / 2592000);
            $time_string = $time_months . ' мес. назад';
        } else {
            $time_years = floor($time_diff / 31536000);
            $time_string = $time_years . ' л. назад';
        }

        echo '<center><div class="post"><p>'.$post_username.'</p>';
        echo '<b>'.$post_text.'</b><br><br>';
        if ($post_audio != null) {
            echo '<audio style="width:100%" src="'.$post_audio.'" controls></audio><br><br>';
        }
        if ($post_video_yt != null) {
            echo $post_video_yt.'<br><br>';
        }
        // echo 'Дата публикации: '.$post_time.'<br><br>';
        echo $time_string.'<br><br></div></center><br>';
    }

} catch (PDOException $e) {
    echo "Ошибка выполнения запроса: " . $e->getMessage();
}
?>
