<?php 
    session_start();
    require_once 'config.php'; // ajout connexion bdd 
    
    

    // On récupere les données de l'utilisateur
    $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch();
   
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Espace membre</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.min.css" >
  </head>
  <body>
        <div class="container">
            <div class="col-md-12">
                <?php 
                        if(isset($_GET['err'])){
                            $err = htmlspecialchars($_GET['err']);
                            switch($err){
                                case 'current_password':
                                    echo "<div class='alert alert-danger'>Le mot de passe actuel est incorrect</div>";
                                break;

                                case 'success_password':
                                    echo "<div class='alert alert-success'>Le mot de passe a bien été modifié ! </div>";
                                break; 
                            }
                        }
                    ?>


                <div class="text-center">
                        <h1 class="p-5">Bonjour <?php echo $data['role']; ?> <?php echo $data['pseudo']; ?> </h1>
                        <hr />
                        <a href="deconnexion.php" class="btn btn-danger btn-lg">Déconnexion</a>
                        <a href="tache.php" class="btn btn-info btn-lg">Tâches</a>
                        <?php

                        session_start(); // Démarrer la session

                        // Vérifier si l'utilisateur est connecté
                        if($data["role"] == "Administrateur") {
    
    


                        ?>

                        <a style ="background-color:#1C1C1C;color:white;" href="role.php" class="btn btn-lg"> répartition des rôles</a> <?php }?>
                        <!-- Button trigger modal -->
                       
                </div>
            </div>
        </div>    

  </body>
  
</html>
