<?php
require('header.php');
?>
<?php
require_once('../modeles/votes.php');
?>

<?php if (isset($_SESSION['error'])): ?>
    <p class="erreur"><?= ($_SESSION['error']) ?></p>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<h1>Bienvenue dans la galerie photo</h1>
<p>Découvrez ici les photos !</p>
<section class="galerie">
    <?php foreach ($listePhotos as $photo): ?>
        <article id="photo<?= $photo['id_photo'] ?> " class="photo">
            <img src="../../<?= $photo['chemin_photo'] ?>" alt="<?= $photo['titre_photo'] ?>" width="300">
            <p>Titre : <?= $photo['titre_photo'] ?></p>
            <p>Date d’ajout : <?= $photo['date_photo'] ?></p>
            <p>Auteur : <?= $photo['auteur_photo'] ?></p>
            <p>Description : <?= $photo['description_photo'] ?></p>
            <?php
            $userVote = null;
            if (isset($_SESSION['pseudo'])) {
                // On suppose que la fonction obtenirVote est déjà incluse et disponible
                $userVote = obtenirVote($photo['id_photo'], $_SESSION['pseudo']);
            }
            ?>

            <?php
            $moyenne = moyenneVotes($photo['id_photo']);
            if ($moyenne !== null) {
                echo "<p>Note moyenne : <strong>$moyenne / 5</strong></p>";
            } else {
                echo "<p>Pas encore de note</p>";
            }
            ?>


            <?php if (isset($_SESSION['pseudo']) && $_SESSION['pseudo'] !== $photo['auteur_photo']): ?>
                <form action="../controleurs/gestionVotes.php" method="POST" class="vote-form">
                    <h3>Voter pour cette photo</h3>
                    <input type="hidden" name="id_photo" value="<?= $photo['id_photo'] ?>">

                    <div class="stars">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <input type="radio" id="star<?= $i ?>-<?= $photo['id_photo'] ?>" name="note" value="<?= $i ?>"
                                <?= ($userVote == $i) ? 'checked' : '' ?> required>
                            <label for="star<?= $i ?>-<?= $photo['id_photo'] ?>"
                                title="<?= $i ?> étoile<?= $i > 1 ? 's' : '' ?>">⭐</label>
                        <?php endfor; ?>
                    </div>

                    <button type="submit"><?= $userVote ? "Modifier mon vote" : "Voter" ?></button>
                </form>
                <?php if ($userVote): ?>
                    <p>Votre note : <strong><?= $userVote ?> ⭐</strong></p>
                <?php endif; ?>
            <?php elseif (isset($_SESSION['pseudo']) && $_SESSION['pseudo'] === $photo['auteur_photo']): ?>
                <p><em>Vous ne pouvez pas voter pour votre propre photo.</em></p>
            <?php endif; ?>
        </article>
    <?php endforeach; ?>
</section>
<?php require('footer.php'); ?>