<?php

require_once 'c_Ecole.php';
session_start();
$ctrl = new SchoolsSpace();
if(isset($_GET['schoolsadd']) && isset($_SESSION['login'])) {
	$ctrl->afficheAjouterEcole();
}
elseif(isset($_SESSION['login'],$_GET['schoolsaddfinish'],$_POST['typeEcole'],$_POST['nomEcole'],$_POST['adresseEcole'], $_POST['cpEcole'], $_POST['villeEcole'], $_POST['mailDir'], $_POST['telDir'], $_POST['nomDir'], $_POST['prenomDir'])) {
	$ctrl->ajouterEcole($_POST['typeEcole'],$_POST['nomEcole'],$_POST['adresseEcole'], $_POST['cpEcole'], $_POST['villeEcole'], $_POST['mailDir'], $_POST['telDir'], $_POST['civDir'], $_POST['nomDir'], $_POST['prenomDir']);
	header("Location:/JP/kiosqueadmin/schools/");
}
elseif(isset($_SESSION['login'],$_GET['schools'],$_GET['suppr'])) {
	$ctrl->supprimerEcole($_GET['schools']);
	header("Location:/JP/kiosqueadmin/schools/");
}
elseif(isset($_SESSION['login'],$_GET['schools'],$_GET['edit'])) {
	$ctrl->afficheModifierEcole($_GET['schools']);
}
elseif(isset($_SESSION['login'],$_GET['schoolsseditfinish'],$_GET['schools'],$_POST['typeEcole'],$_POST['nomEcole'],$_POST['adresseEcole'],$_POST['cpEcole'],$_POST['villeEcole'],$_POST['mailDir'],$_POST['telDir'],$_POST['civDir'],$_POST['nomDir'],$_POST['prenomDir'])) {
	$ctrl->editEcole($_GET['schools'],$_POST['typeEcole'],$_POST['nomEcole'],$_POST['adresseEcole'],$_POST['cpEcole'],$_POST['villeEcole'],$_POST['mailDir'],$_POST['telDir'],$_POST['civDir'],$_POST['nomDir'],$_POST['prenomDir']);
	header("Location:/JP/kiosqueadmin/schools/");
}
elseif(isset($_SESSION['login'])) {
	$ctrl->afficheGestEcoles();
}
else
{
	$ctrl->afficheConnexion();
}