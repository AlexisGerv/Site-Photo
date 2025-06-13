<?php 
require('header.php');
?>

<?php if(isset($_SESSION['error'])): ?>
    <p class="erreur"><?= ($_SESSION['error']) ?></p>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<form action="connexion.php" method="post">
    <label for="pseudo">Entrer votre pseudo :</label>
    <input type="text" name="pseudo" id="pseudo" placeholder="Alexis" required>

    <label for="password">Entrez votre mot de passe :</label>
    <input type="text" name="password" id="password" required>

    <input type="submit" value="Connexion">
</form>

<?php require('footer.php')?>