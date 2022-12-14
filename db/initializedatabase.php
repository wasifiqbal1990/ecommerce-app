<?php

# File created using Visual Studio Code: https://code.visualstudio.com/



if (!defined("DOCUMENT_ROOT")) {
    define("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']);
}
/** Include the config files, Remember our database creditials are defined here */
require_once DOCUMENT_ROOT . "/configs.php";


/** Create DB connection without selecting any database */
$conn = new mysqli(CONFIGS::DB_SERVER, CONFIGS::DB_USERNAME, CONFIGS::DB_PASSWORD);
/** Check the connection for errors */
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



/**
 * Creating The ecommerce database
 */
$create_ecommerce_db = "CREATE DATABASE IF NOT EXISTS `ecommerce` CHARACTER SET utf8 COLLATE utf8_unicode_ci";
if ($conn->query($create_ecommerce_db) !== true) {
    echo "<br>Error creating Database-(ecommerce): " . $conn->error . "<br>";
} else {
    echo "New Database-(ecommerce) created<br>";
}



/**
 * Select the ecommerce database
 */
if ($conn->query("USE " . CONFIGS::DB_NAME) !== true) {
    echo "<br>Error: " . $conn->error . "<br>";
    exit;
} else {
    echo "Selected the ".CONFIGS::DB_NAME." database<br>";
}



/**
 * Add users table
 */
$create_users_table = "CREATE TABLE IF NOT EXISTS users (
    `userid` BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) not null,
    `password` VARCHAR(100) not null, 
    `registration_date` datetime not null DEFAULT CURRENT_TIMESTAMP,
    `account_level` INT(2) not null DEFAULT 0,
    `pagination` INT(2) not null DEFAULT 30,
    UNIQUE KEY `username` (`username`),
    KEY `password` (`password`),
    KEY `account_level` (`account_level`)
) CHARACTER SET utf8 ENGINE=InnoDB";

if ($conn->query($create_users_table) !== true) {
    if ($conn->error === "Table 'users' already exists") {
        echo "Table 'users' already exists<br>";
    } else {
        echo "<br>Error creating Table-(users)): " . $conn->error . "<br>";
        exit;
    }
} else {
    echo "New Table (users) created<br>";
}




/**
 * Add sessions table
 * This session table has been designed to work with the session_class we will use.
 * We did not want to use any filesystem session
 */
$create_sessions_table = "CREATE TABLE IF NOT EXISTS `sessions`(
    `id` varchar(32) not null,
    `ownerid` BIGINT(20) UNSIGNED,
    `access` int(10) unsigned,
    `accesstime` datetime not null DEFAULT CURRENT_TIMESTAMP,
    `Session_Data` MEDIUMBLOB,
    PRIMARY KEY (id),
    KEY `ownerid` (`ownerid`),
    CONSTRAINT
        FOREIGN KEY (`ownerid`)
        REFERENCES `users`(`userid`)
            ON UPDATE CASCADE
            ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

if ($conn->query($create_sessions_table) !== true) {
    if ($conn->error === "Table 'sessions' already exists") {
        echo "Table 'sessions' already exists<br>";
    } else {
        echo "<br>Error creating Table-(sessions)): " . $conn->error;
        exit();
    }
} else {
    echo "New Table-(sessions) created<br>";
}
