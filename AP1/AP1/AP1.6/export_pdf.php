<?php
require_once('fpdf.php');
require_once('config.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Requête pour récupérer les tâches en cours
$query = $bdd->prepare("SELECT * FROM task WHERE status = 'en cours'");
$query->execute();
$tasks = $query->fetchAll();

// Création du fichier PDF
$pdf = new FPDF();
$pdf->AddPage();

// Titre centré et souligné
$pdf->SetFont('Arial','B',20);

$pdf->Cell(0,30,'Liste des taches en cours',1,0,'C');

// Contenu de votre PDF
$pdf->SetFont('Arial','B',12);
$pdf->Ln(40);
$pdf->Cell(40, 10, 'Tache', 1);
$pdf->Cell(40, 10, 'Createur', 1);
$pdf->Cell(70, 10, 'Demande', 1);
$pdf->Cell(40, 10, 'Priorite', 1);

// Récupération des données et ajout au tableau
$pdf->SetFont('Arial','',10);

foreach ($tasks as $task) {
    // Requête pour récupérer les informations de l'utilisateur créateur de la tâche
    $query2 = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
    $query2->execute([$task['id_utilisateurs']]);
    $user = $query2->fetch();
    
    // Vérifier si la requête a renvoyé un résultat
    if (!$user) {
        // Traiter le cas où la requête n'a pas renvoyé de résultat
        continue;
    }
    
    // Ajouter la ligne dans le tableau
    $pdf->Ln();
    $pdf->Cell(40, 10, $task['task'], 1);
    $pdf->Cell(40, 10, $user['pseudo'], 1);
    $pdf->Cell(70, 10, $task['Demande'], 1);
    $pdf->Cell(40, 10, $task['priorité'], 1);
}

// Enregistrement du fichier PDF
$pdf->Output('liste_taches_en_cours.pdf', 'D');
?>
