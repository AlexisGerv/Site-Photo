<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/global.css">
    
    <title>Site de concours photo</title>
</head>

<body>
    <header>
        <div>
            <a href="accueil.php">Accueil</a>

            <?php if(isset($_SESSION['pseudo'])): ?>
                <span>Bienvenue, <?=($_SESSION['pseudo'])?> !</span>
                <a href="deconnexion.php">Se déconnecter</a>
                <a href="../vues/vuePhoto.php">Poster photo</a>
            <?php else: ?>
                <a href="connexion.php">Se connecter</a>
                <a href="inscription.php">S'inscrire</a>
            <?php endif; ?>
        </div>

    </header>
</body>
</html>