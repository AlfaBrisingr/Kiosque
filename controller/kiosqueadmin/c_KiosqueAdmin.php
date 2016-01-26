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
						header("Location:?uc=admin&action=voirForm");
						//include("views/kiosqueadmin/v_AccueilAdmin.php");
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
		$listIns = MInscription::getInscriptions();
		$listPlan = MPlanning::getPlannings();
		$listSpec = MSpectacle::getSpectacles();
		$listSean = MSeance::getSeances();
		$listChoix = MChoix::getChoixs();
		$listJauge = MPlanning::getJaugeRestante();
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

	case 'voirPlanif':
		$inscription = MInscription::getInscriptionByIdInscription($_GET['ins']);
		$listChoix = MChoix::getChoixBySub($inscription);
		include("views/kiosqueadmin/v_InscriptionValidated.php");
		break;

	case 'validerInscription':
		try {
			$inscription = MInscription::getInscriptionByIdInscription($_GET['ins']);
			if (isset($_POST['seance'])) {
				$seance = MSeance::getSeance($_POST['seance']);
				$planning = new Planning($seance, $inscription);
				MPlanning::addUnPlanning($planning);
				MInscription::validerInscription($inscription);

				Main::setFlashMessage("La panification de l'inscription à été faite", "valid");
				header("Location:?uc=admin&action=voirInscription");
			} else {

				$listChoix = MChoix::getChoixByIns($_GET['ins']);
				include("views/kiosqueadmin/v_InscriptionValidated.php");
			}
		}
		catch (Exception $e){
			Main::setFlashMessage($e->getMessage(), "error");
		}
		break;
}