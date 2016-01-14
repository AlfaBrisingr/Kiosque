<?php

require_once 'm_Main.php';

class MInscription
{
    /**
     * Récupère toutes les inscriptions
     * @return Collection
     * @throws Exception
     */
    static public function getInscriptions() {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("SELECT * FROM inscription");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $enseignant = MEnseignant::getEnseignantById($tab['idEns']);
                $inscription = new Inscription(
                    $tab['idInscription'],
                    $enseignant,
                    new \DateTime($tab['dateInscription']),
                    $tab['diversInscription'],
                    $tab['impoInscription'],
                    $tab['nbEnfantsInscription'],
                    $tab['nbAdultesInscription']
                    );
                $lesChoix = MChoix::getChoixsByInscription($inscription);
                $inscription->setLesChoix($lesChoix);
                $coll->ajouter($inscription);
            }
            return $coll;
        }
        catch (PDOException $e)
        {
            throw new Exception("Il n'y a aucune inscription validée");
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }
    /**
     * Récupère toutes les incriptions non validées
     * @return Collection
     * @throws Exception
     */
    static public function getInscriptionsNonValide() {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("SELECT * FROM inscription WHERE validationInscription = 0");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $enseignant = MEnseignant::getEnseignantById($tab['idEns']);
                $inscription = new Inscription(
                    $tab['idInscription'],
                    $enseignant,
                    new \DateTime($tab['dateInscription']),
                    $tab['diversInscription'],
                    $tab['impoInscription'],
                    $tab['nbEnfantsInscription'],
                    $tab['nbAdultesInscription']
                    );
                $lesChoix = MChoix::getChoixsByInscription($inscription);
                $inscription->setLesChoix($lesChoix);
                $coll->ajouter($inscription);
            }
            return $coll;
        }
        catch (PDOException $e)
        {
            throw new Exception("Il n'y a aucune inscription non validée");
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * Récupère toutes les inscriptions validées
     * @return Collection
     * @throws Exception
     */
    static public function getInscriptionsValide() {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("SELECT * FROM inscription WHERE validationInscription = 1");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $enseignant = MEnseignant::getEnseignantById($tab['idEns']);
                $inscription = new Inscription(
                    $tab['idInscription'],
                    $enseignant,
                    new \DateTime($tab['dateInscription']),
                    $tab['diversInscription'],
                    $tab['impoInscription'],
                    $tab['nbEnfantsInscription'],
                    $tab['nbAdultesInscription']
                    );
                $lesChoix = MChoix::getChoixsByInscription($inscription);
                $inscription->setLesChoix($lesChoix);
                $coll->ajouter($inscription);
            }
            return $coll;
        }
        catch (PDOException $e)
        {
            throw new Exception("Il n'y a aucune inscription validée");
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }
    /**
     * Récupère les inscriptions d'un enseignant
     * @param Enseignant $enseignant
     * @return Inscription
     * @throws Exception
     */
    static public function getInscriptionByEnseignant(Enseignant $enseignant) {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT * FROM inscription WHERE idEns = ?");
            $reqPrepare->execute(array($enseignant->getId()));
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $inscription = new Inscription(
                    $tab['idInscription'],
                    $enseignant,
                    new \DateTime($tab['dateInscription']),
                    $tab['diversInscription'],
                    $tab['impoInscription'],
                    $tab['nbEnfantsInscription'],
                    $tab['nbAdultesInscription']
                    );
                $lesChoix = MChoix::getChoixsByInscription($inscription);
                $inscription->setLesChoix($lesChoix);
                $coll->ajouter($inscription);
            }
            return $coll;
        }
        catch (PDOException $e)
        {
            throw new Exception("L'enseignant ".$enseignant->getId()." n'a aucune inscription.");
        }
    }

    /**
     * Récupère l'inscription dont le numéro est passé en paramètre
     * @param int $id idInscription
     * @return Inscription
     * @throws Exception
     */
    static public function getInscriptionByIdInscription($id) {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT * FROM inscription WHERE idInscription = ?");
            $reqPrepare->execute(array($id));
            $tab = $reqPrepare->fetch();
            $enseignant = MEnseignant::getEnseignantById($tab['idEns']);
            $inscription = new Inscription(
                $tab['idInscription'],
                $enseignant,
                new \DateTime($tab['dateInscription']),
                $tab['diversInscription'],
                $tab['impoInscription'],
                $tab['nbEnfantsInscription'],
                $tab['nbAdultesInscription']
                );
            $lesChoix = MChoix::getChoixsByInscription($inscription);
            $inscription->setLesChoix($lesChoix);
            return $inscription;
        }
        catch (PDOException $e)
        {
            throw new Exception("L'inscription $id n'existe pas.");
        }
    }
    /**
     * Ajoute une inscription
     * @param Inscription $inscription
     * @throws Exception
     */
    static public function addInscription(Inscription $inscription){
        $conn = Main::bdd();
        try
        {
            $conn->beginTransaction();
            $validated = null;
            if($inscription->isValidated())
                $validated = 1;
            else
                $validated = 0;
            $reqPrepare = $conn->prepare("INSERT INTO inscription (validationInscription, idEns, dateInscription, diversInscription, impoInscription, nbEnfantsInscription, nbAdultesInscription) VALUES (?,?,?,?,?,?,?)");
            $reqPrepare->execute(array(
                $validated,
                $inscription->getEnseignant()->getId(),
                $inscription->getDate()->format('Y-m-d H:i:s'),
                $inscription->getDivers(),
                $inscription->getImpo(),
                $inscription->getNbEnfants(),
                $inscription->getNbAdultes()
                ));
        }
        catch (PDOException $e)
        {
            $conn->rollBack();
            throw new Exception("L'ajout de l'inscription ".$inscription->getId()." a échouée. Détails : <p>".$e->getMessage()."</p>");
        }
    }

    /**
     * Modifie une inscription
     * @param Inscription $inscription
     * @throws Exception
     */
    static public function editInscription(Inscription $inscription)
    {
        $conn = Main::bdd();
        try
        {
            $conn->beginTransaction();
            $validated = null;
            if($inscription->isValidated())
                $validated = 1;
            else
                $validated = 0;
            $reqPrepare = $conn->prepare("UPDATE inscription SET validationInscription = ?, idEns = ?, dateInscription = ?, diversInscription = ?, impoInscription = ?, nbEnfantsInscription = ?, nbAdultesInscription = ? WHERE idInscription = ?");
            $reqPrepare->execute(array(
                $validated,
                $inscription->getEnseignant()->getId(),
                $inscription->getDate()->format('Y-m-d H:i:s'),
                $inscription->getDivers(),
                $inscription->getImpo(),
                $inscription->getNbEnfants(),
                $inscription->getNbAdultes(),
                $inscription->getId()
                ));
        }
        catch (PDOException $e)
        {
            $conn->rollBack();
            throw new Exception("L'inscription ".$inscription->getId()." n'a pas pu être modifiée. Détails : <p>".$e->getMessage()."</p>");
        }
    }

    /**
     * Supprime une inscription
     * @param Inscription $inscription
     * @throws Exception
     */
    static public function rmInscription(Inscription $inscription) {
        $conn = Main::bdd();
        try {
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("DELETE FROM choix WHERE idInscription = ?");
            $reqPrepare->execute(array($inscription->getId()));
            $reqPrepare = $conn->prepare("DELETE FROM inscription WHERE idInscription = ?");
            $reqPrepare->execute(array($inscription->getId()));
        }
        catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception("L'inscription ".$inscription->getId()." n'a pas pu être supprimée. Détails : <p>".$e->getMessage()."</p>");
        }
    }
}