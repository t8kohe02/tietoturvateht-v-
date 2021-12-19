<?php
require('headers.php');
require('functions.php');

$json = json_decode(file_get_contents('php://input'));

$fname = filter_var($json->fname, FILTER_SANITIZE_STRING);
$lname = filter_var($json->lname, FILTER_SANITIZE_STRING);
$uname = filter_var($json->uname, FILTER_SANITIZE_STRING);
$passwd = filter_var($json->passwd, FILTER_SANITIZE_STRING);

$db = createDbConnection();

createUser($db, $fname, $lname, $uname, $passwd);
