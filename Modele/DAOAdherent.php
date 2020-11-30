<?php


namespace Modele;


use DateTime;
use Metier\Adherent;
use PDO;

/**
 * Classe DAOAdherent
 * Fournit les méthodes de CRUD pour la classe Adherent
 * @package Modele
 */
class DAOAdherent
{
    /**
     * @return array Tous les adhérents (actifs et archivés)
     */
    public static function getAdherents() : array
    {
        $requete = 'SELECT a.id_adh, estactif_adh, nom_adh, prenom_adh, datenaissance_adh, dateinscription_adh, datefincertifmed_adh, fonctionbureau_adh, estresponsablemateriel_adh, estresponsableplanning_adh, login_adh, mdp_adh, c.id_adh as idcoach, e.id_adh as identraineur FROM adherent a LEFT JOIN entraineur e on a.id_adh = e.id_adh LEFT JOIN coach c on e.id_adh = c.id_adh ORDER BY a.nom_adh ASC';
        $resultatsRequete = DBInterface::executerRequete($requete);
        $adherents = array();
        foreach ($resultatsRequete as $ligneDeResultat) {
            $numero = $ligneDeResultat['id_adh'];
            $adherents[$numero] = self::newAdherent($ligneDeResultat);
        }
        return $adherents;
    }

    /**
     * @return array Liste (array) des adhérents actifs
     */
    public static function getAdherentsActifs() : array
    {
        $requete = 'SELECT a.id_adh, estactif_adh, nom_adh, prenom_adh, datenaissance_adh, dateinscription_adh, datefincertifmed_adh, fonctionbureau_adh, estresponsablemateriel_adh, estresponsableplanning_adh, login_adh, mdp_adh, c.id_adh as idcoach, e.id_adh as identraineur FROM adherent a LEFT JOIN entraineur e on a.id_adh = e.id_adh LEFT JOIN coach c on e.id_adh = c.id_adh WHERE estactif_adh = 1 ORDER BY nom_adh ASC';
        $resultatsRequete = DBInterface::executerRequete($requete);
        $adherents = array();
        foreach ($resultatsRequete as $ligneDeResultat) {
            $numero = $ligneDeResultat['id_adh'];
            $adherents[$numero] = self::newAdherent($ligneDeResultat);
        }
        return $adherents;
    }

    public static function getAdherent(string $identifiant) : Adherent
    {
        $requete = 'SELECT a.id_adh, estactif_adh, nom_adh, prenom_adh, datenaissance_adh, dateinscription_adh, datefincertifmed_adh, fonctionbureau_adh, estresponsablemateriel_adh, estresponsableplanning_adh, login_adh, mdp_adh, c.id_adh as idcoach, e.id_adh as identraineur FROM adherent a LEFT JOIN entraineur e on a.id_adh = e.id_adh LEFT JOIN coach c on e.id_adh = c.id_adh WHERE a.id_adh = ?';
        $resultatsRequete = DBInterface::executerRequete($requete,[$identifiant])->fetch(PDO::FETCH_ASSOC);
        return self::newAdherent($resultatsRequete);
    }

    public static function getAdherentLogin(string $login)
    {
        $requete = 'SELECT a.id_adh, estactif_adh, nom_adh, prenom_adh, datenaissance_adh, dateinscription_adh, datefincertifmed_adh, fonctionbureau_adh, estresponsablemateriel_adh, estresponsableplanning_adh, login_adh, mdp_adh, c.id_adh as idcoach, e.id_adh as identraineur FROM adherent a LEFT JOIN entraineur e on a.id_adh = e.id_adh LEFT JOIN coach c on e.id_adh = c.id_adh WHERE login_adh = ?';
        $resultatsRequete = DBInterface::executerRequete($requete,[$login])->fetch(PDO::FETCH_ASSOC);
        return ($resultatsRequete) ? self::newAdherent($resultatsRequete) : false;
    }

    public static function newAdherent(array $ligneDeResultat) : Adherent
    {
        $identifiant = $ligneDeResultat['id_adh'];
        $estActif = $ligneDeResultat['estactif_adh'];
        $nom = $ligneDeResultat['nom_adh'];
        $prenom = $ligneDeResultat['prenom_adh'];
        $dateNaissance = new DateTime($ligneDeResultat['datenaissance_adh']);
        $dateInscription = new DateTime($ligneDeResultat['dateinscription_adh']);
        $dateFinCertifMed = new DateTime($ligneDeResultat['datefincertifmed_adh']);
        $estEntraineur = ($ligneDeResultat['identraineur'] == null) ? false : true;
        $estCoach = ($ligneDeResultat['idcoach'] == null) ? false : true;
        $fonctionBureau = $ligneDeResultat['fonctionbureau_adh'];
        $estRespMateriel = $ligneDeResultat['estresponsablemateriel_adh'];
        $estRespPlanning = $ligneDeResultat['estresponsableplanning_adh'];
        $login = $ligneDeResultat['login_adh'];
        $mdp = $ligneDeResultat['mdp_adh'];

        return new Adherent($identifiant,$nom,$prenom,$dateNaissance,$dateInscription,$dateFinCertifMed,$login,$mdp,$estActif,$estEntraineur,$estCoach,$fonctionBureau,$estRespMateriel,$estRespPlanning);
    }

    public static function archiverAdherent(string $identifiant)
    {
        // Le '?' est un placeholder : on utilise la méthode PDO::prepare à laquelle on donne comme argument $identifiant qui vient prendre la place du placeholder
        $requete = 'UPDATE adherent SET estactif_adh = 0 WHERE id_adh = ?';
        DBInterface::executerRequete($requete, [$identifiant]);
    }

    public static function desarchiverAdherent(string $identifiant)
    {
        // Le '?' est un placeholder : on utilise la méthode PDO::prepare à laquelle on donne comme argument $identifiant qui vient prendre la place du placeholder
        $requete = 'UPDATE adherent SET estactif_adh = 1 WHERE id_adh = ?';
        DBInterface::executerRequete($requete, [$identifiant]);
    }
    /**
     * Méthode Insert
     * @param Adherent $adherent
     */
    public static function inscrireAdherent(Adherent $adherent)
    {
        $id = $adherent->getIdentifiant();
        $estActif = ($adherent->getEstActif()) ? 1 : 0;
        $nom = $adherent->getNom();
        $prenom = $adherent->getPrenom();
        $dateNaissance = $adherent->getDateNaissance()->format("Y-m-d");
        $dateInscription = $adherent->getDateInscription()->format("Y-m-d");
        $dateFinCertifMed = $adherent->getDateFinCertifMed()->format("Y-m-d");
        $fonctionBureau = ($adherent->getFonctionBureau() == 'Aucune') ? NULL : $adherent->getFonctionBureau();
        $estRespMateriel = ($adherent->getEstRespMateriel()) ? 1 : 0;
        $estRespPlanning = ($adherent->getEstRespPlanning()) ? 1 : 0;
        $login = $adherent->getLogin();
        $mdp = $adherent->getMdp();
        $requete = 'INSERT INTO adherent (id_adh, estactif_adh, nom_adh, prenom_adh, datenaissance_adh, dateinscription_adh, datefincertifmed_adh, fonctionbureau_adh, estresponsablemateriel_adh, estresponsableplanning_adh, login_adh, mdp_adh) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)';
        $param = array($id,$estActif,$nom,$prenom,$dateNaissance,$dateInscription,$dateFinCertifMed,$fonctionBureau,$estRespMateriel,$estRespPlanning,$login,$mdp);
        DBInterface::executerRequete($requete,$param);
    }

    public static function getIDlibre()
    {
        $requete = 'SELECT MAX(id_adh) FROM adherent';
        $maxId = DBInterface::executerRequete($requete)->fetch(PDO::FETCH_ASSOC);
        $maxId = $maxId["MAX(id_adh)"];
        return ++$maxId;
    }

    /**
     * @param Adherent $adherent L'adhérent dont il faut mettre à jour le mot de passe
     * @param string $nouveauMdp Le nouveau mot de passe
     */
    public static function changerMotDePasse(Adherent $adherent, string $nouveauMdp)
    {
        $identifiant = $adherent->getIdentifiant();
        $requete = 'UPDATE adherent SET mdp_adh = ? WHERE id_adh = ?';
        DBInterface::executerRequete($requete,array($nouveauMdp,$identifiant));
    }
}