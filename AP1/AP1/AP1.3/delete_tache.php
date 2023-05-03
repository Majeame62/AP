<?php
session_start();
require_once 'config.php';
if(!isset($_SESSION['user'])){
    header('Location:conn.php');
    die();
}

if(isset($_POST['task_id'])){
    $tache_id = $_POST['task_id'];
    $req = $bdd->prepare('DELETE FROM task WHERE task_id = ?');
    $req->execute(array($tache_id));
}

header('Location: tache.php');
?>