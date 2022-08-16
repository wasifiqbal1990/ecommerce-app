<?php

# File created using Visual Studio Code: https://code.visualstudio.com/
# Created by Naisend. Telegram contact: https://t.me/elipheleh





if (!defined('DOCUMENT_ROOT')) {
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
}

require_once DOCUMENT_ROOT.'/configs.php';
require_once DOCUMENT_ROOT.'/db/db_helper.functions.php';
require_once DOCUMENT_ROOT.'/db/db_queries.php';

// DATABASE CONNECT
$conn = new mysqli(CONFIGS::DB_SERVER, CONFIGS::DB_USERNAME, CONFIGS::DB_PASSWORD, CONFIGS::DB_NAME);
/**
 * Charset `utf8mb4` is preferreable because it covers all ranges of utf characters while `utf8` covers only about 5.58% */
$conn->set_charset('utf8mb4'); // $conn->set_charset('utf8');
// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
