<?php
include_once 'utils/user.php';
force_authenticated();
charge_user(get_user_pk(), -100);
header('Location: /');
?>
