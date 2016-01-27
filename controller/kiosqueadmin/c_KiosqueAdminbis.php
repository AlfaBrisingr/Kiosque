<?php
class EspaceAdmin
{

	private $Dir, $spectacle, $artiste, $ecole, $seance, $enseignant, $lieu, $saison, $titre, $admin, $inscription,$planning;
	private $choix;

	public function __construct() {
		if(file_exists(getcwd().'/../../models/m_Ecole.php')) {
			$this->Dir = getcwd().'/../../';
		}
		elseif(file_exists(getcwd().'/../models/m_Ecole.php')) {
			$this->Dir = getcwd().'/../';
		}
		elseif(file_exists(getcwd().'/models/m_Ecole.php')) {
			$this->Dir = getcwd().'/';
		}
		$this->titre = 'Administration Kiosque'; /* Création des objets des classes correspondantes */
		$this->spectacle = new MSpectacle();
		$this->artiste = new MArtiste();
		$this->ecole = new MEcole();
		$this->seance = new MSeance();
		$this->enseignant = new MEnseignant();
		$this->lieu = new MLieu();
		$this->planning = new M();
		$this->saison = new MSaison();
		$this->admin = new Admin();
		$this->inscription = new MInscription();
		$this->choix = new MChoix();
	}
	public function afficheAccueil() {
		$titre = 'Espace Admin - Le Kiosque';
		require_once $this->Dir.'views/kiosqueadmin/v_Accueil.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function afficheAdmin() {
		$titre = 'Identification - Le Kiosque';
		require_once $this->Dir.'views/kiosqueadmin/v_Form.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function afficheGestInscr() {
		$titre = 'Inscriptions - Le Kiosque';
		$listIns = $this->listerInscriptionNonValide();
		$listPlan = $this->planning->getPlannings();
		$listSpec = $this->spectacle->getSpectacles();
		$listSean = $this->seance->getSeances();
		$listChoix = $this->choix->getChoixs();
		$listJauge = $this->planning->getJaugeRestante();
		$row = $listChoix->rowCount();
		if($row == 1) {
			$c = 2;
		}
		if($row == 2) {
			$c = 1;

		}
		if($row == 0) {
			$c = 0;
		}
		if($row == 3) {
			$c = 0;
		}
		if($row > 3) {
			$c = 0;
		}
		require_once $this->Dir.'views/kiosqueadmin/v_Inscription.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function connecter($login, $password) {
		$login = trim($login);
		$bddUser = $this->admin->getUserByName($login);
		if($login == $bddUser['login'] && $login != 'jeunepublic') {
			if(sha1($password) && $bddUser['password']) {
				$_SESSION['login'] = ucfirst($bddUser['login']);
				header("Location:/JP/kiosqueadmin/");
			}
			else
			{
				$_SESSION['error'] = "Erreur lors de la saisie de l'identifiant ou du mot de passe";
				header("Location:/JP/kiosqueadmin");
			}
		}
		else
		{
			$_SESSION['error'] = "Erreur lors de la saisie de l'identifiant ou du mot de passe";
			header("Location:/JP/kiosqueadmin");
		}
	}
	public function listerInscriptionNonValide() {
		$v = $this->inscription->getInscriptions();
		return $v;
	}
	public function validerInscription($idInscription,$idSeance) {
		$test = $this->inscription->getSmInscriptionByIdInscription($idInscription);
		if($test['validationInscription'] == '1') {
			$_SESSION['error'] = 'Cette inscription est déjà planifiée';
		}
		else
		{
			$rest = $this->planning->getJaugeRestanteBySeance($idSeance);
			if($rest['jaugeRestante'] <= 0 && !empty($rest['jaugeRestante'])) {
				$_SESSION['error'] = "La séance $idSeance est complète. Vous ne pouvez pas ajouter d'autres inscriptions.";
			}
			else
			{
				$this->inscription->validerInscription($idInscription);
				$this->planning->addPlanning($idSeance,$idInscription);
				$_SESSION['valid'] = "L'inscription $idInscription a bien été planifiée à la séance $idSeance";
			}
		}
	}
	public function supprimerInscription($idInscription) {
		$q = $this->inscription->rmInscription($idInscription);
		if($q) {
			$_SESSION['valid'] = "L'inscription $idInscription a été supprimée";
		}
		else
		{
			$_SESSION['error'] = "Erreur lors de la suppresion de l'inscription $idInscription";
		}
	}
	public function supprimerSeance($idSeance) {
		$q = $this->seance->rmSeance($idSeance);
		if($q) {
			$_SESSION['valid'] = "La séance $idSeance a été supprimée";
		}
		else
		{
			$_SESSION['error'] = "La séance $idSeance n'existe pas";
		}
	}
	public function afficheAjouterSeance() {
		$titre = "Inscriptions - Le Kiosque";
		$listSpec = $this->spectacle->getSpectacles();
		$listLieu = $this->lieu->getLieux();
		require_once $this->Dir.'views/kiosqueadmin/v_SeanceAdd.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function afficheValiderInscription($idInscription) {
		$titre = "Inscriptions - Le Kiosque";
		$listChoix = $this->choix->getChoixBySub($idInscription);
		require_once $this->Dir.'views/kiosqueadmin/v_InscriptionValidated.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function afficheModifierInscription($idInscription) {
		$titre = "Inscriptions - Le Kiosque";
		$listIns = $this->inscription->getInscriptionByIdInscription($idInscription);
		$c = 0;
		foreach ($listIns as $key) {
			$c = $c + 1;
			if($c == 1){
				$listChoix1 = array(
					"idSpectacle" => $key['idSpectacle'],
					"idInscription" => $key['idInscription'],
					"priorite" => $key['prioriteChoix']
				);
			}
			if($c == 2) {
				$listChoix2 = array(
					"idSpectacle" => $key['idSpectacle'],
					"idInscription" => $key['idInscription'],
					"priorite" => $key['prioriteChoix']
				);
			}
			if($c == 3) {
				$listChoix2 = array(
					"idSpectacle" => $key['idSpectacle'],
					"idInscription" => $key['idInscription'],
					"priorite" => $key['prioriteChoix']
				);
			}
		}
		$listIns = $this->inscription->getInscriptionByIdInscription($idInscription)->fetch();
		$listSpec = $this->spectacle->getSpectacles();
		$listSpec2 = $this->spectacle->getSpectacles();
		$listSpec3 = $this->spectacle->getSpectacles();
		require_once $this->Dir.'views/kiosqueadmin/v_InscriptionEdit.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function supprPlanning($idSeance,$idInscription) {
		$q = $this->planning->rmPlanning($idSeance,$idInscription);
		if($q){
			$this->inscription->annulerInscription($idInscription);
			$_SESSION['valid'] = "L'inscription a été supprimée du planning";
		}
		else
		{
			$_SESSION['error'] = "Impossible de supprimer l'inscription n° $idInscription du planning";
		}
	}
	public function modifierInscription($idInscription,$nbEleve,$nbAdulte,$choix1,$choix2,$choix3,$mailEns) {
		$d = 0;
		$c = 1;
		if($choix1 == $choix2) {
			$choix2 = 'non';
		}
		if($choix2 == $choix3) {
			$choix3 = 'non';
		}
		if($choix3 == $choix1) {
			$choix3 = 'non';
		}
		$q = $this->inscription->rmChoix($idInscription);
		if($q){
			$this->inscription->editInscription($idInscription,$choix1,1,$nbEleve,$nbAdulte,$mailEns);
			if($choix2 != 'non') {
				$this->inscription->editInscription($idInscription,$choix2,2,$nbEleve,$nbAdulte,$mailEns);
			}
			if($choix3 != 'non') {
				$this->inscription->editInscription($idInscription,$choix3,3,$nbEleve,$nbAdulte,$mailEns);
			}
			$this->inscription->editNbEnfant($nbEleve,$idInscription);
			$this->inscription->editNbAdulte($nbAdulte,$idInscription);
			$listIns = $this->choix->getChoixBySub($idInscription);
			$_SESSION['valid'] = "L'inscription a bien été modifiée";
		}
		else
		{
			$_SESSION['error'] = "Erreur lors de la suppresion : l'inscription n'existe pas.";
		}
	}
	public function ajouterSeance($idSpectacle, $idLieu, $Date) {
		if (false == strtotime($Date)) {
			$_SESSION['error'] = "Impossible d'ajouter la séance : Problème de format de date (JJ/MM/AAAA HH:MM:SS)";
		}
		else {
			$d = new DateTime($Date);
		}
		if(isset($d)){
			$q = $this->seance->addSeance($idSpectacle, $idLieu, $d->format('Y-m-d H:i:s'));
			if($q) {
				$_SESSION['valid'] = "La séance a été ajoutée";
			}
			else
			{
				$_SESSION['error'] = "Impossible d'ajouter la séance : Problème de format de date (JJ/MM/AAAA HH:MM:SS)";
			}
		}
		else
		{
			$_SESSION['error'] = "Impossible d'ajouter la séance : Problème de format de date (JJ/MM/AAAA HH:MM:SS)";
		}
	}
	public function supprimerLieu($id) {
		$this->spectacle->rmSpectacleByLocation($id);
		$this->config_lieu->rmConfigLieuByLocation($id);
		$this->lieu->rmLieuById($id);
		header("Location:/JP/kiosqueadmin/?location=list");
	}
	public function modifierLieu($id) {
		$_SESSION['location'] = $this->lieu->getLieuById($id);
		$this->affiche('vue_location_edit');
	}
	public function editLieu($id,$nom,$adr,$cp,$city,$jauge) {
		$this->lieu->editLieu($id,$nom,$adr,$cp,$city,$jauge);
		header("Location:/JP/kiosqueadmin/?location=list");
	}
	public function afficheError($msgError) {
		require_once $this->Dir.'views/kiosqueadmin/v_Erreur.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function exporter() {
		header("Location:/JP/kiosqueadmin/infos/");
	}
}