<?php

session_start();
require('../modeles/connect.php');
require('../modeles/utilisateurs.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['pseudo'];
    $mail = $_POST['mail'];
    $mdp = $_POST['mdp'];

    if (inscriptionOk($pseudo, $mail)) {
        ajouterUtilisateur($pseudo, $mail, $mdp);
        $_SESSION['pseudo'] = $pseudo;
        header('Location: accueil.php');
        exit();
    } else {
        $erreur = "Ce pseudo ou mail est déjà pris.";
        require('../vues/vueInscription.php');
    }
} else {
    require('../vues/vueInscription.php');
}
