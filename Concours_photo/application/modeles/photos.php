<?php


function obtenirPhotos() {
    // Connexion à la base de données
    require('../modeles/connect.php');
    $dbh = connect();
    // Préparation et exécution de la requête pour obtenir toutes les photos
    $sql = "SELECT * FROM photo";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $results = $sth->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}

function importPhoto($auteur, $description, $date, $titre, $chemin) {
    $dbh = connect();
    // Préparation de la requête pour insérer une nouvelle photo dans la base de données
    $sql = "INSERT INTO photo (auteur_photo, description_photo, chemin_photo, date_photo, titre_photo)
            VALUES (:auteur, :description, :chemin, :date, :titre)";
    $sth = $dbh->prepare($sql);
    $sth->execute([':auteur' => $auteur, ':description' => $description, ':chemin' => $chemin, ':date' => $date, ':titre' => $titre]);
}

?>
