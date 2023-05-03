<?php
	// inclure le fichier de configuration de la base de données
	require_once 'config.php';
	
	// vérifier si un pseudo est passé en paramètre dans l'URL
	if(isset($_POST['id_salle'])){
		$id_salle = $_POST['id_salle'];
 
		// supprimer l'utilisateur correspondant dans la base de données
		$bdd->query("DELETE FROM salles WHERE id_salle = '$id_salle'") or die(mysqli_errno($bdd)) ;
		
		// rediriger vers la page de gestion des rôles
		header("location: salle.php");
	}	
?>