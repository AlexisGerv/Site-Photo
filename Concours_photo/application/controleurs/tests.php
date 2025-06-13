<?php


require_once('../modeles/votes.php');

$id_photo = 2; // une photo existante
$pseudo = 'aline'; // un utilisateur existant
$note = 4;

// Ajout d'un vote
ajoutVoteBDD($id_photo, $pseudo, $note);

// Récupération du vote pour vérifier
$vote = obtenirVote($id_photo, $pseudo);
echo "Vote trouvé : " . ($vote ?? "aucun vote");
if ($vote !== null) {
    echo " Le vote de $pseudo pour la photo $id_photo est de $vote.";
} else {
    echo " Aucun vote trouvé pour la photo $id_photo par l'utilisateur $pseudo.";
}   
?>