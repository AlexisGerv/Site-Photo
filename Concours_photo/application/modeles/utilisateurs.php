<?php 
function connexionOk($pseudo, $pw){
    require('../modeles/connect.php');
    $dbh = connect();

    $sql = "SELECT pseudo_utilisateur,mdp_utilisateur FROM utilisateur WHERE pseudo_utilisateur=? AND mdp_utilisateur=?";
    $sth = $dbh->prepare(query: $sql);
    $sth ->execute(params: Array($pseudo, $pw));
    $result = $sth->fetch();

    if ($result ="") {
        return false;
    }

    return true;
}

function inscriptionOk($pseudo, $mail) {
    $dbh = connect();
    $sql = "SELECT * FROM utilisateur WHERE pseudo_utilisateur = :pseudo OR mail_utilisateur = :mail";
    $sth = $dbh->prepare($sql);
    $sth->execute([
        ':pseudo' => $pseudo,
        ':mail' => $mail
    ]);

    $result = $sth->fetch(PDO::FETCH_ASSOC);
    return $result === false; 
}

function ajouterUtilisateur($pseudo, $mail, $mdp) {
    $dbh = connect();
    $sql = "INSERT INTO utilisateur (pseudo_utilisateur, mail_utilisateur, mdp_utilisateur)
            VALUES (:pseudo, :mail, :mdp)";
    $sth = $dbh->prepare($sql);
    $sth->execute([
        ':pseudo' => $pseudo,
        ':mail' => $mail,
        ':mdp' => $mdp
    ]);
}
