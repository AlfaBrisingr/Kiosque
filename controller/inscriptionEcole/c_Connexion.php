<?php

if(isset($_GET['action']))
    $action = $_GET['action'];
else
    $action = "voirForm";

switch($action)
{
    case 'voirForm' :
    include("views/inscriptionEcole/v_FormProteger.php"); break;
    
    case 'login' :
    try
    {

        if(Main::connexionExistantePublic())
        {
            header("Location:?uc=jp&action=choisirTypeEcole");
        }
        if(isset($_POST['login']))
        {
            $pwd = sha1($_POST['password']);
            if(strtolower($_POST['login']) == "jeunepublic" && $pwd == "120525d1a28d39f78ef479b07011de199c5c2e92")
            {
                $_SESSION['utilisateur'] = new Utilisateur(3,"jeunePublic","120525d1a28d39f78ef479b07011de199c5c2e92");
                Main::setFlashMessage("Connecté avec succès", "valid");
                header("Location:?uc=jp&action=choisirTypeEcole");
            }
            else
            {
                Main::launchWrongUserPwd();
                header("Location:?uc=connexion");
            }
        }
        else
        {
            header("Location:?uc=index");
        }
    }
    catch (Exception $e)
    {
        Main::setFlashMessage($e->getMessage(), "error");
    } break;
    case 'logout' :
    session_destroy();
    Main::setFlashMessage("Déconnecté avec succès", "valid");
    header("Location:?uc=index"); break;
    default : header("Location:?uc=index"); break;
}