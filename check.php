<?php
session_start();
require('headers.php');
require('functions.php');

if(isset($_SESSION["user"])){

    $db = createDbConnection();
    $user = $_SESSION["user"];

    $sql = "SELECT firstname,lastname FROM info WHERE uname = '$user'";
    $query = $db->query($sql);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $row){
            echo $row["infotext"]."\n";
        }
    
    echo "\nInfotekstit JSON muodossa \n"."\n";
    echo json_encode($results);

    exit;
}

header('HTTP/1.0 401 Unauthorized');

echo "Kirjaudu ensin sisään!";

exit;