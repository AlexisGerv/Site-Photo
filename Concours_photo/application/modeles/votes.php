<?php
require_once('connect.php');
function obtenirVote($id_photo, $pseudo) {
    $dbh = connect();
    $sql = "SELECT valeur_vote FROM vote WHERE photo_vote = :id_photo AND utilisateur_vote = :pseudo";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([
        ':id_photo' => $id_photo,
        ':pseudo' => $pseudo
    ]);
    $vote = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($vote) {
        return $vote['valeur_vote']; // ex : 3, 4, 5...
    } else {
        return null; // Pas de vote trouvé
    }
}

function ajoutVoteBDD($id_photo, $evaluateur, $note) {
    $dbh = connect();

    // On vérifie si un vote existe déjà pour ce couple photo/utilisateur
    if (obtenirVote($id_photo, $evaluateur) != null) {
        // On supprime l'ancien vote
        $sql = "DELETE FROM vote WHERE photo_vote = :id_photo AND utilisateur_vote = :pseudo";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':id_photo' => $id_photo,
            ':pseudo' => $evaluateur
        ]);
    }

    // On insère le nouveau vote
    $sql = "INSERT INTO vote (photo_vote, utilisateur_vote, valeur_vote) VALUES (:id_photo, :pseudo, :note)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([
        ':id_photo' => $id_photo,
        ':pseudo' => $evaluateur,
        ':note' => $note
    ]);
}

function moyenneVotes($id_photo) {
    $dbh = connect();
    $sql = "SELECT AVG(valeur_vote) as moyenne FROM vote WHERE photo_vote = :id_photo";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([':id_photo' => $id_photo]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    // On retourne la moyenne arrondie à 2 chiffres après la virgule, ou null si pas de vote
    return $result && $result['moyenne'] !== null ? round($result['moyenne'], 2) : null;
}
