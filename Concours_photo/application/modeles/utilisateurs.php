<?php
function connexionOk($pseudo, $pw)
{
    require('../modeles/connect.php');
    $dbh = connect();

    $sql = "SELECT pseudo_utilisateur,mdp_utilisateur FROM utilisateur WHERE pseudo_utilisateur=? AND mdp_utilisateur=?";
    $sth = $dbh->prepare( $sql);
    $sth->execute([$pseudo, $pw]);
    $result = $sth->fetch();

    if (empty($result)) {
        return false;
    }
    return true;
}

function inscriptionOk($pseudo, $mail)
{
    $dbh = connect();
    // Vérifie si le pseudo ou le mail existe déjà dans la base de données
    // Si l'un des deux existe, la fonction retourne false
    $sql = "SELECT * FROM utilisateur WHERE pseudo_utilisateur = :pseudo OR mail_utilisateur = :mail";
    $sth = $dbh->prepare($sql);
    $sth->execute([':pseudo' => $pseudo, ':mail' => $mail]);

    $result = $sth->fetch(PDO::FETCH_ASSOC);
    return $result === false;
}

function ajouterUtilisateur($pseudo, $mail, $mdp)
{
    $dbh = connect();
    // Préparation de la requête pour insérer un nouvel utilisateur dans la base de données
    $sql = "INSERT INTO utilisateur (pseudo_utilisateur, mail_utilisateur, mdp_utilisateur)
            VALUES (:pseudo, :mail, :mdp)";
    $sth = $dbh->prepare($sql);
    $sth->execute([':pseudo' => $pseudo, ':mail' => $mail, ':mdp' => $mdp]);
}
