<?php

require_once ('models/m_Admin.php');
require_once ('classes/Utilisateur.php');

if(isset($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action = "voirSpectacle";
}

switch($action) {
    case 'voirSpectacle':
        include("views/kiosqueadmin/shows/v_Spectacle.php");
        break;

    case 'voirChangerSaison':
        try {
            $actuel = MSaison::getSaisonCourante();
            $listSaison = MSaison::getSaisonNonCourante();
            include("views/kiosqueadmin/shows/v_SaisonEdit.php");
        }
        catch (Exception $e)
        {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'ChangerSaison' :
        try{
            $actuel = MSaison::getSaisonCourante();
            if ($_POST['nouvelleSaison']) {
                $nouvelle = MSaison::getSaisonById($_POST['nouvelleSaison']);
                $d = MSaison::setSaisonCourante($actuel, $nouvelle);
                if ($d) {
                    $r = MSaison::getSaisonCourante();
                    header("Location:?uc=admin&action=voirSpectacle");
                    $_SESSION['valid'] = "La nouvelle saison est désormais " . $r->getNom();
                } else {
                    $_SESSION['error'] = "Une erreur s'est produite lors du changement de saison";
                }
            }

        }
        catch (Exception $e)
        {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'voirAjouterSpectacle':
        $listSaison = MSaison::getSaisons();
        $actuel = MSaison::getSaisonCourante();
        include ("views/kiosqueadmin/shows/v_SpectacleAdd.php");
        break;

    case 'AjouterSpectacle':
        try{
            if( !is_numeric($_POST['nomSpectacle']) && is_numeric($_POST['nbPlaceSpectacle']) && !is_numeric($_POST['typeClasse']) && (!empty($_POST['typeClasse']) && !empty($_POST['nomSpectacle']) && !empty($_POST['nbPlaceSpectacle']) && !empty($_POST['idSaison']) && !empty($_POST['typeClasse']))) {
                $saison = MSaison::getSaisonById($_POST['idSaison']);
                $spectacle = new Spectacle(1, $_POST['nomSpectacle'], $_POST['nbPlaceSpectacle'], $_POST['typeClasse'], $saison);
                MSpectacle::addSpectacle($spectacle);
                $spec = MSpectacle::getSpectacleByName($_POST['nomSpectacle']);
                if($spec){

                    $q = MSaison::setSaisonSpectacle($saison,$spec);
                    if($q){
                        $_SESSION['valid'] = "Le spectacle a bien été ajouté à la saison ".$saison->getNom();
                        header("Location:?uc=admin&action=voirSpectacle");
                    }else{
                        $_SESSION['error'] = "Impossible d'ajouter le spectacle (mauvais formats entrés)";
                    }
                }else{
                    $_SESSION['error'] = "Impossible d'ajouter le spectacle (mauvais formats entrés)";
                }
            }else{
                $_SESSION['error'] = "Impossible d'ajouter le spectacle (mauvais formats entrés ou champs vides)";
            }
        }
        catch (Exception $e)
        {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'SupprimerSpectacle':
        try{
            $spectacle = MSpectacle::getSpectacleById($_GET['shows']);
            $saison = MSaison::getSaisonDuSpectacle($spectacle);
            $x = MSeance::rmSeancesSpec($spectacle);
            if ($x){
                $q = MSaison::rmSaisonSpectacle($saison,$spectacle);
                if($q){
                    $t = MSpectacle::rmSpectacle($spectacle);
                    if($t) {
                        $_SESSION['valid'] = "Le spectacle $spectacle->getId() a bien été supprimé";
                        header("Location:?uc=admin&action=voirSpectacle");
                    }
                    else
                    {
                        $_SESSION['error'] = "Impossible de supprimer le spectacle $spectacle->getId(), il n'existe pas";
                    }
                }else{
                    $_SESSION['error'] = "Impossible de supprimer le spectacle $spectacle->getId(), il n'existe pas";
                }
            }else{
                $_SESSION['error'] = "Impossible de supprimer le spectacle $spectacle->getId(), il n'existe pas";
            }
        }
        catch (Exception $e)
        {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'voirModifierSpectacle':
        include("views/kiosqueadmin/shows/v_SpectacleEdit.php");
        break;

}
