<?php

if(file_exists(getcwd().'/../../models/m_Spectacle.php')) {
	require_once getcwd().'/../../models/m_Spectacle.php';
	require_once getcwd().'/../../models/m_Seance.php';
	require_once getcwd().'/../../models/m_Saison.php';
	require_once getcwd().'/../../models/m_SaisonSpectacle.php';
}
elseif(file_exists(getcwd().'/../../../models/m_Spectacle.php')) {
	require_once getcwd() . '/../../../models/m_Spectacle.php';
	require_once getcwd() . '/../../../models/m_Saison.php';
	require_once getcwd() . '/../../../models/m_Seance.php';
	require_once getcwd() . '/../../../models/m_SaisonSpectacle.php';
}
else
{
	require_once getcwd().'/../models/m_Spectacle.php';
	require_once getcwd().'/../models/m_Saison.php';
	require_once getcwd().'/../models/m_Seance.php';
	require_once getcwd().'/../models/m_SaisonSpectacle.php';
}

class ShowsSpace {

	private $spectacle, $Dir, $saison, $saison_spectacle, $seance;

	public function __construct() {
		$this->spectacle = new MSpectacle();
		$this->saison = new MSaison();
		$this->saison_spectacle = new MSaisonSpectacle();
		$this->seance = new MSeance();
		if(file_exists(getcwd().'/../../models/m_Spectacle.php')) {
			$this->Dir = getcwd().'/../../';
		}
		elseif(file_exists(getcwd().'/../../../models/m_Spectacle.php')) {
			$this->Dir = getcwd().'/../../../';
		}
		else
		{
			$this->Dir = getcwd().'/../';
		}

	}

	public function afficheGestSpectacle() {
		$titre = "Spectacles - Le Kiosque";
		$listSpec = $this->spectacle->getSpectaclesSaisonCourante();
		$actuel = $this->saison->getSaisonCourante();
		require_once $this->Dir.'views/kiosqueadmin/shows/v_Spectacle.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function afficheNouveauSpectacle() {
		$titre = "Spectacles - Le Kiosque";
		$listSaison = $this->saison->getSaisons();
		$actuel = $this->saison->getSaisonCourante();
		require_once $this->Dir.'views/kiosqueadmin/shows/v_SpectacleAdd.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function afficheConnexion() {
		$titre = "Identification - Le Kiosque";
		require_once $this->Dir.'views/kiosqueadmin/v_Form.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function nouveauSpectacle($idSaison,$nomSpectacle,$nbPlaceSpectacle,$typeClasse) {
		$s = $this->spectacle->addSpectacle($nomSpectacle,$nbPlaceSpectacle,$typeClasse);
		if($s && !is_numeric($nomSpectacle) && is_numeric($nbPlaceSpectacle) && !is_numeric($typeClasse) && (!empty($typeClasse) && !empty($nomSpectacle) && !empty($nbPlaceSpectacle) && !empty($idSaison) && !empty($typeClasse))) {
			$spec = $this->spectacle->getSpectacleByName($nomSpectacle);
			if($spec) {
				$saison = $this->saison->getSaisonById($idSaison);
				$q = $this->saison_spectacle->setSaisonSpectacle($idSaison,$spec['idSpectacle']);
				if($q) {
					$_SESSION['valid'] = "Le spectacle a bien été ajouté à la saison ".$saison['nomSaison'];
				}
				else
				{
					$_SESSION['error'] = "Impossible d'ajouter le spectacle (mauvais formats entrés)";
				}
			}
			else
			{
				$_SESSION['error'] = "Impossible d'ajouter le spectacle (mauvais formats entrés)";
			}
		}
		else
		{
			$_SESSION['error'] = "Impossible d'ajouter le spectacle (mauvais formats entrés ou champs vides)";
		}
	}
	public function supprimerSpectacle($idSpectacle) {
		$ss = $this->saison_spectacle->getSaisonDuSpectacle($idSpectacle);
		$x = $this->seance->rmSeancesSpec($idSpectacle);
		if($x) {
			$q = $this->saison_spectacle->rmSaisonSpectacle($ss['idSaison'],$idSpectacle);
			if($q) {
				$t = $this->spectacle->rmSpectacleById($idSpectacle);
				if($t) {
					$_SESSION['valid'] = "Le spectacle $idSpectacle a bien été supprimé";
				}
				else
				{
					$_SESSION['error'] = "Impossible de supprimer le spectacle $idSpectacle, il n'existe pas";
				}
			}
			else
			{
				$_SESSION['error'] = "Impossible de supprimer le spectacle $idSpectacle, il n'existe pas";
			}
		}
		else
		{
			$_SESSION['error'] = "Impossible de supprimer le spectacle $idSpectacle, il n'existe pas";
		}
	}
	public function afficheEditSaison() {
		$titre = "Spectacles - Le Kiosque";
		$actuel = $this->saison->getSaisonCourante();
		$listSaison = $this->saison->getSaisonNonCourante();
		require_once $this->Dir.'views/kiosqueadmin/shows/v_SaisonEdit.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function editSaisonCourante($idSaisonAncien,$idSaisonNouveau) {
		$d = $this->saison->setSaisonCourante($idSaisonAncien,$idSaisonNouveau);
		if($d) {
			$r = $this->saison->getSaisonCourante();
			$_SESSION['valid'] = "La nouvelle saison est désormais ".$r['nomSaison'];
		}
		else
		{
			$_SESSION['error'] = "Une erreur s'est produite lors du changement de saison";
		}
	}
	public function editSpectacle($idSpectacle,$nomSpectacle,$nbPlaceSpectacle,$idSaison,$typeClasse) {
		$d = $this->spectacle->editSpectacle($idSpectacle,$nomSpectacle,$nbPlaceSpectacle,$idSaison,$typeClasse);
		if($d && !is_numeric($nomSpectacle) && is_numeric($nbPlaceSpectacle) && (!empty($idSpectacle) && !empty($nomSpectacle) && !empty($nbPlaceSpectacle) && !empty($idSaison) && !empty($typeClasse))) {
			$_SESSION['valid'] = "Le spectacle $idSpectacle a bien été modifié";
		}
		else
		{
			$_SESSION['error'] = "Une erreur s'est produite lors de la modification du spectacle $idSpectacle, vérifiez les formats entrés";
		}
	}
	public function afficheErreur($msgErreur) {
		$titre = "Erreur - Le Kiosque";
		require_once $this->Dir.'views/kiosqueadmin/v_Erreur.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function afficheEditSpectacle($idSpectacle) {
		$titre = "Spectacles - Le Kiosque";
		$listSaison = $this->saison->getSaisons();
		$listSpec = $this->spectacle->getSpectacleById($idSpectacle);
		require_once $this->Dir.'views/kiosqueadmin/shows/v_SpectacleEdit.php';
		require_once $this->Dir.'views/gabarit.php';
	}
}
