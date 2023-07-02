<?php 
include_once 'utils/user.php'; 
$user_pk = get_user_pk();
?>

<div class="navbar">
    <a class="logo" href="/">Alledrogo</a>
    <div class="fill"></div>
    <?php  if (is_null($user_pk)) { ?>
        <a href="/signin.php">Zaloguj się</a>
        <a href="/register.php">Zarejestruj się</a>
    <?php } else { ?>
        <span><?php echo(get_user_name($user_pk))?></span>
        <a href="/logout.php">Wyloguj się</a>
    <?php } ?>
</div>