<?php

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = "voirForm";
}

switch ($action) {
    case 'voirForm':
        require_once ROOT.'views/kiosqueadmin/v_Form.php';
        break;

    case 'voirAdmin':
        try {
            if (Main::connexionExistante()) {
                require_once ROOT.'views/kiosqueadmin/v_AccueilAdmin.php';
            } else {
                if (isset($_POST['login']) && $_POST['login'] != 'jeunepublic') {
                    $mdp = sha1($_POST['password']);
                    $_SESSION['utilisateur'] = Admin::getUserByName($_POST['login']);
                    if (isset($_POST['password']) == $_SESSION['utilisateur']->getPassword()) {
                        Main::setFlashMessage("Connecté avec succès", "valid");
                        header("Location:?uc=admin&action=voirAdmin");
                    } else {

                        Main::launchWrongUserPwd();
                        header("Location:?uc=admin");
                    }
                } else {
                    header("Location:?uc=admin");
                }

            }
        } catch (Exception $e) {

            Main::setFlashMessage($e->getMessage(), "error");
        }

        break;

    case 'voirInscription':
        $listIns = MInscription::getInscriptionsJeunePublic();
        $listPlan = MPlanning::getPlanningsJeunePublic();
        $listSpec = MSpectacle::getSpectaclesSaisonCouranteJeunePublic();
        $listSean = MSeance::getSeancesJeunePublic();
        $listChoix = MChoix::getChoixs();
        $listJauge = MPlanning::getJaugeRestanteJeunePublic();
        $enfant = MInscription::getNbEnfantsInscription();
        require_once ROOT.'views/kiosqueadmin/JeunePublic/v_Inscription.php';
        break;

    case 'voirInscriptionCL':
        $listIns = MInscription::getInscriptionsCollegeLycee();
        $listPlan = MPlanning::getPlanningsCollegeLycee();
        $listSpec = MSpectacle::getSpectaclesSaisonCouranteCollegeLycee();
        $listSean = MSeance::getSeancesCollegeLycee();
        $listChoix = MChoix::getChoixs();
        $listJauge = MPlanning::getJaugeRestanteCollegeLycee();
        require_once ROOT.'views/kiosqueadmin/CollegeLycee/v_Inscription.php';
        break;

    case 'voirSpectacle':
        $listSpec = MSpectacle::getSpectaclesSaisonCourante();
        $actuel = MSaison::getSaisonCourante();
        require_once ROOT.'views/kiosqueadmin/shows/v_Spectacle.php';
        break;

    case 'voirLieu':
        $listLieu = MLieu::getLieux();
        require_once ROOT.'views/kiosqueadmin/locations/v_Lieu.php';
        break;

    case 'voirEcole':
        $listEcole = MEcole::getEcoles();
        require_once ROOT.'views/kiosqueadmin/schools/v_School.php';
        break;

    case 'voirInfos':
        require_once ROOT.'views/kiosqueadmin/infos/v_Infos.php';
        break;

    case 'validerInscription':
        try {
            $inscription = MInscription::getInscriptionByIdInscription($_GET['ins']);
            if (isset($_POST['seance'])) {
                $seance = MSeance::getSeance($_POST['seance']);
                $planning = new Planning($seance, $inscription);
                MPlanning::addUnPlanning($planning);
                MInscription::validerInscription($inscription);

                Main::setFlashMessage("La panification de l'inscription a été faite", "valid");
                header("Location:?uc=admin&action=voirInscription");
            } else {

                $listChoix = MChoix::getChoixByIns($_GET['ins']);
                require_once ROOT.'views/kiosqueadmin/JeunePublic/v_InscriptionValidated.php';
            }
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'SupprimerInscription':
        try {
            $inscription = MInscription::getInscriptionByIdInscription($_GET['ins']);
            MInscription::rmInscription($inscription);

            Main::setFlashMessage("La suppression de l'inscription a été faite", "valid");
            header("Location:?uc=admin&action=voirInscription");

        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;


    case 'ModifierInscription':
        try {
            if (isset($_POST['idSpectacleC1']) && isset($_POST['idSpectacleC2']) && isset($_POST['idSpectacleC3']) && isset($_POST['nbrEnfants']) && isset($_POST['nbrAdultes']) && isset($_POST['classe'])) {
                $inscription = MInscription::getInscriptionByIdInscription($_GET['ins']);
                MChoix::rmChoix($inscription);
                $inscription->setClasse($_POST['classe']);
                $inscription->setNbAdultes($_POST['nbrAdultes']);
                $inscription->setNbEnfants($_POST['nbrEnfants']);

                $spectacle1 = MSpectacle::getSpectacleById($_POST['idSpectacleC1']);
                $choix1 = new Choix($inscription, $spectacle1, 1);
                MChoix::addChoix($choix1);

                if ($_POST['idSpectacleC2'] != "non") {
                    $spectacle2 = MSpectacle::getSpectacleById($_POST['idSpectacleC2']);
                    $choix2 = new Choix($inscription, $spectacle2, 2);
                    MChoix::addChoix($choix2);
                }

                if ($_POST['idSpectacleC3'] != "non") {
                    $spectacle3 = MSpectacle::getSpectacleById($_POST['idSpectacleC3']);
                    $choix3 = new Choix($inscription, $spectacle3, 3);
                    MChoix::addChoix($choix3);
                }

                MInscription::editInscription($inscription);

                Main::setFlashMessage("La modification de l'inscription a réussi", "valid");
                header("Location:?uc=admin&action=voirInscription");
            } else {
                $listIns = MInscription::getInscriptionByIdInscription($_GET['ins']);
                $listSpec = MSpectacle::getSpectacles();
                $listSpec2 = MSpectacle::getSpectacles();
                $listSpec3 = MSpectacle::getSpectacles();
                require_once ROOT.'views/kiosqueadmin/JeunePublic/v_InscriptionEdit.php';
            }

        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'SupprimerunPlanning':
        try {
            $inscription = MInscription::getInscriptionByIdInscription($_GET['i']);
            MPlanning::rmPlanningByInscription($inscription);
            $inscription->setValidated(0);
            MInscription::editInscription($inscription);

            Main::setFlashMessage("La suppression du planning a été faite", "valid");
            header("Location:?uc=admin&action=voirInscription");

        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'AjouterSeance':
        try {
            if (isset($_POST['idSpectacle']) && isset($_POST['dateHeure']) && isset($_POST['idLieu'])) {
                $spectacle = MSpectacle::getSpectacleById($_POST['idSpectacle']);
                $lieu = MLieu::getLieuById($_POST['idLieu']);
                $date = DateTime::createFromFormat('d/m/Y H:i:s', $_POST['dateHeure']);
                $seance = new Seance(1, $spectacle, $date, $lieu);
                MSeance::addSeance($seance);
                Main::setFlashMessage("L'ajout de la séance a été faite", "valid");
                header("Location:?uc=admin&action=voirInscription");
            } else {
                $listLieu = MLieu::getLieux() ;
                $listSpec = MSpectacle::getSpectacles();
                require_once ROOT.'views/kiosqueadmin/JeunePublic/v_SeanceAdd.php';
            }
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'SupprimerSeance':
        try {
            $seance = MSeance::getSeance($_GET['seance']);
            MSeance::rmSeance($seance);

            Main::setFlashMessage("La suppression de la séance a été faite", "valid");
            header("Location:?uc=admin&action=voirInscription");
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'PlanningPDF':
        try {
            if (isset($_GET['seance'])) {
                $seance = MSeance::getSeance($_GET['seance']);
                $listPlanSeance = MPlanning::getPlanningBySeance($seance);
                $_SESSION['idSeance'] = $_GET['seance'];
                $_SESSION['planning'] = $listPlanSeance;

            }

            if (isset($_POST['valider'])) {
                $seance = MSeance::getSeance($_SESSION['idSeance']);
                $listPlanSeance = MPlanning::getPlanningBySeance($seance);
                $spectacle = MSpectacle::getSpectacleById($seance->getSpectacle()->getId());

                // get the HTML
                ob_start(); ?>
                <style type="text/css">

                    table{
                        text-align: center;
                        vertical-align: middle;
                        line-height: 6px;
                        font-family: helvetica;
                        font-size: 12pt;
                        width: 100%;
                        border-collapse: collapse;
                    }

                    table td, table th {
                        border: 1px solid;
                        padding: 3mm 1mm;
                    }
                    h1{
                        text-align: center;
                        font-size: 20px;
                        font-family: helvetica;
                        font-style: inherit;
                    }
                </style>

                <page>
                    <h1>Planning de la séance n° <?= $seance->getId()?> sur le spectacle : <?= $spectacle->getNom() ?> : <br>
                    Séance prévu le <?= $seance->getDate()->format('d/m/Y - H:i') ?> <br>
                    Niveau : <?= $seance->getSpectacle()->getTypeClasse() ?><br>
                    Jauge Spectacle : <?= $seance->getSpectacle()->getNbPlace() ?> places</h1>
                    <table>
                        <thead>
                        <tr>
                            <th style="width: 50%">Inscription</th>
                            <th style="width: 10%">Classe</th>
                            <th style="width: 10%">Téléphone</th>
                            <th style="width: 10%">Enfants</th>
                            <th style="width: 10%">Adultes</th>
                            <th style="width: 10%">Présence</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($listPlanSeance->getCollection() as $planning) { ?>
                            <tr>
                                <td><?= $planning->getInscription()->getEnseignant()->getEcole()->getNom() ?> <?= '- '.$planning->getInscription()->getEnseignant()->getNom().' '.$planning->getInscription()->getEnseignant()->getPrenom() ?></td>
                                <td><?= $planning->getInscription()->getClasse() ?></td>
                                <td><?= $planning->getInscription()->getEnseignant()->getEcole()->getDirecteur()->getTel() ?></td>
                                <td><?= $planning->getInscription()->getNbEnfants()?></td>
                                <td><?= $planning->getInscription()->getNbAdultes() ?></td>
                                <td>
                                    <label>
                                        <input type="checkbox" >
                                    </label>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </page>

                <?php $content = ob_get_clean();

                // convert in PDF
                require("html2pdf/html2pdf.class.php");
                try {
                    ob_end_clean();
                    $pdf = new HTML2PDF('L', 'A4', 'fr');
                    $pdf->writeHTML($content);
                    $pdf->Output('Planning.pdf');
                } catch (HTML2PDF_exception $e) {
                    echo $e;
                    exit;
                }
            }
            $listSeance = MSeance::getSeances();
            $listSpectacle = MSpectacle::getSpectacles();
            $listPlan = MPlanning::getPlannings();
            require_once ROOT.'views/kiosqueadmin/JeunePublic/v_PlanningPDF.php';
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'SeancePDF':
        try {
            if (isset($_GET['spectacle'])) {
                $spectacle = MSpectacle::getSpectacleById($_GET['spectacle']);
                $listSeanceSpectacle = MSeance::getSeancesBySpec($spectacle);
                $_SESSION['idSpectacle'] = $_GET['spectacle'];
                $_SESSION['seance'] = $listSeanceSpectacle;

            }

            if (isset($_POST['valider'])) {
                $spectacle = MSpectacle::getSpectacleById($_SESSION['idSpectacle']);
                $listSeanceSpectacle = MSeance::getSeancesBySpec($spectacle);


                // get the HTML
                ob_start(); ?>
                <style type="text/css">

                    table{
                        text-align: center;
                        vertical-align: middle;
                        line-height: 6px;
                        font-family: helvetica;
                        font-size: 12pt;
                        width: 100%;
                        border-collapse: collapse;
                        margin:auto;
                    }

                    table td, table th {
                        border: 1px solid;
                        padding: 3mm 1mm;
                    }
                    h1{
                        text-align: center;
                        font-size: 20px;
                        font-family: helvetica;
                        font-style: inherit;
                    }
                </style>

                <page>
                    <h1>Séances du Spectacle : <?= $spectacle->getNom() ?> : <br>
                        Niveau : <?= $spectacle->getTypeClasse() ?><br>
                        Jauge Spectacle : <?= $spectacle->getNbPlace() ?> places</h1>
                    <table>
                        <thead>
                        <tr>
                            <th style="width: 10%">N° Seance</th>
                            <th style="width: 20%">Date/Heure</th>
                            <th style="width: 20%">Lieu</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($listSeanceSpectacle->getCollection() as $seance) { ?>
                            <tr>
                                <td><?= $seance->getId() ?></td>
                                <td><?= $seance->getDate()->format('d/m/Y - H:i')  ?></td>
                                <td><?= $seance->getLieu()->getNom()?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </page>

                <?php $content = ob_get_clean();

                // convert in PDF
                require("html2pdf/html2pdf.class.php");
                try {
                    ob_end_clean();
                    $pdf = new HTML2PDF('L', 'A4', 'fr');
                    $pdf->writeHTML($content);
                    $pdf->Output('Planning.pdf');
                } catch (HTML2PDF_exception $e) {
                    echo $e;
                    exit;
                }
            }
            $listSeance = MSeance::getSeances();
            $listSpectacle = MSpectacle::getSpectacles();
            require_once ROOT.'views/kiosqueadmin/JeunePublic/v_SeancePDF.php';
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'JaugePDF':
        try {
            if (isset($_GET['spectacle'])) {
                $spectacle = MSpectacle::getSpectacleById($_GET['spectacle']);
                $listJaugeSpectacle = MPlanning::getJaugeRestanteJeunePublicBySpec($spectacle);
                $_SESSION['idSpectacle'] = $_GET['spectacle'];
                $_SESSION['seance'] = $listJaugeSpectacle;

            }

            if (isset($_POST['valider'])) {
                $spectacle = MSpectacle::getSpectacleById($_SESSION['idSpectacle']);
                $listJaugeSpectacle = MPlanning::getJaugeRestanteJeunePublicBySpec($spectacle);


                // get the HTML
                ob_start(); ?>
                <style type="text/css">

                    table{
                        text-align: center;
                        vertical-align: middle;
                        line-height: 6px;
                        font-family: helvetica;
                        font-size: 12pt;
                        width: 100%;
                        border-collapse: collapse;
                        margin:auto;
                    }

                    table td, table th {
                        border: 1px solid;
                        padding: 3mm 1mm;
                    }
                    h1{
                        text-align: center;
                        font-size: 20px;
                        font-family: helvetica;
                        font-style: inherit;
                    }
                </style>

                <page>
                    <h1>Séances du Spectacle : <?= $spectacle->getNom() ?> : <br>
                        Niveau : <?= $spectacle->getTypeClasse() ?><br>
                        Jauge Spectacle : <?= $spectacle->getNbPlace() ?> places</h1>
                    <table>
                        <thead>
                        <tr>
                            <th>Séance</th>
                            <th>Spectacle</th>
                            <th>Date Séance</th>
                            <th>Nbr Enfants</th>
                            <th>Nbr Adultes</th>
                            <th>Jauge utilisée</th>
                            <th>Jauge restante</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($listJaugeSpectacle->getCollection() as $jauge) { ?>
                            <tr>
                                <td><?= $jauge->getSeance()->getId() ?></td>
                                <td><?= $jauge->getSeance()->getSpectacle()->getNom() ?></td>
                                <td><?= $jauge->getSeance()->getDate()->format('d/m/Y - H:i') ?></td>
                                <td><?= $jauge->getNbEnfants() ?></td>
                                <td><?= $jauge->getNbAdultes() ?></td>
                                <td><?= $jauge->getUtilise() ?></td>
                                <td><?= $jauge->getRestante() ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </page>

                <?php $content = ob_get_clean();

                // convert in PDF
                require("html2pdf/html2pdf.class.php");
                try {
                    ob_end_clean();
                    $pdf = new HTML2PDF('L', 'A4', 'fr');
                    $pdf->writeHTML($content);
                    $pdf->Output('Planning.pdf');
                } catch (HTML2PDF_exception $e) {
                    echo $e;
                    exit;
                }
            }
            $listJauge = MPlanning::getJaugeRestanteJeunePublic();
            $listSpectacle = MSpectacle::getSpectacles();
            require_once ROOT.'views/kiosqueadmin/JeunePublic/v_JaugePDF.php';
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'validerInscriptionCL':
        try {
            $inscription = MInscription::getInscriptionByIdInscription($_GET['ins']);
            if (isset($_POST['seance'])) {
                $seance = MSeance::getSeance($_POST['seance']);
                $planning = new Planning($seance, $inscription);
                MPlanning::addUnPlanning($planning);
                MInscription::validerInscription($inscription);

                Main::setFlashMessage("La panification de l'inscription a été faite", "valid");
                header("Location:?uc=admin&action=voirInscriptionCL");
            } else {

                $listChoix = MChoix::getChoixByIns($_GET['ins']);
                require_once ROOT.'views/kiosqueadmin/CollegeLycee/v_InscriptionValidated.php';
            }
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'SupprimerInscriptionCL':
        try {
            $inscription = MInscription::getInscriptionByIdInscription($_GET['ins']);
            MInscription::rmInscription($inscription);

            Main::setFlashMessage("La suppression de l'inscription a été faite", "valid");
            header("Location:?uc=admin&action=voirInscriptionCL");

        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;


    case 'ModifierInscriptionCL':
        try {
            if (isset($_POST['idSpectacleC1']) && isset($_POST['idSpectacleC2']) && isset($_POST['idSpectacleC3']) && isset($_POST['nbrEnfants']) && isset($_POST['nbrAdultes']) && isset($_POST['classe'])) {
                $inscription = MInscription::getInscriptionByIdInscription($_GET['ins']);
                MChoix::rmChoix($inscription);
                $inscription->setClasse($_POST['classe']);
                $inscription->setNbAdultes($_POST['nbrAdultes']);
                $inscription->setNbEnfants($_POST['nbrEnfants']);

                $spectacle1 = MSpectacle::getSpectacleById($_POST['idSpectacleC1']);
                $choix1 = new Choix($inscription, $spectacle1, 1);
                MChoix::addChoix($choix1);

                if ($_POST['idSpectacleC2'] != "non") {
                    $spectacle2 = MSpectacle::getSpectacleById($_POST['idSpectacleC2']);
                    $choix2 = new Choix($inscription, $spectacle2, 2);
                    MChoix::addChoix($choix2);
                }

                if ($_POST['idSpectacleC3'] != "non") {
                    $spectacle3 = MSpectacle::getSpectacleById($_POST['idSpectacleC3']);
                    $choix3 = new Choix($inscription, $spectacle3, 3);
                    MChoix::addChoix($choix3);
                }

                MInscription::editInscription($inscription);

                Main::setFlashMessage("La modification de l'inscription a réussi", "valid");
                header("Location:?uc=admin&action=voirInscriptionCL");
            } else {
                $listIns = MInscription::getInscriptionByIdInscription($_GET['ins']);
                $listSpec = MSpectacle::getSpectacles();
                $listSpec2 = MSpectacle::getSpectacles();
                $listSpec3 = MSpectacle::getSpectacles();
                require_once ROOT.'views/kiosqueadmin/CollegeLycee/v_InscriptionEdit.php';
            }

        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'SupprimerunPlanningCL':
        try {
            $inscription = MInscription::getInscriptionByIdInscription($_GET['i']);
            MPlanning::rmPlanningByInscription($inscription);
            $inscription->setValidated(0);
            MInscription::editInscription($inscription);

            Main::setFlashMessage("La suppression du planning a été faite", "valid");
            header("Location:?uc=admin&action=voirInscriptionCL");

        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'AjouterSeanceCL':
        try {
            if (isset($_POST['idSpectacle']) && isset($_POST['dateHeure']) && isset($_POST['idLieu'])) {
                $spectacle = MSpectacle::getSpectacleById($_POST['idSpectacle']);
                $lieu = MLieu::getLieuById($_POST['idLieu']);
                $date = DateTime::createFromFormat('d/m/Y H:i:s', $_POST['dateHeure']);
                $seance = new Seance(1, $spectacle, $date, $lieu);
                MSeance::addSeance($seance);
                Main::setFlashMessage("L'ajout de la séance a été faite", "valid");
                header("Location:?uc=admin&action=voirInscriptionCL");
            } else {
                $listLieu = MLieu::getLieux() ;
                $listSpec = MSpectacle::getSpectacles();
                require_once ROOT.'views/kiosqueadmin/CollegeLycee/v_SeanceAdd.php';
            }
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'SupprimerSeanceCL':
        try {
            $seance = MSeance::getSeance($_GET['seance']);
            MSeance::rmSeance($seance);

            Main::setFlashMessage("La suppression de la séance a été faite", "valid");
            header("Location:?uc=admin&action=voirInscriptionCL");
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'PlanningPDFCL':
        try {
            if (isset($_GET['seance'])) {
                $seance = MSeance::getSeance($_GET['seance']);
                $listPlanSeance = MPlanning::getPlanningBySeance($seance);
                $_SESSION['idSeance'] = $_GET['seance'];
                $_SESSION['planning'] = $listPlanSeance;

            }

            if (isset($_POST['valider'])) {
                $seance = MSeance::getSeance($_SESSION['idSeance']);
                $listPlanSeance = MPlanning::getPlanningBySeance($seance);
                $spectacle = MSpectacle::getSpectacleById($seance->getSpectacle()->getId());

                // get the HTML
                ob_start(); ?>
                <style type="text/css">

                    table{
                        text-align: center;
                        vertical-align: middle;
                        line-height: 6px;
                        font-family: helvetica;
                        font-size: 12pt;
                        width: 100%;
                        border-collapse: collapse;
                    }

                    table td, table th {
                        border: 1px solid;
                        padding: 3mm 1mm;
                    }
                    h1{
                        text-align: center;
                        font-size: 20px;
                        font-family: helvetica;
                        font-style: inherit;
                    }
                </style>

                <page>
                    <h1>Planning de la séance n° <?= $seance->getId()?> sur le spectacle : <?= $spectacle->getNom() ?> : <br>
                        Séance prévu le <?= $seance->getDate()->format('d/m/Y - H:i') ?> <br>
                        Niveau : <?= $seance->getSpectacle()->getTypeClasse() ?><br>
                        Jauge Spectacle : <?= $seance->getSpectacle()->getNbPlace() ?> places</h1>
                    <table>
                        <thead>
                        <tr>
                            <th style="width: 50%">Inscription</th>
                            <th style="width: 10%">Classe</th>
                            <th style="width: 10%">Téléphone</th>
                            <th style="width: 10%">Enfants</th>
                            <th style="width: 10%">Adultes</th>
                            <th style="width: 10%">Présence</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($listPlanSeance->getCollection() as $planning) { ?>
                            <tr>
                                <td><?= $planning->getInscription()->getEnseignant()->getEcole()->getNom() ?> <?= '- '.$planning->getInscription()->getEnseignant()->getNom().' '.$planning->getInscription()->getEnseignant()->getPrenom() ?></td>
                                <td><?= $planning->getInscription()->getClasse() ?></td>
                                <td><?= $planning->getInscription()->getEnseignant()->getEcole()->getDirecteur()->getTel() ?></td>
                                <td><?= $planning->getInscription()->getNbEnfants()?></td>
                                <td><?= $planning->getInscription()->getNbAdultes() ?></td>
                                <td>
                                    <label>
                                        <input type="checkbox" >
                                    </label>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </page>

                <?php $content = ob_get_clean();

                // convert in PDF
                require("html2pdf/html2pdf.class.php");
                try {
                    ob_end_clean();
                    $pdf = new HTML2PDF('L', 'A4', 'fr');
                    $pdf->writeHTML($content);
                    $pdf->Output('Planning.pdf');
                } catch (HTML2PDF_exception $e) {
                    echo $e;
                    exit;
                }
            }
            $listSeance = MSeance::getSeances();
            $listSpectacle = MSpectacle::getSpectacles();
            $listPlan = MPlanning::getPlannings();
            require_once ROOT.'views/kiosqueadmin/CollegeLycee/v_PlanningPDF.php';
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'SeancePDFCL':
        try {
            if (isset($_GET['spectacle'])) {
                $spectacle = MSpectacle::getSpectacleById($_GET['spectacle']);
                $listSeanceSpectacle = MSeance::getSeancesBySpec($spectacle);
                $_SESSION['idSpectacle'] = $_GET['spectacle'];
                $_SESSION['seance'] = $listSeanceSpectacle;

            }

            if (isset($_POST['valider'])) {
                $spectacle = MSpectacle::getSpectacleById($_SESSION['idSpectacle']);
                $listSeanceSpectacle = MSeance::getSeancesBySpec($spectacle);


                // get the HTML
                ob_start(); ?>
                <style type="text/css">

                    table{
                        text-align: center;
                        vertical-align: middle;
                        line-height: 6px;
                        font-family: helvetica;
                        font-size: 12pt;
                        width: 100%;
                        border-collapse: collapse;
                        margin:auto;
                    }

                    table td, table th {
                        border: 1px solid;
                        padding: 3mm 1mm;
                    }
                    h1{
                        text-align: center;
                        font-size: 20px;
                        font-family: helvetica;
                        font-style: inherit;
                    }
                </style>

                <page>
                    <h1>Séances du Spectacle : <?= $spectacle->getNom() ?> : <br>
                        Niveau : <?= $spectacle->getTypeClasse() ?><br>
                        Jauge Spectacle : <?= $spectacle->getNbPlace() ?> places</h1>
                    <table>
                        <thead>
                        <tr>
                            <th style="width: 10%">N° Seance</th>
                            <th style="width: 20%">Date/Heure</th>
                            <th style="width: 20%">Lieu</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($listSeanceSpectacle->getCollection() as $seance) { ?>
                            <tr>
                                <td><?= $seance->getId() ?></td>
                                <td><?= $seance->getDate()->format('d/m/Y - H:i')  ?></td>
                                <td><?= $seance->getLieu()->getNom()?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </page>

                <?php $content = ob_get_clean();

                // convert in PDF
                require("html2pdf/html2pdf.class.php");
                try {
                    ob_end_clean();
                    $pdf = new HTML2PDF('L', 'A4', 'fr');
                    $pdf->writeHTML($content);
                    $pdf->Output('Planning.pdf');
                } catch (HTML2PDF_exception $e) {
                    echo $e;
                    exit;
                }
            }
            $listSeance = MSeance::getSeances();
            $listSpectacle = MSpectacle::getSpectacles();
            require_once ROOT.'views/kiosqueadmin/CollegeLycee/v_SeancePDF.php';
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'JaugePDFCL':
        try {
            if (isset($_GET['spectacle'])) {
                $spectacle = MSpectacle::getSpectacleById($_GET['spectacle']);
                $listJaugeSpectacle = MPlanning::getJaugeRestanteJeunePublicBySpec($spectacle);
                $_SESSION['idSpectacle'] = $_GET['spectacle'];
                $_SESSION['seance'] = $listJaugeSpectacle;

            }

            if (isset($_POST['valider'])) {
                $spectacle = MSpectacle::getSpectacleById($_SESSION['idSpectacle']);
                $listJaugeSpectacle = MPlanning::getJaugeRestanteJeunePublicBySpec($spectacle);


                // get the HTML
                ob_start(); ?>
                <style type="text/css">

                    table{
                        text-align: center;
                        vertical-align: middle;
                        line-height: 6px;
                        font-family: helvetica;
                        font-size: 12pt;
                        width: 100%;
                        border-collapse: collapse;
                        margin:auto;
                    }

                    table td, table th {
                        border: 1px solid;
                        padding: 3mm 1mm;
                    }
                    h1{
                        text-align: center;
                        font-size: 20px;
                        font-family: helvetica;
                        font-style: inherit;
                    }
                </style>

                <page>
                    <h1>Séances du Spectacle : <?= $spectacle->getNom() ?> : <br>
                        Niveau : <?= $spectacle->getTypeClasse() ?><br>
                        Jauge Spectacle : <?= $spectacle->getNbPlace() ?> places</h1>
                    <table>
                        <thead>
                        <tr>
                            <th>Séance</th>
                            <th>Spectacle</th>
                            <th>Date Séance</th>
                            <th>Nbr Enfants</th>
                            <th>Nbr Adultes</th>
                            <th>Jauge utilisée</th>
                            <th>Jauge restante</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($listJaugeSpectacle->getCollection() as $jauge) { ?>
                            <tr>
                                <td><?= $jauge->getSeance()->getId() ?></td>
                                <td><?= $jauge->getSeance()->getSpectacle()->getNom() ?></td>
                                <td><?= $jauge->getSeance()->getDate()->format('d/m/Y - H:i') ?></td>
                                <td><?= $jauge->getNbEnfants() ?></td>
                                <td><?= $jauge->getNbAdultes() ?></td>
                                <td><?= $jauge->getUtilise() ?></td>
                                <td><?= $jauge->getRestante() ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </page>

                <?php $content = ob_get_clean();

                // convert in PDF
                require("html2pdf/html2pdf.class.php");
                try {
                    ob_end_clean();
                    $pdf = new HTML2PDF('L', 'A4', 'fr');
                    $pdf->writeHTML($content);
                    $pdf->Output('Planning.pdf');
                } catch (HTML2PDF_exception $e) {
                    echo $e;
                    exit;
                }
            }
            $listJauge = MPlanning::getJaugeRestanteJeunePublic();
            $listSpectacle = MSpectacle::getSpectacles();
            require_once ROOT.'views/kiosqueadmin/CollegeLycee/v_JaugePDF.php';
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'CourrierPDF':
        try {
            if (isset($_GET['ecole'])) {
                $ecole = MEcole::getEcoleById($_GET['ecole']);
                $listInsEcole = MPlanning::getPlanningsbyEcole($ecole);
                $_SESSION['idEcole'] = $_GET['ecole'];
                $_SESSION['ecole'] = $listInsEcole;

            }

            if (isset($_POST['valider'])) {
                $ecole = MEcole::getEcoleById($_SESSION['idEcole']);
                $listInsEcole = MPlanning::getPlanningsbyEcole($ecole);


                // get the HTML
                ob_start(); ?>
                <style type="text/css">
                    table{
                        text-align: center;
                        vertical-align: middle;
                        line-height: 6px;
                        font-family: helvetica;
                        font-size: 12pt;
                        width: 100%;
                        border-collapse: collapse;
                        margin:auto;
                    }

                    table td, table th {
                        border: 1px solid;
                        padding: 3mm 1mm;
                    }
                    h1{
                        text-align: center;
                        font-size: 20px;
                        font-family: helvetica;
                        font-style: inherit;
                    }
                </style>

                <page>

                </page>

                <?php $content = ob_get_clean();

                // convert in PDF
                require("html2pdf/html2pdf.class.php");
                try {
                    ob_end_clean();
                    $pdf = new HTML2PDF('L', 'A4', 'fr');
                    $pdf->writeHTML($content);
                    $pdf->Output('Planning.pdf');
                } catch (HTML2PDF_exception $e) {
                    echo $e;
                    exit;
                }
            }
            $listIns = MPlanning::getPlannings();
            $listEcole = MEcole::getEcoles();
            require_once ROOT.'views/kiosqueadmin/v_Courrier.php';
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'Ecole':
        if ($_GET['type'] == 1) {

            $ListEcoleChoix = MEcole::getEcolesJeunePublic();
            $_SESSION['idType'] = $_GET['type'];
            $_SESSION['type'] = $ListEcoleChoix;
        }

        if ($_GET['type'] == 2) {
            $ListEcoleChoix = MEcole::getEcolesCollegeLycee();
            $_SESSION['idType'] = $_GET['type'];
            $_SESSION['type'] = $ListEcoleChoix;
        }
        require_once ROOT.'views/kiosqueadmin/schools/v_School.php';
        break;

    case 'Spectacle':
        if ($_GET['type'] == 1) {

            $listSpecEcole = MSpectacle::getSpectaclesSaisonCouranteJeunePublic();
            $_SESSION['idType'] = $_GET['type'];
            $_SESSION['type'] = $listSpecEcole;
        }

        if ($_GET['type'] == 2) {
            $listSpecEcole = MSpectacle::getSpectaclesSaisonCouranteCollegeLycee();
            $_SESSION['idType'] = $_GET['type'];
            $_SESSION['type'] = $listSpecEcole;
        }
        $actuel = MSaison::getSaisonCourante();
        require_once ROOT.'views/kiosqueadmin/shows/v_Spectacle.php';
        break;
}