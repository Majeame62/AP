<!DOCTYPE html>
<html>
<head>
    <title>Gestion des salles</title>
    <!-- Lien vers la feuille de style Bootstrap -->
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<center>
<body>
</center><a style="margin-left:10px;margin-top:10px; " href="liste_reservation.php">&lt;-- Retour</a><center>
    <div class="container">
    
        <h1>Gestion des salles</h1>
        <hr>
        <!-- Formulaire d'ajout de salle -->
       
        <form method="POST" action="ajouter_salle.php">
           
            <button type="submit" class="btn btn-primary">Ajouter une salle</button>
        </form>
        <hr>
        <!-- Liste des salles -->
        <h2>Liste des salles</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>nombre de places</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Configuration de la connexion à la base de données
                require_once('config.php');

            // Récupération de la liste des salles
            $query = "SELECT * FROM salles";
            $result = $bdd->query($query);
            while ($row = $result->fetch()) {
                echo "<tr>";
                echo "<td>" . $row['nom_salle'] . "</td>";
                echo "<td>" . $row['capacite'] . "</td>";
                echo "<td>";
                echo "<form method='POST' action='modifier_salle.php'>";
                echo "<input type='hidden' name='id_salle' value='" . $row['id_salle'] . "'>";
                echo "<button type='submit' class='btn btn-info'>Modifier</button>";
                echo "</form>";
                
                echo "<form method='POST' action='delete_salle.php'>";
                echo "<input type='hidden' name='id_salle' value='" . $row['id_salle'] . "'>";
                echo "<button type='submit' class='btn btn-danger'>Supprimer</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div></center>
</body></center>
</html>