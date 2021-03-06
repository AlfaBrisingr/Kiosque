<?php

use Kiosque\Models\MEcole;
use Kiosque\Models\Main;
use Kiosque\Models\MEnseignant;
use Kiosque\Classes\Ecole;
use Kiosque\Classes\Enseignant;

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = "voirEcole";
}

switch ($action) {
    case 'voirEcole':
        $listEcole = MEcole::getEcoles();
        require_once ROOT.'views/kiosqueadmin/schools/v_School.php';
        break;

    case 'voirModifierEcole':
        $listEcole = MEcole::getEcoleById($_GET['schools']);
        require_once ROOT.'views/kiosqueadmin/schools/v_SchoolEdit.php';
        break;

    case 'ModifierEcole':
        try {
            $listEcole = MEcole::getEcoleById($_GET['schools']);
            if (!is_numeric($_POST['nomEcole']) && is_numeric($_POST['cpEcole']) && is_numeric($_POST['telDir']) && !empty($_POST['nomEcole']) && !empty($_POST['adresseEcole']) && !empty($_POST['cpEcole']) && !empty($_POST['villeEcole']) && !empty($_POST['mailDir']) && !empty($_POST['telDir']) && !empty($_POST['nomDir']) && !empty($_POST['prenomDir'])) {
                $directeur = new Enseignant($listEcole->getDirecteur()->getId(),$_POST['civDir'],$_POST['nomDir'],$_POST['prenomDir'],$_POST['mailDir'],$_POST['telDir'],1);
                $ecole = new Ecole($_GET['schools'], $_POST['typeEcole'],$_POST['nomEcole'],$_POST['adresseEcole'],1,$_POST['cpEcole'],$_POST['villeEcole'],$_POST['mailDir'],$directeur);
                MEcole::editEcole($ecole, $directeur);

                Main::setFlashMessage("L'écolé a bien été modifiée", "valid");
                echo '<script>document.location.href ="?uc=ecole"</script>';

            } else {
                throw new \Exception ("Impossible de modifier l'école (mauvais formats entrés)");
            }

        }
        catch (\Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'voirAjouterEcole':
        require_once ROOT.'views/kiosqueadmin/schools/v_SchoolAdd.php';
        break;

    case 'AjouterEcole':
        try {
            if (!is_numeric($_POST['nomEcole']) && is_numeric($_POST['cpEcole']) && is_numeric($_POST['telDir']) && !empty($_POST['nomEcole']) && !empty($_POST['adresseEcole']) && !empty($_POST['cpEcole']) && !empty($_POST['villeEcole']) && !empty($_POST['mailDir']) && !empty($_POST['telDir']) && !empty($_POST['nomDir'])) {
                $directeur = new Enseignant(1,$_POST['civDir'],$_POST['nomDir'],$_POST['prenomDir'],$_POST['mailDir'],$_POST['telDir'],1);
                $ecole = new Ecole(1,$_POST['typeEcole'],$_POST['nomEcole'],$_POST['adresseEcole'],1,$_POST['cpEcole'],$_POST['villeEcole'],$_POST['mailDir'],$directeur);
                $idEcole = MEcole::setEcole($ecole);
                $ecole->setId($idEcole);
                $directeur->setEcole($ecole);

                $idEnseignant = MEnseignant::addEnseignant($directeur);
                $directeur->setId($idEnseignant);
                $ecole->setDirecteur($directeur);

                MEcole::editEcole($ecole, $directeur);

                Main::setFlashMessage("L'école a bien été ajoutée", "valid");
                echo '<script>document.location.href ="?uc=ecole"</script>';


            } else {
                echo '<script>document.location.href ="?uc=ecole"</script>';
                throw new \Exception ("Impossible d'ajouter l'école (mauvais formats entrés)");

            }

        } catch (\Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'SupprimerEcole':
        try {
            $ecole = MEcole::getEcoleById($_GET['schools']);
            MEcole::rmEcole($ecole);

            Main::setFlashMessage("L'école : " .$ecole->getNom(). " a bien été supprimée", "valid");
            echo '<script>document.location.href ="?uc=ecole"</script>';
        } catch (\Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }

        break;
}
