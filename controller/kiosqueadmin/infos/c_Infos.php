<?php

if(file_exists(getcwd().'/../../models/m_Spectacle.php')) {
	require_once getcwd().'/../../models/m_Spectacle.php';
	require_once getcwd().'/../../models/m_Seance.php';
	require_once getcwd().'/../../models/m_Lieu.php';
	require_once getcwd().'/../../models/m_Saison.php';
	require_once getcwd().'/../../models/m_SaisonSpectacle.php';
}
elseif(file_exists(getcwd().'/../../../models/m_Spectacle.php')) {
	require_once getcwd() . '/../../../models/m_Spectacle.php';
	require_once getcwd() . '/../../../models/m_Saison.php';
	require_once getcwd() . '/../../../models/m_Lieu.php';
	require_once getcwd() . '/../../../models/m_Seance.php';
	require_once getcwd() . '/../../../models/m_SaisonSpectacle.php';
}
else
{
	require_once getcwd().'/../models/m_Spectacle.php';
	require_once getcwd().'/../models/m_Saison.php';
	require_once getcwd().'/../models/m_Seance.php';
	require_once getcwd().'/../models/m_Lieu.php';
	require_once getcwd().'/../models/m_SaisonSpectacle.php';
}

class InfosSpace {

	private $lieutacle, $Dir, $saison, $saison_spectacle, $seance, $lieu;

	public function __construct() {
		$this->spectacle = new MLieu();
		$this->saison = new MSaison();
		$this->saison_spectacle = new MSaisonSpectacle();
		$this->seance = new MSeance();
		$this->lieu = new MLieu();
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

	public function afficheInfos() {
		$titre = "Informations - Le Kiosque";
		require_once $this->Dir.'views/kiosqueadmin/infos/v_Infos.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function afficheConnexion() {
		$titre = "Identification - Le Kiosque";
		require_once $this->Dir.'views/kiosqueadmin/v_Form.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function afficheErreur($msgErreur) {
		$titre = "Erreur - Le Kiosque";
		require_once $this->Dir.'views/kiosqueadmin/v_Erreur.php';
		require_once $this->Dir.'views/gabarit.php';
	}
}
