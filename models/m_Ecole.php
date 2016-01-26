<?php

require_once 'm_Main.php';

class MEcole
{
    /**
     * Récupère toutes les écoles
     * @return Collection
     * @throws Exception
     */
    static public function getEcoles()
    {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("
                SELECT e.idEcole, typeEcole, nomEcole, adresseEcole, adresse2Ecole, cpEcole, villeEcole, mail_dir, civEns, nomEns, prenomEns, mailEns, telEns, idEns
                FROM ecole e
                INNER JOIN enseignant ens ON e.idDirecteur = ens.idEns");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $directeur = new Enseignant($tab['idEns'], $tab['civEns'], $tab['nomEns'], $tab['prenomEns'], $tab['mailEns'], $tab['telEns']);
                $ecole = new Ecole($tab['idEcole'], $tab['typeEcole'],  $tab['nomEcole'], $tab['adresseEcole'], $tab['adresse2Ecole'], $tab['cpEcole'], $tab['villeEcole'], $tab['mail_dir'], $directeur);
                $coll->ajouter($ecole);
            }
            return $coll;
        }
        catch (PDOException $e)
        {
            throw new Exception($e->getMessage());
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }

    static public function getEcolesPublique()
    {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("
                SELECT e.idEcole, typeEcole, nomEcole, adresseEcole, adresse2Ecole, cpEcole, villeEcole, mail_dir, civEns, nomEns, prenomEns, mailEns, telEns, idEns
                FROM ecole e
                INNER JOIN enseignant ens ON e.idDirecteur = ens.idEns
                WHERE typeEcole = 1");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $directeur = new Enseignant($tab['idEns'], $tab['civEns'], $tab['nomEns'], $tab['prenomEns'], $tab['mailEns'], $tab['telEns']);
                $ecole = new Ecole($tab['idEcole'], $tab['typeEcole'],  $tab['nomEcole'], $tab['adresseEcole'], $tab['adresse2Ecole'], $tab['cpEcole'], $tab['villeEcole'], $tab['mail_dir'], $directeur);
                $coll->ajouter($ecole);
            }
            return $coll;
        }
        catch (PDOException $e)
        {
            throw new Exception($e->getMessage());
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }

    static public function getEcolesPrive()
    {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("
                SELECT e.idEcole, typeEcole, nomEcole, adresseEcole, adresse2Ecole, cpEcole, villeEcole, mail_dir, civEns, nomEns, prenomEns, mailEns, telEns, idEns
                FROM ecole e
                INNER JOIN enseignant ens ON e.idDirecteur = ens.idEns
                WHERE typeEcole = 2");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $directeur = new Enseignant($tab['idEns'], $tab['civEns'], $tab['nomEns'], $tab['prenomEns'], $tab['mailEns'], $tab['telEns']);
                $ecole = new Ecole($tab['idEcole'], $tab['typeEcole'],  $tab['nomEcole'], $tab['adresseEcole'], $tab['adresse2Ecole'], $tab['cpEcole'], $tab['villeEcole'], $tab['mail_dir'], $directeur);
                $coll->ajouter($ecole);
            }
            return $coll;
        }
        catch (PDOException $e)
        {
            throw new Exception($e->getMessage());
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }
    /**
     * Récupère l'école avec le numéro $codeEcole
     * @param int $codeEcole
     * @return Ecole
     * @throws Exception
     */
    static public function getEcoleById($codeEcole)
    {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT e.idEcole, typeEcole, nomEcole, adresseEcole, adresse2Ecole, cpEcole, villeEcole, mail_dir, civEns, nomEns, prenomEns, mailEns, telEns, idEns
                FROM ecole e
                INNER JOIN enseignant ens ON e.idDirecteur = ens.idEns
                WHERE e.idEcole = ?");
            $reqPrepare->execute(array($codeEcole));
            $tab = $reqPrepare->fetch();
            $directeur = new Enseignant($tab['idEns'], $tab['civEns'], $tab['nomEns'], $tab['prenomEns'], $tab['mailEns'], $tab['telEns']);
            $ecole = new Ecole($tab['idEcole'], $tab['typeEcole'],  $tab['nomEcole'], $tab['adresseEcole'], $tab['adresse2Ecole'], $tab['cpEcole'], $tab['villeEcole'], $tab['mail_dir'], $directeur);
            return $ecole;
        }
        catch (PDOException $e)
        {
            //throw new Exception("L'école $codeEcole n'existe pas");
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Récupère l'école avec le nom $name
     * @param string $name
     * @return Ecole
     * @throws Exception
     */
    static public function getEcoleByName($name)
    {
      try
      {
        $conn = Main::bdd();
        $reqPrepare = $conn->prepare("SELECT e.idEcole, typeEcole, nomEcole, adresseEcole, adresse2Ecole, cpEcole, villeEcole, mail_dir, civEns, nomEns, prenomEns, mailEns, telEns FROM ecole
            FROM ecole e
            INNER JOIN enseignant ens ON e.idDirecteur = ens.idEns
            WHERE e.nomEcole = ?");
        $reqPrepare->execute(array($name));
        $tab = $reqPrepare->fetch();
        $directeur = new Enseignant($tab['idEns'], $tab['civEns'], $tab['nomEns'], $tab['prenomEns'], $tab['mailEns'], $tab['telEns']);
        $ecole = new Ecole($tab['idEcole'], $tab['typeEcole'],  $tab['nomEcole'], $tab['adresseEcole'], $tab['adresse2Ecole'], $tab['cpEcole'], $tab['villeEcole'], $tab['mail_dir'], $directeur);
        return $ecole;
    }
    catch (PDOException $e)
    {
        throw new Exception("L'école '$name' n'existe pas");
    }
}

    /**
     * Récupère les écoles avec comme type $type
     * @param int $type
     * @return Collection
     * @throws Exception
     */
    static public function getEcoleByType($type)
    {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT e.idEcole, typeEcole, nomEcole, adresseEcole, adresse2Ecole, cpEcole, villeEcole, mail_dir, civEns, nomEns, prenomEns, mailEns, telEns FROM ecole
                FROM ecole e
                INNER JOIN enseignant ens ON e.idDirecteur = ens.idEns
                WHERE e.typeEcole = ?
                ORDER BY villeEcole");
            $reqPrepare->execute(array($type));
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $directeur = new Enseignant($tab['idEns'], $tab['civEns'], $tab['nomEns'], $tab['prenomEns'], $tab['mailEns'], $tab['telEns']);
                $ecole = new Ecole($tab['idEcole'], $tab['typeEcole'], $tab['nomEcole'], $tab['adresseEcole'], $tab['adresse2Ecole'], $tab['cpEcole'], $tab['villeEcole'], $tab['mail_dir'], $directeur);
                $coll->ajouter($ecole);
                return $coll;
            }
        }
        catch (PDOException $e)
        {
            throw new Exception("Il n'y a aucune école de type $type");
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * Ajoute une école
     * @param Ecole $ecole
     * @throws Exception
     */
    static public function setEcole(Ecole $ecole) {
        $conn = Main::bdd();
        try {
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("INSERT INTO ecole (typeEcole, nomEcole, adresseEcole, adresse2Ecole, cpEcole, villeEcole, mail_dir, idDirecteur) VALUES (?,?,?,?,?,?,?,?)");
            $reqPrepare->execute(array(
                $ecole->getType(),
                $ecole->getNom(),
                $ecole->getAdresse(),
                $ecole->getAdresse2(),
                $ecole->getCp(),
                $ecole->getVille(),
                $ecole->getMailDirecteur(),
                $ecole->getDirecteur()->getId()
                ));
            $idEcole = $conn->lastInsertId();
            $conn->commit();

            return $idEcole;
        }
        catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception("L'ajout de l'école ".$ecole->getId()." a échoué. Détails : <p>".$e->getMessage()."</p>");
        }
    }

    /**
     * Modifie une école
     * @param Ecole $ecole
     * @throws Exception
     */
    static public function editEcole(Ecole $ecole, Enseignant $directeur) {
        $conn = Main::bdd();
        try {
            $conn->beginTransaction();
            MEnseignant::editDirecteur($directeur);
            $reqPrepare = $conn->prepare("UPDATE ecole SET typeEcole = ?, nomEcole = ?, adresseEcole = ?, adresse2Ecole = ?, cpEcole = ?, villeEcole = ?, mail_dir = ?, idDirecteur = ? WHERE idEcole = ?");
            $reqPrepare->execute(array(
                $ecole->getType(),
                $ecole->getNom(),
                $ecole->getAdresse(),
                $ecole->getAdresse2(),
                $ecole->getCp(),
                $ecole->getVille(),
                $ecole->getMailDirecteur(),
                $directeur->getId(),
                $ecole->getId()
                ));
            $conn->commit();
        }
        catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception("L'école ".$ecole->getId()." n'a pas pu être modifiée. Détails : <p>".$e->getMessage()."</p>");
        }
    }

    /**
     * Supprime une école et ses enseignant en cascade
     * @param Ecole $ecole
     * @throws Exception
     */
    static public function rmEcole(Ecole $ecole) {
        $conn = Main::bdd();
        try {
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("DELETE FROM enseignant WHERE idEcole = ?");
            $reqPrepare->execute(array($ecole->getId()));
            $reqPrepare = $conn->prepare("DELETE FROM ecole WHERE idEcole = ?");
            $reqPrepare->execute(array($ecole->getId()));
            $conn->commit();
        }
        catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception("L'école ".$ecole->getId()." n'a pas pu être supprimée. Détails : <p>".$e->getMessage()."</p>");
        }
    }
}
