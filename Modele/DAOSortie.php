<?php


namespace Modele;


use DateTime;
use Metier\Sortie;

class DAOSortie
{
    public static function getSorties() : array
    {
        //$requete = 'SELECT * FROM sortie s, entraineur e, adherent a WHERE s.id_adh = e.id_adh AND e.id_adh = a.id_adh ORDER BY id_sortie ASC';
        $requete = 'SELECT id_sortie, jour_sortie, lieurdv_sortie, heurerdv_sortie, plage_sortie, heuremisealeau_sortie, niveaupublic_sortie, mentionhiver_sortie, s.id_adh, c.id_adh AS idcoach, e.id_adh AS identraineur, a.id_adh, estactif_adh, nom_adh, prenom_adh, datenaissance_adh, dateinscription_adh, datefincertifmed_adh, fonctionbureau_adh, estresponsablemateriel_adh, estresponsableplanning_adh, login_adh, mdp_adh FROM sortie s, entraineur e, coach c, adherent a WHERE s.id_adh = e.id_adh AND e.id_adh = a.id_adh AND c.id_adh = e.id_adh ORDER BY id_sortie ASC';
        $resultatsRequete = DBInterface::executerRequete($requete);
        $sorties = array();
        foreach ($resultatsRequete as $ligneDeResultat) {
            $numero = $ligneDeResultat['id_sortie'];
            $sorties[$numero] = self::newSortie($ligneDeResultat);
        }
        return $sorties;
    }

    private static function newSortie(array $ligneDeResultat) : Sortie
    {
        $identifiant = $ligneDeResultat['id_sortie'];
        $jour = new DateTime($ligneDeResultat['jour_sortie']);
        $strJour = $jour->format('Y-m-d');
        $lieuRDV = $ligneDeResultat['lieurdv_sortie'];
        $heureRDV = DateTime::createFromFormat('Y-m-d H:i:s',$strJour.' '.$ligneDeResultat['heurerdv_sortie']);
        $plage = $ligneDeResultat['plage_sortie'];
        $heureMiseAlEau = DateTime::createFromFormat('Y-m-d H:i:s',$strJour.' '.$ligneDeResultat['heuremisealeau_sortie']);
        $niveauPublic = $ligneDeResultat['niveaupublic_sortie'];
        $mentionFacultative = $ligneDeResultat['mentionhiver_sortie'];
        $entraineurEncadrant = DAOAdherent::newAdherent($ligneDeResultat);
        return new Sortie($identifiant,$jour,$lieuRDV,$heureRDV,$plage,$heureMiseAlEau,$niveauPublic,$entraineurEncadrant,$mentionFacultative);
    }
}