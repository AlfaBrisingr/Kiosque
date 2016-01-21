<?php

require_once 'm_Main.php';

class MChoix
{
    /**
     * Récupère tous les choix
     * @return Collection
     * @throws Exception
     */
    static public function getChoixs() {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("SELECT * FROM choix");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $inscription = MInscription::getInscriptionByIdInscription($tab['idInscription']);
                $inscription->setLesChoix(MChoix::getChoixBySub($inscription));
                $spectacle = MSpectacle::getSpectacleById($tab['idSpectacle']);
                $choix = new Choix($inscription,$spectacle,$tab['prioriteChoix']);
                $coll->ajouter($choix);
            }
            return $coll;
        }
        catch (PDOException $e)
        {
            throw new Exception("Il n'y a aucun choix");
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }
    static public function getChoixBySub(Inscription $inscription) {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT * FROM choix WHERE idInscription = ? ORDER BY PrioriteChoix");
            $reqPrepare->execute(array($inscription->getId()));
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $spectacle = MSpectacle::getSpectacleById($tab['idSpectacle']);
                $choix = new Choix($inscription,$spectacle,$tab['prioriteChoix']);
                $coll->ajouter($choix);
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
    static public function rmChoix(Choix $choix) {
        $conn = Main::bdd();
        try {
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("DELETE FROM choix WHERE idInscription = ?");
            $reqPrepare->execute(array($choix->getId()));
            $conn->commit();
        }
        catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception("Le choix n'a pu être supprimé. Détails : <p>".$e->getMessage()."</p>");
        }
    }
    static public function addChoix(Choix $choix) {
        $conn = Main::bdd();
        try
        {
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("INSERT INTO choix (idInscription, idSpectacle, prioriteChoix) VALUES (?,?,?)");
            $reqPrepare->execute(array(
                $choix->getInscription()->getId(),
                $choix->getSpectacle()->getId(),
                $choix->getPriorite()
            ));
            $conn->commit();
        }
        catch (PDOException $e)
        {
            $conn->rollBack();
            throw new Exception("L'ajout du choix a échoué. Détails : <p>".$e->getMessage()."</p>");
        }
    }
}
