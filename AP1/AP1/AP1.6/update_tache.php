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

// Vérifie si l'ID de la tâche est présent dans l'URL
if(!isset($_GET['task_id'])) {
    header('Location: tache.php');
    die();
}

$id_task = $_GET['task_id'];

// Récupère les informations de la tâche correspondant à l'ID
$req2 = $bdd->prepare('SELECT * FROM task WHERE task_id = ?');
$req2->execute(array($id_task));
$fetch = $req2->fetch();

// Traitement du formulaire de modification
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

        // Modifie la tâche dans la base de données
        $req3 = $bdd->prepare('UPDATE task SET task=?, status=?, demande=? , priorité=? WHERE task_id=?');
        if ($req3->execute(array($task, $status, $demande,$prio, $id_task))) {
            echo "La tâche a été modifiée avec succès.";
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
    <title>Modifier une tâche</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
<div class="container">
	
<h2>Modifier une tâche</h2>
<?php if(isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>
<form method="post" action="">
    <div class="form-group">
        <label for="task">Tâche:</label>
        <input type="text" class="form-control" id="task" name="task" value="<?php echo $fetch['task']; ?>" required>
    </div>
    <div class="form-group">
        <label for="status">Statut:</label>
        <select class="form-control" id="status" name="status">
            <option value="non assignée" <?php if($fetch['status'] == "non assignée") echo "selected"; ?>>Non assignée</option>
            <option value="en cours" <?php if($fetch['status'] == "en cours") echo "selected"; ?>>En cours</option>
            <option value="en attente" <?php if($tache['status'] == "en attente")  echo " selected"; ?>>En attente</option>
            <option value="terminée" <?php if($tache['status'] == "terminée")  echo " selected"; ?>>terminée</option>
    </select>
</div>
<div class="form-group">
    <label for="demande">Demande:</label>
    <textarea class="form-control" id="demande" name="demande" ><?php echo $fetch['demande']; ?></textarea>
</div>
<div class="form-group">
        <label for="priorité">Priorité</label>
        <select class="form-control" id="priorité" name="priorité">
            <option value="Basique" <?php if($fetch['priorité'] == "Basique") echo "selected"; ?>>Basique</option>
            <option value="Normal" <?php if($fetch['priorité'] == "Normal") echo "selected"; ?>>Normal</option>
            <option value="Important" <?php if($tache['priorité'] == "Important")  echo " selected"; ?>>Important</option>
            <option value="Urgent" <?php if($tache['status'] == "Urgent")  echo " selected"; ?>>Urgent</option>
    </select>
</div>
<br>
<button type="submit" name="submit" class="btn btn-primary">Enregistrer</button>
</form>
</div>
</body>
</html>
