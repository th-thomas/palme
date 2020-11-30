<?php


namespace Controleur;

use Exception;

require 'Controleur.php';

class Routeur
{
    private Controleur $controleur;

    public function __construct()
    {
        $this->controleur = new Controleur();
    }

    public function routerRequete()
    {
        try {
            if (isset($_GET['action'])) {
                $action = $_GET['action'];
                if ($action == 'trombi') {
                    $this->controleur->trombi();
                }
                else if ($action == 'annuaire') {
                    $this->controleur->annuaire();
                }
                else if ($action == 'adherent') {
                    if (isset($_GET['id'])) {
                        $this->controleur->afficheAdherent($_GET['id']);
                    }
                }
                else if ($action == 'archiver') {
                    if (isset($_GET['id'])) {
                        $this->controleur->archiver($_GET['id']);
                    }
                    else {
                        $this->controleur->erreur('Cette page n\'existe pas.');
                    }
                }
                else if ($action == 'desarchiver') {
                    if (isset($_GET['id'])) {
                        $this->controleur->desarchiver($_GET['id']);
                    }
                    else {
                        $this->controleur->erreur('Cette page n\'existe pas.');
                    }
                }
                else if ($action == 'nouveladherent') {
                    $this->controleur->nouvelAdherent();
                }
                else if ($action == 'validernouvadh') {
                    $this->controleur->validerNouvelAdherent();
                }
                else if ($action == 'connexion') {
                    $this->controleur->connexion();
                }
                else if ($action == 'validerConnexion') {
                    $this->controleur->validerConnexion();
                }
                else if ($action == 'monCompte') {
                    $this->controleur->monCompte();
                }
                else if ($action == 'nouveauMdp') {
                    $this->controleur->validerNouveauMdp();
                }
                else if ($action == 'deconnexion') {
                    $this->controleur->deconnexion();
                }
                else {
                    $this->controleur->accueil();
                }
            }
            else {
                $this->controleur->accueil();
            }
        }
        catch (Exception $e) {
            echo '<html><body>Erreur ! ' . $e->getMessage() . '</body></html>';
        }

    }
}