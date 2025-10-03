<?php
require('header.php');

?>

<?php if (isset($message))
    echo "<p style='color:green;'>$message</p>"; ?>
<?php if (isset($erreur))
    echo "<p style='color:red;'>$erreur</p>"; ?>

<form action="../controleurs/posterPhoto.php" method="POST" enctype="multipart/form-data" class="form-posterPhoto">
    <h2>Importer une nouvelle photo</h2>

    <label for="titre">Titre :</label>
    <input type="text" name="titre" id="titre" required><br>

    <label for="description">Description :</label>
    <textarea name="description" id="description" required></textarea><br>

    <label for="photo">Image :</label>
    <input type="file" name="photo" id="photo" accept="image/*" required><br>

    <button type="submit">Importer</button>
</form>

<?php require('footer.php'); ?>