<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once 'utils/user.php';
    $token = sign_in($_POST["username"], $_POST["password"]);
    if ($token == false) {
        header('Location: /');
        exit();
    }
    setcookie("TOKEN", $token);
    header('Location: /');
    exit();
} else {
    include_once 'layout/header.php';
    ?><form method="post">
        <label for="">
            <span>Nazwa użytkownika:</span>
            <input type="text" name="username" id="username">
        </label>
        <br>
        <label for="">
            <span>Hasło:</span>
            <input type="password" name="password" id="password">
        </label>
        <br>
        <button type="submit">Zaloguj się</button>
    </form><?php 
    include_once 'layout/footer.php';
} 
?>