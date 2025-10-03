<?php 
require('header.php');
?>

<?php if(isset($_SESSION['error'])): ?>
    <p class="erreur"><?= ($_SESSION['error']) ?></p>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<form action="connexion.php" method="post" class="form-connexion">
    <h2>Connexion</h2>
    <p>Veuillez entrer vos identifiants pour vous connecter.</p>
    <label for="pseudo">Entrer votre pseudo :</label>
    <input type="text" name="pseudo" id="pseudo" placeholder="Alexis" required>

    <label for="mdp">Entrez votre mot de passe :</label>
    <input type="text" name="mdp" id="mdp" required>

    <input type="submit" value="Connexion">
</form>

<?php require('footer.php')?>