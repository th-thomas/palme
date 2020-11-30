<?php


namespace Controleur;


use Metier\Adherent;
use Modele\DAOAdherent;
use Vue\Vue;

class Controleur
{
    public function accueil()
    {
        session_start();
        $vue = new Vue("Accueil");
        $vue->generer(array());
    }

    public function connexion()
    {
        session_start();
        $vue = new Vue("Connexion");
        $vue->generer(array());
    }

    public function validerConnexion()
    {
        session_start();
        $adherent = DAOAdherent::getAdherentLogin($_POST['login']);
        if (!$adherent) {
            $msgErreurConnexion = "echecId";
            $vue = new Vue("Connexion");
            $vue->generer(array('msgErreurConnexion' => $msgErreurConnexion));
        }
        else {
            if ($_POST['motdepasse'] == $adherent->getMdp()) {
                $utilisateurConnecte = $adherent;
                $vue = new Vue("Connexion");
                $vue->generer(array('utilisateurConnecte' => $utilisateurConnecte));
            }
            else {
                $msgErreurConnexion = "echecMdp";
                $vue = new Vue("Connexion");
                $vue->generer(array('msgErreurConnexion' => $msgErreurConnexion));
            }
        }
    }

    public function annuaire()
    {
        session_start();
        if (isset($_SESSION['utilisateur'])) {
            $lesAdherents = ($_SESSION['utilisateur']->estAutoriseSecretariat()) ? DAOAdherent::getAdherents() : DAOAdherent::getAdherentsActifs();
            $vue = new Vue("Annuaire");
            $vue->generer(array('adherents' => $lesAdherents));
        }
        else {
            $this->erreur('Vous n\'êtes pas autorisé à consulter cette page.');
        }
    }

    public function trombi()
    {
        session_start();
        if (isset($_SESSION['utilisateur'])) {
            $lesAdherents = ($_SESSION['utilisateur']->estAutoriseSecretariat()) ? DAOAdherent::getAdherents() : DAOAdherent::getAdherentsActifs();
            $vue = new Vue("Trombi");
            $vue->generer(array('adherents' => $lesAdherents));
        }
        else {
            $this->erreur('Vous n\'êtes pas autorisé à consulter cette page.');
        }
    }

    public function afficheAdherent($identifiant)
    {
        session_start();
        if (isset($_SESSION['utilisateur'])) {
            $adherent = DAOAdherent::getAdherent($identifiant);
            $vue = new Vue("Adherent");
            $vue->generer(array('adherent' => $adherent));
        }
        else {
            $this->erreur('Vous n\'êtes pas autorisé à consulter cette page.');
        }
    }

    public function archiver($identifiant = null)
    {
        session_start();
        if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']->estAutoriseSecretariat()) {
            if ($identifiant != null) {
                DAOAdherent::archiverAdherent($identifiant);
                self::trombi();
            }
            else {
                $this->erreur('Cette page n\'existe pas.');
            }
        }
        else {
            $this->erreur('Vous n\'êtes pas autorisé à consulter cette page.');
        }
    }

    public function desarchiver($identifiant = null)
    {
        session_start();
        if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']->estAutoriseSecretariat()) {
            if ($identifiant != null) {
                DAOAdherent::desarchiverAdherent($identifiant);
                self::trombi();
            }
            else {
                $this->erreur('Cette page n\'existe pas.');
            }
        }
        else {
            $this->erreur('Vous n\'êtes pas autorisé à consulter cette page.');
        }
    }

    public function nouvelAdherent()
    {
        session_start();
        if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']->estAutoriseSecretariat()) {
            $idLibre = DAOAdherent::getIDlibre();
            $vue = new Vue("NouvelAdherent");
            $vue->generer(array('idLibre' => $idLibre));
        }
        else {
            $this->erreur('Vous n\'êtes pas autorisé à consulter cette page.');
        }
    }

    public function validerNouvelAdherent()
    {
        session_start();
        if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']->estAutoriseSecretariat()) {
            $identifiant = DAOAdherent::getIDlibre();
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $dateNaissance = new \DateTime($_POST['datenaissance']);
            $dateInscription = new \DateTime(date("Y-m-d"));
            $dateFinCertifMed = new \DateTime($_POST['datefincertifmed']);
            $login = strtolower(substr($prenom,0,1).$prenom);
            $mdp = $login.'pwd';
            $adherent = new Adherent($identifiant,$nom,$prenom,$dateNaissance,$dateInscription,$dateFinCertifMed,$login,$mdp);
            DAOAdherent::inscrireAdherent($adherent);
            self::afficheAdherent($identifiant);
        }
        else {
            $this->erreur('Vous n\'êtes pas autorisé à consulter cette page.');
        }
    }

    public function validerNouveauMdp()
    {
        session_start();
        if (isset($_SESSION['utilisateur'])) {
            if (isset($_POST['nvMdp']) && isset($_POST['mdpActuel'])) {
                if ($_POST['mdpActuel'] == $_SESSION['utilisateur']->getMdp()) {
                    if ($_POST['nvMdp'] == '') {
                        $msg = 'Erreur lors de la saisie du nouveau mot de passe : il ne doit pas être vide.';
                        $vue = new Vue("MonCompte");
                        $vue->generer(array('msg' => $msg));
                    }
                    else {
                        $identifiant = $_SESSION['utilisateur']->getIdentifiant();
                        DAOAdherent::changerMotDePasse($_SESSION['utilisateur'], $_POST['nvMdp']);
                        $msg = '';
                        session_destroy();
                        session_start();
                        $_SESSION['utilisateur'] = DAOAdherent::getAdherent($identifiant);
                        $vue = new Vue("MonCompte");
                        $vue->generer(array('msg' => $msg));
                    }
                }
                else {
                    $msg = 'Erreur lors de la saisie du mot de passe actuel.';
                    $vue = new Vue("MonCompte");
                    $vue->generer(array('msg' => $msg));
                }
            }
            else {
                $this->erreur('Cette page n\'existe pas.');
            }
        }
        else {
            $this->erreur('Vous n\'êtes pas autorisé à consulter cette page.');
        }
    }

    public function monCompte()
    {
        session_start();
        if (isset($_SESSION['utilisateur'])) {
            $vue = new Vue("MonCompte");
            $vue->generer(array());
        }
        else {
            $this->erreur('Vous n\'êtes pas autorisé à consulter cette page.');
        }
    }

    public function deconnexion()
    {
        session_start();
        session_destroy();
        $this->accueil();
    }

    public function erreur(string $msgErreur)
    {
        session_start();
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}