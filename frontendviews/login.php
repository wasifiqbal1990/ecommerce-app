<?php

# File created using Visual Studio Code: https://code.visualstudio.com/




if (!defined("DOCUMENT_ROOT")) {
    define("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']);
}
require_once DOCUMENT_ROOT.'/configs.php';
require_once DOCUMENT_ROOT.'/session/session.class.php';
require_once DOCUMENT_ROOT.'/libs/captcha/SimpleCaptcha.php';

$db = new Database();
$errors = [];
if(isset($_POST['login']))
{
    if(!isset($_POST['username']) && empty($_POST['username']))
    {
        $errors[] = "Username is required";
    }

    if(!isset($_POST['pwd']) && empty($_POST['pwd']))
    {
        $errors[] = "Password is required";
    }

    if(empty($errors))
    {
        $username = $_POST['username'];
        $password = $_POST['pwd'];

        $db->query("Select * from users where username=:username and password=:password");
        $db->bind("username",$username);
        $db->bind("password",$password);
        $result = $db->execute();
        if($result)
        {
            $user = $db->single();
            $success = 'Logged in successfully';
            session_start();
            $_SESSION['logged_in'] = 1;
            header("Location: /portal");exit;
            // Set the session and redirec the user to portal
//            $session = new Session();
//            $session->write($user['userid'], $user);
//            echo 'done';exit;
        }

        $errors[] = "Username or password is incorrect";
    }


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
            <img src="/assets/site/images/register_image01.svg" class="img-fluid" alt="Phone image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
            <form action="" method="post">
                <div class="container">
                    <h1>Login</h1>

                    <hr>

                    <?php
                    if (!empty($errors)) {
                        echo '<div id="error_explanation" class="text-danger">';
                        echo '<div class="error_message alert alert-danger d-none"><strong>Some Errors occurred!</strong></div>';
                        echo '<ul>';
                        foreach ($errors as $error) {
                            echo '<li>'.$error.'</li>';
                        }
                        echo '</ul>';
                        echo '</div>';
                    }
                    if (isset($success)) {
                        echo '<div class="error_message alert alert-success"><strong>'.$success.'</strong></div>';
                    }

                    ?>

                    <label for="email"><b>User</b></label>
                    <input type="text" placeholder="Enter Username" name="username" id="username"  value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" />

                    <label for="pwd"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="pwd" id="pwd"  />


                    <input type="submit" name="login" class="registerbtn" value="Login">
                </div>

                <div class="container signin">
                    <p>Don't have an account? <a href="/register">Register here</a>.</p>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once DOCUMENT_ROOT.'/templates_include/footer.php'; ?>

</body>

</html>
