<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une salle</title>
    <!-- Lien vers la feuille de style Bootstrap -->
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <div class="container">
        <a style="margin-left:10px;margin-top:10px; " href="salle.php">&lt;-- Retour à la liste des salles</a>
        <h1>Ajouter une salle</h1>
        <hr>
        <form method="POST">
            <div class="form-group">
                <label for="nom_salle">Nom de la salle :</label>
                <input type="text" class="form-control" id="nom_salle" name="nom_salle">
            </div>
            <div class="form-group">
                <label for="capacite_salle">Capacité de la salle :</label>
                <input type="number" class="form-control" id="capacite_salle" name="capacite_salle">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter la salle</button>
        </form>
        <hr>
        <?php
        // Vérification si le formulaire a été soumis
        if (isset($_POST['nom_salle']) && isset($_POST['capacite_salle'])) {
            // Configuration de la connexion à la base de données
            require_once('config.php');

            // Récupération des données du formulaire
            $nom_salle = $_POST['nom_salle'];
            $capacite_salle = $_POST['capacite_salle'];

            // Vérification si la salle existe déjà dans la base de données
            $query = "SELECT COUNT(*) FROM salles WHERE nom_salle = ?";
            $result = $bdd->prepare($query);
            $result->execute(array($nom_salle));
            $count = $result->fetchColumn();

            if ($count > 0) {
                echo "<div class='alert alert-danger' role='alert'>La salle existe déjà dans la base de données.</div>";
            } else {
                // Ajout de la salle à la base de données
                $query = "INSERT INTO salles (nom_salle, capacite) VALUES (?, ?)";
                $result = $bdd->prepare($query);
                $result->execute(array($nom_salle, $capacite_salle));
                header('salle.php');
                echo "<div class='alert alert-success'  role='alert'>La salle a été ajoutée avec succès dans la base de données.</div>";
            }
        }
        ?>
    </div>
</body>
</html>