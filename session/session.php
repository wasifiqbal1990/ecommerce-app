<?php

# File created using Visual Studio Code: https://code.visualstudio.com/
# Created by Naisend. Telegram contact: https://t.me/elipheleh



if (!defined('DOCUMENT_ROOT')) {
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
}




/**
 * 1. Check zlib extension is installed or not. ob_gzhandler needs the zlib extension to work. Without which it just silently falls back to default settings.
 * 2. Verify that you don't have zlib.output_compression enabled in your php.ini.
 */
if (extension_loaded('zlib') && !ini_get('zlib.output_compression')) {
    ob_start('ob_gzhandler');
} else {
    ob_start();
}

require_once DOCUMENT_ROOT.'/db/dbconnection.php';
$conn = new mysqli(CONFIGS::DB_SERVER, CONFIGS::DB_USERNAME, CONFIGS::DB_PASSWORD, CONFIGS::DB_NAME);

/**
 * Set Character set for DB results
 * Charset `utf8mb4` is preferreable because it covers all ranges of utf characters while `utf8` covers only about 5.58%
 */
// $conn->set_charset('utf8');
$conn->set_charset('utf8mb4');

if (!$conn->query('select 1 from `sessions` LIMIT 1')) {
    header('Location: /index');
}

require_once DOCUMENT_ROOT.'/session/session.class.php';
require_once DOCUMENT_ROOT.'/configs.php';


$session = new Session();

//after x minutes the user gets logged out.  SEE: configs.php
$idletimeout = !isset($_SESSION['idletimeout']) ? CONFIGS::DEFAULT_LOGIN_TIMEOUT : (int) $_SESSION['idletimeout'] ;



/**
 * Function that check if a user has been expired for staying idle for too long
 *
 * @return [type]
 *
 */
function expireActiveUserByTime() : bool
{
    global $idletimeout;
    if ($idletimeout < time() - (isset($_SESSION['timestamp']) ? $_SESSION['timestamp'] : 0)) {
        return true;
    }
    return false;
}


/**
 * Function that check if a user has been expired for by a form request
 *
 * @return bool
 *
 */
function expireActiveUserByPost() : bool
{
    if (isset($_POST['expireActiveUser']) && $_POST['expireActiveUser'] === true) {
        return true;
    }
    return false;
}
