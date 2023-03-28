<!DOCTYPE html>
<html>
<head>
    <title>Planning d'occupation des salles</title>
    <!-- Lien vers la feuille de style Bootstrap -->
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
<a style="margin-left:10px;margin-top:10px; " href="liste_reservation.php">&lt;-- Retour à la liste des reservations</a>
    <div class="container">
       
        <h1>Planning d'occupation des salles</h1>
        <hr>
        <form method="POST">
            <div class="form-group">
                <label for="select_salle">Sélectionnez une salle :</label>
                <select class="form-control" id="select_salle" name="select_salle">
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
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Afficher le planning</button>
        </form>
        <hr>
        <?php
        // Vérification si une salle a été sélectionnée
        if (isset($_POST['select_salle'])) {
            $salle = $_POST['select_salle'];

            // Récupération de l'ID de la salle à partir de son nom
            $query = "SELECT id_salle FROM salles WHERE nom_salle = ?";
            $result  = $bdd->prepare($query);
            $result->execute(array($salle));
            $id_salle = $result->fetchColumn();

            // Récupération du planning d'occupation de la salle pour les 7 prochains jours
            $query = "SELECT * FROM reservation WHERE id_salle = ? AND date_reservation BETWEEN DATE(NOW()) AND DATE_ADD(NOW(), INTERVAL 7 DAY) ORDER BY date_reservation, heure_debut";
            $result2=$bdd->query("SELECT pseudo FROM utilisateurs JOIN reservation ON utilisateurs.id = reservation.id_utilisateur");
            $result  = $bdd->prepare($query);
            $result->execute(array($id_salle));
            $row2 = $result2->fetch();

            if ($result->rowCount() > 0) {
                echo "<h2>Planning d'occupation de la salle " . $salle . "</h2>";
                echo "<table class='table'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Date</th>";
                echo "<th>Heure de début</th>";
                echo "<th>Heure de fin</th>";
                echo "<th>Utilisateur</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row = $result->fetch()) {
                    echo "<tr>";
                    echo "<td>" . $row['date_reservation'] . "</td>";
                    echo "<td>" . $row['heure_debut'] . "</td>";
                    echo "<td>" . $row['heure_fin'] . "</td>";
                    echo "<td>" . $row2['pseudo'] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>Aucune réservation pour la salle " . $salle . " pour les 7 prochains jours.</p>";}}?>
                </div>

</body>
</html>