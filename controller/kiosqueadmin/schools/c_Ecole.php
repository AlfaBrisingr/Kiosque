<?php

if(file_exists(getcwd().'/../../models/m_Spectacle.php')) {
	require_once getcwd().'/../../models/m_Spectacle.php';
	require_once getcwd().'/../../models/m_Seance.php';
	require_once getcwd().'/../../models/m_Saison.php';
	require_once getcwd().'/../../models/m_Enseignant.php';
	require_once getcwd().'/../../models/m_Ecole.php';
	require_once getcwd().'/../../models/m_SaisonSpectacle.php';
}
elseif(file_exists(getcwd().'/../../../models/m_Spectacle.php')) {
	require_once getcwd() . '/../../../models/m_Spectacle.php';
	require_once getcwd() . '/../../../models/m_Saison.php';
	require_once getcwd() . '/../../../models/m_Enseignant.php';
	require_once getcwd() . '/../../../models/m_Ecole.php';
	require_once getcwd() . '/../../../models/m_Seance.php';
	require_once getcwd() . '/../../../models/m_SaisonSpectacle.php';
}
else
{
	require_once getcwd().'/../models/m_Spectacle.php';
	require_once getcwd().'/../models/m_Saison.php';
	require_once getcwd().'/../models/m_Enseignant.php';
	require_once getcwd().'/../models/m_Ecole.php';
	require_once getcwd().'/../models/m_Seance.php';
	require_once getcwd().'/../models/m_SaisonSpectacle.php';
}

class SchoolsSpace {

	private $spectacle, $Dir, $saison, $saison_spectacle, $seance, $ecole, $enseignant;

	public function __construct() {
		$this->spectacle = new MSpectacle();
		$this->saison = new MSaison();
		$this->saison_spectacle = new MSaisonSpectacle();
		$this->seance = new MSeance();
		$this->enseignant = new MEnseignant();
		$this->ecole = new MEcole();
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

	public function afficheGestEcoles() {
		$titre = "Ecoles - Le Kiosque";
		$listEcole = $this->ecole->getEcoles();
		require_once $this->Dir.'views/kiosqueadmin/schools/v_School.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function afficheAjouterEcole() {
		$titre = "Ecoles - Le Kiosque";
		$listEns = $this->enseignant->getEnseignants();
		require_once $this->Dir.'views/kiosqueadmin/schools/v_SchoolAdd.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function ajouterEcole($typeEcole,$nomEcole,$adresseEcole,$cpEcole,$villeEcole,$mailDir,$telDir,$civDir,$nomDir,$prenomDir) {
		if(!is_numeric($nomEcole) && is_numeric($cpEcole) && is_numeric($telDir) && !empty($nomEcole) && !empty($adresseEcole) && !empty($cpEcole) && !empty($villeEcole) && !empty($mailDir) && !empty($telDir) && !empty($nomDir) && !empty($prenomDir)) {
			$ec = $this->ecole->setEcole($typeEcole,$nomEcole,$adresseEcole,$cpEcole,$villeEcole,$mailDir);
			if($ec) {
				$d = $this->enseignant->getEnseignantByName($nomDir);
				if($d) {
					$infoEcole = $this->ecole->getEcoleByName($nomEcole);
					$editDir = $this->ecole->editIdDirecteur($infoEcole['idEcole'],$d['idEns']);
					if($editDir) {
						$_SESSION['valid'] = "L'école a été enregistrée.";
					}
					else
					{
						$_SESSION['error'] = "L'école n'a pas pu être enregistrée.";
					}
				}
				else
				{
					$infoEcole = $this->ecole->getEcoleByName($nomEcole);
					$ens = $this->enseignant->addEnseignant($civDir,$nomDir,$prenomDir,$telDir,"",$infoEcole['idEcole']);
					if($ens) {
						$infoDirecteur = $this->enseignant->getEnseignantByName($nomDir);
						$editDir = $this->ecole->editIdDirecteur($infoEcole['idEcole'],$infoDirecteur['idEns']);
						if($editDir) {
							$_SESSION['valid'] = "L'école a été enregistrée.";
						}
						else
						{
							$tmp = $infoEcole['idEcole'];
							$tmp2 = $infoDirecteur['idEns'];
							$_SESSION['error'] = "$tmp, $tmp2 L'école n'a pas pu être enregistrée 1";
						}
					}
					else
					{
						$_SESSION['error'] = "Le directeur n'a pas pu être enregistré.";
					}
				}
			}
			else
			{
				$_SESSION['error'] = "L'école n'a pas pu être enregistrée.";
			}
		}
		else
		{
			$_SESSION['error'] = "L'écolé n'a pas pu être enregistrée, vérifier les champs entrés.";
		}
	}
	public function afficheConnexion() {
		$titre = "Identification - Le Kiosque";
		require_once $this->Dir.'views/kiosqueadmin/v_Form.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function supprimerEcole($idEcole) {
		$x = $this->ecole->rmEcole($idEcole);
		if($x) {
			$_SESSION['valid'] = "L'école $idEcole a bien été supprimée";
		}
		else
		{
			$_SESSION['error'] = "Impossible de supprimer l'école $idEcole, elle n'existe pas";
		}
	}
	public function afficheErreur($msgErreur) {
		$titre = "Erreur - Le Kiosque";
		require_once $this->Dir.'views/kiosqueadmin/v_Erreur.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function afficheModifierEcole($idEcole) {
		$titre = "Ecoles - Le Kiosque";
		$listEcole = $this->ecole->getEcoleById($idEcole);
		require_once $this->Dir.'views/kiosqueadmin/schools/v_SchoolEdit.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function editEcole($idEcole,$typeEcole,$nomEcole,$adresseEcole,$cpEcole,$villeEcole,$mailDir,$telDir,$civDir,$nomDir,$prenomDir) {
		$d = $this->enseignant->getEnseignantByName($nomDir);
		if($d) {
			$x = $this->ecole->editEcole($idEcole,$d['idEns'],$typeEcole,$nomEcole,$adresseEcole,$cpEcole,$villeEcole,$mailDir,$telDir,$civDir,$nomDir,$prenomDir);
			if($x) {
				$_SESSION['valid'] = "L'école $idEcole a été modifiée.";
			}
			else
			{
				//$_SESSION['error'] = "L'école $idEcole n'a pas pu être modifiée (erreur: 0x0002).";
				$_SESSION['error'] = "<pre> idDir = $idDir ; idDir = ".$d['idEns']." ; idEcole = ".$idEcole." ; typeEcole = ".$typeEcole." ; nomEcole = ".$nomEcole." ; adresseEcole = ".$adresseEcole." ; cpEcole = ".$cpEcole." ; mailDir = ".$mailDir." ; telDir = ".$telDir." ; civDir = ".$civDir." ; nomDir = ".$nomDir." ; prenomDir = ".$prenomDir." ; </pre>";
			}
		}
		else
		{
			$f = $this->enseignant->addEnseignant($civDir,$nomDir,$prenomDir,$telDir,"",$idEcole);
			if($f) {
				$ens = $this->enseignant->getEnseignantByName($nomDir,$prenomDir);
				if($ens) {
					$x = $this->ecole->editEcole($idEcole,$ens['idEns'],$typeEcole,$nomEcole,$adresseEcole,$cpEcole,$villeEcole,$mailDir,$telDir,$civDir,$nomDir,$prenomDir);
					if($x) {
						$_SESSION['valid'] = "L'école $idEcole a été modifiée.";
					}
					else
					{
						$_SESSION['error'] = "L'école $idEcole n'a pas pu être modifiée (erreur: 0x0000).";
					}
				}
				else
				{
					$_SESSION['error'] = "L'école $idEcole n'a pas pu être modifiée (erreur:0x0003).";
				}
			}
			else
			{
				$_SESSION['error'] = "L'école $idEcole n'a pas pu être modifiée (erreur:0x0001).";
			}
		}
	}
}
