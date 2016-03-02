<?php

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = "voirSpectacle";
}

switch ($action) {
    case 'voirSpectacle':
        $listSpec = MSpectacle::getSpectaclesSaisonCourante();
        $actuel = MSaison::getSaisonCourante();
        require_once ROOT.'views/kiosqueadmin/shows/v_Spectacle.php';
        break;

    case 'voirChangerSaison':
        try {
            $actuel = MSaison::getSaisonCourante();
            $listSaison = MSaison::getSaisonNonCourante();
            require_once ROOT.'views/kiosqueadmin/shows/v_SaisonEdit.php';
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'ChangerSaison':
        try {
            $actuel = MSaison::getSaisonCourante();
            if ($_POST['nouvelleSaison']) {
                $nouvelle = MSaison::getSaisonById($_POST['nouvelleSaison']);
                $d = MSaison::setSaisonCourante($actuel, $nouvelle);
                $saison = MSaison::getSaisonCourante();
                Main::setFlashMessage("La nouvelle saison est désormais " . $saison->getNom(), "valid");
                header("Location:?uc=admin&action=voirSpectacle");
            } else {
                throw new Exception ("Une erreur s'est produite lors du changement de saison");
            }


        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'voirAjouterSpectacle':
        $listSaison = MSaison::getSaisons();
        $actuel = MSaison::getSaisonCourante();
        require_once ROOT.'views/kiosqueadmin/shows/v_SpectacleAdd.php';
        break;

    case 'AjouterSpectacle':
        try {
            if( !is_numeric($_POST['nomSpectacle']) && is_numeric($_POST['nbPlaceSpectacle']) && !is_numeric($_POST['typeClasse']) && (!empty($_POST['typeClasse']) && !empty($_POST['nomSpectacle']) && !empty($_POST['nbPlaceSpectacle']) && !empty($_POST['idSaison']) && !empty($_POST['typeClasse']))) {
                $saison = MSaison::getSaisonById($_POST['idSaison']);
                $spectacle = new Spectacle(1, $_POST['nomSpectacle'], $_POST['nbPlaceSpectacle'], $_POST['typeClasse'], $saison,$_POST['typeSpectacle']);
                MSpectacle::addSpectacle($spectacle);
                $spec = MSpectacle::getSpectacleByName($_POST['nomSpectacle']);
                MSaison::AjoutSaisonSpectacle($saison, $spec);

                Main::setFlashMessage("Le spectacle a bien été ajouté à la saison " . $saison->getNom(), "valid");
                header("Location:?uc=spectacle");

            } else {
                throw new Exception ("Impossible d'ajouter le spectacle (mauvais formats entrés)");
            }

        } catch (Exception $e) {

            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'SupprimerSpectacle':
        try {
            $spectacle = MSpectacle::getSpectacleById($_GET['shows']);
            MSpectacle::rmSpectacle($spectacle);
            Main::setFlashMessage("Le spectacle $spectacle->getId() a bien été supprimé", "valid");
            header("Location:?uc=spectacle");
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'voirModifierSpectacle':
        $listSpec = MSpectacle::getSpectacleById($_GET['shows']);
        $listSaison = MSaison::getSaisons();
        $actuel = MSaison::getSaisonCourante();
        require_once ROOT.'views/kiosqueadmin/shows/v_SpectacleEdit.php';
        break;

    case 'ModifierSpectacle':
        try {
            if (!is_numeric($_POST['nomSpectacle']) && is_numeric($_POST['nbPlaceSpectacle']) && !is_numeric($_POST['typeClasse']) && (!empty($_POST['typeClasse']) && !empty($_POST['nomSpectacle']) && !empty($_POST['nbPlaceSpectacle']) && !empty($_POST['idSaison']) && !empty($_POST['typeClasse']))) {
                $saison = MSaison::getSaisonById($_POST['idSaison']);
                $spectacle = new Spectacle($_GET['shows'], $_POST['nomSpectacle'], $_POST['nbPlaceSpectacle'], $_POST['typeClasse'], $saison,$_POST['typeSpectacle']);
                MSpectacle::editSpectacle($saison, $spectacle);

                Main::setFlashMessage("Le spectacle a bien été modifié à la saison " . $saison->getNom(), "valid");
                header("Location:?uc=spectacle");
            } else {
                throw new Exception ("Impossible de modifier le spectacle (mauvais formats entrés)");
            }
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");

        }
        break;

}
