<?php

# File created using Visual Studio Code: https://code.visualstudio.com/




if (!defined('DOCUMENT_ROOT')) {
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
}

require_once DOCUMENT_ROOT . '/session/session.class.php';
require_once DOCUMENT_ROOT . '/db/dbconnection.php';
require_once DOCUMENT_ROOT.'/libs/trim.functions.php';




if (!isset($_SESSION['userid'])) {
    $session = new Session();
} else {
    $validationerrors[] = 'Log out the already logged in User first';
}
if (isset($_SESSION['loginsuccess'])) {
    unset($_SESSION['loginsuccess']);
}
if (isset($_SESSION['loginerrors'])) {
    unset($_SESSION['loginerrors']);
}
$_SESSION['HTTP_REFERER'] = 'ecommerceloginpage';


/* -------------------------------------------------------------------------- */
/*       Validations, Selecting From Database, and Credentials Matching       */
/* -------------------------------------------------------------------------- */


if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') {
    header('location: /login');
    exit;
}


$validationerrors = [];

/* --------------------------- Validating Username -------------------------- */
$username = $_POST['username'];
$username_trimmed = lrtrim($username);

if (!isset($username)) {
    $validationerrors[] = 'Username is a Required field';
} elseif (strlen($username_trimmed) < 2) {
    // $validationerrors[] = 'Username must be greater than 2 characters long';
    // Do not tell user the real reason. Might be a bruteforcer
    $validationerrors[] = 'Username does not exist';
} elseif (!preg_match('/[A-Za-z0-9]{6,}/', $username)) {
    // $validationerrors[] = 'Username valid chars only: a-z A-Z 0-9; and above six(6) characters';
    // Do not tell user the real reason. Might be a bruteforcer
    $validationerrors[] = 'Username does not exist';
} else {
    $query_select_from_users_by_username = $conn->prepare(DBQUERY::SELECT_FROM_USERS_BY_USERNAME);
    $query_select_from_users_by_username->bind_param('s', $username_trimmed);
    $query_select_from_users_by_username->execute();
    $query_select_from_users_by_username->store_result();
    if ($query_select_from_users_by_username->num_rows === 0) {
        // $validationerrors[] = "User with that username doesn't exist!<br>Please register to continue...";
        // Do not tell user the real reason. Might be a bruteforcer
        $validationerrors[] = 'Username does not exist';
    } else {
        // User exists. Get userid from here
        $results = fetch_assoc_stmt($query_select_from_users_by_username);
        $user_id = (int) $results[0]['userid'];
        $query_select_from_users_by_username->free_result();
    }
}
if (count($validationerrors) > 0) {
    $_SESSION['loginerrors'] = $validationerrors;
    header('location: /login');
    exit;
}


/* --------------------------- Validating Password -------------------------- */
$password = $_POST['pwd'];
$password_trimmed = lrtrim($password);
if (!isset($password)) {
    $validationerrors[] = 'Password is a Required field';
} elseif (strlen($password_trimmed) < 8) {
    // $validationerrors[] = 'Password must be greater than 8 characters long';
    // Do not tell user the real reason. Might be a bruteforcer
    $validationerrors[] = 'Username or password is incorrect';
} elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,20}$/', $password)) {
    // $validationerrors[] = "Weak password! Password must contain at least one uppercase, one lowercase, one special character (#$@!%&*?), one digit; And totally a minimum of eight characters long";
    // Do not tell user the real reason. Might be a bruteforcer
    $validationerrors[] = 'Username or password is incorrect';
}
if (count($validationerrors) > 0) {
    $_SESSION['loginerrors'] = $validationerrors;
    header('location: /login');
    exit;
}


/* ----------------------------- CSRF Protection ---------------------------- */
if (!isset($_POST[$_SESSION['tokenName']]) || $_POST[$_SESSION['tokenName']] !== $_SESSION['tokenValue']) {
    // Disallow the CSRF attacker. Don't even give this attacker a 200 response
    header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
    exit;
}




/* ------------ Update Session table logged_in status and ownerid ----------- */
$_SESSION['timestamp'] = time();
$_SESSION['session_id'] = session_id();
$_SESSION['userid'] = $user_id;
$_SESSION['logged_in'] = true; //we now say user is logged in finally
$_SESSION['loginsuccess'] = 'Already logged in.'; // Incase user navigates back to the login page

header('location: /dashboard');
