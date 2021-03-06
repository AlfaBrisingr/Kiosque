<?php namespace Kiosque\Models;

use Kiosque\Classes\Collection;
use Kiosque\Classes\Ecole;
use Kiosque\Classes\Enseignant;

class MEcole
{
    /**
     * Récupère toutes les écoles
     * @return Collection
     * @throws \Exception
     */
    public static function getEcoles()
    {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("
                SELECT *
                FROM ecole e
                INNER JOIN enseignant ens ON e.idEcole = ens.idEcole
                WHERE TypeEnseignant = 1
                ORDER BY TypeEcole");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab) {
                $directeur = new Enseignant($tab['idEns'], $tab['civEns'], $tab['nomEns'], $tab['prenomEns'], $tab['mailEns'], $tab['telEns'], $tab['TypeEnseignant']);
                $ecole = new Ecole($tab['idEcole'], $tab['typeEcole'],  $tab['nomEcole'], $tab['adresseEcole'], $tab['adresse2Ecole'], $tab['cpEcole'], $tab['villeEcole'], $tab['mail_dir'], $directeur);
                $coll->ajouter($ecole);
            }
            return $coll;
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        } catch (KeyHasUseException $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public static function getEcolesPublique()
    {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("
                SELECT *
                FROM ecole e
                INNER JOIN enseignant ens ON e.idEcole = ens.idEcole
                WHERE typeEcole = 1
                AND TypeEnseignant = 1");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab) {
                $directeur = new Enseignant($tab['idEns'], $tab['civEns'], $tab['nomEns'], $tab['prenomEns'], $tab['mailEns'], $tab['telEns'], $tab['TypeEnseignant']);
                $ecole = new Ecole($tab['idEcole'], $tab['typeEcole'],  $tab['nomEcole'], $tab['adresseEcole'], $tab['adresse2Ecole'], $tab['cpEcole'], $tab['villeEcole'], $tab['mail_dir'], $directeur);
                $coll->ajouter($ecole);
            }
            return $coll;
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        } catch (KeyHasUseException $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public static function getEcolesJeunePublic()
    {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("
                SELECT *
                FROM ecole e
                INNER JOIN enseignant ens ON e.idEcole = ens.idEcole
                WHERE typeEcole = 1 or typeEcole = 2
                AND TypeEnseignant = 1");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab) {
                $directeur = new Enseignant($tab['idEns'], $tab['civEns'], $tab['nomEns'], $tab['prenomEns'], $tab['mailEns'], $tab['telEns'], $tab['TypeEnseignant']);
                $ecole = new Ecole($tab['idEcole'], $tab['typeEcole'],  $tab['nomEcole'], $tab['adresseEcole'], $tab['adresse2Ecole'], $tab['cpEcole'], $tab['villeEcole'], $tab['mail_dir'], $directeur);
                $coll->ajouter($ecole);
            }
            return $coll;
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
        catch (KeyHasUseException $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public static function getEcolesCollegeLycee()
    {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("
                SELECT *
                FROM ecole e
                INNER JOIN enseignant ens ON e.idEcole = ens.idEcole
                WHERE typeEcole = 3 or typeEcole = 4
                AND TypeEnseignant = 1");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab) {
                $directeur = new Enseignant($tab['idEns'], $tab['civEns'], $tab['nomEns'], $tab['prenomEns'], $tab['mailEns'], $tab['telEns'], $tab['TypeEnseignant']);
                $ecole = new Ecole($tab['idEcole'], $tab['typeEcole'],  $tab['nomEcole'], $tab['adresseEcole'], $tab['adresse2Ecole'], $tab['cpEcole'], $tab['villeEcole'], $tab['mail_dir'], $directeur);
                $coll->ajouter($ecole);
            }
            return $coll;
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        } catch (KeyHasUseException $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public static function getColleges()
    {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("
                SELECT *
                FROM ecole e
                INNER JOIN enseignant ens ON e.idEcole = ens.idEcole
                WHERE typeEcole = 3
                AND TypeEnseignant = 1");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab) {
                $directeur = new Enseignant($tab['idEns'], $tab['civEns'], $tab['nomEns'], $tab['prenomEns'], $tab['mailEns'], $tab['telEns'], $tab['TypeEnseignant']);
                $ecole = new Ecole($tab['idEcole'], $tab['typeEcole'],  $tab['nomEcole'], $tab['adresseEcole'], $tab['adresse2Ecole'], $tab['cpEcole'], $tab['villeEcole'], $tab['mail_dir'], $directeur);
                $coll->ajouter($ecole);
            }
            return $coll;
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        } catch (KeyHasUseException $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public static function getLycees()
    {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("
                SELECT *
                FROM ecole e
                INNER JOIN enseignant ens ON e.idEcole = ens.idEcole
                WHERE typeEcole = 4
                AND TypeEnseignant = 1");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab) {
                $directeur = new Enseignant($tab['idEns'], $tab['civEns'], $tab['nomEns'], $tab['prenomEns'], $tab['mailEns'], $tab['telEns'], $tab['TypeEnseignant']);
                $ecole = new Ecole($tab['idEcole'], $tab['typeEcole'],  $tab['nomEcole'], $tab['adresseEcole'], $tab['adresse2Ecole'], $tab['cpEcole'], $tab['villeEcole'], $tab['mail_dir'], $directeur);
                $coll->ajouter($ecole);
            }
            return $coll;
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        } catch (KeyHasUseException $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public static function getEcolesPrive()
    {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("
                SELECT *
                FROM ecole e
                INNER JOIN enseignant ens ON e.idEcole = ens.idEcole
                WHERE typeEcole = 2
                AND TypeEnseignant = 1");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab) {
                $directeur = new Enseignant($tab['idEns'], $tab['civEns'], $tab['nomEns'], $tab['prenomEns'], $tab['mailEns'], $tab['telEns'], $tab['TypeEnseignant']);
                $ecole = new Ecole($tab['idEcole'], $tab['typeEcole'],  $tab['nomEcole'], $tab['adresseEcole'], $tab['adresse2Ecole'], $tab['cpEcole'], $tab['villeEcole'], $tab['mail_dir'], $directeur);
                $coll->ajouter($ecole);
            }
            return $coll;
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        } catch (KeyHasUseException $ex) {
            throw new \Exception($ex->getMessage());
        }
    }
    /**
     * Récupère l'école avec le numéro $codeEcole
     * @param int $codeEcole
     * @return Ecole
     * @throws \Exception
     */
    public static function getEcoleById($codeEcole)
    {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT *
                FROM ecole e
                INNER JOIN enseignant ens ON e.idEcole = ens.idEcole
                WHERE e.idEcole = ?");
            $reqPrepare->execute(array($codeEcole));
            $tab = $reqPrepare->fetch();
            $directeur = new Enseignant($tab['idEns'], $tab['civEns'], $tab['nomEns'], $tab['prenomEns'], $tab['mailEns'], $tab['telEns'], $tab['TypeEnseignant']);
            $ecole = new Ecole($tab['idEcole'], $tab['typeEcole'],  $tab['nomEcole'], $tab['adresseEcole'], $tab['adresse2Ecole'], $tab['cpEcole'], $tab['villeEcole'], $tab['mail_dir'], $directeur);
            return $ecole;
        } catch (\PDOException $e) {
            //throw new Exception("L'école $codeEcole n'existe pas");
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Récupère l'école avec le nom $name
     * @param string $name
     * @return Ecole
     * @throws \Exception
     */
    public static function getEcoleByName($name)
    {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT *
            FROM ecole e
            INNER JOIN enseignant ens ON e.idEcole = ens.idEcole
            WHERE e.nomEcole = ?");
            $reqPrepare->execute(array($name));
            $tab = $reqPrepare->fetch();
            $directeur = new Enseignant($tab['idEns'], $tab['civEns'], $tab['nomEns'], $tab['prenomEns'], $tab['mailEns'], $tab['telEns'], $tab['TypeEnseignant']);
            $ecole = new Ecole($tab['idEcole'], $tab['typeEcole'],  $tab['nomEcole'], $tab['adresseEcole'], $tab['adresse2Ecole'], $tab['cpEcole'], $tab['villeEcole'], $tab['mail_dir'], $directeur);
            return $ecole;
        } catch (\PDOException $e) {
            throw new \Exception("L'école '$name' n'existe pas");
        }
    }

    /**
     * Récupère les écoles avec comme type $type
     * @param int $type
     * @return Collection
     * @throws \Exception
     */
    public static function getEcoleByType($type)
    {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT *
                FROM ecole e
                INNER JOIN enseignant ens ON e.idEcole = ens.idEcole
                WHERE e.typeEcole = ?
                AND TypeEnseignant = 1
                ORDER BY villeEcole");
            $reqPrepare->execute(array($type));
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab) {
                $directeur = new Enseignant($tab['idEns'], $tab['civEns'], $tab['nomEns'], $tab['prenomEns'], $tab['mailEns'], $tab['telEns'], $tab['TypeEnseignant']);
                $ecole = new Ecole($tab['idEcole'], $tab['typeEcole'], $tab['nomEcole'], $tab['adresseEcole'], $tab['adresse2Ecole'], $tab['cpEcole'], $tab['villeEcole'], $tab['mail_dir'], $directeur);
                $coll->ajouter($ecole);
                return $coll;
            }
        } catch (\PDOException $e) {
            throw new \Exception("Il n'y a aucune école de type $type");
        } catch (KeyHasUseException $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    /**
     * Ajoute une école
     * @param Ecole $ecole
     * @throws \Exception
     */
    public static function setEcole(Ecole $ecole)
    {
        $conn = Main::bdd();
        try {
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("INSERT INTO ecole (typeEcole, nomEcole, adresseEcole, adresse2Ecole, cpEcole, villeEcole, mail_dir) VALUES (?,?,?,?,?,?,?)");
            $reqPrepare->execute(array(
                $ecole->getType(),
                $ecole->getNom(),
                $ecole->getAdresse(),
                $ecole->getAdresse2(),
                $ecole->getCp(),
                $ecole->getVille(),
                $ecole->getMailDirecteur(),
            ));
            $idEcole = $conn->lastInsertId();
            $conn->commit();

            return $idEcole;
        } catch (\PDOException $e) {
            $conn->rollBack();
            throw new \Exception("L'ajout de l'école ".$ecole->getId()." a échoué. Détails : <p>".$e->getMessage()."</p>");
        }
    }

    /**
     * Modifie une école
     * @param Ecole $ecole
     * @throws \Exception
     */
    public static function editEcole(Ecole $ecole, Enseignant $directeur)
    {
        $conn = Main::bdd();
        try {
            $conn->beginTransaction();
            MEnseignant::editDirecteur($directeur);
            $reqPrepare = $conn->prepare("UPDATE ecole SET typeEcole = ?, nomEcole = ?, adresseEcole = ?, adresse2Ecole = ?, cpEcole = ?, villeEcole = ?, mail_dir = ? WHERE idEcole = ?");
            $reqPrepare->execute(array(
                $ecole->getType(),
                $ecole->getNom(),
                $ecole->getAdresse(),
                $ecole->getAdresse2(),
                $ecole->getCp(),
                $ecole->getVille(),
                $ecole->getMailDirecteur(),
                $ecole->getId()
            ));
            $conn->commit();
        } catch (\PDOException $e) {
            $conn->rollBack();
            throw new \Exception("L'école ".$ecole->getId()." n'a pas pu être modifiée. Détails : <p>".$e->getMessage()."</p>");
        }
    }

    /**
     * Supprime une école et ses enseignant en cascade
     * @param Ecole $ecole
     * @throws \Exception
     */
    public static function rmEcole(Ecole $ecole)
    {
        $conn = Main::bdd();
        try {
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("DELETE FROM enseignant WHERE idEcole = ?");
            $reqPrepare->execute(array($ecole->getId()));
            $reqPrepare = $conn->prepare("DELETE FROM ecole WHERE idEcole = ?");
            $reqPrepare->execute(array($ecole->getId()));
            $conn->commit();
        } catch (\PDOException $e) {
            $conn->rollBack();
            throw new \Exception("L'école ".$ecole->getId()." n'a pas pu être supprimée. Détails : <p>".$e->getMessage()."</p>");
        }
    }
}
