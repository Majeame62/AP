<?php
$host = 'localhost';
$dbname = 'm2l';
$username = 'root';
$password = 'root';
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
); 
$bdd = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,$options);

// vérification de la connexion
if (!$bdd) {
    die("Connection failed: " . mysqli_connect_error());
}
?>