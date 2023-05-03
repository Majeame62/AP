<?php
session_start();
require_once 'config.php';

// Vérifie si l'utilisateur est connecté
if(!isset($_SESSION['user'])){
    header('Location: conn.php');
    die();
}

// Récupère les informations de l'utilisateur connecté
$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
$req->execute(array($_SESSION['user']));
$data = $req->fetch();
$id_utilisateur = $data['id'];

// Traitement du formulaire
if(isset($_POST['submit'])){
    // Vérifie si le champ tâche est renseigné
    if(empty($_POST['task'])){
        $error = "Le champ tâche est obligatoire.";
    }
    else {
        // Nettoie et valide les données du formulaire
        $task = htmlspecialchars(trim($_POST['task']));
        $status = htmlspecialchars(trim($_POST['status']));
        $demande = htmlspecialchars(trim($_POST['demande']));
        $prio = htmlspecialchars(trim($_POST['priorité']));

        // Ajoute la tâche à la base de données
        $req2 = $bdd->prepare('INSERT INTO task (task, status, id_utilisateurs, demande,priorité) VALUES (?, ?, ?, ?,?)');
        if ($req2->execute(array($task, $status, $id_utilisateur, $demande,$prio))) {
            echo "La tâche a été créée avec succès.";
        } else {
            echo "Erreur: " . $sql . "<br>" . $stmt->errorInfo()[2];
        }
        header('Location: tache.php');
        die(); 
    }
} 

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Créer une tâche</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
<div class="container">
	
<h2>Créer une tâche</h2>
<?php if(isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>
<form method="post" action="">
    <div class="form-group">
        <label for="task">Tâche:</label>
        <input type="text" class="form-control" id="task" name="task" required>
    </div>
    <div class="form-group">
        <label for="status">Statut:</label>
        <select class="form-control" id="status" name="status">
            <option value="non assignée">Non assignée</option>
            <option value="en cours">En cours</option>
            <option value="en attente">En attente</option>
            <option value="terminée">Terminée</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="demande">Demande:</label>
        <textarea class="form-control" id="demande" name="demande" ></textarea>
    </div>
    <div class="form-group">
        <label for="priorité">Statut:</label>
        <select class="form-control" id="priorité" name="priorité">
            <option value="Basique">Basique</option>
            <option value="Normal">Normal</option>
            <option value="Important">Important</option>
            <option value="Urgent">Urgent</option>
        </select>
    </div>
    <br>
    <button type="submit" name="submit" class="btn btn-primary">Créer</button>
</form>
