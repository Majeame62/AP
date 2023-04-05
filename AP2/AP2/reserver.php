
<!DOCTYPE html>
<html>
<head>
	<title>reservation de salles</title>
	<!-- Lien vers la feuille de style Bootstrap -->
	<link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
<?php 
	session_start();
	require_once 'config.php';
	if(!isset($_SESSION['user'])){
		header('Location: conn.php');
		die();
	}?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form action="reservation.php" method="post">
        <div class="form-group">
          <label for="date">Date :</label>
          <input type="date" class="form-control" name="date" required>
        </div>
        <div class="form-group">
          <label for="heure_debut">Heure de début :</label>
          <input type="time" class="form-control" name="heure_debut" required>
        </div>
        <div class="form-group">
          <label for="heure_fin">Heure de fin :</label>
          <input type="time" class="form-control" name="heure_fin" required>
        </div>
        <br>
        <div class="form-group">
        <label for="salle">Salle :</label>
		<select type="salle" class="form-control" name="salle" >
    <?php
    // Configuration de la connexion à la base de données
                    require_once('config.php');

                    // Récupération de la liste des salles
                    $query = "SELECT nom_salle FROM salles";
                    $result = $bdd->query($query);
                    while ($row = $result->fetch()) {
                        echo "<option>" . $row['nom_salle'] . "</option>";
                    }
                    ?>
		</select><br><br>
        </div>
        <button type="submit" class="btn btn-primary">Vérifier disponibilité</button>
        
      </form>
    </div>
  </div>
</div>