<?php


namespace Vue;


use Controleur\Controleur;
use Exception;

class Vue
{
    // region Attributs privés
    /**
     * @var string Chemin et nom du fichier associé à la vue
     */
    private string $fichier;
    /**
     * @var string Titre de la vue (défini dans le fichier vue)
     */
    private string $titre;
    // endregion

    // region Constructeur
    /**
     * Constructeur de Vue.
     * @param string $action L'action qui détermine la vue
     */
    public function __construct(string $action)
    {
        $this->fichier = 'Vue/Vue' . $action . '.php';
    }
    // endregion

    // region Méthodes
    /**
     * Génère et affiche la vue
     * @param array $donnees Tableau de données spécifiques à la vue
     * @throws Exception
     */
    public function generer(array $donnees)
    {
        $contenu = $this->genererFichier($this->fichier, $donnees);
        $vue = $this->genererFichier('Vue/gabarit.php',array('titre' => $this->titre, 'contenu' => $contenu));
        echo $vue;
    }

    /**
     * Génère un fichier vue et renvoie le résultat produit
     * @param string $fichier Chemin et nom du fichier associé à la vue
     * @param array $donnees Tableau de données spécifiques à la vue
     * @return false|string
     * @throws Exception
     */
    private function genererFichier(string $fichier,array $donnees)
    {
        if (file_exists($fichier)){
            extract($donnees);
            ob_start();
            require $fichier;
            return ob_get_clean();
        }
        else {
            throw new Exception("Fichier '$fichier' introuvable");
        }
    }
    // endregion
}
