<?php


namespace Metier;


use DateTime;
use Modele\DAOAdherent;

class Adherent
{
    // region Attributs privés
    /**
     * @var string Code identifiant l'adhérent
     */
    private string $identifiant;
    /**
     * @var bool Adhérent actif ou ancien adhérent
     */
    private bool $estActif;
    /**
     * @var string Nom de famille de l'adhérent
     */
    private string $nom;
    /**
     * @var string Prénom de l'adhérent
     */
    private string $prenom;
    /**
     * @var DateTime Date de naissance de l'adhérent
     */
    private DateTime $dateNaissance;
    /**
     * @var DateTime Date d'inscription de l'adhérent
     */
    private DateTime $dateInscription;
    /**
     * @var DateTime Date jusqu'à laquelle le certificat médical de l'adhérent est valide
     */
    private DateTime $dateFinCertifMed;
    /**
     * @var string Eventuelle fonction occupée par l'adhérent au sein du bureau
     */
    private string $fonctionBureau;
    /**
     * @var bool L'adhérent est entraîneur ou non
     */
    private bool $estEntraineur;
    /***
     * @var bool L'adhérent est coach ou non
     */
    private bool $estCoach;
    /**
     * @var bool L'adhérent est responsable ou non du matériel
     */
    private bool $estRespMateriel;
    /**
     * @var bool L'adhérent est responsable ou non du planning des séances
     */
    private bool $estRespPlanning;
    /**
     * @var string Login de l'adhérent
     */
    private string $login;
    /**
     * @var string Mot de passe de l'adhérent
     */
    private string $mdp;
    // endregion

    // region Accesseurs en lecture
    /**
     * @return string Code identifiant l'adhérent
     */
    public function getIdentifiant(): string
    {
        return $this->identifiant;
    }

    /**
     * @return bool Adhérent actif ou ancien adhérent
     */
    public function getEstActif(): bool
    {
        return $this->estActif;
    }

    /**
     * @return string Nom de famille de l'adhérent
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @return string Prénom de l'adhérent
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @return DateTime Date de naissance de l'adhérent
     */
    public function getDateNaissance(): DateTime
    {
        return $this->dateNaissance;
    }

    /**
     * @return DateTime Date d'inscription de l'adhérent
     */
    public function getDateInscription(): DateTime
    {
        return $this->dateInscription;
    }

    /**
     * @return DateTime Date jusqu'à laquelle le certificat médical de l'adhérent est valide
     */
    public function getDateFinCertifMed(): DateTime
    {
        return $this->dateFinCertifMed;
    }

    /**
     * @return string Eventuelle fonction occupée par l'adhérent au sein du bureau
     */
    public function getFonctionBureau(): string
    {
        return $this->fonctionBureau;
    }

    /**
     * @return bool L'entraineur est entraîneur ou non
     */
    public function getEstEntraineur() : bool
    {
        return $this->estEntraineur;
    }

    /**
     * @return bool L'adhérent est coach ou non
     */
    public function getEstCoach() : bool
    {
        return $this->estCoach;
    }
    
    /**
     * @return bool L'adhérent est responsable ou non du matériel
     */
    public function getEstRespMateriel(): bool
    {
        return $this->estRespMateriel;
    }

    /**
     * @return bool L'adhérent est responsable ou non du planning des séances
     */
    public function getEstRespPlanning(): bool
    {
        return $this->estRespPlanning;
    }
    
    /**
     * @return string Login de l'adhérent
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string Mot de passe de l'adhérent
     */
    public function getMdp(): string
    {
        return $this->mdp;
    }
    // endregion

    // region Accesseurs en écriture
    /**
     * @param string $identifiant Code identifiant l'adhérent
     */
    public function setIdentifiant(string $identifiant): void
    {
        $this->identifiant = $identifiant;
    }

    /**
     * @param bool $estActif Adhérent actif ou ancien adhérent
     */
    public function setEstActif(bool $estActif): void
    {
        $this->estActif = $estActif;
    }

    /**
     * @param string $nom Nom de famille de l'adhérent
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @param string $prenom Prénom de l'adhérent
     */
    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @param DateTime $dateNaissance Date de naissance de l'adhérent
     */
    public function setDateNaissance(DateTime $dateNaissance): void
    {
        $this->dateNaissance = $dateNaissance;
    }

    /**
     * @param DateTime $dateInscription Date d'inscription de l'adhérent
     */
    public function setDateInscription(DateTime $dateInscription): void
    {
        $this->dateInscription = $dateInscription;
    }

    /**
     * @param DateTime $dateFinCertifMed Date jusqu'à laquelle le certificat médical de l'adhérent est valide
     */
    public function setDateFinCertifMed(DateTime $dateFinCertifMed): void
    {
        $this->dateFinCertifMed = $dateFinCertifMed;
    }

    /**
     * @param bool $estEntraineur L'adhérent est entraîneur ou non
     */
    public function setEstEntraineur(bool $estEntraineur) : void
    {
        $this->estEntraineur = $estEntraineur;
        // Si l'adhérent n'est pas entraîneur alors il ne peut pas être coach
        if (!$estEntraineur) {
            $this->estCoach = false;
        }
    }

    /**
     * @param bool $estCoach L'adhérent est coach ou non
     */
    public function setEstCoach(bool $estCoach) : void
    {
        $this->estCoach = $estCoach;
        // Si l'adhérent est coach alors il est aussi entraîneur
        if ($estCoach) {
            $this->estEntraineur = true;
        }
    }

    /**
     * @param string $fonctionBureau Eventuelle fonction occupée par l'adhérent au sein du bureau
     */
    public function setFonctionBureau(string $fonctionBureau): void
    {
        $this->fonctionBureau = $fonctionBureau;
    }

    /**
     * @param bool $estResponsableMateriel L'adhérent est responsable ou non du matériel
     */
    public function setEstRespMateriel(bool $estResponsableMateriel): void
    {
        $this->estRespMateriel = $estResponsableMateriel;
    }

    /**
     * @param bool $estResponsablePlanning L'adhérent est responsable ou non du planning des séances
     */
    public function setEstRespPlanning(bool $estResponsablePlanning): void
    {
        $this->estRespPlanning = $estResponsablePlanning;
    }

    /**
     * @param string $login Login de l'adhérent
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @param string $mdp Mot de passe de l'adhérent
     */
    public function setMdp(string $mdp): void
    {
        $this->mdp = $mdp;
    }
    // endregion

    // region Constructeur
    /**
     * Adherent constructor.
     * @param string $identifiant Code identifiant l'adhérent
     * @param bool $estActif Adhérent actif ou ancien adhérent
     * @param string $nom Nom de famille de l'adhérent
     * @param string $prenom Prénom de l'adhérent
     * @param DateTime $dateNaissance Date de naissance de l'adhérent
     * @param DateTime $dateInscription Date d'inscription de l'adhérent
     * @param DateTime $dateFinCertifMed Date jusqu'à laquelle le certificat médical de l'adhérent est valide
     * @param string $login Login de l'adhérent
     * @param string $mdp Mot de passe de l'adhérent
     * @param bool $estEntraineur L'adhérent est entraîneur ou non
     * @param bool $estCoach L'adhérent est coach ou non
     * @param string $fonctionBureau Eventuelle fonction occupée par l'adhérent au sein du bureau
     * @param bool $estRespMateriel L'adhérent est responsable ou non du matériel
     * @param bool $estRespPlanning L'adhérent est responsable ou non du planning des séances
     */
    public function __construct(string $identifiant, string $nom, string $prenom, DateTime $dateNaissance, DateTime $dateInscription, DateTime $dateFinCertifMed, string $login, string $mdp, bool $estActif = true, bool $estEntraineur = false, bool $estCoach = false, string $fonctionBureau = 'Aucune', bool $estRespMateriel = false, bool $estRespPlanning = false)
    {
        $this->identifiant = $identifiant;
        $this->estActif = $estActif;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
        $this->dateInscription = $dateInscription;
        $this->dateFinCertifMed = $dateFinCertifMed;
        $this->fonctionBureau = $fonctionBureau;
        if ($estCoach) {
            $this->estCoach = true;
            $this->estEntraineur = true;
        }
        else {
            $this->estCoach = false;
            $this->estEntraineur = $estEntraineur;
        }
        $this->estRespMateriel = $estRespMateriel;
        $this->estRespPlanning = $estRespPlanning;
        $this->login = $login;
        $this->mdp = $mdp;
    }
    // endregion

    // region Méthodes
    /**
     * Retourne objet Adherent sous forme textuelle
     * @return string Objet Adherent sous forme textuelle
     */
    public function __toString()
    {
        $identifiant = $this->identifiant;
        $estActif = ($this->estActif) ? 'Oui' : 'Non';
        $nom = $this->nom;
        $prenom = $this->prenom;
        $dateNaissance = $this->dateNaissance->format('Y-m-d');
        $dateInscription = $this->dateInscription->format('Y-m-d');
        $dateFinCertifMed = $this->dateFinCertifMed->format('Y-m-d');
        $fonctionBureau = $this->fonctionBureau;
        $estRespMateriel = ($this->estRespMateriel) ? 'Oui' : 'Non';
        $estRespPlanning = ($this->estRespPlanning) ? 'Oui' : 'Non';
        $estEntraineur = ($this->estEntraineur) ? 'Oui' : 'Non';
        $estCoach = ($this->estCoach) ? 'Oui' : 'Non';
        $login = $this->login;
        $mdp = $this->mdp;

        $string = "[Adhérent] Identifiant : $identifiant, Est actif : $estActif, Nom : $nom, Prénom : $prenom, Login : $login, Mot de passe : $mdp, ";
        $string .= "Date de naissance : $dateNaissance, Date d'inscription : $dateInscription, Date de fin de validité du certificat médical : $dateFinCertifMed, ";
        $string .= "Est entraîneur : $estEntraineur, Est coach : $estCoach, ";
        $string .= "Fonction occupée au sein du bureau : $fonctionBureau, Est responsable matériel : $estRespMateriel, Est responsable planning : $estRespPlanning";

        return $string;
    }

    /**
     * @return string Le chemin de la photo de l'adhérent
     */
    public function cheminPhoto() : string
    {
        $nomImage = strtolower(substr($this->getPrenom(),0,1).$this->getNom());
        $format = 'jpg';
        return 'img/'.$nomImage.'.'.$format;
    }

    public function estAutoriseSecretariat() : bool
    {
        return ($this->getFonctionBureau() == 'Secrétaire' | $this->getFonctionBureau() == 'Secrétaire adjoint') ? true : false;
    }
    // endregion
}