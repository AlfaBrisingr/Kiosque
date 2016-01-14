<?php

require_once 'c_Infos.php';
session_start();
$ctrl = new InfosSpace();
if(isset($_SESSION['login'])) {
	$ctrl->afficheInfos();
}
else
{
	$ctrl->afficheConnexion();
}
