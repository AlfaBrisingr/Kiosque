<?php namespace Kiosque\Models;

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
                    $tab['nbAdultesInscription'],
                    $tab['classe']
                );
                if($tab['validationInscription'] == '1'){
                    $inscription->setValidated(true);
                }else{
                    $inscription->setValidated(false);
                }
                $lesChoix = MChoix::getChoixBySub($inscription);
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
     * Récupère toutes les inscriptions
     * @return Collection
     * @throws Exception
     */
    static public function getInscriptionsJeunePublic() {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("SELECT * FROM inscription i
             INNER JOIN enseignant en ON en.idEns = i.idEns
             INNER JOIN ecole e ON e.idEcole = en.idEcole
             WHERE typeEcole = 1 OR typeEcole = 2");
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
                    $tab['nbAdultesInscription'],
                    $tab['classe']
                );
                if($tab['validationInscription'] == '1'){
                    $inscription->setValidated(true);
                }else{
                    $inscription->setValidated(false);
                }
                $lesChoix = MChoix::getChoixBySub($inscription);
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
     * Récupère toutes les inscriptions
     * @return Collection
     * @throws Exception
     */
    static public function getInscriptionsCollegeLycee() {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("SELECT * FROM inscription i
             INNER JOIN enseignant en ON en.idEns = i.idEns
             INNER JOIN ecole e ON e.idEcole = en.idEcole
             WHERE typeEcole = 3 OR typeEcole = 4");
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
                    $tab['nbAdultesInscription'],
                    $tab['classe']
                );
                if($tab['validationInscription'] == '1'){
                    $inscription->setValidated(true);
                }else{
                    $inscription->setValidated(false);
                }
                $lesChoix = MChoix::getChoixBySub($inscription);
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
                    $tab['nbAdultesInscription'],
                    $tab['classe']
                );
                $lesChoix = MChoix::getChoixBySub($inscription);
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
                    $tab['nbAdultesInscription'],
                    $tab['classe']
                );
                $lesChoix = MChoix::getChoixBySub($inscription);
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
                    $tab['nbAdultesInscription'],
                    $tab['classe']
                );
                $lesChoix = MChoix::getChoixBySub($inscription);
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
                $tab['nbAdultesInscription'],
                $tab['classe']
            );
            $lesChoix = MChoix::getChoixBySub($inscription);
            $inscription->setLesChoix($lesChoix);
            return $inscription;
        }
        catch (PDOException $e)
        {
            throw new Exception("L'inscription $id n'existe pas.");
        }
    }

    static public function getNbEnfantsInscription(){
        $conn = Main::bdd();
        try{
            $reqPrepare = $conn->query("SELECT SUM(nbEnfantsInscription) as 'nbEnfants' FROM inscription GROUP BY idInscription ");
            $req = $reqPrepare->fetch();
            return $req['nbEnfants'];
        }
        catch (PDOException $e)
        {
            throw new Exception($e->getMessage());
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
            $reqPrepare = $conn->prepare("INSERT INTO inscription (validationInscription, idEns, dateInscription, diversInscription, impoInscription, nbEnfantsInscription, nbAdultesInscription, classe) VALUES (?,?,?,?,?,?,?,?)");
            $reqPrepare->execute(array(
                $validated,
                $inscription->getEnseignant()->getId(),
                $inscription->getDate()->format('Y-m-d H:i:s'),
                $inscription->getDivers(),
                $inscription->getImpo(),
                $inscription->getNbEnfants(),
                $inscription->getNbAdultes(),
                $inscription->getClasse()
            ));
            $id = $conn->lastInsertId();

            $conn->commit();

            return $id;
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
            $reqPrepare = $conn->prepare("UPDATE inscription SET validationInscription = ?, idEns = ?, dateInscription = ?, diversInscription = ?, impoInscription = ?, nbEnfantsInscription = ?, nbAdultesInscription = ?, classe = ? WHERE idInscription = ?");
            $reqPrepare->execute(array(
                $validated,
                $inscription->getEnseignant()->getId(),
                $inscription->getDate()->format('Y-m-d H:i:s'),
                $inscription->getDivers(),
                $inscription->getImpo(),
                $inscription->getNbEnfants(),
                $inscription->getNbAdultes(),
                $inscription->getClasse(),
                $inscription->getId()
            ));
            $conn->commit();
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
            MPlanning::rmPlanningByInscription($inscription);
            $reqPrepare = $conn->prepare("DELETE FROM choix WHERE idInscription = ?");
            $reqPrepare->execute(array($inscription->getId()));
            $reqPrepare = $conn->prepare("DELETE FROM inscription WHERE idInscription = ?");
            $reqPrepare->execute(array($inscription->getId()));
            $conn->commit();
        }
        catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception("L'inscription ".$inscription->getId()." n'a pas pu être supprimée. Détails : <p>".$e->getMessage()."</p>");
        }
    }

    static public function getInscriptionByIdEnseignantNonJoin(Enseignant $enseignant){
        $conn = Main::bdd();
        try {

            $reqPrepare = $conn->prepare("SELECT * FROM inscription WHERE idEns = ?");
            $reqPrepare->execute(array($enseignant->getId()));
            $tab = $reqPrepare->fetchall();
            return $tab;
        }
        catch (PDOException $e)
        {
            throw new Exception("L'enseignant ".$enseignant->getId()." n'a aucune inscription.");
        }
    }

    static public function getIdInscription(Inscription $inscription){
        $conn = Main::bdd();
        try{
            $reqPrepare = $conn->prepare("SELECT idIscription FROM inscription");
            $reqPrepare->execute(array(Main::bdd()->lastInsertId($inscription->getId())));
            $req = $reqPrepare->fetch();
            return $req;
        }
        catch (PDOException $e)
        {
            throw new Exception("L'id de l'inscription n° ".$inscription->getId()." n'a pas été retrouvé.");
        }
    }

    static public function validerInscription(Inscription $inscription){
        $conn = Main::bdd();
        try{
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("UPDATE inscription SET validationInscription = 1 WHERE idInscription = ?");
            $reqPrepare->execute(array($inscription->getId()));
            $conn->commit();
        }
        catch (PDOException $e){
            $conn->rollBack();
            throw new Exception("l'inscription n° ".$inscription->getId()." n'a pas été valider.");
        }
    }
}
