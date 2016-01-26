<?php

require_once 'm_Main.php';

/**
 *
 */
class MSeance
{
    /**
     * Récupère toutes les séances
     * @return Collection
     * @throws Exception
     */
    static public function getSeances() {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("SELECT * FROM seance");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $spectacle = MSpectacle::getSpectacleById($tab['idSpectacle']);
                $lieu = MLieu::getLieuById($tab['idLieu']);
                $seance = new Seance(
                    $tab['idSeance'],
                    $spectacle,
                    new \DateTime($tab['date_heure']),
                    $lieu
                );
                $coll->ajouter($seance);
            }
            return $coll;
        }
        catch (PDOException $e)
        {
            throw new Exception("Il n'y a aucune séance");
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * Récupère la séance numéro $id
     * @param int $id
     * @return Seance
     * @throws Exception
     */
    static public function getSeance($id) {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT * FROM seance WHERE idSeance = ?");
            $reqPrepare->execute(array($id));
            $tab = $reqPrepare->fetch();
            $spectacle = MSpectacle::getSpectacleById($tab['idSpectacle']);
            $lieu = MLieu::getLieuById($tab['idLieu']);
            $seance = new Seance(
                $tab['idSeance'],
                $spectacle,
                new \DateTime($tab['date_heure']),
                $lieu
            );
            return $seance;
        }
        catch (PDOException $e)
        {
            throw new Exception("La séance $id n'existe pas.");
        }
    }

    /**
     * Récupère les séances dans le lieu $lieu
     * @param Lieu $lieu
     * @return Collection
     * @throws Exception
     */
    static public function getSeanceByLocation(Lieu $lieu) {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT * FROM seance WHERE idLieu = ?");
            $reqPrepare->execute(array($lieu->getId()));
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $spectacle = MSpectacle::getSpectacleById($tab['idSpectacle']);
                $seance = new Seance(
                    $tab['idSeance'],
                    $spectacle,
                    new \DateTime($tab['date_heure']),
                    $lieu
                );
                $coll->ajouter($seance);
            }
            return $coll;
        }
        catch (PDOException $e)
        {
            throw new Exception("Il n'y a aucune séance dans le lieu ".$lieu->getId().".");
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * Récupère les séances du spectacle $spectacle
     * @param Spectacle $spectacle
     * @return Collection
     * @throws Exception
     */
    static public function getSeancesBySpec(Spectacle $spectacle) {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT * FROM seance WHERE idSpectacle = ?");
            $reqPrepare->execute(array($spectacle->getId()));
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $lieu = MLieu::getLieuById($tab['idLieu']);
                $seance = new Seance(
                    $tab['idSeance'],
                    $spectacle,
                    new \DateTime($tab['date_heure']),
                    $lieu
                );
                $coll->ajouter($seance);
            }
            return $coll;
        }
        catch (PDOException $e)
        {
            throw new Exception("Il n'y a aucune séance pour le spectacle ".$spectacle->getNom());
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }
    static public function getSeancesByLieu(Lieu $lieu) {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT * FROM seance WHERE idLieu = ?");
            $reqPrepare->execute(array($lieu->getId()));
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $spectacle = MSpectacle::getSpectacleById($tab['idSpectacle']);
                $seance = new Seance(
                    $tab['idSeance'],
                    $spectacle,
                    new \DateTime($tab['date_heure']),
                    $lieu
                );
                $coll->ajouter($seance);
            }
            return $coll;
        }
        catch (PDOException $e)
        {
            throw new Exception("Il n'y a aucune séance pour le spectacle ".$spectacle->getNom());
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * Supprime la séance $seance
     * @param Seance $seance
     * @throws Exception
     */
    static public function rmSeance(Seance $seance) {
        $conn = Main::bdd();
        try {
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("DELETE FROM planning WHERE idSeance = ?");
            $reqPrepare->execute(array($seance->getId()));
            $reqPrepare = $conn->prepare("DELETE FROM seance WHERE idSeance = ?");
            $reqPrepare->execute(array($seance->getId()));
            $conn->commit();
        }
        catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception("La séance ".$seance->getId()." n'a pas pu être supprimée. Détails : <p>".$e->getMessage()."</p>");
        }
    }

    /**
     * Supprime les séances du spectacle $spectacle
     * @param Spectacle $spectacle
     * @throws Exception
     */
    static public function rmSeancesSpec(Spectacle $spectacle) {
        $conn = Main::bdd();
        try {
            $conn->beginTransaction();
            foreach ($spectacle->getLesSeances()->getCollection() as $seance) {
                $reqPrepare = $conn->prepare("DELETE FROM planning WHERE idSeance = ?");
                $reqPrepare->execute(array($seance->getId()));
            }
            $reqPrepare = $conn->prepare("DELETE FROM seance WHERE idSpectacle = ?");
            $reqPrepare->execute(array($spectacle->getId()));
            $conn->commit();
            return true;
        }
        catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception("Les séances du spectacle ".$spectacle->getId()." n'ont pas pu être supprimées. Détails : <p>".$e->getMessage()."</p>");
            return false;
        }
    }
    static public function addSeance(Seance $seance) {
        $conn = Main::bdd();
        try
        {
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("INSERT INTO seance (idSpectacle, date_heure, idLieu) VALUES (?,?,?)");
            $reqPrepare->execute(array(
                $seance->getSpectacle()->getId(),
                $seance->getDate()->format('Y-m-d H:i:s'),
                $seance->getLieu()->getId()
            ));
            $conn->commit();
        }
        catch (PDOException $e)
        {
            $conn->rollBack();
            throw new Exception("L'ajout de la séance ".$seance->getId()." a échouée. Détails : <p>".$e->getMessage()."</p>");
        }
    }

    static public function getSeanceByIns($idInscription)
    {
        $conn = Main::bdd();
        $lesSeances = new Collection();
        try
        {
            $reqPrepare = $conn->prepare("SELECT choix.idInscription, spectacle.idSpectacle, seance.idSeance, seance.idLieu, seance.date_heure, choix.prioriteChoix
            FROM choix
            INNER JOIN spectacle ON choix.idSpectacle = spectacle.idSpectacle
            INNER JOIN seance ON seance.idSeance = spectacle.idSpectacle

            WHERE choix.idInscription = ?
            ORDER BY choix.prioriteChoix");
            $reqPrepare->execute(array($idInscription));
            $tabs = $reqPrepare->fetchAll();
            foreach ($tabs as $tab) {
                $spectacle = MSpectacle::getSpectacleById($tab['idSpectacle']);
                $inscription = MInscription::getInscriptionByIdInscription($idInscription);
                $lieu = MLieu::getLieuById($tab['idLieu']);
                $seance = new Seance($tab['idSeance'], $spectacle, new \DateTime($tab['date_heure']), $lieu);
                $choix = MChoix::getChoixBySub($inscription);
                $lesSeances->ajouter($seance);
}
        }
        catch (PDOException $e)
        {
            throw new Exception($e->getMessage());
        }
        return $lesSeances;
    }

}
