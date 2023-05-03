<?php
	// inclure le fichier de configuration de la base de données
	require_once 'config.php';
	
	// vérifier si un pseudo est passé en paramètre dans l'URL
	if(isset($_GET['pseudo'])){
		$pseudo = $_GET['pseudo'];
 
		// supprimer l'utilisateur correspondant dans la base de données
		$bdd->query("DELETE FROM utilisateurs WHERE pseudo = '$pseudo'") or die(mysqli_errno($bdd)) ;
		
		// rediriger vers la page de gestion des rôles
		header("location: role.php");
	}	
?>