<?php 
include_once 'layout/header.php'; 
?>

<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once 'utils/user.php';
    $response = create_user($_POST["username"], $_POST["password"]);
    echo($response);
} else {
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
        <button type="submit">Zarejestruj się</button>
    </form><?php 
} 

include_once 'layout/footer.php'; ?>
