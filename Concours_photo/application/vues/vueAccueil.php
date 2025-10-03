<?php
require('header.php');
require_once('../modeles/votes.php');

?>



<main>

    <h2>Bienvenue dans la galerie photo</h2>
    <p>Découvrez ici les photos postées par les utilisateurs !</p>
    <section class="galerie">
        <?php foreach ($listePhotos as $photo): ?>
            <article id="photo<?= $photo['id_photo'] ?> " class="photo">

                <div id="plein-ecran" style="display: none;"></div>
                <img src="../../<?= $photo['chemin_photo'] ?>" alt="<?= $photo['titre_photo'] ?>" width="300"
                    id="<?= $photo['id_photo'] ?>" class="image-cliquable">
                <div class="title">
                    <p>Titre : <?= $photo['titre_photo'] ?></p>
                </div>
                <div class="date">
                    <p>Date d’ajout : <?= $photo['date_photo'] ?></p>
                </div>
                <div class="auteur">
                    <p>Auteur : <?= $photo['auteur_photo'] ?></p>
                </div>
                <div class="desc">
                    <p>Description : <?= $photo['description_photo'] ?></p>
                </div>

                <?php
                $userVote = "";
                if (isset($_SESSION['pseudo'])) {
                    $userVote = obtenirVote($photo['id_photo'], $_SESSION['pseudo']);
                }
                ?>

                <?php
                $moyenne = moyenneVotes($photo['id_photo']);
                echo ($moyenne !== "")
                    ? "<p>Note moyenne : <strong>$moyenne / 5</strong></p>"
                    : "<p>Pas encore de note</p>";
                ?>


                <?php if (isset($_SESSION['pseudo']) && $_SESSION['pseudo'] !== $photo['auteur_photo']): ?>
                    <form action="../controleurs/gestionVotes.php" method="POST" class="vote-form">
                        <h3>Voter pour cette photo</h3>
                        <input type="hidden" name="id_photo" value="<?= $photo['id_photo'] ?>">
                        <div>
                            <input type="radio" id="star1-<?= $photo['id_photo'] ?>" name="note" value="1" <?= ($userVote == 1) ? 'checked' : '' ?> required>
                            <label for="star1-<?= $photo['id_photo'] ?>">★</label>

                            <input type="radio" id="star2-<?= $photo['id_photo'] ?>" name="note" value="2" <?= ($userVote == 2) ? 'checked' : '' ?> required>
                            <label for="star2-<?= $photo['id_photo'] ?>">★</label>

                            <input type="radio" id="star3-<?= $photo['id_photo'] ?>" name="note" value="3" <?= ($userVote == 3) ? 'checked' : '' ?> required>
                            <label for="star3-<?= $photo['id_photo'] ?>">★</label>

                            <input type="radio" id="star4-<?= $photo['id_photo'] ?>" name="note" value="4" <?= ($userVote == 4) ? 'checked' : '' ?> required>
                            <label for="star4-<?= $photo['id_photo'] ?>">★</label>

                            <input type="radio" id="star5-<?= $photo['id_photo'] ?>" name="note" value="5" <?= ($userVote == 5) ? 'checked' : '' ?> required>
                            <label for="star5-<?= $photo['id_photo'] ?>">★</label>
                        </div>
                        <button type="submit"><?= $userVote ? "Modifier mon vote" : "Voter" ?></button>
                    </form>

                    <?php
                    if ($userVote) {
                        echo "<p>Votre note : <strong>$userVote ★</strong></p>";
                    }
                    ?>

                <?php elseif (isset($_SESSION['pseudo']) && $_SESSION['pseudo'] === $photo['auteur_photo']): ?>
                    <p><em>Vous ne pouvez pas voter pour votre propre photo.</em></p>
                <?php endif; ?>

            </article>
        <?php endforeach; ?>
    </section>
</main>

<?php require('footer.php'); ?>