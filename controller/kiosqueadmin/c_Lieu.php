<?php

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = "voirLieu";
}

switch ($action) {
    case 'voirLieu':
        $listLieu = MLieu::getLieux();
        require_once ROOT.'views/kiosqueadmin/locations/v_Lieu.php';
        break;

    case 'voirModifierLieu':
        $listLieu =  MLieu::getLieuById($_GET['locations']);
        require_once ROOT.'views/kiosqueadmin/locations/v_LieuEdit.php';
        break;

    case 'ModifierLieu':
        try {
            if (!is_numeric($_POST['nomLieu']) && !is_numeric($_POST['adrLieu']) && is_numeric($_POST['cpLieu']) && !is_numeric($_POST['villeLieu']) && (!empty($_POST['nomLieu']) && !empty($_POST['adrLieu']) && !empty($_POST['cpLieu']) && !empty($_POST['villeLieu']))) {
                $lieu = new Lieu($_GET['locations'],$_POST['nomLieu'],$_POST['adrLieu'],$_POST['cpLieu'],$_POST['villeLieu']);
                MLieu::editLieu($lieu);

                Main::setFlashMessage("Le lieu a bien été modifié", "valid");
                header("Location:?uc=lieu");
            } else {
                throw new Exception ("Impossible de modifier le lieu (mauvais formats entrés)");
            }
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'voirAjouterLieu':
        require_once ROOT.'views/kiosqueadmin/locations/v_LieuAdd.php';
        break;

    case 'AjouterLieu':
        try {
            if (!is_numeric($_POST['nomLieu']) && !is_numeric($_POST['adrLieu']) && is_numeric($_POST['cpLieu']) && !is_numeric($_POST['villeLieu']) && (!empty($_POST['nomLieu']) && !empty($_POST['adrLieu']) && !empty($_POST['cpLieu']) && !empty($_POST['villeLieu']))) {
                $lieu = new Lieu(1, $_POST['nomLieu'], $_POST['adrLieu'], $_POST['cpLieu'], $_POST['villeLieu']);
                MLieu::addLieu($lieu);

                Main::setFlashMessage("Le lieu a bien été ajouté", "valid");
                header("Location:?uc=lieu");
            } else {
                throw new Exception ("Impossible d'ajouter le lieu (mauvais formats entrés)");
            }
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'SupprimerLieu':
        try {
            $lieu = MLieu::getLieuById($_GET['locations']);
            MLieu::rmLieu($lieu);

            Main::setFlashMessage("Le lieu : " .$lieu->getNom(). " a bien été supprimé", "valid");
            header("Location:?uc=lieu");
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");

        }
        break;

}