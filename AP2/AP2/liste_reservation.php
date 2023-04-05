<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
    <title>reservation</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css" />
  </head>
  <center>
  <body >
</center><a style="margin-left:30px" href="conn.php">Deconnexion</a><center>
    <div  style="margin:center;margin-left:270px; margin-top:10px;">
      <div class="col-md-3"></div>
      <div class="col-md-6 well">
        
        
        <h3
          style="margin-left:100px;margin-top:10px;"
          class="text-primary text-center"
        >
          Liste des differentes réservations
        </h3>
        <hr style="border-top:5px dotted #ccc;" />
        <div class="col-md-2"></div>
        <div class="col-md-8"></div>
        <a href="reserver.php" class="btn btn-success" style="margin-left:10px;margin-top:10px;"><span class="glyphicon glyphicon-check">Reserver une salle</span></a>
        <a href="planning.php" class="btn btn-success" style="margin-left:10px;margin-top:10px;"><span class="glyphicon glyphicon-check">Occupation des differentes salles</span></a>
        <a href="salle.php" class="btn btn-success" style="margin-left:10px;margin-top:10px;"><span class="glyphicon glyphicon-check">Gestion des differentes salles</span></a>
        <a href="purge.php" class="btn btn-danger" style="margin-left:10px;margin-top:10px;"><span class="glyphicon glyphicon-check">purge des données</span></a>
        <br />
        <table style="margin-left:110px;" class="table">
          <thead>
            <tr>
              <th>id</th>
              <th>pseudo</th>
              <th>salle</th>
              <th>date de reservation</th>
              <th>heure de debut</th>
              <th>heure de fin</th>
            </tr>
          </thead>
          <tbody>
            <?php
            
            
              require_once('config.php');
              $query = $bdd->query("SELECT * FROM reservation");
              $query2=$bdd->query("SELECT nom_salle FROM salles inner JOIN reservation ON salles.id_salle = reservation.id_salle");
              $fetch2 = $query2->fetch(PDO::FETCH_ASSOC);
              $query3=$bdd->query("SELECT pseudo FROM utilisateurs JOIN reservation ON utilisateurs.id = reservation.id_utilisateur");
              $fetch3 = $query3->fetch(PDO::FETCH_ASSOC);
              while($fetch = $query->fetch(PDO::FETCH_ASSOC)){
               
                    
            ?>
            <tr>
                

              <td><?php echo $fetch['id_reservation']?></td>
              <td><?php echo $fetch3['pseudo']?></td>
              <td><?php echo $fetch2['nom_salle']?></td>
              <td><?php echo $fetch['date_reservation']?></td>
              <td><?php echo $fetch['heure_debut']?></td>
              <td><?php echo $fetch['heure_fin']?></td>
              <td colspan="2">
              <a href="delete.php?id_reservation=<?php echo $fetch['id_reservation']?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove">supprimer</span></a>
              </td>
            </tr>
            <?php
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </body></center>
</html>