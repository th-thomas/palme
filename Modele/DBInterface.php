<?php


namespace Modele;


use PDO;
use PDOException;

/**
 * Classe DBInterface.
 * Centralise les services d'accès à une base de données.
 * Utilise l'API PDO de PHP.
 *
 * @package Modele
 * @author Thibault THOMAS
 *
 * Merci à Baptiste PESQUET : https://bpesquet.developpez.com/tutoriels/php/evoluer-architecture-mvc/
 *
 * Date de création : 8 mai 2020
 * Date de dernière modification : 9 mai 2020
 */
class DBInterface
{
    /**
     * @var PDO|null Objet PDO d'accès à la base de données.
     */
    private static ?PDO $bdd = null;

    public static function executerRequete(string $requete, array $parametres = null)
    {
        if ($parametres == null) {
            $resultat = self::getBDD()->query($requete); // exécution directe
        }
        else {
            $resultat = self::getBDD()->prepare($requete); // requête préparée
            $resultat->execute($parametres);
        }
        return $resultat;
    }


    private static function getBDD() : PDO
    {
        if (self::$bdd == null) {
            $dsn = Configuration::get("dsn");
            $login = Configuration::get("login");
            $mdp = Configuration::get("mdp");
            // Création de la connexion
            try {
                self::$bdd = new PDO($dsn,$login,$mdp,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
            catch (PDOException $e) {
                throw new PDOException($e->getMessage(),(int)$e->getCode());
            }
        }
        return self::$bdd;
    }
}

