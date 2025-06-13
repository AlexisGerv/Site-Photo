<?php

function obtenirPhotos() {
    require('../modeles/connect.php');
    $dbh = connect();

    $sql = "SELECT * FROM photo";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $results = $sth->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}

function importPhoto($auteur, $description, $date, $titre, $chemin) {
    $dbh = connect();
    $sql = "INSERT INTO photo (auteur_photo, description_photo, chemin_photo, date_photo, titre_photo)
            VALUES (:auteur, :description, :chemin, :date, :titre)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([
        ':auteur' => $auteur,
        ':description' => $description,
        ':chemin' => $chemin,
        ':date' => $date,
        ':titre' => $titre
    ]);
}

?>
