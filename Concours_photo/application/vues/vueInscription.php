<?php require('header.php'); ?>

<h2>Inscription</h2>

<?php if (isset($erreur))
    echo "<p style='color:red;'>$erreur</p>"; ?>

<form action="inscription.php" method="POST">
    <label for="pseudo">Pseudo :</label>
    <input type="text" name="pseudo" required>

    <label for="mail">Mail :</label>
    <input type="email" name="mail" required>

    <label for="mdp">Mot de passe :</label>
    <input type="password" name="mdp" required>

    <button type="submit">S'inscrire</button>
</form>

<?php require('footer.php'); ?>