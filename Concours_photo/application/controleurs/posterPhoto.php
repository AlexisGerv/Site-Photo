<?php
session_start();
require_once('../modeles/connect.php');
require_once('../modeles/photos.php');

$erreur = null;
$message = null;

if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $tmpName = $_FILES['photo']['tmp_name'];
    $originalName = basename($_FILES['photo']['name']);
    $infos = getimagesize($tmpName);

    if ($infos !== false) {
        
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $titre_compact = str_replace(' ', '_', $_POST['titre']);
        $auteur_compact = str_replace(' ', '_', $_SESSION['pseudo']);
        
        $nouveauNom = $auteur_compact . $titre_compact . '.' . $extension;
        $destination = '../../public/media/images/' . $nouveauNom;
        $cheminBDD = 'public/media/images/' . $nouveauNom;
        
        move_uploaded_file($tmpName, $destination);
        
        importPhoto($_SESSION['pseudo'], $_POST['description'], date("Y-m-d H:i:s"), $_POST['titre'], $cheminBDD);
        $message = "Photo importée avec succès.";
    } else {
        $erreur = "Le fichier doit être une image.";
    }
} else {
    $erreur = "Erreur lors de l'importation du fichier.";
}

require('../vues/vuePhoto.php');
