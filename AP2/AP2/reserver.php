
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
			<option value="multimedia">Multimédia</option>
			<option value="amphithéatre">Amphithéâtre</option>
			<option value="réunion 1">Réunion 1</option>
			<option value="réunion 2">Réunion 2</option>
			<option value="réunion 4">Réunion 4</option>
			<option value="réunion 5">Réunion 5</option>
			<option value="réunion 6">Réunion 6</option>
			<option value="réunion 7">Réunion 7</option>
			<option value="réunion 8">Réunion 8</option>
		</select><br><br>
        </div>
        <button type="submit" class="btn btn-primary">Vérifier disponibilité</button>
        
      </form>
    </div>
  </div>
</div>