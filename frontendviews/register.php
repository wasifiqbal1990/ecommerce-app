<?php

# File created using Visual Studio Code: https://code.visualstudio.com/
# Created by Naisend. Telegram contact: https://t.me/elipheleh




if (!defined("DOCUMENT_ROOT")) {
    define("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']);
}
require_once DOCUMENT_ROOT.'/configs.php';
require_once DOCUMENT_ROOT.'/session/session.class.php';
require_once DOCUMENT_ROOT.'/libs/captcha/SimpleCaptcha.php';

$captcha = (new SimpleCaptcha())
    ->option('secret_key', CONFIGS::CAPTCHA_SALT_)
    ->option('secret_salt', CONFIGS::CAPTCHA_SECRET_)
    ->option('difficulty', 1) // 0 (easy) to 3 (difficult)
    ->option('distortion_type', 1) // 1: position distortion, 2: scale distortion
    ->option('num_terms', 2)
    ->option('max_num_terms', 4) // -1 means constant num_terms
    ->option('min_term', 1)
    ->option('max_term', 21)
    ->option('has_multiplication', true)
    ->option('has_division', true)
    ->option('has_equal_sign', true)
    ->option('color', 0x121212)
    ->option('background', 0xffffff);

    // $captcha->reset();


$session = new Session();


$captchaImage = $captcha->getCaptcha();
$_SESSION['captchaHash'] = $captcha->getHash();



if (!isset($_SESSION['HTTP_REFERER']) || $_SESSION['HTTP_REFERER'] !== 'ecommerceloginpage') {
    unset($_SESSION['registrationerrors']);
    unset($_SESSION['registrationsuccess']);
}
if (isset($_SESSION['HTTP_REFERER'])) {
    unset($_SESSION['HTTP_REFERER']);
}





?>
<!DOCTYPE html>
<html lang="en">
    <head>
 
        <title>ecommerce site</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="/assets/css/main.css?version=<?php echo filemtime('/assets/css/main.css'); ?>">
    
    </head>
    <body>
    <?php require_once DOCUMENT_ROOT.'/templates_include/header.php'; ?>
                
    <section id="page_container" class="w-100 px-4 py-5 bg-white border rounded-5">
        <style>
            .divider:after,
            .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
            }
        </style>

        <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-lg-7 col-xl-6">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg" class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <form action="register/c" method="post">
                    <div class="container">
                        <h1>Register</h1>

                        <p>Please fill in this form to create an account.</p>
                        <hr>

                        <?php
                        if (isset($_SESSION['registrationerrors']) && count($_SESSION['registrationerrors']) > 0) {
                            echo '<div id="error_explanation" class="text-danger">';
                                echo '<div class="error_message alert alert-danger d-none"><strong>Some Errors occurred!</strong></div>';
                                    echo '<ul>';
                                    foreach ($_SESSION['registrationerrors'] as $error) {
                                        echo '<li>'.$error.'</li>';
                                    }
                                    echo '</ul>';
                            echo '</div>';
                        }
                        if (isset($_SESSION['registrationsuccess']) && strlen($_SESSION['registrationsuccess']) > 0) {
                            echo '<div class="error_message alert alert-success"><strong>'.$_SESSION['registrationsuccess'].'</strong></div>';
                        }

                        ?>

                        <label for="email"><b>User</b></label>
                        <input type="text" placeholder="Enter Username" name="username" id="username" required="" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" />

                        <label for="pwd"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="pwd" id="pwd" required="" />

                        <label for="pwd-repeat"><b>Repeat Password</b></label>
                        <input type="password" placeholder="Repeat Password" name="pwd-repeat" id="pwd-repeat" required="" />
                        
                        <a href="/register" class="btn captchabtn"><img src="<?php echo $captchaImage; ?>" /> <span class="glyphicon glyphicon-refresh"></span> Refresh</a>
                        <input type="text" name="answer" placeholder="Answer" value="" />
                        <hr>

                        <p>By creating an account you agree to our <a href="/tos">Terms &amp; Privacy</a>.</p>
                        <!-- <button type="submit" class="registerbtn">Register</button> -->
                        <input type="submit" class="registerbtn" value="Register">
                    </div>

                    <div class="container signin">
                        <p>Already have an account? <a href="/login">Sign in</a>.</p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php require_once DOCUMENT_ROOT.'/templates_include/footer.php'; ?>

    </body>
    
</html>