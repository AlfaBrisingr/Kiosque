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

class LocationsSpace {

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

	public function afficheGestLieu() {
		$titre = "Lieux - Le Kiosque";
		$listLieu = $this->lieu->getLieux();
		require_once $this->Dir.'views/kiosqueadmin/locations/v_Lieu.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function afficheNouveauLieu() {
		$titre = "Lieux - Le Kiosque";
		require_once $this->Dir.'views/kiosqueadmin/locations/v_LieuAdd.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function afficheConnexion() {
		$titre = "Identification - Le Kiosque";
		require_once $this->Dir.'views/kiosqueadmin/v_Form.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function nouveauLieu($nomLieu,$adrLieu,$cpLieu,$villeLieu) {
		$s = $this->lieu->addLieu($nomLieu,$adrLieu,$cpLieu,$villeLieu);
		if($s && !is_numeric($nomLieu) && is_numeric($cpLieu) && strlen($cpLieu) == '5' && !is_numeric($villeLieu) && (!empty($nomLieu) && !empty($adrLieu) && !empty($cpLieu) && !empty($villeLieu))) {
			$_SESSION['valid'] = "Le lieu a bien été ajouté";
		}
		else
		{
			$_SESSION['error'] = "Impossible d'ajouter le lieu (mauvais formats entrés ou champs vides)";
		}
	}
	public function supprimerLieu($idLieu) {
		$x = $this->lieu->rmSeancesLieu($idLieu);
		if($x) {
			$t = $this->lieu->rmLieuById($idLieu);
			if($t) {
				$_SESSION['valid'] = "Le lieu $idLieu a bien été supprimé";
			}
			else
			{
				$_SESSION['error'] = "Impossible de supprimer le lieu $idLieu, il n'existe pas";
			}
		}
		else
		{
			$_SESSION['error'] = "Impossible de supprimer le lieu $idLieu, il n'existe pas";
		}
	}
	public function editLieu($idLieu,$nomLieu,$adrLieu,$cpLieu,$villeLieu) {
		$d = $this->lieu->editLieu($idLieu,$nomLieu,$adrLieu,$cpLieu,$villeLieu);
		if($d && !is_numeric($nomLieu) && is_numeric($cpLieu) && strlen($cpLieu) == '5' && (!empty($idLieu) && !empty($nomLieu) && !empty($cpLieu) && !empty($villeLieu))) {
			$_SESSION['valid'] = "Le lieu $idLieu a bien été modifié";
		}
		else
		{
			$_SESSION['error'] = "Une erreur s'est produite lors de la modification du lieu $idLieu, vérifiez les formats entrés";
		}
	}
	public function afficheErreur($msgErreur) {
		$titre = "Erreur - Le Kiosque";
		require_once $this->Dir.'views/kiosqueadmin/v_Erreur.php';
		require_once $this->Dir.'views/gabarit.php';
	}
	public function afficheEditLieu($idLieu) {
		$titre = "Lieux - Le Kiosque";
		$listLieu = $this->lieu->getLieuById($idLieu);
		require_once $this->Dir.'views/kiosqueadmin/locations/v_LieuEdit.php';
		require_once $this->Dir.'views/gabarit.php';
	}
}
