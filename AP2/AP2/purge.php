<?php
// Connexion à la base de données
require_once("config.php");
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Date limite à partir de laquelle les données seront supprimées
$date_limite = date('Y-m-d', strtotime('-2 days'));

// Suppression des données obsolètes
$sql = "DELETE FROM reservation WHERE date_creation < '$date_limite'";
$result = $bdd->query( $sql);

if ($result) {
    
    header("Location:liste_reservation.php");
} else {
    echo "Erreur lors de la suppression des données obsolètes : " . mysqli_error($bdd);
}

// Fermeture de la connexion

?>