<?php
    require_once 'config.php';
 
    if(isset($_GET['pseudo'])){
        $pseudo = $_GET['pseudo'];
 
        $stmt = $bdd->prepare("UPDATE utilisateurs SET role = 'utilisateur' WHERE pseudo = '$pseudo'");
        
 
        if($stmt->execute()){
            header('location: role.php');
        } else {
            echo "Erreur lors de la mise à jour du compte.";
        }
 
        $stmt->close();
    }
?>