<?php

require_once DOCUMENT_ROOT.'/session/session.class.php';

$session = new Session();
var_dump($session);

if(isset($_SESSION['logged_in'])  && $_SESSION['logged_in'] == 1)
{
    echo 'You are logged in';exit;
}
else
{
    header("Location: /login");exit;
}

