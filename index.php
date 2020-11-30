<?php

use Controleur\Routeur;

require __DIR__ . '/vendor/autoload.php';
require __DIR__.'/Controleur/Routeur.php';

$routeur = new Routeur();
$routeur->routerRequete();