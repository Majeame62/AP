<!DOCTYPE html>
<html>
<head>
    <title>Modifier une salle</title>
    <!-- Lien vers la feuille de style Bootstrap -->
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <div class="container">
        <a style="margin-left:10px;margin-top:10px; " href="salle.php">&lt;-- Retour à la liste des salles</a>
        <h1>Modifier une salle</h1>
        <hr>
        <?php
        // Configuration de la connexion à la base de données
        require_once('config.php');

         // Vérification si un ID de salle a été transmis en paramètre
    if (isset($_POST['id_salle'])) {
        $id_salle = intval($_POST['id_salle']);

        // Récupération des données de la salle
        $query = "SELECT * FROM salles WHERE id_salle = ?";
        $stmt = $bdd->prepare($query);
        $stmt->execute(array($id_salle));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            exit("Salle non trouvée.");
        }
    } else {
        // Redirection vers la liste des salles si aucun ID de salle n'a été transmis
        header('Location: salle.php');
        exit();
    }

    // Traitement du formulaire de modification de la salle
    if (isset($_POST['nom_salle'])) {
        $id_salle = intval($_POST['id_salle']);
        $nom_salle = trim($_POST['nom_salle']);
        $capacite = intval($_POST['capacite']);

        // Mise à jour des données de la salle dans la base de données
        $query = "UPDATE salles SET nom_salle = ?, capacite = ? WHERE id_salle = ?";
        $stmt = $bdd->prepare($query);
        $result = $stmt->execute(array($nom_salle, $capacite, $id_salle));
        
        if ($result) {
            header("Location:salle.php");
        } else {
            exit("La mise à jour des données a échoué.");
        }
    }
        ?>
        <form method="POST">
        <input type="hidden" name="id_salle" value="<?php echo $row['id_salle']; ?>">
            <div class="form-group">
                <label for="nom_salle">Nom de la salle :</label>
                <input type="text" class="form-control" id="nom_salle" name="nom_salle" value="<?php echo $row['nom_salle']; ?>">
            </div>
            <div class="form-group">
                <label for="capacite">Capacité de la salle :</label>
                <input type="number" class="form-control" id="capacite" name="capacite" value="<?php echo $row['capacite']; ?>">
            </div>
            <br>
            <button type="submit"  class="btn btn-primary">Enregistrer les modifications</button>
        </form>
    </div>
</body>
</html>