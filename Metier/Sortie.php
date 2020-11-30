<?php


namespace Metier;


use DateTime;

class Sortie
{
    // region Attributs privés
    /**
     * @var string Code identifiant la sortie
     */
    private string $identifiant;
    /**
     * @var DateTime Jour de la sortie
     */
    private DateTime $jour;
    /**
     * @var string Lieu du rendez-vous
     */
    private string $lieuRDV;
    /**
     * @var DateTime Heure du rendez-vous
     */
    private DateTime $heureRDV;
    /**
     * @var string Plage de mise à l'eau
     */
    private string $plage;
    /**
     * @var DateTime Heure de mise à l'eau
     */
    private DateTime $heureMiseAlEau;
    /**
     * @var string Niveau du public concerné par la sortie
     */
    private string $niveauPublic;
    /**
     * @var string Mention facultative (en hiver)
     */
    private string $mentionFacultative;
    // Commune à toutes les instances
    /**
     * @var string Mention obligatoire pour la sécurité des nageurs
     */
    private static string $mentionObligatoire = "Bonnet de couleur et bouée de signalisation obligatoire";
    /**
     * @var Adherent Entraineur qui encadre la sortie
     */
    private Adherent $entraineurEncadrant;
    // endregion

    // region Accesseurs en lecture
    /**
     * @return string Code identifiant la sortie
     */
    public function getIdentifiant(): string
    {
        return $this->identifiant;
    }

    /**
     * @return DateTime Jour de la sortie
     */
    public function getJour(): DateTime
    {
        return $this->jour;
    }

    /**
     * @return string Lieu du rendez-vous
     */
    public function getLieuRDV(): string
    {
        return $this->lieuRDV;
    }

    /**
     * @return DateTime Heure du rendez-vous
     */
    public function getHeureRDV(): DateTime
    {
        return $this->heureRDV;
    }

    /**
     * @return string Plage de mise à l'eau
     */
    public function getPlage(): string
    {
        return $this->plage;
    }

    /**
     * @return DateTime Heure de mise à l'eau
     */
    public function getHeureMiseAlEau(): DateTime
    {
        return $this->heureMiseAlEau;
    }

    /**
     * @return string Niveau du public concerné par la sortie
     */
    public function getNiveauPublic(): string
    {
        return $this->niveauPublic;
    }

    /**
     * @return string Mention facultative (en hiver)
     */
    public function getMentionFacultative(): string
    {
        return $this->mentionFacultative;
    }

    /**
     * @return string Mention obligatoire pour la sécurité des nageurs
     */
    public static function getMentionObligatoire(): string
    {
        return self::$mentionObligatoire;
    }

    /**
     * @return Adherent Entraineur qui encadre la sortie
     */
    public function getEntraineurEncadrant(): Adherent
    {
        return $this->entraineurEncadrant;
    }
    // endregion

    // region Accesseurs en écriture
    /**
     * @param string $identifiant Code identifiant la sortie
     */
    public function setIdentifiant(string $identifiant): void
    {
        $this->identifiant = $identifiant;
    }

    /**
     * @param DateTime $jour Jour de la sortie
     */
    public function setJour(DateTime $jour): void
    {
        $this->jour = $jour;
    }

    /**
     * @param string $lieuRDV Lieu du rendez-vous
     */
    public function setLieuRDV(string $lieuRDV): void
    {
        $this->lieuRDV = $lieuRDV;
    }

    /**
     * @param DateTime $heureRDV Heure du rendez-vous
     */
    public function setHeureRDV(DateTime $heureRDV): void
    {
        $this->heureRDV = $heureRDV;
    }

    /**
     * @param string $plage Plage de mise à l'eau
     */
    public function setPlage(string $plage): void
    {
        $this->plage = $plage;
    }

    /**
     * @param DateTime $heureMiseAlEau Heure de mise à l'eau
     */
    public function setHeureMiseAlEau(DateTime $heureMiseAlEau): void
    {
        $this->heureMiseAlEau = $heureMiseAlEau;
    }

    /**
     * @param string $niveauPublic Niveau du public concerné par la sortie
     */
    public function setNiveauPublic(string $niveauPublic): void
    {
        $this->niveauPublic = $niveauPublic;
    }

    /**
     * @param string $mentionFacultative Mention facultative (en hiver)
     */
    public function setMentionFacultative(string $mentionFacultative): void
    {
        $this->mentionFacultative = $mentionFacultative;
    }

    /**
     * @param Adherent $entraineurEncadrant Entraineur qui encadre la sortie
     */
    public function setEntraineurEncadrant(Adherent $entraineurEncadrant): void
    {
        $this->entraineurEncadrant = $entraineurEncadrant;
    }
    // endregion

    // region Constructeur
    public function __construct(string $identifiant, DateTime $jour, string $lieuRDV, DateTime $heureRDV, string $plage, DateTime $heureMiseAlEau, string $niveauPublic, Adherent $entraineurEncadrant, string $mentionFacultative = 'Aucune')
    {
        $this->identifiant = $identifiant;
        $this->jour = $jour;
        $this->lieuRDV = $lieuRDV;
        $this->heureRDV = $heureRDV;
        $this->plage = $plage;
        $this->heureMiseAlEau = $heureMiseAlEau;
        $this->niveauPublic = $niveauPublic;
        $this->mentionFacultative = $mentionFacultative;
        $this->entraineurEncadrant = $entraineurEncadrant;
    }
    // endregion

    // region Méthodes
    public function __toString()
    {
        $identifiant = $this->identifiant;
        $jour = $this->jour->format('Y-m-d');
        $lieuRDV = $this->lieuRDV;
        $heureRDV = $this->heureRDV->format('H:i');
        $plage = $this->plage;
        $heureMiseAlEau = $this->heureMiseAlEau->format('H:i');
        $niveauPublic = $this->niveauPublic;
        $mentionObligatoire = self::$mentionObligatoire;
        $mentionFacultative = $this->mentionFacultative;
        $entraineurEncadrant = $this->entraineurEncadrant->getPrenom().' '.$this->entraineurEncadrant->getNom().' '.$this->entraineurEncadrant->getIdentifiant();

        $string = "[Sortie] Identifiant : $identifiant, Jour : $jour, Lieu du RDV : $lieuRDV, Heure du RDV : $heureRDV, ";
        $string .= "Plage de mise à l'eau : $plage, Heure de mise à l'eau : $heureMiseAlEau, Niveau public : $niveauPublic, ";
        $string .= "Mention obligatoire : $mentionObligatoire, Mention facultative : $mentionFacultative, ";
        $string .= "Nom, prénom et identifiant de l'entraîneur encadrant : $entraineurEncadrant";
        return $string;
    }
    // endregion
}