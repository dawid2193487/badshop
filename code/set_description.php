<?php 
include_once 'utils/user.php';
force_authenticated();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = set_description(get_user_pk(), $_POST["description"]);
    header("Location: /profile.php?pk=".get_user_pk());
} else {
    include_once 'layout/header.php'; ?>
    <form method="post">
        <label for="">
            <span>Opis:</span>
            <textarea name="description" id="description"></textarea>
        </label>
        <br>
        <button type="submit">Ustaw opis</button>
    </form><?php 
} 

include_once 'layout/footer.php'; ?>
