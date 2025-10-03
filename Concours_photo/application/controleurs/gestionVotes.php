<?php
session_start();
require_once("../modeles/votes.php");

// Vérification que l'utilisateur est connecté et que les données nécessaires sont présentes
// Si l'utilisateur n'est pas connecté, on le redirige vers la page d'accueil
if ( isset($_SESSION['pseudo']) && isset($_POST['id_photo']) && isset($_POST['note']) ) {
    $pseudo = $_SESSION['pseudo'];
    $id_photo = $_POST['id_photo'];
    $note = $_POST['note'];
    ajoutVoteBDD($id_photo, $pseudo, $note);
    header("Location: accueil.php#" . $id_photo);
}




