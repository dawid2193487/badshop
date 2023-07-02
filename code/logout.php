<?php
    include_once 'utils/user.php';
    logout();
    setcookie("TOKEN", "", time()-3600*24);
    header('Location: /');
    exit();
?>