<?php
session_start();
require_once('../modeles/connect.php');
require_once('../modeles/photos.php');
require_once('../vues/vuePhoto.php');

// On vérifie que le fichier transmis est bien une image et qu'il n'y a pas d'erreur
if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $tmpNom = $_FILES['photo']['tmp_name'];
    $originalNom = $_FILES['photo']['name'];

    // Vérifie que le fichier est une image
    $infosImage = @getimagesize($tmpNom);
    if ($infosImage === false) {
        $erreur = "Le fichier envoyé n'est pas une image valide.";
        
    } else {
        //On unifie le nom du fichier pour éviter les espaces
        $titre_compact = str_replace(' ', '_', $_POST['titre']);
        $auteur_compact = str_replace(' ', '_', $_SESSION['pseudo']);
        $nom_compact = str_replace(' ', '_', $originalNom);
        $nouveauNom = $auteur_compact . $titre_compact . $nom_compact;

        // création du nom de fichier final
        $destination = '../../public/media/images/' . $nouveauNom;
        $cheminBDD = 'public/media/images/' . $nouveauNom;

        //On déplace le fichier temporaire vers le dossier de destination
        move_uploaded_file($tmpNom, $destination);

        importPhoto($_SESSION['pseudo'], $_POST['description'], date("Y-m-d H:i:s"), $_POST['titre'], $cheminBDD);
        $message = "Photo importée avec succès.";
        header('location:accueil.php');

    }
} else if (isset($_FILES['photo'])) {
    $erreur = "Erreur lors de l'importation du fichier."; 
}



