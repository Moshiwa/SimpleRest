<?php

echo "
<script src='webroot/js/jquery.js'></script>
<script src='webroot/js/login.js'></script>
<link rel='stylesheet' href='webroot/css/main.css'>
";

include_once 'api/config/session.php';
include_once 'api/config/database.php';

$Session = new Session();
$userId = $Session->getSession('user_id');

$registerFormElement = "
        <div class='form-register hidden'>
            <form name='' method='post' action='api/objects/user/create.php'>
                <p>
                    <label>Username</label>
                    <input type='text' name='username'>
                </p>
                <p>
                    <label>Password</label>
                    <input type='password' name='password'>
                </p>
                <p>
                    <label>Are yr author?</label>
                    <input type='checkbox' name='role'>
                </p>
                <button type='submit'>Register</button>
            </form>
        </div>";

$buttonToggleRegisterForm = "<button class='js-toggle-register-form'>Show/Hide register form</button>";

$loginFormElement = " 
        <div class='login-form-js'>
            <input type='text' name='username' class='js-username'>
            <input type='password' name='password' class='js-password'>
            <button class='js-btn-login'>Log In</button>
        </div>";

if (empty($userId)) {
    echo "<div class='auth-container'>";
    echo $registerFormElement;
    echo $loginFormElement;
    echo $buttonToggleRegisterForm;
    echo "</div>";
} else {
    echo 'Hello';
}
