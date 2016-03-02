<?php namespace Kiosque\Models;

class MSaison
{
    /**
     * Récupère les saisons
     * @return Collection
     * @throws Exception
     */
    static public function getSaisons() {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("SELECT * FROM saison s");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab){
                $saison = new Saison(
                    $tab['idSaison'],
                    $tab['nomSaison'],
                    $tab['courante']
                );
                $lesSpectacles = MSpectacle::getSpectaclesBySaison($saison);
                $saison->setLesSpectacles($lesSpectacles);
                $coll->ajouter($saison);
            }
            return $coll;
        }
        catch (PDOException $e)
        {
            throw new Exception("La saison n'existe pas.");
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * Récupère la saison dont le numéro est passé en paramètre
     * @param int $id
     * @return Saison
     * @throws Exception
     */
    static public function getSaisonById($id) {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT * FROM saison s WHERE s.idSaison = ?");
            $reqPrepare->execute(array($id));
            $tab = $reqPrepare->fetch();
            $saison = new Saison(
                $tab['idSaison'],
                $tab['nomSaison'],
                $tab['courante']
            );
            $lesSpectacles = MSpectacle::getSpectaclesBySaison($saison);
            $saison->setLesSpectacles($lesSpectacles);
            return $saison;
        }
        catch (PDOException $e)
        {
            throw new Exception("La saison $id n'existe pas.");
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * Récupère la saison dont le nom est passé en paramètre
     * @param string $name
     * @return Saison
     * @throws Exception
     */
    static public function getSaisonByName($name) {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT * FROM saison s INNER JOIN saison_spectacle ss ON ss.idSaison = s.idSaison INNER JOIN spectacle sp ON sp.idSpectacle = ss.idSpectacle WHERE s.nomSaison = ?");
            $reqPrepare->execute(array($name));
            $tab = $reqPrepare->fetchAll();
            $lesSpectacles = MSpectacle::getSpectaclesByIdSaison($tab['idSaison']);
            $saison = new Saison(
                $tab['idSaison'],
                $tab['nomSaison'],
                $tab['courante']
            );
            $saison->setLesSpectacles($lesSpectacles);
            return $saison;
        }
        catch (PDOException $e)
        {
            throw new Exception("La saison $name n'existe pas.");
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * Récupère la saison courante
     * @return Saison
     * @throws Exception
     */
    static public function getSaisonCourante() {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("SELECT * FROM saison s WHERE courante = 1");
            $tab = $reqPrepare->fetch();
            $saison = new Saison(
                $tab['idSaison'],
                $tab['nomSaison'],
                $tab['courante']
            );
            $lesSpectacles = MSpectacle::getSpectaclesBySaison($saison);
            $saison->setLesSpectacles($lesSpectacles);
            return $saison;
        }
        catch (PDOException $e)
        {
            throw new Exception("La saison n'existe pas.");
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * Récupère la saison courante
     * @return Saison
     * @throws Exception
     */
    static public function getSaisonNonCourante() {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("SELECT * FROM saison s WHERE courante = 0");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab){
                $saison = new Saison(
                    $tab['idSaison'],
                    $tab['nomSaison'],
                    $tab['courante']
                );
                $lesSpectacles = MSpectacle::getSpectaclesBySaison($saison);
                $saison->setLesSpectacles($lesSpectacles);
                $coll->ajouter($saison);
            }
            return $coll;
        }
        catch (PDOException $e)
        {
            throw new Exception("La saison n'existe pas.");
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }


    static public function getSaisonByIdSpectacle($id) {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT s.idSaison, s.nomSaison, s.courante FROM saison s INNER JOIN saison_spectacle ss ON ss.idSaison = s.idSaison INNER JOIN spectacle sp ON sp.idSpectacle = ss.idSpectacle WHERE sp.idSpectacle = ?");
            $reqPrepare->execute(array($id));
            $tab = $reqPrepare->fetch();
            $saison = new Saison(
                $tab['idSaison'],
                $tab['nomSaison'],
                $tab['courante']
            );
            $lesSpectacles = MSpectacle::getSpectaclesBySaison($saison);
            $saison->setLesSpectacles($lesSpectacles);
            return $saison;
        }
        catch (PDOException $e)
        {
            throw new Exception("La saison n'existe pas.");
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }


    /**
     * Change la saison courante
     * @param Saison $saisonAncienne
     * @param Saison $saisonNouvelle
     * @return bool
     * @throws Exception
     */
    static public function setSaisonCourante(Saison $saisonAncienne, Saison $saisonNouvelle) {
        $conn = Main::bdd();
        try
        {
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("UPDATE saison SET courante = 0 WHERE idSaison = ?");
            $reqPrepare->execute(array($saisonAncienne->getId()));
            $reqPrepare = $conn->prepare("UPDATE saison SET courante = 1 WHERE idSaison = ?");
            $reqPrepare->execute(array($saisonNouvelle->getId()));
            $conn->commit();
        }
        catch (PDOException $e)
        {
            $conn->rollBack();
            throw new Exception("La saison courante n'a pas pu être modifiée. Détails : <p>".$e->getMessage()."</p>");
        }
    }

    static public function getSaisonSpectacle() {
        try {
            $conn = Main::bdd();
            return $conn->query("SELECT * FROM spectacle as spec
				INNER JOIN saison_spectacle as ss ON ss.idSpectacle = spec.idSpectacle
				INNER JOIN saison as s ON s.idSaison = ss.idSaison
				ORDER BY nomSpectacle");
        }
        catch (PDOException $e) {
            throw new Exception($e->getMessage());

        }
    }
    static public function getSaisonDuSpectacle(Spectacle $spectacle) {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT * FROM spectacle as spec
				INNER JOIN saison_spectacle as ss ON ss.idSpectacle = spec.idSpectacle
				INNER JOIN saison as s ON s.idSaison = ss.idSaison
				WHERE spec.idSpectacle = ?
				ORDER BY nomSpectacle");
            $reqPrepare->execute(array($spectacle->getId()));
            $tab = $reqPrepare->fetch();
            $saison = new Saison(
                $tab['idSaison'],
                $tab['nomSaison'],
                $tab['courante']
            );
            $lesSpectacles = MSpectacle::getSpectaclesBySaison($saison);
            $saison->setLesSpectacles($lesSpectacles);
            return $saison;
        }
        catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    static public function AjoutSaisonSpectacle(Saison $saison, Spectacle $spectacle){
        $conn = Main::bdd();
        try {

            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("INSERT INTO saison_spectacle(idSaison, idSpectacle) VALUES (?,?)");
            $reqPrepare->execute(array($saison->getId(),$spectacle->getId()));
            $conn->commit();
        }
        catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception($e->getMessage());
        }
    }

    static public function setSaisonSpectacle(Saison $saison, Spectacle $spectacle){
        $conn = Main::bdd();
        try {

            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("UPDATE saison_spectacle SET idSaison = ? WHERE idSpectacle = ?");
            $reqPrepare->execute(array($saison->getId(),$spectacle->getId()));
            $conn->commit();
        }
        catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception($e->getMessage());
        }
    }
    static public function rmSaisonSpectacle(Spectacle $spectacle) {
        $conn = Main::bdd();
        try {

            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("DELETE FROM saison_spectacle WHERE idSpectacle = ?");
            $reqPrepare->execute(array($spectacle->getId()));
            $conn->commit();
        }
        catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception($e->getMessage());
        }
    }


}
