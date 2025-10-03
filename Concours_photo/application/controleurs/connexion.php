<?php

session_start();
require('../modeles/utilisateurs.php');

// Si le formulaire n'est pas soumis, on affiche la page de connexion
// Sinon on traite la connexion
if (empty($_POST)) {
    require('../vues/vueConnexion.php');
} else {
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];
    $user = connexionOk($pseudo, $mdp);

    // Si l'utilisateur est trouvé, on initialise la session et on redirige vers l'accueil
    // Sinon on affiche un message d'erreur
    if ($user) {
        $_SESSION['pseudo'] = $pseudo;
        header('location:accueil.php');

    } else {
        $_SESSION['error'] = "Le pseudo ou le mot de passe est incorrect";
        header('Location:connexion.php');
    }

}


?>