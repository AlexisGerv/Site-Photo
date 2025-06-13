<?php
session_start();

require('../modeles/photos.php');
$listePhotos = obtenirPhotos();
require('../vues/vueAccueil.php');

