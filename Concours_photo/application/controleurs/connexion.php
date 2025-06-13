<?php

session_start();
require('../modeles/utilisateurs.php');

if(empty($_POST)){
    require('../vues/vueConnexion.php');

} else {
    $pseudo = trim($_POST['pseudo']);
    $password = trim($_POST['password']);
    $user = connexionOk($pseudo,$password);

    if ($user){
        $_SESSION['pseudo'] = $pseudo;
        header('location:accueil.php');
        exit();
    } else {
        $_SESSION['error'] = "Le pseudo ou le mot de passe est incorrect";
        header('Location:connexion.php');
        exit();
    }

}


?>