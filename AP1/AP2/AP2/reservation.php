<!DOCTYPE html>
<html>
<head>
    <title>Réservation</title>
    <!-- Lien vers la feuille de style Bootstrap -->
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <div class="container">
        <a style="margin-left:10px;margin-top:10px; " href="liste_reservation.php">&lt;-- Retour</a>
    </div>
    <?php
    // Configuration de la connexion à la base de données
    require_once('config.php');

    // Démarrage de la session
    session_start();

    // Vérification de l'authentification de l'utilisateur
    if(!isset($_SESSION['user'])){
        header('Location: conn.php');
        die();
    }

    // Récupération des données du formulaire
    $date = $_POST['date'];
    $heure_debut = $_POST['heure_debut'];
    $heure_fin = $_POST['heure_fin'];
    $salle = $_POST['salle'];

    // Récupération de l'ID utilisateur à partir du jeton de session
    $query3 = "SELECT id FROM utilisateurs WHERE token = ?";
    $result3  = $bdd->prepare($query3);
    $result3->execute(array($_SESSION['user']));
    $id_utilisateur = $result3->fetchColumn();

    // Récupération de l'ID de la salle à partir de son nom
    $query2 = "SELECT id_salle FROM salles WHERE nom_salle = ?";
    $result2  = $bdd->prepare($query2);
    $result2->execute(array($salle));
    $id_salle = $result2->fetchColumn();

    // Vérification de la disponibilité de la salle pour la plage horaire demandée
    $query = "SELECT COUNT(*) FROM reservation WHERE id_salle = ? AND date_reservation = ? AND heure_debut = ? AND heure_fin = ?";
    $result  = $bdd->prepare($query);
    $result->execute(array($id_salle, $date, $heure_debut, $heure_fin));
    $row = $result->fetchColumn();

    // Validation de la plage horaire (8h00-20h00 par tranche de 1 heure)
    $heure_debut_int = intval(str_replace(':', '', $heure_debut));
    $heure_fin_int = intval(str_replace(':', '', $heure_fin));
    $plage_min_int = 800;
    $plage_max_int = 2000;
    $plage_pas = 100;
    $plage_valide = false;
    for ($i = $plage_min_int; $i <= $plage_max_int - $plage_pas; $i += $plage_pas) {
        if ($heure_debut_int >= $i && $heure_debut_int + $plage_pas <= $plage_max_int && $heure_fin_int > $heure_debut_int && $heure_fin_int <= $i + $plage_pas) {
            $plage_valide = true;
        }
        }
        // Vérification de la disponibilité de la salle pour la plage horaire demandée
if ($row > 0 || !$plage_valide) {
    // Affichage d'un message d'erreur si la salle n'est pas disponible
    echo '<div class="container">';
    echo '<h2 class="text-danger">La salle n\'est pas disponible pour la plage horaire demandée</h2>';
    ;
    echo '</div>';
} else {
    // Enregistrement de la réservation dans la base de données
    $query = "INSERT INTO reservation(id_utilisateur, id_salle, date_reservation, heure_debut, heure_fin) VALUES (?, ?, ?, ?, ?)";
    $result = $bdd->prepare($query);
    $result->execute(array($id_utilisateur, $id_salle, $date, $heure_debut, $heure_fin));

    // Affichage d'un message de succès
    echo '<div class="container">';
    echo '<h2 class="text-success">La réservation a été enregistrée avec succès</h2>';
   
    echo '</div>';
}
?>

</body>
</html>





        
        