<?php
$host = 'localhost';
$dbname = 'm2l2';
$username = 'root';
$password = 'root';

$bdd = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// vérification de la connexion
if (!$bdd) {
    die("Connection failed: " . mysqli_connect_error());
}
?>