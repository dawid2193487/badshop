<?php 

include_once 'get_mysqli.php';
include_once 'user.php';

define(SIGN_IN_PATH, "/sign_in.php");

function create_product($title, $description, $price) {
    force_authenticated();
    
    $mysqli = get_mysqli();
    $user_pk = get_user_pk();

    $product_created = $mysqli->query("
        INSERT INTO Products (user_pk, title, description, price) 
        VALUES (".$user_pk.", '".$title."', '".$description."', ".$price.");"
    );

    if (!$product_created) {
        return "Nie udało się stworzyć oferty.";
    }

    return "Oferta utworzona!";
}

function get_products_of_user($user_pk) {
    $mysqli = get_mysqli();
    $query = "SELECT * FROM Products WHERE user_pk=".$user_pk.";";
    $result = $mysqli->query($query);

    while ($product = $result->fetch_object()) {
        yield $product;
    }
}

function get_product($pk) {
    $mysqli = get_mysqli();
    $query = "SELECT * FROM Products WHERE pk=".$pk.";";
    $result = $mysqli->query($query);

    $product = $result->fetch_object();
    return $product;
}

function get_products() {
    $mysqli = get_mysqli();
    $query = "SELECT * FROM Products;";
    $result = $mysqli->query($query);

    while ($product = $result->fetch_object()) {
        yield $product;
    }
}
?>