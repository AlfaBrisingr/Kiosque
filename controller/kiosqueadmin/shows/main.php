<?php

require_once 'c_Spectacle.php';
session_start();
$ctrl = new ShowsSpace();
if(isset($_GET['showsadd']) && isset($_SESSION['login'])) {
	$ctrl->afficheNouveauSpectacle();
}
elseif(isset($_GET['seasonedit']) && isset($_SESSION['login'])) {
	$ctrl->afficheEditSaison();
}
elseif(isset($_GET['seasoneditfinish'],$_GET['old'],$_POST['nouvelleSaison']) && isset($_SESSION['login'])) {
	$ctrl->editSaisonCourante($_GET['old'],$_POST['nouvelleSaison']);
	header("Location:/JP/kiosqueadmin/shows/");
}
elseif(isset($_GET['showsaddfinish']) && isset($_SESSION['login']) && isset($_POST['idSaison'],$_POST['nbPlaceSpectacle'],$_POST['nomSpectacle'])) {
	$ctrl->nouveauSpectacle($_POST['idSaison'], $_POST['nomSpectacle'], $_POST['nbPlaceSpectacle'],$_POST['typeClasse']);
	header("Location:/JP/kiosqueadmin/shows/");
}
elseif(isset($_GET['showseditfinish'],$_GET['shows'],$_POST['nomSpectacle'],$_POST['idSaison'],$_POST['nbPlaceSpectacle'],$_POST['typeClasse']) && isset($_SESSION['login'])) {
	$ctrl->editSpectacle($_GET['shows'],$_POST['nomSpectacle'],$_POST['nbPlaceSpectacle'],$_POST['idSaison'],$_POST['typeClasse']);
	header("Location:/JP/kiosqueadmin/shows");
}
elseif(isset($_GET['showsedit'],$_GET['shows']) && isset($_SESSION['login'])) {
	$ctrl->afficheEditSpectacle($_GET['shows']);
}
elseif(isset($_GET['showssuppr']) && isset($_SESSION['login']) && isset($_GET['shows'])) {
	$ctrl->supprimerSpectacle($_GET['shows']);
	header("Location:/JP/kiosqueadmin/shows/");
}

elseif(isset($_SESSION['login'])) {
	$ctrl->afficheGestSpectacle();
}
else
{
	$ctrl->afficheConnexion();
}
