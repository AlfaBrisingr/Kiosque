<?php
require_once 'm_Main.php';

class MPlanning
{

    /**
     * Récupère tous les plannings
     * @return Collection
     * @throws Exception
     */
    static public function getPlannings() {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("SELECT * FROM planning ORDER BY idSeance");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $inscription = MInscription::getInscriptionByIdInscription($tab['idInscription']);
                $seance = MSeance::getSeance($tab['idSeance']);
                $planning = new Planning($seance, $inscription);
                $coll->ajouter($planning);
            }
            return $coll;
        }
        catch (PDOException $e)
        {
            throw new Exception("Il n'y a aucun planning");
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * Récupère tous les plannings
     * @return Collection
     * @throws Exception
     */
    static public function getPlanningsJeunePublic() {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("SELECT * FROM planning p
             INNER JOIN inscription i ON i.idInscription = p.idInscription
             INNER JOIN enseignant en ON en.idEns = i.idEns
             INNER JOIN ecole e ON e.idEcole = en.idEcole
             WHERE typeEcole = 1 OR typeEcole = 2
             ORDER BY idSeance");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $inscription = MInscription::getInscriptionByIdInscription($tab['idInscription']);
                $seance = MSeance::getSeance($tab['idSeance']);
                $planning = new Planning($seance, $inscription);
                $coll->ajouter($planning);
            }
            return $coll;
        }
        catch (PDOException $e)
        {
            throw new Exception("Il n'y a aucun planning");
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * Récupère tous les plannings
     * @return Collection
     * @throws Exception
     */
    static public function getPlanningsCollegeLycee() {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("SELECT * FROM planning p
             INNER JOIN inscription i ON i.idInscription = p.idInscription
             INNER JOIN enseignant en ON en.idEns = i.idEns
             INNER JOIN ecole e ON e.idEcole = en.idEcole
             WHERE typeEcole = 3 OR typeEcole = 4
             ORDER BY idSeance");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $inscription = MInscription::getInscriptionByIdInscription($tab['idInscription']);
                $seance = MSeance::getSeance($tab['idSeance']);
                $planning = new Planning($seance, $inscription);
                $coll->ajouter($planning);
            }
            return $coll;
        }
        catch (PDOException $e)
        {
            throw new Exception("Il n'y a aucun planning");
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * Recuperer un planning
     * @param int $idSeance, int $idInscription
     * @return Planning
     */
    static public function getPlanning($idSeance,$idInscription){
        try{
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT * FROM planning WHERE idSeance = ? AND idInscription = ? ");
            $reqPrepare->execute(array($idSeance, $idInscription));
            $tab = $reqPrepare->fetch();
            $seance = MSeance::getSeance($tab['idSeance']);
            $inscription = MInscription::getInscriptionByIdInscription($tab['idInscription']);
            $planning = new Planning($seance,$inscription);
            return $planning;
        }
        catch (PDOException $e){
            throw new Exception("Il n'y a aucun planning");
        }
    }

    /**
     * Récupère la jauge restante
     * @return Collection
     * @throws Exception
     */
    static public function getJaugeRestante() {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("SELECT *, SUM(i.nbAdultesInscription + i.nbEnfantsInscription) as jaugeUtilise, SUM(i.nbAdultesInscription) as nbAdultes, SUM(i.nbEnfantsInscription) as nbEnfants, spec.nbPlaceSpectacle as jaugeMax, (spec.nbPlaceSpectacle - SUM((i.nbAdultesInscription + i.nbEnfantsInscription))) as jaugeRestante FROM planning as p
				INNER JOIN inscription as i ON i.idInscription = p.idInscription
				INNER JOIN seance as s ON s.idSeance = p.idSeance
				INNER JOIN spectacle as spec ON spec.idSpectacle = s.idSpectacle
				WHERE i.validationInscription = 1
				GROUP BY s.idSeance");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $seance = MSeance::getSeance($tab['idSeance']);
                $jauge = new Jauge($tab['jaugeUtilise'], $tab['jaugeRestante'], $tab['nbEnfants'], $tab['nbAdultes'], $tab['jaugeMax'], $seance);
                $coll->ajouter($jauge);
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
     * Récupère la jauge restante
     * @return Collection
     * @throws Exception
     */
    static public function getJaugeRestanteJeunePublic() {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("SELECT *, SUM(i.nbAdultesInscription + i.nbEnfantsInscription) as jaugeUtilise, SUM(i.nbAdultesInscription) as nbAdultes, SUM(i.nbEnfantsInscription) as nbEnfants, spec.nbPlaceSpectacle as jaugeMax, (spec.nbPlaceSpectacle - SUM((i.nbAdultesInscription + i.nbEnfantsInscription))) as jaugeRestante FROM planning as p
				INNER JOIN inscription as i ON i.idInscription = p.idInscription
				INNER JOIN seance as s ON s.idSeance = p.idSeance
				INNER JOIN spectacle as spec ON spec.idSpectacle = s.idSpectacle
				WHERE i.validationInscription = 1
				AND spec.typeSpectacle = 1
				GROUP BY s.idSeance");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $seance = MSeance::getSeance($tab['idSeance']);
                $jauge = new Jauge($tab['jaugeUtilise'], $tab['jaugeRestante'], $tab['nbEnfants'], $tab['nbAdultes'], $tab['jaugeMax'], $seance);
                $coll->ajouter($jauge);
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
     * Récupère la jauge restante
     * @return Collection
     * @throws Exception
     */
    static public function getJaugeRestanteCollegeLycee() {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("SELECT *, SUM(i.nbAdultesInscription + i.nbEnfantsInscription) as jaugeUtilise, SUM(i.nbAdultesInscription) as nbAdultes, SUM(i.nbEnfantsInscription) as nbEnfants, spec.nbPlaceSpectacle as jaugeMax, (spec.nbPlaceSpectacle - SUM((i.nbAdultesInscription + i.nbEnfantsInscription))) as jaugeRestante FROM planning as p
				INNER JOIN inscription as i ON i.idInscription = p.idInscription
				INNER JOIN seance as s ON s.idSeance = p.idSeance
				INNER JOIN spectacle as spec ON spec.idSpectacle = s.idSpectacle
				WHERE i.validationInscription = 1
				AND spec.typeSpectacle = 2
				GROUP BY s.idSeance");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $seance = MSeance::getSeance($tab['idSeance']);
                $jauge = new Jauge($tab['jaugeUtilise'], $tab['jaugeRestante'], $tab['nbEnfants'], $tab['nbAdultes'], $tab['jaugeMax'], $seance);
                $coll->ajouter($jauge);
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
     * Récupère la jauge restante par séance
     * @param Seance $seance
     * @return Collection
     * @throws Exception
     */
    static public function getJaugeRestanteBySeance(Seance $seance) {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT *, SUM(i.nbAdultesInscription + i.nbEnfantsInscription) as jaugeUtilise, SUM(i.nbAdultesInscription) as nbAdultes, SUM(i.nbEnfantsInscription) as nbEnfants, spec.nbPlaceSpectacle as jaugeMax, (spec.nbPlaceSpectacle - SUM((i.nbAdultesInscription + i.nbEnfantsInscription))) as jaugeRestante FROM planning as p
				INNER JOIN inscription as i ON i.idInscription = p.idInscription
				INNER JOIN seance as s ON s.idSeance = p.idSeance
				INNER JOIN spectacle as spec ON spec.idSpectacle = s.idSpectacle
				WHERE i.validationInscription = 1 and s.isSeance = ?
				GROUP BY s.idSeance");
            $reqPrepare->execute(array($seance->getId()));
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $seance = MSeance::getSeance($tab['idSeance']);
                $jauge = new Jauge($tab['jaugeUtilise'], $tab['jaugeRestante'], $tab['nbEnfants'], $tab['nbAdultes'], $tab['jaugeMax'], $seance);
                $coll->ajouter($jauge);
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
     * Récupère le planning où la séance est passée en paramètre
     * @param Seance $seance
     * @return Collection
     * @throws Exception
     */
    static public function getPlanningBySeance(Seance $seance) {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT * FROM planning WHERE idSeance = ?");
            $reqPrepare->execute(array($seance->getId()));
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $inscription = MInscription::getInscriptionByIdInscription($tab['idInscription']);
                $seance = MSeance::getSeance($tab['idSeance']);
                $planning = new Planning($seance, $inscription);
                $coll->ajouter($planning);
            }
            return $coll;
        }
        catch (PDOException $e)
        {
            throw new Exception("La séance ".$seance->getId()." n'est pas dans le planning");
        }
    }

    /**
     * Récupère le planning où l'inscription est passé en paramètre
     * @param Inscription $inscription
     * @return Planning
     * @throws Exception
     */
    static public function getPlanningByInscription(Inscription $inscription) {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT * FROM planning WHERE idInscription = ?");
            $reqPrepare->execute(array($inscription->getId()));
            $tab = $reqPrepare->fetch();
            $seance = MSeance::getSeance($tab['idSeance']);
            $planning = new Planning($seance, $inscription);
            return $planning;
        }
        catch (PDOException $e)
        {
            throw new Exception("L'inscription ".$inscription->getId()." n'est pas dans le planning");
        }
    }

    /**
     * Supprime la séance et l'inscription du planning
     * @param Seance $seance
     * @param Inscription $inscription
     * @throws Exception
     */
    static public function rmPlanning(Seance $seance, Inscription $inscription) {
        $conn = Main::bdd();
        try {
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("DELETE FROM planning WHERE idSeance = ? AND idInscription = ?");
            $reqPrepare->execute(array($seance->getId(), $inscription->getId()));
            $conn->commit();
        }
        catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception("Le planning n'a pas pu être supprimé. Détails : <p>".$e->getMessage()."</p>");
        }
    }

    static public function rmPlanningbySeance(Seance $seance) {
        $conn = Main::bdd();
        try {
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("DELETE FROM planning WHERE idSeance = ? ");
            $reqPrepare->execute(array($seance->getId()));
            $conn->commit();
        }
        catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception("Le planning n'a pas pu être supprimé. Détails : <p>".$e->getMessage()."</p>");
        }
    }

    /**
 * Ajoute la séance et l'inscription au planning
 * @param Seance $seance
 * @param Inscription $inscription
 * @throws Exception
 */
    static public function addPlanning(Seance $seance,Inscription $inscription) {
        $conn = Main::bdd();
        try
        {
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("INSERT INTO planning (idSeance, idInscription) VALUES (?,?)");
            $reqPrepare->execute(array(
                $seance->getId(),
                $inscription->getId()
            ));
            $conn->commit();
        }
        catch (PDOException $e)
        {
            $conn->rollBack();
            throw new Exception("L'ajout du planning a échoué. Détails : <p>".$e->getMessage()."</p>");
        }
    }

    /**
     * Supprime l'inscription du planning
     * @param Inscription $inscription
     * @throws Exception
     */
    static public function rmPlanningByInscription(Inscription $inscription) {
        $conn = Main::bdd();
        try {
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("DELETE FROM planning WHERE idInscription = ?");
            $reqPrepare->execute(array($inscription->getId()));
            $conn->commit();
        }
        catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception("Le planning n'a pas pu être supprimé. Détails : <p>".$e->getMessage()."</p>");
        }
    }

    /**
     * Ajoute la séance et l'inscription au planning
     * @param Planning $unPlanning
     * @throws Exception
     */
    static public function addUnPlanning(Planning $unPlanning) {
        $conn = Main::bdd();
        try
        {
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("INSERT INTO planning (idSeance, idInscription) VALUES (?,?)");
            $reqPrepare->execute(array(
                $unPlanning->getSeance()->getId(),
                $unPlanning->getInscription()->getId()
            ));
            $conn->commit();
        }
        catch (PDOException $e)
        {
            $conn->rollBack();
            throw new Exception("L'ajout du planning a échoué. Détails : <p>".$e->getMessage()."</p>");
        }
    }
}
