<?php
session_start();
require_once('inc/pdo.php');
require_once('inc/function.php');
//////////////////////////////////
// Appel à la base de données
$sql   = "SELECT * FROM logement";
$query = $pdo->prepare($sql);
$query->execute();
$logements = $query->fetchAll();
include_once('inc/header.php');
?>
<!-- Affichage des articles -->
<a href="index.php">Retour au formulaire</a>
<h1>Les biens disponibles</h1>
<div class="wrapAffichage">
    <?php
foreach ($logements as $logement) { ?>
    <div class="articles">
        <h2><?php echo $logement['titre']; ?></h2>
        <img src="upload/<?php echo $logement['photo']; ?>" alt="photo du bien">
        <p>Adresse : <?php echo $logement['adresse']; ?></p>
        <h3>Ville : <?php echo $logement['ville']; ?></h3>
        <p>CP : <?php echo $logement['cp']; ?></p>
        <p>Surface : <?php echo $logement['surface']; ?> m²</p>
        <p>Prix : <?php echo $logement['prix']; ?> €</p>
        <p>Type : <?php echo $logement['type']; ?></p>
        <!-- Limitation à 20 caractères pour la description -->
        <p>Description : <?php echo substr($logement['description'], 0, 20). "..."; ?></p>
    </div>
    <?php } ?>
</div>
    
    <?php include_once('inc/footer.php');