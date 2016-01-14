<?php

require_once 'm_Main.php';

class MEnseignant
{
    /**
     * Récupère tous les enseignants
     * @return Collection
     * @throws Exception
     */
    static public function getEnseignants()
    {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("
                SELECT e.idEcole, typeEcole, nomEcole, adresseEcole, adresse2Ecole, cpEcole, villeEcole, mail_dir, civEns, nomEns, prenomEns, mailEns, telEns FROM ecole
                FROM enseignant ens
                INNER JOIN ecole e ON e.idEcole = ens.idEcole");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $directeur = new Enseignant($tab['idEns'], $tab['civEns'], $tab['nomEns'], $tab['prenomEns'], $tab['mailEns'], $tab['telEns']);
                $ecole = new Ecole($tab['idEcole'], $tab['nomEcole'], $tab['adresseEcole'], $tab['adresse2Ecole'], $tab['cpEcole'], $tab['villeEcole'], $tab['mail_dir'], $directeur);
                $lesInscriptions = MInscription::getInscriptionsByEns($directeur);
                $directeur->setEcole($ecole);
                $directeur->setLesInscriptions($lesInscriptions);
                $coll->ajouter($directeur);
            }
            return $coll;
        }
        catch (PDOException $e)
        {
            throw new Exception("Il n'y a aucun enseignant");
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * Récupère l'enseignant dont le numéro est passé en paramètres
     * @param int $codeEnseignant
     * @return Enseignant
     * @throws Exception
     */
    static public function getEnseignantById($codeEnseignant)
    {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT e.idEcole, typeEcole, nomEcole, adresseEcole, adresse2Ecole, cpEcole, villeEcole, mail_dir, idEns , civEns, nomEns, prenomEns, mailEns, telEns
                FROM enseignant ens
                INNER JOIN ecole e ON e.idEcole = ens.idEcole
                WHERE ens.idEns = ?");
            $reqPrepare->execute(array($codeEnseignant));
            $tab = $reqPrepare->fetch();
            $directeur = new Enseignant($tab['idEns'], $tab['civEns'], $tab['nomEns'], $tab['prenomEns'], $tab['mailEns'], $tab['telEns']);
            $ecole = new Ecole($tab['idEcole'], $tab['nomEcole'], $tab['adresseEcole'], $tab['adresse2Ecole'], $tab['cpEcole'], $tab['villeEcole'], $tab['mail_dir'], $directeur);
            $lesInscriptions = MInscription::getInscriptionByEnseignant($directeur);
            $directeur->setEcole($ecole);
            $directeur->setLesInscriptions($lesInscriptions);
            return $directeur;
        }
        catch (PDOException $e)
        {
            throw new Exception("L'enseignant n°$codeEnseignant n'existe pas");
        }
    }

    /**
     * Récupère l'enseignant dont le nom et prénom sont passés en paramètres
     * @param string $name
     * @param string $prenom
     * @return Enseignant
     * @throws Exception
     */
    public function getEnseignantByName($name,$prenom)
    {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT e.idEcole, typeEcole, nomEcole, adresseEcole, adresse2Ecole, cpEcole, villeEcole, mail_dir, civEns, nomEns, prenomEns, mailEns, telEns FROM ecole
                FROM enseignant ens
                INNER JOIN ecole e ON e.idEcole = ens.idEcole
                WHERE ens.nomEns = ? AND ens.prenomEns = ?");
            $reqPrepare->execute(array($name, $prenom));
            $tab = $reqPrepare->fetch();
            $directeur = new Enseignant($tab['idEns'], $tab['civEns'], $tab['nomEns'], $tab['prenomEns'], $tab['mailEns'], $tab['telEns']);
            $ecole = new Ecole($tab['idEcole'], $tab['nomEcole'], $tab['adresseEcole'], $tab['adresse2Ecole'], $tab['cpEcole'], $tab['villeEcole'], $tab['mail_dir'], $directeur);
            $lesInscriptions = MInscription::getInscriptionsByEns($directeur);
            $directeur->setEcole($ecole);
            $directeur->setLesInscriptions($lesInscriptions);
            return $directeur;
        }
        catch (PDOException $e)
        {
            throw new Exception("L'enseignant '$name $prenom' n'existe pas");
        }
    }

    /**
     * Ajoute un enseignant
     * @param Enseignant $enseignant
     * @throws Exception
     */
    public function addEnseignant(Enseignant $enseignant)
    {
        $conn = Main::bdd();
        try
        {
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("INSERT INTO enseignant (civEns, nomEns, prenomEns, mailEns, telEns, idEcole) VALUES (?,?,?,?,?,?)");
            $reqPrepare->execute(array(
                $enseignant->getCivilite(),
                $enseignant->getNom(),
                $enseignant->getPrenom(),
                $enseignant->getMail(),
                $enseignant->getTel(),
                $enseignant->getEcole()->getId()
                ));
        }
        catch (PDOException $e)
        {
            $conn->rollBack();
            throw new Exception("L'ajout de l'enseignant ".$enseignant->getId()." a échoué. Détails : <p>".$e->getMessage()."</p>");
        }
    }

    /**
     * Modifie un enseignant
     * @param Enseignant $enseignant
     * @throws Exception
     */
    static public function editEnseignant(Enseignant $enseignant)
    {
        $conn = Main::bdd();
        try {
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("UPDATE enseignant SET civEns = ?, nomEns = ?, prenomEns = ?, mailEns = ?, telEns = ?, idEcole = ? WHERE idEns = ?");
            $reqPrepare->execute(array(
                $enseignant->getCivilite(),
                $enseignant->getNom(),
                $enseignant->getPrenom(),
                $enseignant->getMail(),
                $enseignant->getTel(),
                $enseignant->getEcole()->getId(),
                $enseignant->getId()
                ));
        }
        catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception("L'enseignant ".$enseignant->getId()." n'a pas pu être modifiée. Détails : <p>".$e->getMessage()."</p>");
        }
    }
    /**
     * Supprime un enseignant et ses inscriptions en cascade
     * @param Enseignant $enseignant
     * @throws Exception
     */
    public function rmEnseignant(Enseignant $enseignant)
    {
        $conn = Main::bdd();
        try {
            $conn->beginTransaction();
            foreach ($enseignant->getLesInscriptions()->getCollection() as $inscription)
            {
                $reqPrepare = $conn->prepare("DELETE FROM choix WHERE idInscription = ?");
                $reqPrepare->execute(array($inscription->getId()));
            }
            $reqPrepare = $conn->prepare("DELETE FROM inscription WHERE idEns = ?");
            $reqPrepare->execute(array($enseignant->getId()));
            $reqPrepare = $conn->prepare("DELETE FROM enseignant WHERE idEns = ?");
            $reqPrepare->execute(array($enseignant->getId()));
        }
        catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception("L'enseignant ".$enseignant->getId()." n'a pas pu être supprimé. Détails : <p>".$e->getMessage()."</p>");
        }
    }
}
