<?php
try {
    session_start();
    $bdd = new PDO('mysql:host=localhost;dbname=forum;charset=utf8;', 'root', 'mysql');
}catch(Exception $e){
    die("Une erreur a été trouvée: " . $e->getMessage());
}