<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>tache</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
</head>
<?php require_once ('landing.php');?>
<body>
	<?php 
	session_start();
	require_once 'config.php';
	if(!isset($_SESSION['user'])){
		header('Location: conn.php');
		die();
	}
	$query = $bdd->query("SELECT * FROM task ");
	$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
	$req->execute(array($_SESSION['user']));
	$data = $req->fetch();
	if($data["role"] == "Employée") {
		$query2 = $bdd->prepare("SELECT * FROM task WHERE id_utilisateurs = ?");
		$query2->execute(array($data['id']));
	} else {
		$query2 = $bdd->query("SELECT * FROM task");
	}
	?><div class="container">
	<a style="margin-left:10px;margin-top:10px; " href="landing.php">&lt;-- Retour</a>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6 well">
			<h3 class="text-primary text-center" style="margin-top:10px;">Liste des différentes tâches</h3>
			<hr style="border-top:5px dotted #ccc;"/>
			<div class="col-md-2"></div>
			<div class="col-md-8"></div>

			<?php 
			if($fetch['status'] != "Done"){
				echo '<a href="create_tache.php" class="btn btn-success" style="margin-left:10px;margin-top:10px;"><span class="glyphicon glyphicon-check">Créer une tâche</span></a>';
			} 
			?>
			<br />
			<table class="table" style="margin-left:110px;">
				<thead>
					<tr>
						<th>Tâche</th>
						<th>Status</th>
						<th>ID Créateur</th>
						<th>Demande</th>
					</tr>
				</thead>
				<tbody>
					<?php
					while($fetch = $query->fetch(PDO::FETCH_ASSOC)){
						while($fetch2 = $query2->fetch(PDO::FETCH_ASSOC)){
							if ($data["role"] == "Employée") {
								// afficher uniquement les tâches de l'utilisateur connecté
								if ($fetch2["id_utilisateurs"] != $data["id"]) {
									continue;
								}
							}
							?>
							<tr>

								<td><?php echo $fetch2['task']  ?></td>
								<td><?php  echo $fetch2['status']?></td>
								<td><?php  echo $fetch2['id_utilisateurs']?></td>
								<td><?php  echo $fetch2['Demande']?></td>
								<td colspan="2">
									<center>
										<?php
										if ($data["role"] != "utilisateur") {
											if($fetch2['status'] != "Done"){
											echo '<form method="post" action="update_tache.php?task_id='.$fetch2['task_id'].'">
											<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-check">modifier la tache</span></button>
											</form>';
											}
											}
											if($data["role"] == "Administrateur" || $data["role"] == "responsable") {
											echo '<form method="post" action="delete_tache.php">
											<input type="hidden" name="task_id" value="'.$fetch2['task_id'].'">
											<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove">supprimer la tâche</span></button>
											</form>';
											}
											echo '</td>
											
											</tr>';
											}}
											?>