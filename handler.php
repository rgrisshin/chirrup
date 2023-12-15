<?php
session_start();
$user = $_SESSION['user'];

if (($user) == ('user1')){
    echo 'Вход выполнен';
}

?>
<script>
alert('<?php echo ($user); ?>');
</script>