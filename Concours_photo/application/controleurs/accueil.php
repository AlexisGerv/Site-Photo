<?php
session_start();
// Controleur pour la page d'accueil
// Charge les modèles et les vues nécessaires
require('../modeles/photos.php');
$listePhotos = obtenirPhotos();
require('../vues/vueAccueil.php');

