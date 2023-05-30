<?php
$HOST = "localhost";
$DBNAME = "projet 2 laetitia";
$DBUSER = "root";
$PASSWORD = "";

try {
    $bdd = new PDO("mysql:host=$HOST;dbname=$DBNAME;charset=utf8", $DBUSER, $PASSWORD);
} catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}
?>
