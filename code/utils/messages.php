<?php 

include_once 'get_mysqli.php';
include_once 'user.php';

define(SIGN_IN_PATH, "/signin.php");

function send_message($to, $content) {
    force_authenticated();
    
    $mysqli = get_mysqli();
    $user_pk = get_user_pk();

    $message_created = $mysqli->query("
        INSERT INTO Messages (from_user, to_user, message) 
        VALUES (".$user_pk.", '".$to."', '".$content."');"
    );

    if (!$message_created) {
        return "Nie udało się wysłać wiadomości.";
    }

    return "Wiadomość wysłana";
}

function get_messages($with) {    
    force_authenticated();
    
    $mysqli = get_mysqli();
    $user_pk = get_user_pk();

    $query = "SELECT * FROM Messages WHERE (from_user=".$user_pk." AND to_user=".$with.") OR (to_user=".$user_pk." AND from_user=".$with.");";
    $result = $mysqli->query($query);

    while ($message = $result->fetch_object()) {
        yield $message;
    }
}
?>