<!DOCTYPE html>
<html>
<head>
    <title>Planning des réservation des salles sur la semaine</title>
    <!-- Lien vers la feuille de style Bootstrap -->
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
<a style="margin-left:10px;margin-top:10px; " href="liste_reservation.php">&lt;-- Retour à la liste des reservations</a>
    <div class="container">
       
        <h1>Planning des réservation des salles sur la semaine</h1>
        <hr>
        <form method="POST">
            <div class="form-group">
                <label for="select_salle">Sélectionnez une semaine :</label>
                <select class="form-control" id="select_date" name="date">
                     <option value="2023-04-03"> semaine du 03/04/2023 au 09/04/2023</option>
                     <option value="2023-04-10"> semaine du 10/04/2023 au 16/04/2023</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Afficher le planning</button>
        </form>
        <hr>
        <?php
        // Vérification si une salle a été sélectionnée
        if (isset($_POST['select_date'])) {
            $salle = $_POST['select_date'];

            // Récupération de l'ID de la salle à partir de son nom
            $query = "SELECT id_salle FROM salles WHERE nom_salle = ?";
            $result  = $bdd->prepare($query);
            $result->execute(array($salle));
            $id_salle = $result->fetchColumn();

            // Récupération du planning d'occupation de la salle pour les 7 prochains jours
            $query = "SELECT * FROM reservation WHERE date_reservation BETWEEN DATE('$date') AND DATE_ADD('$date', INTERVAL 7 DAY) ORDER BY date_reservation, heure_debut";
            $result2=$bdd->query("SELECT nom_salle FROM salles JOIN reservation ON salles.id_salle = reservation.id_salle");
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

                    echo "<td>" . $row2['nom_salle²'] . "</td>";
                    echo "<td>" . $row['date_reservation'] . "</td>";
                    echo "<td>" . $row['heure_debut'] . "</td>";
                    echo "<td>" . $row['heure_fin'] . "</td>";
                   
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>Aucune réservation pour la salle " . $salle . " pour les 7 prochains jours.</p>";}}?>
                </div>

</body>
</html>