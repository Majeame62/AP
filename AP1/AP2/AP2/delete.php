<?php
	// inclure le fichier de configuration de la base de données
	require_once 'config.php';
	
	// vérifier si un pseudo est passé en paramètre dans l'URL
	if(isset($_GET['id_reservation'])){
		$id_reservation = $_GET['id_reservation'];
 
		// supprimer l'utilisateur correspondant dans la base de données
		$bdd->query("DELETE FROM reservation WHERE id_reservation = '$id_reservation'") or die(mysqli_errno($bdd)) ;
		
		// rediriger vers la page de gestion des rôles
		header("location: liste_reservation.php");
	}	
?>