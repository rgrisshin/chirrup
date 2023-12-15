
<head>

<meta name="viewport" content="width=device-width, initial-scale=1" />

<style>
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
-webkit-text-stroke-width: 0.5px;
-webkit-text-stroke-color: black;
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
background-color: #8A2BE2;
height:60px;
width:100%;
}

textarea{
   
}
</style>
</head>
<div class="header">
    <button class="chirrup_logo" onclick="document.location='https://chirrup.ru/index.php'">Chirrup</button>
    <button class="out_button" onclick="document.location='https://chirrup.ru/auth/out.php'">Выйти</button>
</div>
<br><br><br>
<?
session_start(); 

var_dump($_COOKIE); 

if (isset($_SESSION['login'])){
    }
//if ($_COOKIE['token'] == 'c6d73ec37c081fafa129ffdbf7364a3a36a9ba90f15e9612bf59d6edced4386d1a230c315025d6bf86bbc27168ee214d'){
//        $_SESSION['login'] = 'loh';
//    }
else{
        header('Location: https://chirrup.ru/auth/auth.php?warn=2');
    }

$upload_post = $_POST['comment'];

if ($upload_post != null){
    echo '<script>alert("Ваш пост успешно опубликован! (был бы, если бы мы успели доделать проект)");</script>';
}

$_SESSION['user'] = 'user1';

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

    echo '<center><div class="post_form_adder"><form name="upload_post" method="post" action="">
  <p>Добавить пост:<Br>
   <textarea name="comment" cols="40" rows="3"></textarea></p>
   
   <p>Аудио: <br><input name="browser" type="text" size="40"></p>
   <p>Видео с YouTube: <br><input name="browser" type="text" size="40"></p>

   <p><input type="submit" value="Отправить">
   <input type="reset" value="Очистить"></p>
 </form></div></center>';
    
    for ($post_id = 1; $post_id <= 10; $post_id++) {

    // Подготовленное выражение для получения user_id
    $stmt = $pdo->prepare("SELECT text FROM posts WHERE id = :post_id");
    $stmt->execute(['post_id' => $post_id]);
    $post_text = $stmt->fetch(PDO::FETCH_ASSOC)['text'];

    $stmt = $pdo->prepare("SELECT user_id FROM posts WHERE id = :post_id");
    $stmt->execute(['post_id' => $post_id]);
    $post_user_id = $stmt->fetch(PDO::FETCH_ASSOC)['user_id'];

    $stmt = $pdo->prepare("SELECT username FROM users WHERE id = :post_user_id");
    $stmt->execute(['post_user_id' => $post_user_id]);
    $post_username = $stmt->fetch(PDO::FETCH_ASSOC)['username'];

    $stmt = $pdo->prepare("SELECT time FROM posts WHERE id = :post_id");
    $stmt->execute(['post_id' => $post_id]);
    $post_time = $stmt->fetch(PDO::FETCH_ASSOC)['time'];

    $stmt = $pdo->prepare("SELECT audio FROM posts WHERE id = :post_id");
    $stmt->execute(['post_id' => $post_id]);
    $post_audio = $stmt->fetch(PDO::FETCH_ASSOC)['audio'];

    $stmt = $pdo->prepare("SELECT video_yt FROM posts WHERE id = :post_id");
    $stmt->execute(['post_id' => $post_id]);
    $post_video_yt = $stmt->fetch(PDO::FETCH_ASSOC)['video_yt'];

    $stmt = $pdo->prepare("SELECT video_ib FROM posts WHERE id = :post_id");
    $stmt->execute(['post_id' => $post_id]);
    $post_video_ib = $stmt->fetch(PDO::FETCH_ASSOC)['video_ib'];


    if ($post_text != null){
    echo '<center><div class="post"><p>ID пользователя: '.$post_user_id.'</p>';
    echo '<b>'.$post_text.'</b><br><br>';
        if ($post_audio != null){
            echo '<audio style="width:100%" src="'.$post_audio.'" controls></audio><br><br>';
        }
        if ($post_video_yt != null){
            echo $post_video_yt.'<br><br>';
        }
        if ($post_video_ib != null){
            echo $post_video_ib.'<br><br>';
        }
    echo 'Дата публикации: '.$post_time.'<br><br></div></center><br>';
    }
    }

} catch (PDOException $e) {
    echo "Ошибка выполнения запроса: " . $e->getMessage();
}

?>