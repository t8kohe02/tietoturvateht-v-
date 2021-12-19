<?php
//hakee host,database,user ja password config inistä
function openDB(): object {
    $ini=parse_ini_file("../config.ini", true);

    $host = $ini['host'];
    $database = $ini['database'];
    $user = $ini['user'];
    $password = $ini['password'];
    $db = new PDO("mysql:host=$host;dbname=$database;charset=utf8",$user,$password);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $db;
}

// tarkistaa käyttäjän ja salasanan tietokannasta 

function checkUser(PDO $dbcon, $username, $passwd){

    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $passwd = filter_var($passwd, FILTER_SANITIZE_STRING);

    try{
        $sql = "SELECT password FROM user WHERE username=?";  
        $prepare = $dbcon->prepare($sql);   
        $prepare->execute(array($username)); 

        $rows = $prepare->fetchAll(); 

        foreach($rows as $row){
            $pw = $row["password"];  
            if( password_verify($passwd, $pw) ){  
                return true;
            }
        }

       
        return false;

    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();

    }

}
//luo uuden käyttäjän

function createUser(PDO $dbcon, $username, $passwd){

    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $passwd = filter_var($passwd, FILTER_SANITIZE_STRING);

    try{
        $hash_pw = password_hash($passwd, PASSWORD_DEFAULT); 
        $sql = "INSERT IGNORE INTO user VALUES (?,?)"; 
        $prepare = $dbcon->prepare($sql); 
        $prepare->execute(array($username, $hash_pw));  
    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }
}
//luo tietokantayhteyden

function createDbConnection(){

    try{
        $dbcon = new PDO('mysql:host=localhost:3307;dbname=t8kohe02', 'root', '');
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }

    return $dbcon;
}