<?php
namespace Kiosque\Models;

use Kiosque\Classes\Collection;
use Kiosque\Classes\Spectacle;
use Kiosque\Classes\Saison;

class MSpectacle
{
    /**
     * Récupère tous les spectacles
     * @return Collection
     * @throws \Exception
     */
    public static function getSpectacles()
    {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->query(
                "SELECT sp.idSpectacle, nomSpectacle, nbPlaceSpectacle, typeClasse, typeSpectacle, s.idSaison, nomSaison, courante
                FROM spectacle sp
                INNER JOIN saison_spectacle ss on ss.idSpectacle = sp.idSpectacle
                INNER JOIN saison s on s.idSaison = ss.idSaison");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab) {
                //$saison = MSaison::getSaisonByIdSpectacle($tab['idSpectacle']);
                $saison = new Saison($tab['idSaison'], $tab['nomSaison'], $tab['courante']);
                $spectacle = new Spectacle(
                    $tab['idSpectacle'],
                    $tab['nomSpectacle'],
                    $tab['nbPlaceSpectacle'],
                    $tab['typeClasse'],
                    $saison,
                    $tab['typeSpectacle']
                );
                $coll->ajouter($spectacle);
            }
            return $coll;
        } catch (\PDOException $e) {
            throw new \Exception("Il n'y a aucun spectacle");
        } catch (KeyHasUseException $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    /**
     * Récupère les spectacles de la saison courante
     * @return Collection
     * @throws \Exception
     */
    public static function getSpectaclesSaisonCourante()
    {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->query(
                "SELECT sp.idSpectacle, nomSpectacle, nbPlaceSpectacle, typeClasse, typeSpectacle, s.idSaison, nomSaison, courante
                FROM spectacle sp
                INNER JOIN saison_spectacle ss ON ss.idSpectacle = sp.idSpectacle
                INNER JOIN saison s ON s.idSaison = ss.idSaison
                WHERE courante = 1");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            $saison = MSaison::getSaisonCourante();
            foreach ($tabs as $tab) {
                $spectacle = new Spectacle(
                    $tab['idSpectacle'],
                    $tab['nomSpectacle'],
                    $tab['nbPlaceSpectacle'],
                    $tab['typeClasse'],
                    $saison,
                    $tab['typeSpectacle']
                );
                $lesSeances = MSeance::getSeancesBySpec($spectacle);
                $spectacle->setLesSeances($lesSeances);
                $coll->ajouter($spectacle);
            }
            return $coll;
        } catch (\PDOException $e) {
            throw new \Exception("Il n'y a aucun spectacle");
        } catch (KeyHasUseException $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    /**
     * Récupère les spectacles de la saison courante
     * @return Collection
     * @throws \Exception
     */
    public static function getSpectaclesSaisonCouranteJeunePublic()
    {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->query(
                "SELECT sp.idSpectacle, nomSpectacle, nbPlaceSpectacle, typeClasse, typeSpectacle, s.idSaison, nomSaison, courante
                FROM spectacle sp
                INNER JOIN saison_spectacle ss ON ss.idSpectacle = sp.idSpectacle
                INNER JOIN saison s ON s.idSaison = ss.idSaison
                WHERE courante = 1
                AND typeSpectacle = 1");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab) {
                $saison = new Saison($tab['idSaison'], $tab['nomSaison'], $tab['courante']);
                $spectacle = new Spectacle(
                    $tab['idSpectacle'],
                    $tab['nomSpectacle'],
                    $tab['nbPlaceSpectacle'],
                    $tab['typeClasse'],
                    $saison,
                    $tab['typeSpectacle']
                );
                $lesSeances = MSeance::getSeancesBySpec($spectacle);
                $spectacle->setLesSeances($lesSeances);
                $coll->ajouter($spectacle);
            }
            return $coll;
        } catch (\PDOException $e) {
            throw new \Exception("Il n'y a aucun spectacle");
        } catch (KeyHasUseException $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    /**
     * Récupère les spectacles de la saison courante
     * @return Collection
     * @throws \Exception
     */
    public static function getSpectaclesSaisonCouranteCollegeLycee()
    {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->query(
                "SELECT sp.idSpectacle, nomSpectacle, nbPlaceSpectacle, typeClasse, typeSpectacle, s.idSaison, nomSaison, courante
                FROM spectacle sp
                INNER JOIN saison_spectacle ss ON ss.idSpectacle = sp.idSpectacle
                INNER JOIN saison s ON s.idSaison = ss.idSaison
                WHERE courante = 1
                AND typeSpectacle = 2");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            $saison = MSaison::getSaisonCourante();
            foreach ($tabs as $tab) {
                $spectacle = new Spectacle(
                    $tab['idSpectacle'],
                    $tab['nomSpectacle'],
                    $tab['nbPlaceSpectacle'],
                    $tab['typeClasse'],
                    $saison,
                    $tab['typeSpectacle']
                );
                $lesSeances = MSeance::getSeancesBySpec($spectacle);
                $spectacle->setLesSeances($lesSeances);
                $coll->ajouter($spectacle);
            }
            return $coll;
        } catch (\PDOException $e) {
            throw new \Exception("Il n'y a aucun spectacle");
        } catch (KeyHasUseException $ex) {
            throw new \Exception($ex->getMessage());
        }
    }
    /**
     * Récupère les spectacles qui ne sont pas dans la saison courante
     * @return Collection
     * @throws \Exception
     */
    public static function getSpectaclesSaisonNonCourante()
    {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->query(
                "SELECT sp.idSpectacle, nomSpectacle, nbPlaceSpectacle, typeClasse, typeSpectacle, s.idSaison, nomSaison, courante
                FROM spectacle sp
                INNER JOIN saison_spectacle ss ON ss.idSpectacle = sp.idSpectacle
                INNER JOIN saison s ON s.idSaison = ss.idSaison
                WHERE courante = 0");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab) {
                $saison = new Saison($tab['idSaison'], $tab['nomSaison'], $tab['courante']);
                $spectacle = new Spectacle(
                    $tab['idSpectacle'],
                    $tab['nomSpectacle'],
                    $tab['nbPlaceSpectacle'],
                    $tab['typeClasse'],
                    $saison,
                    $tab['typeSpectacle']
                );
                $coll->ajouter($spectacle);
            }
            return $coll;
        } catch (\PDOException $e) {
            throw new \Exception("Il n'y a aucun spectacle");
        } catch (KeyHasUseException $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    /**
     * @param Saison $saison
     * @return Collection
     * @throws \Exception
     */
    public static function getSpectaclesBySaison(Saison $saison)
    {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare(
                "SELECT sp.idSpectacle, nomSpectacle, nbPlaceSpectacle, typeClasse, typeSpectacle, s.idSaison
                FROM spectacle sp
                INNER JOIN saison_spectacle ss ON ss.idSpectacle = sp.idSpectacle
                INNER JOIN saison s ON s.idSaison = ss.idSaison
                WHERE s.idSaison = ?");
            $reqPrepare->execute([$saison->getId()]);
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab) {
                $spectacle = new Spectacle(
                    $tab['idSpectacle'],
                    $tab['nomSpectacle'],
                    $tab['nbPlaceSpectacle'],
                    $tab['typeClasse'],
                    $saison,
                    $tab['typeSpectacle']
                );
                $coll->ajouter($spectacle);
            }
            return $coll;
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param int $idSaison
     * @return Collection
     * @throws \Exception
     */
    public static function getSpectaclesByIdSaison($idSaison)
    {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT sp.idSpectacle, nomSpectacle, nbPlaceSpectacle, typeClasse, typeSpectacle, s.idSaison
                FROM spectacle sp
                INNER JOIN saison_spectacle ss ON ss.idSpectacle = sp.idSpectacle
                INNER JOIN saison s ON s.idSaison = ss.idSaison
                WHERE s.idSaison = ?");
            $reqPrepare->execute(array($idSaison));
            $tabs = $reqPrepare->fetchAll();
            Main::viewVar($tabs);
            $coll = new Collection();
            foreach ($tabs as $tab) {
                $saison = new Saison($tab['idSaison'], $tab['nomSaison'], $tab['courante']);
                $spectacle = new Spectacle(
                    $tab['idSpectacle'],
                    $tab['nomSpectacle'],
                    $tab['nbPlaceSpectacle'],
                    $tab['typeClasse'],
                    $saison,
                    $tab['typeSpectacle']
                );
                $coll->ajouter($spectacle);
            }
            return $coll;
        } catch (\PDOException $e) {
            throw new \Exception("Il n'y a aucun spectacle dans la saison $idSaison");
        } catch (KeyHasUseException $ex) {
            throw new \Exception($ex->getMessage());
        }
    }
    /**
     * Récupère le spectacle dont le numéro est passé en paramètre
     * @param int $id
     * @return Spectacle
     * @throws \Exception
     */
    public static function getSpectacleById($id)
    {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("
                                SELECT sp.idSpectacle, nomSpectacle, nbPlaceSpectacle, typeClasse, typeSpectacle, s.idSaison, nomSaison, courante
                                FROM spectacle sp
                                INNER JOIN saison_spectacle ss ON ss.idSpectacle = sp.idSpectacle
                                INNER JOIN saison s ON s.idSaison = ss.idSaison
                                WHERE idSpectacle = ?");
            $reqPrepare->execute(array($id));
            $tab = $reqPrepare->fetch();
            $saison = new Saison($tab['idSaison'], $tab['nomSaison'], $tab['courante']);
            $spectacle = new Spectacle(
                $tab['idSpectacle'],
                $tab['nomSpectacle'],
                $tab['nbPlaceSpectacle'],
                $tab['typeClasse'],
                $saison,
                $tab['typeSpectacle']
            );
            return $spectacle;
        } catch (\PDOException $e) {
            throw new \Exception("Le spectacle $id n'existe pas.");
        } catch (KeyHasUseException $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    /**
     * Récupère le spectacle dont le nom est passé en paramètre
     * @param string $name
     * @return Spectacle
     * @throws \Exception
     */
    public static function getSpectacleByName($name)
    {
        try {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT sp.idSpectacle, nomSpectacle, nbPlaceSpectacle, typeClasse, typeSpectacle, s.idSaison, nomSaison, courante
                                FROM spectacle sp
                                INNER JOIN saison_spectacle ss ON ss.idSpectacle = sp.idSpectacle
                                INNER JOIN saison s ON s.idSaison = ss.idSaison
                                WHERE nomSpectacle = ?");
            $reqPrepare->execute(array($name));
            $tab = $reqPrepare->fetch();
            $saison = new Saison($tab['idSaison'], $tab['nomSaison'], $tab['courante']);
            $spectacle = new Spectacle(
                $tab['idSpectacle'],
                $tab['nomSpectacle'],
                $tab['nbPlaceSpectacle'],
                $tab['typeClasse'],
                $saison,
                $tab['typeSpectacle']
            );
            return $spectacle;
        } catch (\PDOException $e) {
            throw new \Exception("Le spectacle $name n'existe pas.");
        } catch (KeyHasUseException $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    /**
     * Ajoute un spectacle
     * @param Spectacle $spectacle
     * @throws \Exception
     */
    public static function addSpectacle(Spectacle $spectacle)
    {
        $conn = Main::bdd();
        try {
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("INSERT INTO spectacle (nomSpectacle, nbPlaceSpectacle, typeClasse, typeSpectacle) VALUES (?,?,?,?)");
            $reqPrepare->execute(array(
                $spectacle->getNom(),
                $spectacle->getNbPlace(),
                $spectacle->getTypeClasse(),
                $spectacle->getTypeSpectacle()
            ));
            $conn->commit();
        } catch (\PDOException $e) {
            $conn->rollBack();
            throw new \Exception("L'ajout du spectacle ".$spectacle->getId()." a échoué. Détails : <p>".$e->getMessage()."</p>");
        }
    }

    /**
     * Modifie un spectacle
     * @param Saison $saison
     * @param Spectacle $spectacle
     * @throws \Exception
     */
    public static function editSpectacle(Saison $saison, Spectacle $spectacle)
    {
        $conn = Main::bdd();
        try {
            $conn->beginTransaction();
            MSaison::setSaisonSpectacle($saison, $spectacle);
            $reqPrepare = $conn->prepare("UPDATE spectacle SET nomSpectacle = ?, nbPlaceSpectacle = ?, typeClasse = ?, typeSpectacle = ? WHERE idSpectacle = ?");
            $reqPrepare->execute(array(
                $spectacle->getNom(),
                $spectacle->getNbPlace(),
                $spectacle->getTypeClasse(),
                $spectacle->getTypeSpectacle(),
                $spectacle->getId()
            ));
            $conn->commit();
        } catch (\PDOException $e) {
            $conn->rollBack();
            throw new \Exception("Le spectacle ".$spectacle->getId()." n'a pas pu être modifié. Détails : <p>".$e->getMessage()."</p>");
        }
    }

    /**
     * Supprime un spectacle
     * @param Spectacle $spectacle
     * @throws \Exception
     */
    public static function rmSpectacle(Spectacle $spectacle)
    {
        $conn = Main::bdd();
        try {
            $conn->beginTransaction();

            MSaison::rmSaisonSpectacle($spectacle);

            foreach ($spectacle->getLesSeances()->getCollection() as $seance) {
                MPlanning::rmPlanningbySeance($seance);
            }
            MSeance::rmSeancesSpec($spectacle);

            $reqPrepare = $conn->prepare("DELETE FROM spectacle WHERE idSpectacle = ?");
            $reqPrepare->execute(array($spectacle->getId()));

            $conn->commit();
        } catch (\PDOException $e) {
            $conn->rollBack();
            throw new \Exception("Le spectacle ".$spectacle->getId()." n'a pas pu être supprimé. Détails : <p>".$e->getMessage()."</p>");
        }
    }
}
