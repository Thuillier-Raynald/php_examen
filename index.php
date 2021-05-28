<?php
session_start();
require_once('inc/pdo.php');
require_once('vendor/autoload.php');
require_once('inc/function.php');
use Gregwar\Image\Image;
////////////////////
// Traitement PHP //
////////////////////

// création d'un tableau d'erreurs
$errors = array();
// Déclaration d'une taille maximum pour le fichier "photo"
$maxSize = 10000000;
///////////////////////////////
// Verification du formulaire
//////////////////////////////
if (!empty($_POST['submitted'])) {
    // Vérification de la présence d'une image
    if (!empty($_FILES['photo'])) {
        // Stockage du type
        $typePhoto = $_FILES['photo']['type'];
        // Stockage de la taille du fichier Photo
        $taillePhoto = filesize($_FILES['photo']['tmp_name']);
        //debug($taillePhoto);
    }
    //debug($_POST);
    //debug($_FILES);
    ///////////////////////////
    // Securisation des champs
    $titre = trim(strip_tags($_POST['titre']));
    $adresse = trim(strip_tags($_POST['adresse']));
    $ville = trim(strip_tags($_POST['ville']));
    $cp = trim(strip_tags($_POST['cp']));
    $surface = trim(strip_tags($_POST['surface']));
    $prix = trim(strip_tags($_POST['prix']));
    $photo = trim(strip_tags($_FILES['photo']['name']));
    $type = trim(strip_tags($_POST['type']));
    $description = trim(strip_tags($_POST['description']));
    //debug($_POST);
    //debug($_FILES);
    /////////////////////////
    // Validation des champs
    $errors = validInput($errors, $titre, 'titre', 2, 255);
    $errors = validInput($errors, $adresse, 'adresse', 10, 255);
    $errors = validInput($errors, $ville, 'ville', 2, 255);
    $errors = validInput($errors, $cp, 'cp', 5, 5);
    $errors = validInput($errors, $surface, 'surface', 2, 11);
    $errors = validInput($errors, $prix, 'prix', 1, 11);
    // Vérification du format du champ "CP"
    if (strlen($cp) !== 5) {
        $errors['cp'] = 'Veuillez renseigner un CP à 5 chiffres';
    }
    if (!is_numeric($cp)) {
        $errors['cp'] = 'Veuillez renseigner un nombre entier';
    } 
    if ($cp <= 0) {
        $errors['cp'] = 'Veuillez renseigner un nombre positif !';
    } 
    // Vérification des champs "prix" et "surface"
    if (!is_numeric($prix)) {
        $errors['prix'] = 'Veuillez renseigner un nombre entier';
    } 
    if ($prix <= 0) {
        $errors['prix'] = 'Veuillez renseigner un nombre positif !';
    } 
    if (!is_numeric($surface)) {
        $errors['surface'] = 'Veuillez renseigner un nombre entier';
    } 
    if ($surface <= 0) {
        $errors['surface'] = 'Veuillez renseigner un nombre positif !';
    }
    // Vérification de la taille de la "photo"
    // max => 10000
    if ($taillePhoto > $maxSize) {
        $errors['photo'] = 'Fichier trop lourd !';
    }
    // Vérification de l'extension du fichier de la "photo"
    // Formats acceptés: jpg / jepg / png
    if (!empty($_FILES['photo']['name'])) {
        if (!strstr($typePhoto, 'jpg') && !strstr($typePhoto, 'jpeg') && !strstr($typePhoto, 'png')) {
            $errors['photo'] = 'Ce format n\'est pas pris en charge!';
        } 
    }
    //debug($_POST);
    //debug($_FILES);
    //debug($typePhoto);
    //debug($errors);
    ///////////////////////////
    // Insertion en BDD
    if (count($errors) === 0) {
        // si pas d'erreurs, écriture de la requête
        $sql = "INSERT INTO logement (titre, adresse, ville, cp, surface, prix, photo, type, description)
                VALUES (:titre, :adresse, :ville, :cp, :surface, :prix, :photo, :type, :description)
                ";
        // Préparation de la requête
        $query = $pdo->prepare($sql);
        // Sécurisation de l'envou en BDD
        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':adresse', $adresse, PDO::PARAM_STR);
        $query->bindValue(':ville', $ville, PDO::PARAM_STR);
        $query->bindValue(':cp', $cp, PDO::PARAM_INT);
        $query->bindValue(':surface', $surface, PDO::PARAM_INT);
        $query->bindValue(':prix', $prix, PDO::PARAM_INT);
        $query->bindValue(':photo', $photo, PDO::PARAM_STR);
        $query->bindValue(':type', $type, PDO::PARAM_STR);
        $query->bindValue(':description', $description, PDO::PARAM_STR);
        // Execution de la requête
        $query->execute();
        // Récupération du dernier id
        $lastId = $pdo->lastInsertId();
        // Gestion de l'extention
        if (!empty($_FILES['photo']['name'])) {
            switch ($typePhoto) {
                case 'image/jpg':
                    $ext = 'jpg';
                    break;
                case 'image/jpeg':
                    $ext = 'jpeg';
                    break;
                case 'image/png':
                    $ext = 'png';
                    break;
                default:
                    break;
            }
            // UPLOAD de l'image
            Image::open($_FILES['photo']['tmp_name'])
                ->cropResize(300, 300)
                ->save('upload/thumbmail/logement_' . $lastId . '_300x300.' . $ext, $ext);
            Image::open($_FILES['photo']['tmp_name'])
                ->cropResize(150, 150)
                ->save('upload/' . 'logement_' . $lastId . '.' . $ext, $ext);
            // ajout de la photo en lien avec l'ID 
            $sql = "UPDATE logement SET photo = :lastPhoto WHERE id_logement = :lastId";
            $query = $pdo->prepare($sql);
            // je securise
            $query->bindValue(':lastId', $lastId, PDO::PARAM_STR);
            $query->bindValue(':lastPhoto', 'logement_'. $lastId . '.' . $ext, PDO::PARAM_STR);
            $query->execute();
        }
        // Redirection
        header('Location: affichage.php');
    }
}
include_once('inc/header.php');
?>
<!-- Affichage du formulaire -->
<h1>Enregistrez votre demande</h1>
<div class="wrap">
    <form action="" method="POST" enctype="multipart/form-data" novalidate>

        <label for="titre">Titre<span>*</span></label>
        <span class="error"><?php if (!empty($errors['titre'])) {
                                echo $errors['titre'];
                            } ?></span>
        <input type="text" name="titre" id="titre" value="">
        
        <label for="adresse">Adresse<span>*</span></label>
        <span class="error"><?php if (!empty($errors['adresse'])) {
                                echo $errors['adresse'];
                            } ?></span>
        <input type="text" name="adresse" id="adresse" value="">

        <label for="ville">ville<span>*</span></label>
        <span class="error"><?php if (!empty($errors['ville'])) {
                                echo $errors['ville'];
                            } ?></span>
        <input type="text" name="ville" id="ville" value="">

        <label for="cp">CP<span>*</span></label>
        <span class="error"><?php if (!empty($errors['cp'])) {
                                echo $errors['cp'];
                            } ?></span>
        <input type="number" name="cp" id="cp" value="">

        <label for=surface"">Surface<span>*</span></label>
        <span class="error"><?php if (!empty($errors['surface'])) {
                                echo $errors['surface'];
                            } ?></span>
        <input type="number" name="surface" id="surface" value="">

        <label for="prix">Prix<span>*</span></label>
        <span class="error"><?php if (!empty($errors['prix'])) {
                                echo $errors['prix'];
                            } ?></span>
        <input type="number" name="prix" id="prix" value="">

        <label for="photo">Photo</label>
        <span class="error"><?php if (!empty($errors['photo'])) {
                                echo $errors['photo'];
                            } ?></span>
        <input type="file" name="photo" id="photo" value="">

        <div class="type">
            <label for="type">Location</label>
            <span class="error"><?php if (!empty($errors['type'])) {
                                echo $errors['type'];
                            } ?></span>
            <input type="radio" name="type" id="location" value="Location" checked>
            <label for="type">Vente</label>
            <input type="radio" name="type" id="vente" value="Vente">
        </div>

        <label for="description">Description du bien</label>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>

        <input type="submit" name="submitted" value="Valider">
    <p>* Champs obligatoires</p>
    </form>
</div>

<?php include_once('inc/footer.php');
