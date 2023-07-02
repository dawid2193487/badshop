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
    password_hash VARCHAR(64) NOT NULL
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
 * Create Products
 */
$mysqli->query("
CREATE TABLE Products (
    pk INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_pk INT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL
)");
?>