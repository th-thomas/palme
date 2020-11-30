<?php


namespace Modele;


class Configuration
{
    /**
     * @var array Tableau des paramètres
     */
    private static array $parametres = array();

    /**
     * Renvoie la valeur d'un paramètre de configuration
     * @param string $nom Nom du paramètre
     * @return mixed|null Valeur du paramètre
     * @throws \Exception
     */
    public static function get(string $nom)
    {
        if (isset(self::getParametres()[$nom])) {
            $valeur = self::getParametres()[$nom];
        }
        else {
            $valeur = null;
        }
        return $valeur;
    }

    /**
     * Renvoie le tableau des paramètres en le chargeant au besoin
     * @return array|false Tableau des paramètres (false en cas d'échec)
     * @throws \Exception
     */
    private static function getParametres()
    {
        if (self::$parametres == null) {
            $cheminFichier = __DIR__."/../Config/prod.ini";
            if (!file_exists($cheminFichier)) {
                $cheminFichier = __DIR__."/../Config/dev.ini";
            }
            if (!file_exists($cheminFichier)) {
                throw new \Exception("Aucun fichier de configuration trouvé");
            }
            else {
                self::$parametres = parse_ini_file($cheminFichier);
            }
        }
        return self::$parametres;
    }
}
