<?php 

include_once 'get_mysqli.php';

const SIGN_IN_PATH = "/signin.php";

function create_user($username, $password) {
    $mysqli = get_mysqli();
    $password = md5($password);

    $existing_user = $mysqli->query("SELECT * FROM Users WHERE username='".$username."';");
    if ($existing_user->num_rows > 0 ) {
        return "Użytkownik o takiej nazwie już istnieje.";
    }

    $user_created = $mysqli->query("
        INSERT INTO Users (username, password_hash) 
        VALUES ('".$username."', '".$password."');"
    );
    $user_pk = $mysqli->insert_id;

    $mysqli->query("
        INSERT INTO Profiles (user_pk, description) 
        VALUES ('".$user_pk."', '');"
    );

    if (!$user_created) {
        return "Nie udało się stworzyć użytkownika.";
    }

    return "Użytkownik utworzony!";
}

function generate_token() {
    return md5(rand());
}

function sign_in($username, $password) {
    $mysqli = get_mysqli();
    $password = md5($password);

    $existing_user = $mysqli->query("SELECT pk FROM Users WHERE username='".$username."' AND password_hash='".$password."';");
    if ($existing_user->num_rows == 0 ) {
        return false;
    }

    $pk = $existing_user->fetch_object()->pk;

    // assign token to user
    $token = generate_token();
    $user_created = $mysqli->query("
        INSERT INTO Tokens (user_pk, token) 
        VALUES ('".$pk."', '".$token."');"
    );

    return $token;
}

function get_user_pk() {
    if (!isset($_COOKIE["TOKEN"])) {
        return null;
    }

    $mysqli = get_mysqli();
    $query = "SELECT user_pk, token FROM Tokens WHERE token='".$_COOKIE["TOKEN"]."';";
    $user_pk = $mysqli->query($query);

    // $tokens_query = "SELECT user_pk, token FROM Tokens;";
    // $tokens = $mysqli->query($tokens_query);
    // foreach ($tokens->fetch_all() as $row) {
    //     print_r($row);
    // }
    
    // echo($user_pk->num_rows);
    // echo($query);
    if ($user_pk->num_rows == 0) {
        return null;
    }

    return $user_pk->fetch_object()->user_pk;
}

function get_user_name($pk) {
    $mysqli = get_mysqli();
    $query = "SELECT username FROM Users WHERE pk='".$pk."';";
    $user_pk = $mysqli->query($query);


    if ($user_pk->num_rows == 0) {
        return null;
    }

    return $user_pk->fetch_object()->username;
}

function get_profile($pk) {
    $mysqli = get_mysqli();
    $query = "SELECT * FROM Profiles WHERE user_pk='".$pk."';";
    $profile = $mysqli->query($query);

    if ($profile->num_rows == 0) {
        return null;
    }

    return $profile->fetch_object();
}

function logout() {
    if (!isset($_COOKIE["TOKEN"])) {
        return;
    }

    $mysqli = get_mysqli();
    $mysqli->query("DELETE FROM Tokens WHERE token='".$_COOKIE["TOKEN"]."';");
}


function force_authenticated() {
    if (!isset($_COOKIE["TOKEN"])) {
        header("Location: ".SIGN_IN_PATH);
        exit();
    }

    $current_user = get_user_pk();

    if ($current_user == null) {
        header("Location: ".SIGN_IN_PATH);
        exit();
    }

    return $current_user;
}

?>