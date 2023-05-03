<!DOCTYPE html>
<html  lang="en">
<link rel="stylesheet" type="text/css" href="bootstrap.min.css"/>
<title>Rôle </title>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
	<head>
		
	</head>
<body>
	
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
    <a style="margin-left:10px;margin-top:10px; "href="landing.php"><--Retour</a>
		<h3 style="margin-left:100px;margin-top:10px;" class="text-primary">Liste des differents rôles</h3>
		<hr style="border-top:5px dotted #ccc;"/>
		<div class="col-md-2"></div>
		<div class="col-md-8">
			
		</div>
		<br />
		<table style="margin-left:110px;" class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>pseudo</th>
					<th>role</th>
					
				</tr>
			</thead>
			<tbody>
				<?php
					require_once('config.php') ;
					
					$query = $bdd->query("SELECT * FROM utilisateurs where pseudo != 'maximeu62' ");
					$count = 1;
					while($fetch = $query->fetch(PDO::FETCH_ASSOC)){
				?>
				<tr>
					<td><?php echo $count++?></td>
					<td><?php echo $fetch['pseudo']?></td>
					<td><?php echo $fetch['role']?></td>
                        <td colspan="2">
                            <center>
                                <?php
                                    if($fetch['status'] != "Done"){
                                    echo 
                                    '<a href="update_role3.php?pseudo='.$fetch['pseudo'].'" class="btn btn-success"><span class="glyphicon glyphicon-check">changer en utlisateur</span></a>';
                                    }
                                    if($fetch['status'] != "Done"){
                                        echo 
                                        '<a href="update_role.php?pseudo='.$fetch['pseudo'].'" class="btn btn-success"><span class="glyphicon glyphicon-check">changer en Employée</span></a>';
                                    }
                            
                                
                                    if($fetch['status'] != "Done"){
                                        echo 
                                        '<a href="update_role2.php?pseudo='.$fetch['pseudo'].'" class="btn btn-success"><span class="glyphicon glyphicon-check">changer en Responsable</span></a>';
                                    }
                                
                                
                                    
                                ?>
                                <a href="delete_compte.php?pseudo=<?php echo $fetch['pseudo']?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove">supprimer</span></a>
                            </center>
					</td>
				</tr>
				<?php
					}
				?>
				
			</tbody>
		</table>
	</div>
</body>
</html>