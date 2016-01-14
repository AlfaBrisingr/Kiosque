<?php
class Main
{
    /**
     * Permet de se connecter à la base de données
     * @return PDO
     * @throws Exception
     */
    static public function bdd() {
        try
        {
            /*$host = "db576425814.db.1and1.com";
            $dbname = 'db576425814';
            $user = "dbo576425814";
            $mdp = "BcW&n7,4";*/
            $host = "localhost";
            $dbname = "db576425814";
            $user = "root";
            $mdp = "";
            $pdo = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8',
                $user, $mdp, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            return $pdo;
        }
        catch (PDOException $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Vérifie si l'utilisateur est connecté ou non
     * @return bool
     */
    static public function connexionExistante()
    {
        if(isset($_SESSION['utilisateur']))
            if($_SESSION['utilisateur']->getUsername() != "jeunePublic")
                return true;
            else
                return false;
            else
                return false;
        }

        static public function connexionExistantePublic()
        {
            if(isset($_SESSION['utilisateur']))
                return true;
            else
                return false;
        }
    /**
     * Établi les messages flash d'erreur ou de succès
     * @param string $message
     * @param string $type
     */
    static public function setFlashMessage($message, $type)
    {
        switch ($type)
        {
            case 'valid' : $_SESSION['valid'] = $message; if(isset($_SESSION['error'])) { unset($_SESSION['error']); } break;
            case 'error' : $_SESSION['error'] = $message; if(isset($_SESSION['valid'])) { unset($_SESSION['valid']); } break;
            default : $_SESSION['error'] = "Erreur inconnue"; break;
        }
    }

    /**
     * Établi un message d'erreur global pour les connexions incorrectes.
     */
    static public function launchWrongUserPwd()
    {
        Main::setFlashMessage("Nom d'utilisateur ou mot de passe incorrecte","error");
    }

    static public function viewVar($var)
    {
        echo var_dump($var);
    }
}
