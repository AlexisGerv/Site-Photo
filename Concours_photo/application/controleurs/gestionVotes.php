<?php
session_start();
require_once("../modeles/votes.php");
header('Content-Type: application/json');
// On vérifie que l'utilisateur est connecté et que les champs sont remplis
if (
    isset($_SESSION['pseudo']) &&
    isset($_POST['id_photo']) &&
    isset($_POST['note'])
) {
    $pseudo = $_SESSION['pseudo'];
    $id_photo = intval($_POST['id_photo']);
    $note = intval($_POST['note']);

    // On vérifie que l'utilisateur ne vote pas pour sa propre photo (sécurité côté serveur)
    // À toi d'ajouter ici si besoin une vérification supplémentaire en BDD

    // On ajoute (ou met à jour) le vote dans la BDD
    ajoutVoteBDD($id_photo, $pseudo, $note);
}

// Après le vote, on retourne à l'accueil (redirection)
header("Location: accueil.php#photo" . $id_photo);
exit();
// Note : On utilise l'ID de la photo pour rediriger l'utilisateur vers la photo votée
// afin qu'il puisse voir son vote et la note mise à jour.
