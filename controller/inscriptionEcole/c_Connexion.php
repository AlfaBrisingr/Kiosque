<?php

use Kiosque\Models\Main;
use Kiosque\Classes\Utilisateur;

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = "voirForm";
}

switch ($action) {
    case 'voirForm':
        require_once ROOT.'views/inscriptionEcole/v_FormProteger.php';
        break;

    case 'login':
        try {

            if (Main::connexionExistantePublic()) {
                echo '<script>redirection("?uc=jp&action=choisirTypeEcole")</script>';
            }
            if (isset($_POST['login'])) {
                $pwd = sha1($_POST['password']);
                if (strtolower($_POST['login']) == "jeunepublic" && $pwd == "120525d1a28d39f78ef479b07011de199c5c2e92") {
                    $_SESSION['utilisateur'] = new Utilisateur(3,"jeunePublic","120525d1a28d39f78ef479b07011de199c5c2e92");
                    Main::setFlashMessage("Connecté avec succès", "valid");
                    echo '<script>redirection("?uc=jp&action=choisirTypeEcole")</script>';
                } else {
                    Main::launchWrongUserPwd();
                    echo '<script>redirection("?uc=connexion")</script>';
                }
            } else {
                echo '<script>redirection("?uc=index")</script>';
                exit();
            }
        } catch (\Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'logout':
        session_destroy();
        Main::setFlashMessage("Déconnecté avec succès", "valid");
        echo '<script>redirection("?uc=index")</script>';
        break;

    default:
        echo '<script>redirection("?uc=index")</script>';
        break;
}