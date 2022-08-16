<?php

# File created using Visual Studio Code: https://code.visualstudio.com/
# Created by Naisend. Telegram contact: https://t.me/elipheleh




if (!defined('DOCUMENT_ROOT')) {
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
}

require_once DOCUMENT_ROOT . '/session/session.class.php';
require_once DOCUMENT_ROOT . '/db/dbconnection.php';
require_once DOCUMENT_ROOT.'/libs/locations.functions.php';
require_once DOCUMENT_ROOT.'/libs/captcha/SimpleCaptcha.php';
require_once DOCUMENT_ROOT.'/libs/trim.functions.php';




if (!isset($_SESSION['userid'])) {
    $session = new Session();
} else {
    $validationerrors[] = 'Log out the already logged in User first';
}
if (isset($_SESSION['registrationsuccess'])) {
    unset($_SESSION['registrationsuccess']);
}
if (isset($_SESSION['registrationerrors'])) {
    unset($_SESSION['registrationerrors']);
}
$_SESSION['HTTP_REFERER'] = 'ecommerceloginpage';


/* -------------------------------------------------------------------------- */
/*               Validations and Inserting of Data into Database              */
/* -------------------------------------------------------------------------- */


if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') {
    header('location: /register');
    exit;
}


$validationerrors = [];

$username = $_POST['username'];
$username_trimmed = lrtrim($username);

if (!isset($username)) {
    $validationerrors[] = 'Username is a Required field';
} elseif (strlen($username_trimmed) < 2) {
    $validationerrors[] = 'Username must be greater than 2 characters long';
} elseif (!preg_match('/[A-Za-z0-9]{6,}/', $username)) {
    $validationerrors[] = 'Username valid chars only: a-z A-Z 0-9; and above six(6) characters';
} else {
    $query_select_from_users_by_username = $conn->prepare(DBQUERY::SELECT_FROM_USERS_BY_USERNAME);
    $query_select_from_users_by_username->bind_param('s', $username_trimmed);
    $query_select_from_users_by_username->execute();
    $query_select_from_users_by_username->store_result();
    if ($query_select_from_users_by_username->num_rows > 0) {
        $validationerrors[] = "Username has already been taken.";
    }
}


$password = $_POST['pwd'];
$password_trimmed = lrtrim($password);
if (!isset($password)) {
    $validationerrors[] = 'Password is a Required field';
} elseif (strlen($password_trimmed) < 8) {
    $validationerrors[] = 'Password must be greater than 8 characters long';
} elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,20}$/', $password)) {
    $validationerrors[] = "Weak password! Password must contain at least one uppercase, one lowercase, one special character (#$@!%&*?), one digit; And totally a minimum of eight characters long";
}


$passwordrepeat = $_POST['pwd-repeat'];
if (!isset($passwordrepeat)) {
    $validationerrors[] = 'Password Repeat is a Required field';
} elseif ($passwordrepeat !== $password_trimmed) {
    $validationerrors[] = 'Password and Password Repeat does not match';
}


$answer = $_POST['answer'];
$captcha = (new SimpleCaptcha())
    ->option('secret_key', CONFIGS::CAPTCHA_SALT_)
    ->option('secret_salt', CONFIGS::CAPTCHA_SECRET_);
if (!isset($answer)) {
    $validationerrors[] = 'Captcha is Required';
} elseif (!$captcha->validate($_POST['answer'], $_SESSION['captchaHash'])) {
    $validationerrors[] = 'Captcha does not match. Verify you are not a robot.';
    // $validationerrors[] = 'Captcha does not match. Verify you are not a robot.'. '<pre> CAPTCAH: '.print_r($captcha, true).'</pre>'. '<pre> SESSION'.print_r($_SESSION, true).'</pre>';
}


if (count($validationerrors) > 0) {
    $_SESSION['registrationerrors'] = $validationerrors;
    header('location: /register');
    exit;
}


/* -------------------------- Insert Into Database -------------------------- */

try {
    $query_insert_new_user = $conn->prepare(DBQUERY::INSERT_NEW_USER);
    $country = getVisitorCountry();
    /**
     * Hash the password for security reason
     */
    $passwordHashed = password_hash($registerpassword, PASSWORD_BCRYPT);
    $query_insert_new_user->bind_param('sss', $username_trimmed, $passwordHashed, $country);
    $query_insert_new_user->execute();
    $_SESSION['logged_in'] = false; // So we know the user has not logged in OR afresh sign up
    $_SESSION['username'] = $username_trimmed;
    $_SESSION['registrationsuccess'] = 'Registration is successful. Now you may <a href="/login" class="btn p-1 d-inline font-weight-bold align-baseline">Login</a>';
    header('location: /register');
    exit;
} catch (Exception $e) {
    $_SESSION['registrationerrors'] = array('Registration failed!. Please contact the site admin.') . $query_insert_new_user->error;
    header('location: /register');
    exit;
}
