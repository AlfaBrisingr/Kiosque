<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = "voirIndex";
}

switch ($action) {
    case 'voirIndex':
        require_once ROOT.'views/v_Accueil.php';
        break;
}