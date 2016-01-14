<?php
require_once ('models/m_Admin.php');
require_once ('classes/Utilisateur.php');

if(isset($_GET['action']))
{
    $action = $_GET['action'];
}
else
{
    $action = "login";
}

switch ($action)
{
    case 'login' :
    header("Location:?uc=index&action=login"); break;
    case 'choisirTypeEcole' :
    try
    {
        $saisonCourante = MSaison::getSaisonCourante();
        include("views/inscriptionEcole/v_EcoleTypeChoix.php");
    }
    catch (Exception $e)
    {
        Main::setFlashMessage($e->getMessage(), "error");
    } break;
    case 'choisirEcole' :
    try
    {
        $saisonCourante = MSaison::getSaisonCourante();
        if(!isset($_POST['typeEcole']))
        {
            header("Location:?uc=jp&action=choisirTypeEcole");
        }
        if($_POST['typeEcole'] == '1')
        {
            $listEcole = MEcole::getEcolesPublique();
        }
        else
        {
            $listEcole = MEcole::getEcolesPrive();
        }
        include("views/inscriptionEcole/v_EcoleChoix.php");
    }
    catch (Exception $e)
    {
        Main::setFlashMessage($e->getMessage(), "error");
    } break;
    case 'etape1':
    try
    {
        if(isset($_POST['choix']))
        {
            $ecole = MEcole::getEcoleById($_POST['choix']);
            $_SESSION['ecole'] = $ecole;
        }
        else
        {
            header("Location:?uc=jp&action=choisirTypeEcole");
        }
        include("views/inscriptionEcole/v_Etape1.php");
    }
    catch (Exception $e)
    {
        Main::setFlashMessage($e->getMessage(), "error");
    } break;

    case 'etape2':
    try
    {
        if(isset($_SESSION['ecole']))
        {
            $enseignant = MEnseignant::getEnseignantById($_SESSION['ecole']->getDirecteur()->getId());
            $_SESSION['enseignant'] = $enseignant; 
            $_SESSION['facture'] = $_POST['facture'];
            $_SESSION['divers'] = $_POST['divers'];

        }
        else
        {
            header("Location:?uc=jp&action=choisirTypeEcole");
        }

        // NE PAS OUBLIER DE FAIRE LA MODIFICATION 

      /*  if(isset($_POST['civEns'])||isset($_POST['nomEns'])||isset($_POST['prenomEns'])||isset($_POST['telEns'])||isset($_POST['mailEns'])){
            $unEnseignant = array(
                'civEns' => $_POST['civEns'],
                'nomEns' => $_POST['nomEns'],
                'prenomEns' => $_POST['prenomEns'],
                'mailEns' => $_POST['mailEns'],
                'telEns' => $_POST['telEns'], 
                'idEcole' => $_SESSION['ecole']->getId(),
                'id' => $_SESSION['ecole']->getDirecteur()->getId());
            MEnseignant::editEnseignant($unEnseignant);
        } */
        include("views/inscriptionEcole/v_Etape2.php");
    }
    catch (Exception $e)
    {
        Main::setFlashMessage($e->getMessage(), "error");
    } break;

    case 'etape3' :
    try
    {
        $lesSpectacles = MSpectacle::getSpectaclesSaisonCourante();
        $nbrEleve = $_POST['nbrEleve'];
        $nbrAccom = $_POST['nbrAccom'];
        $classe = $_POST['classe'];
        $_SESSION['nbrEleve'] = $nbrEleve;
        $_SESSION['nbrAccom'] = $nbrAccom;
        $_SESSION['classe'] = $classe;
        
        include("views/inscriptionEcole/v_Etape3.php");

    }
    catch (Exception $e)
    {
        Main::setFlashMessage($e->getMessage(), "error");
    } break;

    case 'etape4':
    try{

        $lesSpectacles = MSpectacle::getSpectaclesSaisonCourante();

        $_SESSION['choix1'] = $_POST['choix1'];
        $_SESSION['impo1']= $_POST['impo1'];

        include("views/inscriptionEcole/v_Etape4.php");
    }
    catch (Exception $e)
    {
        Main::setFlashMessage($e->getMessage(), "error");
    } break;

    case 'etape5':
    try{
        $lesSpectacles = MSpectacle::getSpectaclesSaisonCourante();

        $_SESSION['choix2'] = $_POST['choix2'];
        $_SESSION['impo2']= $_POST['impo2'];

        if($_SESSION['choix1'] == $_SESSION['choix2']){
            $_SESSION['choix2'] == 'non';
        }

        if($_SESSION['choix2']== 'non'){
            $_SESSION['choix3'] = 'non';
            $_SESSION['impo3'] = null;
        }
        include("views/inscriptionEcole/v_Etape5.php");
        
    }
    catch (Exception $e)
    {
        Main::setFlashMessage($e->getMessage(), "error");
    } break;

    case 'etape6':
    try{
        $lesSpectacles = MSpectacle::getSpectaclesSaisonCourante();

        if(!isset($_POST['choix3'])){
            $_SESSION['choix3'] = 'non';
            $_SESSION['impo3']= null;
        }else{
            $_SESSION['choix3'] = $_POST['choix3'];
            $_SESSION['impo3']= $_POST['impo3'];
        }

        if($_SESSION['choix3'] == $_SESSION['choix1']){
            $_SESSION['choix3'] = 'non';
        }

        if($_SESSION['choix3'] == $_SESSION['choix2']){
            $_SESSION['choix3'] = 'non';
        }
        if($_SESSION['choix2'] == $_SESSION['choix1']){
            $_SESSION['choix2'] = 'non';
        }

        $Ent = array($_SESSION['ecole']->getType(),$_SESSION['ecole']->getNom(),'Adresse 1' => $_SESSION['ecole']->getAdresse(),$_SESSION['ecole']->getAdresse2(),
            $_SESSION['ecole']->getCp(),$_SESSION['ecole']->getVille(),$_SESSION['ecole']->getDirecteur()->getTel(),$_SESSION['ecole']->getDirecteur()->getMail()
            );
        $Resp = array (
            'Civilité' => $_SESSION['enseignant']->getCivilite(),
            'Nom' => $_SESSION['enseignant']->getNom(),
            'Prénom' => $_SESSION['enseignant']->getPrenom());
        $Divers1 = array (
            'Facture libellée à' => $_SESSION['facture'],
            'Infos diverses sur l\'Etablissement' => $_SESSION['divers']
            );
        $Ens1 = array ($_SESSION['enseignant']->getCivilite(),$_SESSION['enseignant']->getNom(), ucfirst(strtolower($_SESSION['enseignant']->getPrenom())));
        $Ens3 = array($_SESSION['enseignant']->getTel(),$_SESSION['enseignant']->getMail());
        $Ens2 = array (
            'Classe' => $_SESSION['classe'],
            'Elèves' => $_SESSION['nbrEleve'],
            'Accompagnateurs' => $_SESSION['nbrAccom'],
            );
        $Choix1 = array (
            'Choisi' => $_SESSION['choix1'],
            'Impossibilités' => $_SESSION['impo1']
            );
        $Choix2 = array (
            'Choisi' => $_SESSION['choix2'],
            'Impossibilités' => $_SESSION['impo2']
            );
        $Choix3 = array (
            'Choisi' => $_SESSION['choix3'],
            'Impossibilités' => $_SESSION['impo3']
            );

        include("views/inscriptionEcole/v_Recap.php");
    }
    catch (Exception $e)
    {
        Main::setFlashMessage($e->getMessage(), "error");
    } break;

}