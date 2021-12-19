<?php
session_start();
require('headers.php');
require('functions.php');

if(isset($_SERVER['PHP_AUTH_USER'])){
    if(checkUser(createDbConnection(), $_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
        $_SESSION["user"] = $_SERVER['PHP_AUTH_USER'];
        echo "Olet kirjautunut sisään" .' ' .$_SESSION["user"]. '!';
        header('Content-Type: application/json');
        exit;
    }
}

header('WWW-Authenticate: Basic');

echo "Virhe kirjautumisessa";
header('Content-Type: application/json');
header('HTTP/1.1 401');

exit;