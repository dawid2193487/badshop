<?php 
include_once 'utils/user.php'; 
$user_pk = get_user_pk();
?>

<div class="navbar">
    <a class="logo" href="/">Alledrogo</a>
    <form action="/search.php" method="get">
        <input class="searchbox" type="text" id="q" name="q" placeholder="Szukaj">
    </form>
    <div class="fill"></div>
    <?php  if (is_null($user_pk)) { ?>
        <a href="/signin.php">Zaloguj się</a>
        <a href="/register.php">Zarejestruj się</a>
    <?php } else { ?>
        <span><?php echo(get_balance($user_pk))?>zł</span>
        <a href="/profile.php?pk=<?php echo $user_pk?>"><?php echo(get_user_name($user_pk))?></a>
        <a href="/top_up.php">Doładuj</a>
        <a href="/create_product.php">Sprzedaj</a>
        <a href="/logout.php">Wyloguj się</a>
    <?php } ?>
</div>