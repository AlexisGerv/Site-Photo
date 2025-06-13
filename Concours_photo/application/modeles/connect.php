<?php
function connect()
{
    $userName = 'root';
    $pw = '';
    $dbName = 'sae203';
    try {
        $db = new PDO("mysql:host=localhost;dbname=$dbName", $userName, $pw);
        return $db;
    } catch (PDOException $e) {
        echo "erreur " . $e->getMessage();
        die();
    }
}
