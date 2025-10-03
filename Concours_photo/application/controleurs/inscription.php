<?php

session_start();
require('../modeles/connect.php');
require('../modeles/utilisateurs.php'); 

// On vérifie si le formulaire a été soumis
// Si oui, on traite l'inscription
// Sinon, on affiche le formulaire d'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['pseudo'];
    $mail = $_POST['mail'];
    $mdp = $_POST['mdp'];

    if (inscriptionOk($pseudo, $mail)) {
        
        // On ajoute l'utilisateur à la base de données
        ajouterUtilisateur($pseudo, $mail, $mdp);
        // On initialise la session
        $_SESSION['pseudo'] = $pseudo;
        header('Location: accueil.php');

    } else {
        // Si le pseudo ou le mail est déjà pris, on affiche un message d'erreur
        $erreur = "Ce pseudo ou mail est déjà pris.";
        require('../vues/vueInscription.php');
    }
} else {
    require('../vues/vueInscription.php');
}
