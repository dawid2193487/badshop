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
    price INT UNSIGNED NOT NULL
)");
?>