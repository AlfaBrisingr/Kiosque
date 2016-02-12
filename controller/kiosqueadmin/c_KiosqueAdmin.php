<?php

require_once ('models/m_Admin.php');
require_once ('classes/Utilisateur.php');

if(isset($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action = "voirForm";
}

switch($action) {
    case 'voirForm':
        include("views/kiosqueadmin/v_Form.php");
        break;

    case 'voirAdmin' :
        try {
            if (Main::connexionExistante()) {
                include("views/kiosqueadmin/v_AccueilAdmin.php");
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
        include("views/kiosqueadmin/v_Inscription.php");
        break;

    case 'voirInscriptionCL' :
        $listIns = MInscription::getInscriptionsCollegeLycee();
        $listPlan = MPlanning::getPlanningsCollegeLycee();
        $listSpec = MSpectacle::getSpectaclesSaisonCouranteCollegeLycee();
        $listSean = MSeance::getSeancesCollegeLycee();
        $listChoix = MChoix::getChoixs();
        $listJauge = MPlanning::getJaugeRestanteCollegeLycee();
        include("views/kiosqueadmin/v_Inscription.php");
        break;

    case 'voirSpectacle' :
        $listSpec = MSpectacle::getSpectaclesSaisonCourante();
        $actuel = MSaison::getSaisonCourante();
        include("views/kiosqueadmin/shows/v_Spectacle.php");
        break;

    case 'voirLieu':
        $listLieu = MLieu::getLieux();
        include("views/kiosqueadmin/locations/v_Lieu.php");
        break;

    case 'voirEcole':
        $listEcole = MEcole::getEcoles();
        include("views/kiosqueadmin/schools/v_School.php");
        break;

    case 'voirInfos':
        include("views/kiosqueadmin/infos/v_Infos.php");
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
                include("views/kiosqueadmin/v_InscriptionValidated.php");
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
                include("views/kiosqueadmin/v_InscriptionEdit.php");
            }

        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'SupprimerunPlanning' :
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
            if(isset($_POST['idSpectacle']) && isset($_POST['dateHeure']) && isset($_POST['idLieu'])){
                $spectacle = MSpectacle::getSpectacleById($_POST['idSpectacle']);
                $lieu = MLieu::getLieuById($_POST['idLieu']);
                $date = DateTime::createFromFormat('d/m/Y H:i:s', $_POST['dateHeure']);
                $seance = new Seance(1,$spectacle,$date,$lieu);
                MSeance::addSeance($seance);
                Main::setFlashMessage("L'ajout de la séance a été faite", "valid");
                header("Location:?uc=admin&action=voirInscription");
            }else{
                $listLieu = MLieu::getLieux() ;
                $listSpec = MSpectacle::getSpectacles();
                include("views/kiosqueadmin/v_SeanceAdd.php");
            }
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'SupprimerSeance':
        try{
            $seance = MSeance::getSeance($_GET['seance']);
            MSeance::rmSeance($seance);

            Main::setFlashMessage("La suppression de la séance a été faite", "valid");
            header("Location:?uc=admin&action=voirInscription");
        }
        catch (Exception $e){
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'TableauPDF':
        try {
            if (isset($_GET['seance'])) {
                $seance = MSeance::getSeance($_GET['seance']);
                $listPlanSeance = MPlanning::getPlanningBySeance($seance);
                $_SESSION['idSeance'] = $_GET['seance'];
                $_SESSION['planning'] = $listPlanSeance = MPlanning::getPlanningBySeance($seance);;

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
            include("views/kiosqueadmin/v_PlanningPDF.php");
        }
        catch (Exception $e){
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

}