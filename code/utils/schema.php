<?php

mysqli_report(MYSQLI_REPORT_ERROR);
$mysqli = new mysqli("db", "root", "root", "store");


/**
 * Create Users
 */
$mysqli->query("
CREATE TABLE Users (
    pk INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password_hash VARCHAR(64) NOT NULL,
    balance INT UNSIGNED DEFAULT 500
)");

/**
 * Create Profile
 */
$mysqli->query("
CREATE TABLE Profiles (
    user_pk INT UNSIGNED NOT NULL,
    description TEXT NOT NULL
)");

/**
 * Create Tokens
 */
$mysqli->query("
CREATE TABLE Tokens (
    user_pk INT UNSIGNED NOT NULL,
    token VARCHAR(64) NOT NULL
)");

/**
 * Create Messages
 */
$mysqli->query("
CREATE TABLE Messages (
    pk INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    from_user INT UNSIGNED NOT NULL,
    to_user INT UNSIGNED NOT NULL,
    message TEXT NOT NULL,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

/**
 * Create Notifications
 */
$mysqli->query("
CREATE TABLE Notifications (
    pk INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_pk INT UNSIGNED NOT NULL,
    message VARCHAR(1024) NOT NULL,
    is_toast BOOL NOT NULL,
    timestamp BIGINT UNSIGNED NOT NULL
)");

/**
 * Create Media
 */
$mysqli->query("
CREATE TABLE Media (
    pk INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_pk VARCHAR(1024) NOT NULL,
    file_ext VARCHAR(8) NOT NULL
)");

/**
 * Create Products
 */
$mysqli->query("
CREATE TABLE Products (
    pk INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_pk INT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price INT UNSIGNED NOT NULL,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

/**
 * Set up index
 */
$mysqli->query("
ALTER TABLE Products ADD FULLTEXT(title, description);
");

include "user.php";
create_user("admin", "aezakmi");
create_user("sklepikarz", "warez");
create_user("haxxor", "123456");

include "product.php";
$_COOKIE["TOKEN"] = sign_in("sklepikarz", "warez");
echo(create_product("Pizza Donatello", "Najlepsza pizza", 12));
echo(create_product("Pizza Guseppe", "mid tier imo", 12));
echo(create_product("Pizza Feliciana", "też dobra jest", 12));

echo("gotowe");

?>