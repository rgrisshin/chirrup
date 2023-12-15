<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chirrup</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img class="form_image" src="Chirrup.png">

    <form class="form" action="handler.php" method="post">

        <h1 class="form_title">Вход</h1>
        <?php
        if (($_GET['warn']) == ('1')){
            echo '<p style="color:red;">Неправильный логин и/или пароль</p><br>';
        }
        if (($_GET['warn']) == ('2')){
            echo '<p style="color:red;">Авторизуйтесь, чтобы просматривать этот контент</p><br>';
        }
        ?>
        <div class="form_group">
            <input class="form_input" type="text" name="input_text_email" id="input_text_email" placeholder=" " autocomplete="off">
            <label class="form_label" for="input_text_email">Email</label>
        </div>

        <div class="form_group">
            <input class="form_input" type="password" name="input_text_password" id="input_text_password" placeholder=" " autocomplete="off">
            <label class="form_label" for="input_text_password">Пароль</label>
        </div>

        <input class="form_button" type="submit" value="Войти">

        <form action="register.php">
            <button class="reg_button" type="button" onclick="document.location='https://chirrup.ru/auth/register.php'"">Не зарегистрированы?</button>
        </form>    
    
    </form>
</body>
</html>