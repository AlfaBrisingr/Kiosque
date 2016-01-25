<?php

require_once 'm_Main.php';

class MLieu
{
    /**
     * Récupère tous les lieux
     * @return Collection
     * @throws Exception
     */
    static public function getLieux() {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->query("SELECT * FROM lieu");
            $tabs = $reqPrepare->fetchAll();
            $coll = new Collection();
            foreach ($tabs as $tab)
            {
                $lieu = new Lieu (
                    $tab['idLieu'],
                    $tab['nomLieu'],
                    $tab['adrLieu'],
                    $tab['cpLieu'],
                    $tab['villeLieu']
                );
                $lesSeances = MSeance::getSeancesByLieu($lieu);
                $lieu->setLesSeances($lesSeances);
                $coll->ajouter($lieu);
            }
            return $coll;
        }
        catch (PDOException $e)
        {
            throw new Exception("Il n'y a aucun lieu");
        }
        catch (KeyHasUseException $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * Récupère un lieu par son numéro
     * @param int $id
     * @return Lieu
     * @throws Exception
     */
    static public function getLieuById($id) {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT * FROM lieu WHERE idLieu = ?");
            $reqPrepare->execute(array($id));
            $tab = $reqPrepare->fetch();
            $lieu = new Lieu (
                $tab['idLieu'],
                $tab['nomLieu'],
                $tab['adrLieu'],
                $tab['cpLieu'],
                $tab['villeLieu']
            );
            $lesSeances = MSeance::getSeancesByLieu($lieu);
            $lieu->setLesSeances($lesSeances);
            return $lieu;
        }
        catch (PDOException $e)
        {
            throw new Exception("Le lieu $id n'existe pas.");
        }
    }

    /**
     * Récupère un lieu par son nom
     * @param string $name
     * @return Lieu
     * @throws Exception
     */
    static public function getLieuByName($name) {
        try
        {
            $conn = Main::bdd();
            $reqPrepare = $conn->prepare("SELECT * FROM lieu WHERE nomLieu = ?");
            $reqPrepare->execute(array($name));
            $tab = $reqPrepare->fetch();
            $lieu = new Lieu (
                $tab['idLieu'],
                $tab['nomLieu'],
                $tab['adrLieu'],
                $tab['cpLieu'],
                $tab['villeLieu']
            );
            $lesSeances = MSeance::getSeancesByLieu($lieu);
            $lieu->setLesSeances($lesSeances);
            return $lieu;
        }
        catch (PDOException $e)
        {
            throw new Exception("Le lieu $name n'existe pas.");
        }
    }

    /**
     * Ajoute un lieu
     * @param Lieu $lieu
     * @throws Exception
     */
    static public function addLieu(Lieu $lieu){
        $conn = Main::bdd();
        try
        {
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("INSERT INTO lieu (nomLieu, adrLieu, cpLieu, villeLieu) VALUES (?,?,?,?)");
            $reqPrepare->execute(array(
                $lieu->getNom(),
                $lieu->getAdresse(),
                $lieu->getCp(),
                $lieu->getVille()
            ));
            $conn->commit();
        }
        catch (PDOException $e)
        {
            $conn->rollBack();
            throw new Exception("L'ajout du lieu ".$lieu->getId()." a échoué. Détails : <p>".$e->getMessage()."</p>");
        }
    }

    /**
     * Supprime un lieu
     * @param Lieu $lieu
     * @throws Exception
     */
    static public function rmLieu(Lieu $lieu) {
        $conn = Main::bdd();
        try {
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("DELETE FROM seance WHERE idLieu = ?");
            $reqPrepare->execute(array($lieu->getId()));
            $reqPrepare = $conn->prepare("DELETE FROM lieu WHERE idLieu = ?");
            $reqPrepare->execute(array($lieu->getId()));
            $conn->commit();
        }
        catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception("Le lieu ".$lieu->getId()." n'a pas pu être supprimé. Détails : <p>".$e->getMessage()."</p>");
        }
    }

    /**
     * Modifie un lieu
     * @param Lieu $lieu
     * @throws Exception
     */
    static public function editLieu(Lieu $lieu) {
        $conn = Main::bdd();
        try
        {
            $conn->beginTransaction();
            $reqPrepare = $conn->prepare("UPDATE lieu SET nomLieu = ?, adrLieu = ?, cpLieu = ?, villeLieu = ? WHERE idLieu = ?");
            $reqPrepare->execute(array(
                $lieu->getNom(),
                $lieu->getAdresse(),
                $lieu->getCp(),
                $lieu->getVille(),
                $lieu->getId()
            ));
            $conn->commit();
        }
        catch (PDOException $e)
        {
            $conn->rollBack();
            throw new Exception("Le lieu ".$lieu->getId()." n'a pas pu être modifié. Détails : <p>".$e->getMessage()."</p>");
        }
    }
}
