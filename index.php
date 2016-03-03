<?php
namespace Kiosque;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__.DS);

require_once ROOT.'vendor/autoload.php';

use Kiosque\Models\Main;

session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <meta charset="utf-8">
    <title>Kiosque</title>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button id="dropdown" type="button"
                    class="navbar-toggle collapsed"
                    data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-3">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <ul class="nav navbar-nav">
                <li <?php if (isset($_GET['uc']) && $_GET['uc'] == 'index') { ?>
                    class="active" <?php } ?>>
                    <a class="navbar-brand" href="?uc=index">Kiosque</a>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li <?php if (isset($_GET['uc']) && $_GET['uc'] == 'jp') { ?>
                    class="active" <?php } ?>>
                    <?php if (Main::connexionExistantePublic()) { ?>
                        <a href="?uc=jp&action=choisirTypeEcole">Jeune Public</a>
                    <?php } else { ?>
                        <a href="?uc=connexion">Jeune Public</a> <?php } ?>
                </li>
                <li <?php if (isset($_GET['uc']) && $_GET['uc'] == 'cl') { ?>
                    class="active" <?php } ?>>
                    <?php if (Main::connexionExistantePublic()) { ?>
                        <a href="?uc=cl&action=choisirTypeEcole">Collège Lycée</a>
                    <?php } else { ?>
                        <a href="?uc=connexionCL">Collège Lycée</a> <?php } ?>
                </li>
                <?php if (Main::connexionExistante()) { ?>
                    <li><a href="?uc=admin&action=voirAdmin">Administration</a></li>
                <?php } ?>
            </ul>
            <?php if (Main::connexionExistante()) { ?>
                <ul class="nav navbar-nav pull-right">
                    <li><a type="button" href="?uc=connexion&action=logout">Déconnexion</a></li>
                </ul>
            <?php } ?>
        </div>
    </div>
</nav>
<div class="container taille">
    <?php
    if (isset($_GET['uc'])) {
        switch ($_GET['uc']) {
            case 'index':
                require_once ROOT.'controller/inscriptionEcole/c_Index.php';
                break;
            case 'connexion':
                require_once ROOT.'controller/inscriptionEcole/c_Connexion.php';
                break;
            case 'admin':
                require_once ROOT.'controller/kiosqueadmin/c_KiosqueAdmin.php';
                break;
            case 'jp':
                require_once ROOT.'controller/inscriptionEcole/c_Inscription.php';
                break;
            case 'lieu':
                require_once ROOT.'controller/kiosqueadmin/c_Lieu.php';
                break;
            case 'ecole':
                require_once ROOT.'controller/kiosqueadmin/c_Ecole.php';
                break;
            case 'spectacle':
                require_once ROOT.'controller/kiosqueadmin/c_Spectacle.php';
                break;
            case 'cl':
                require_once ROOT.'controller/inscriptionCollegeLycee/c_Inscription.php';
                break;
            case 'connexionCL':
                require_once ROOT.'controller/inscriptionCollegeLycee/c_Connexion.php';
                break;
            default:
                require_once ROOT.'views/v_Erreur.php';
                break;
        }
    } else {
        header("Location:?uc=index");
    } ?>
</div>
<footer>
    <!-- Version 2.0 &copy Le Kiosque by TURMEL Kévin -->
</footer>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>