<?php
session_start();
require('headers.php');
require('functions.php');

if(isset($_SESSION["user"])){

    $db = createDbConnection();

    $json = json_decode(file_get_contents('php://input'));
    $infotext = filter_var($json->infotext, FILTER_SANITIZE_STRING);
    $user = $_SESSION["user"];

    $sql = "INSERT INTO info (firstname, lastname) VALUES(?, ?)";
    $prepared = $db->prepare($sql);
    $prepared->execute(array($user, $infotext));

    echo "onnistui!";

    exit;
}

header('HTTP/1.0 401 Unauthorized');

echo "Kirjaudu ensin sisään";

exit;

