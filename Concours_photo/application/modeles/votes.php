<?php
require_once('connect.php');
function obtenirVote($id_photo, $pseudo) {
    // Cette fonction récupère la valeur du vote d'un utilisateur pour une photo donnée
    // Elle retourne la valeur du vote (ex : 3, 4, 5...) ou null si aucun vote n'existe
    $dbh = connect();
    $sql = "SELECT valeur_vote FROM vote WHERE photo_vote = :id_photo AND utilisateur_vote = :pseudo";
    $sth = $dbh->prepare($sql);
    $sth->execute([':id_photo' => $id_photo, ':pseudo' => $pseudo]);
    $vote = $sth->fetch(PDO::FETCH_ASSOC);

    if ($vote) {
        return $vote['valeur_vote']; // ex : 3, 4, 5...
    } else {
        return null; // Pas de vote trouvé
    }
}

function ajoutVoteBDD($id_photo, $pseudo, $note) {
    $dbh = connect();

    // On vérifie si un vote existe déjà pour ce couple photo/utilisateur
    if (obtenirVote($id_photo, $pseudo) != "") {
        // On supprime l'ancien vote
        $sql = "DELETE FROM vote WHERE photo_vote = :id_photo AND utilisateur_vote = :pseudo";
        $sth = $dbh->prepare($sql);
        $sth->execute([':id_photo' => $id_photo, ':pseudo' => $pseudo]);
    }

    // On insère le nouveau vote
    $sql = "INSERT INTO vote (photo_vote, utilisateur_vote, valeur_vote) VALUES (:id_photo, :pseudo, :note)";
    $sth = $dbh->prepare($sql);
    $sth->execute([':id_photo' => $id_photo, ':pseudo' => $pseudo, ':note' => $note]);
}

function moyenneVotes($id_photo) {
    $dbh = connect();

    // Cette fonction calcule la moyenne des votes pour une photo donnée
    // Elle retourne la moyenne arrondie à 2 chiffres après la virgule, ou "" si pas de vote
    $sql = "SELECT AVG(valeur_vote) as moyenne FROM vote WHERE photo_vote = :id_photo";
    $sth = $dbh->prepare($sql);
    $sth->execute([':id_photo' => $id_photo]);
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    
    // On retourne la moyenne arrondie à 2 chiffres après la virgule, ou "" si pas de vote
    // On vérifie que la moyenne n'est pas null (c'est le cas si aucun vote)
    if ($result && $result['moyenne'] !== null) {
        return round($result['moyenne'], 2);
    } else {
        return "";
    }
}


