<?php
if(isset($_GET['action']))
{
    $action = $_GET['action'];
}
else
{
    $action = "voirIndex";
}

switch ($action)
{
    case 'voirIndex' :
        include("views/v_Accueil.php"); break;
}