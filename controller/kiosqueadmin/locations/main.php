<?php

require_once 'c_Lieu.php';
session_start();
$ctrl = new LocationsSpace();
if(isset($_GET['locationsadd']) && isset($_SESSION['login'])) {
	$ctrl->afficheNouveauLieu();
}
elseif(isset($_GET['locationsaddfinish']) && isset($_SESSION['login']) && isset($_POST['nomLieu'],$_POST['adrLieu'],$_POST['cpLieu'], $_POST['villeLieu'])) {
	$ctrl->nouveauLieu($_POST['nomLieu'],$_POST['adrLieu'],$_POST['cpLieu'], $_POST['villeLieu']);
	header("Location:/JP/kiosqueadmin/locations/");
}
elseif(isset($_GET['locationseditfinish'],$_GET['locations'],$_POST['nomLieu'],$_POST['adrLieu'],$_POST['cpLieu'],$_POST['villeLieu']) && isset($_SESSION['login'])) {
	$ctrl->editLieu($_GET['locations'],$_POST['nomLieu'],$_POST['adrLieu'],$_POST['cpLieu'],$_POST['villeLieu']);
	header("Location:/JP/kiosqueadmin/locations/");
}
elseif(isset($_GET['locationsedit'],$_GET['locations']) && isset($_SESSION['login'])) {
	$ctrl->afficheEditLieu($_GET['locations']);
}
elseif(isset($_GET['locationssuppr']) && isset($_SESSION['login']) && isset($_GET['locations'])) {
	$ctrl->supprimerLieu($_GET['locations']);
	header("Location:/JP/kiosqueadmin/locations/");
}

elseif(isset($_SESSION['login'])) {
	$ctrl->afficheGestLieu();
}
else
{
	$ctrl->afficheConnexion();
}
