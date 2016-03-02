<?php namespace Kiosque\Models;

use Kiosque\Classes\Utilisateur;
use Kiosque\Classes\Collection;

class MAdmin
{
    /**
     * Récupère les informations sur l'utilisateur via son code Utilisateur
     * @param int $code
     * @return Utilisateur
     * @throws \Exception
     */

    public static function getUserById($code)
    {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT * FROM admin WHERE code_user = ?");
            $reqPrepare->execute(array($code));
            $tab = $reqPrepare->fetch();
            $utilisateur = new Utilisateur($code, $tab['login'], $tab['password']);
            return $utilisateur;
        } catch (\PDOException $e) {
            throw new \Exception("L'utilisateur n°$code n'existe pas");
        }
    }

    /**
     * Récupère les informations sur l'utilisateur via son nom
     * @param string $name
     * @return Utilisateur
     * @throws Exception
     */
    public static function getUserByName($name)
    {
        $conn = Main::bdd();
        $reqPrepare = $conn->prepare("SELECT * FROM admin WHERE login = ?");
        $reqPrepare->execute(array($name));
        $tab = $reqPrepare->fetch();
        $utilisateur = new Utilisateur($tab['code_user'], $name, $tab['password']);
        return $utilisateur;
    }

    /**
     * Récupère tous les utilisateurs
     * @return Collection Utilisateurs
     * @throws \Exception
     * @throws \KeyHasUseException
     */
    public static function getUsers()
    {
        $conn = Main::bdd();
        $reqPrepare = $conn->query("SELECT * FROM admin");
        $tabs = $reqPrepare->fetchAll();
        $coll = new Collection();
        foreach ($tabs as $tab) {
            $utilisateur = new Utilisateur($tab['code_user'], $tab['login'], $tab['password']);
            $coll->ajouter($utilisateur);
        }
        return $coll;
    }
}
