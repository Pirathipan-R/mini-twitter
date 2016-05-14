<?php

function __autoload( $class_name ) {
    if (file_exists('model/' . strtolower( $class_name ) . '.model.php' ))
    {
        require_once 'model/' . strtolower( $class_name ) . '.model.php';
    }
    else
    {
        throw new Exception("Impossible de charger la classe $class_name.");
    }
};

define("GDS", "ProjetPHP");

$authorized_pages = array(
    "connexion",
    "accueil",
    "profil",
    "abonnements",
    "parametres"
);