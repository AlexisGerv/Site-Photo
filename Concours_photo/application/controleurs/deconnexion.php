<?php

// Déconnexion de l'utilisateur
session_start();
session_unset();

header('location: accueil.php');
exit();
?>