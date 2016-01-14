<?php

function clean_display_phone($nbr, $sep=false)
{
    $nbr = preg_replace('[^0-9]', '', $nbr);

    if(strlen($nbr) != 10)
        return false;
    else
    {
        if($sep)
        {
            for($i=0;$i<5;$i++)
                $nbr_array[] = substr($nbr, $i*2, 2);
            $nbr = implode($sep, $nbr_array);

            return $nbr;
        }
        else
            return $nbr;
    }
}

if(file_exists(getcwd().'/../../models/m_Ecole.php')) {
    require_once getcwd() . '/../../models/m_Ecole.php';
    require_once getcwd() . '/../../models/m_Admin.php';
    require_once getcwd() . '/../../models/m_Enseignant.php';
    require_once getcwd() . '/../../models/m_Spectacle.php';
    require_once getcwd() . '/../../models/m_Inscription.php';
    require_once getcwd() . '/../../models/m_Choix.php';
    require_once getcwd() . '/../../models/m_Seance.php';
    require_once getcwd() . '/../../models/m_Saison.php';
}
elseif(file_exists(getcwd().'/../models/m_Ecole.php')) {
    require_once getcwd().'/../models/m_Ecole.php';
    require_once getcwd().'/../models/m_Admin.php';
    require_once getcwd().'/../models/m_Enseignant.php';
    require_once getcwd().'/../models/m_Spectacle.php';
    require_once getcwd().'/../models/m_Inscription.php';
    require_once getcwd().'/../models/m_Choix.php';
    require_once getcwd().'/../models/m_Seance.php';
    require_once getcwd().'/../models/m_Saison.php';
}
elseif(file_exists(getcwd().'/models/m_Ecole.php')) {
    require_once getcwd().'/models/m_Ecole.php';
    require_once getcwd().'/models/m_Admin.php';
    require_once getcwd().'/models/m_Enseignant.php';
    require_once getcwd().'/models/m_Spectacle.php';
    require_once getcwd().'/models/m_Inscription.php';
    require_once getcwd().'/models/m_Choix.php';
    require_once getcwd().'/models/m_Seance.php';
    require_once getcwd().'/models/m_Saison.php';
}
elseif(file_exists(getcwd().'/../../../models/m_Ecole.php')) {
    require_once getcwd().'/../../../models/m_Ecole.php';
    require_once getcwd().'/../../../models/m_Admin.php';
    require_once getcwd().'/../../../models/m_Enseignant.php';
    require_once getcwd().'/../../../models/m_Spectacle.php';
    require_once getcwd().'/../../../models/m_Inscription.php';
    require_once getcwd().'/../../../models/m_Choix.php';
    require_once getcwd().'/../../../models/m_Seance.php';
    require_once getcwd().'/../../../models/m_Saison.php';
}

class Demande
{
    private $Dir,$inscription,$spectacle,$ecole,$choix,$enseignant,$admin, $saison, $seance;

    public function __construct() {
        if(file_exists(getcwd().'/../../models/m_Ecole.php')) {
            $this->Dir = getcwd().'/../../';
        }
        if(file_exists(getcwd().'/../models/m_Ecole.php')) {
            $this->Dir = getcwd().'/../';
        }
        if(file_exists(getcwd().'/models/m_Ecole.php')) {
            $this->Dir = getcwd().'/';
        }
        if(file_exists(getcwd().'/../../../models/m_Ecole.php')) {
            $this->Dir = getcwd().'/../../../';
        }
        $this->inscription = new MInscription();
        $this->spectacle = new MSpectacle();
        $this->ecole = new MEcole();
        $this->choix = new MChoix();
        $this->admin = new Admin();
        $this->saison = new MSaison();
        $this->seance = new MSeance();
        $this->enseignant = new MEnseignant();
    }

    public function affiche1st($choix){
        $de = new DateTime("2015-09-01 00:00:00");
        $de = $de->getTimestamp();
        $daate = new DateTime();
        $daate = $daate->getTimestamp();
        $datenew = $daate-$de;
        if($datenew <= 0) {
            $titre = "Prochainement...";
            require_once $this->Dir.'views/inscriptionEcole/block/v_Block.php';
            require_once $this->Dir.'views/gabarit.php';
        }
        else
        {
            $titre = "1ère Etape - Jeune Public";
            $ecole = $this->ecole->getEcoleById($choix);
            $ens = $this->enseignant->getEnseignantById($ecole['idDirecteur']);
            $_SESSION['type'] = $ecole['typeEcole'];
            if($_SESSION['type'] == '1') {
                $_SESSION['typeEcole'] = 'Ecole Publique';
            }
            else if($_SESSION['type'] == '2')
            {
                $_SESSION['typeEcole'] = 'Ecole Privée';
            }
            $_SESSION['nomEcole'] = $ecole['nomEcole'];
            $_SESSION['idEns'] = $ens['idEns'];
            $_SESSION['addr1'] = $ecole['adresseEcole'];
            $_SESSION['addr2'] = $ecole['adresse2Ecole'];
            $_SESSION['cp'] = $ecole['cpEcole'];
            $_SESSION['ville'] = $ecole['villeEcole'];
            $_SESSION['idDir'] = $ens['idEns'];
            $_SESSION['mailDir'] = $ecole['mail_dir'];
            $_SESSION['nomDir'] = $ens['nomEns'];
            $_SESSION['prenomDir'] = $ens['prenomEns'];
            $_SESSION['telDir'] = clean_display_phone($ens['telEns'], '.');
            $_SESSION['civDir'] = $ens['civEns'];
            require_once $this->Dir.'views/inscriptionEcole/v_Etape1.php';
            require_once $this->Dir.'views/gabarit.php';
        }
    }
    public function affiche2nd($facture,$divers) {
        $de = new DateTime("2015-09-01 00:00:00");
        $de = $de->getTimestamp();
        $daate = new DateTime();
        $daate = $daate->getTimestamp();
        $datenew = $daate-$de;
        if($datenew <= 0) {
            $titre = "Prochainement...";
            require_once $this->Dir.'views/inscriptionEcole/block/v_Block.php';
            require_once $this->Dir.'views/gabarit.php';
        }
        else
        {
            $titre = '2ème Etape - Jeune Public';
            $facture = addslashes($facture);
            $divers = addslashes($divers);
            $_SESSION['form'] = 'yes';
            $_SESSION['facture'] = $facture;
            $_SESSION['divers1'] = $divers;
            require_once $this->Dir.'views/inscriptionEcole/v_Etape2.php';
            require_once $this->Dir.'views/gabarit.php';
        }
    }
    public function retour($id) {
        $de = new DateTime("2015-09-01 00:00:00");
        $de = $de->getTimestamp();
        $daate = new DateTime();
        $daate = $daate->getTimestamp();
        $datenew = $daate-$de;
        if($datenew <= 0) {
            $titre = "Prochainement...";
            require_once $this->Dir.'views/inscriptionEcole/block/v_Block.php';
            require_once $this->Dir.'views/gabarit.php';
        }
        else
        {
            switch ($id) {
                case 1:
                    if(!(isset($_SESSION['idDir']))){
                        $this->retour(8);
                    }
                    else
                    {
                        $this->affiche1st($_SESSION['idDir']);
                    }
                    break;
                case 2:
                    $titre = '2ème Etape - Jeune Public';
                    require_once $this->Dir.'views/inscriptionEcole/v_Etape2.php';
                    require_once $this->Dir.'views/gabarit.php';
                    break;
                case 3:
                    $titre = '3ème Etape - Jeune Public';
                    $listSean = $this->seance->getSeances();
                    $listSpec = $this->spectacle->getSpectaclesSaisonCourante();
                    $listSp = $this->spectacle->getSpectaclesSaisonCourante();
                    $tabs = [];
                    $tmp = [];
                    foreach ($listSpec as $w) {
                        foreach ($listSp as $f){
                            $q = $this->seance->getSeancesBySpec($f['idSpectacle'])->fetch();
                            $c = $this->seance->getSeancesBySpec($f['idSpectacle']);
                            $temp = array('idSpectacle' => $q['idSpectacle'], 'nomSpectacle' => $q['nomSpectacle'], 'typeClasse' => $q['typeClasse']);
                            while ($s = $c->fetch()) {
                                array_push($temp, $s['date_heure']);
                            }
                            array_push($temp, $tmp);
                            array_push($tabs, $temp);
                        }
                    }
                    require_once $this->Dir.'views/inscriptionEcole/v_Etape3.php';
                    require_once $this->Dir.'views/gabarit.php';
                    break;
                case 4:
                    $titre = '4ème Etape - Jeune Public';
                    $listSean = $this->seance->getSeances();
                    $listSpec = $this->spectacle->getSpectaclesSaisonCourante();
                    $listSp = $this->spectacle->getSpectaclesSaisonCourante();
                    $tabs = [];
                    $tmp = [];
                    foreach ($listSpec as $w) {
                        foreach ($listSp as $f){
                            $q = $this->seance->getSeancesBySpec($f['idSpectacle'])->fetch();
                            $c = $this->seance->getSeancesBySpec($f['idSpectacle']);
                            $temp = array('idSpectacle' => $q['idSpectacle'], 'nomSpectacle' => $q['nomSpectacle'], 'typeClasse' => $q['typeClasse']);
                            while ($s = $c->fetch()) {
                                array_push($temp, $s['date_heure']);
                            }
                            array_push($temp, $tmp);
                            array_push($tabs, $temp);
                        }
                    }
                    require_once $this->Dir.'views/inscriptionEcole/v_Etape4.php';
                    require_once $this->Dir.'views/gabarit.php';
                    break;
                case 5:
                    $titre = '5ème Etape - Jeune Public';
                    $listSean = $this->seance->getSeances();
                    $listSpec = $this->spectacle->getSpectaclesSaisonCourante();
                    $listSp = $this->spectacle->getSpectaclesSaisonCourante();
                    $tabs = [];
                    $tmp = [];
                    foreach ($listSpec as $w) {
                        foreach ($listSp as $f){
                            $q = $this->seance->getSeancesBySpec($f['idSpectacle'])->fetch();
                            $c = $this->seance->getSeancesBySpec($f['idSpectacle']);
                            $temp = array('idSpectacle' => $q['idSpectacle'], 'nomSpectacle' => $q['nomSpectacle'], 'typeClasse' => $q['typeClasse']);
                            while ($s = $c->fetch()) {
                                array_push($temp, $s['date_heure']);
                            }
                            array_push($temp, $tmp);
                            array_push($tabs, $temp);
                        }
                    }
                    require_once $this->Dir.'views/inscriptionEcole/v_Etape5.php';
                    require_once $this->Dir.'views/gabarit.php';
                    break;
                default:
                    $this->afficheAccueil();
                    break;
            }
        }
    }
    public function affiche3rd($civEns,$nomEns,$prenEns,$telEns,$mailEns,$classe,$nbrEleve, $nbrAccom) {
        $de = new DateTime("2015-09-01 00:00:00");
        $de = $de->getTimestamp();
        $daate = new DateTime();
        $daate = $daate->getTimestamp();
        $datenew = $daate-$de;
        if($datenew <= 0) {
            $titre = "Prochainement...";
            require_once $this->Dir.'views/inscriptionEcole/block/v_Block.php';
            require_once $this->Dir.'views/gabarit.php';
        }
        else
        {
            $titre = '3ème Etape - Jeune Public';
            unset($_SESSION['form']);
            $listSean = $this->seance->getSeances();
            $listSpec = $this->spectacle->getSpectaclesSaisonCourante();
            $listSp = $this->spectacle->getSpectaclesSaisonCourante();
            $tabs = [];
            $tmp = [];
            foreach ($listSpec as $w) {
                foreach ($listSp as $f){
                    $q = $this->seance->getSeancesBySpec($f['idSpectacle'])->fetch();
                    $c = $this->seance->getSeancesBySpec($f['idSpectacle']);
                    $temp = array('idSpectacle' => $q['idSpectacle'], 'nomSpectacle' => $q['nomSpectacle'], 'typeClasse' => $q['typeClasse']);
                    while ($s = $c->fetch()) {
                        array_push($temp, $s['date_heure']);
                    }
                    array_push($temp, $tmp);
                    array_push($tabs, $temp);
                }
            }
            $mois = array('1' => 'janvier','2' => 'février','3' => 'mars', '4' => 'avril', '5' => 'mai', '6' => 'juin', '7' => 'juillet', '8' => 'août', '9' => 'septembre', '10' => 'octobre', '11' => 'novembre', '12' => 'décembre');
            $jour = array('1' => 'Lundi','2' => 'Mardi','3' => 'Mercredi', '4' => 'Jeudi', '5' => 'Vendredi', '6' => 'Samedi', '7' => 'Dimanche');
            $_SESSION['form'] = 'yes';
            $civEns = addslashes($civEns);
            $nomEns = addslashes($nomEns);
            $prenEns = addslashes($prenEns);
            $telEns = addslashes($telEns);
            $nbrEleve = addslashes($nbrEleve);
            $nbrAccom = addslashes($nbrAccom);
            $_SESSION['form'] = 'yes';
            $_SESSION['civEns'] = $civEns;
            $_SESSION['nomEns'] = $nomEns;
            $_SESSION['prenomEns'] = $prenEns;
            $_SESSION['telEns'] = $telEns;
            $_SESSION['mailEns'] = $mailEns;
            $_SESSION['classe'] = $classe;
            $_SESSION['nbrEleve'] = $nbrEleve;
            $_SESSION['nbrAccom'] = $nbrAccom;
            require_once $this->Dir.'views/inscriptionEcole/v_Etape3.php';
            require_once $this->Dir.'views/gabarit.php';
        }
    }
    public function affiche4th($choix1,$impo1) {
        $de = new DateTime("2015-09-01 00:00:00");
        $de = $de->getTimestamp();
        $daate = new DateTime();
        $daate = $daate->getTimestamp();
        $datenew = $daate-$de;
        if($datenew <= 0) {
            $titre = "Prochainement...";
            require_once $this->Dir.'views/inscriptionEcole/block/v_Block.php';
            require_once $this->Dir.'views/gabarit.php';
        }
        else
        {
            $titre = '4ème Etape - Jeune Public';
            $choix1 = addslashes($choix1);
            $impo1 = addslashes($impo1);
            $listSean = $this->seance->getSeances();
            $listSpec = $this->spectacle->getSpectaclesSaisonCourante();
            $listSp = $this->spectacle->getSpectaclesSaisonCourante();
            $tabs = [];
            $tmp = [];
            foreach ($listSpec as $w) {
                foreach ($listSp as $f){
                    $q = $this->seance->getSeancesBySpec($f['idSpectacle'])->fetch();
                    $c = $this->seance->getSeancesBySpec($f['idSpectacle']);
                    $temp = array('idSpectacle' => $q['idSpectacle'], 'nomSpectacle' => $q['nomSpectacle'], 'typeClasse' => $q['typeClasse']);
                    while ($s = $c->fetch()) {
                        array_push($temp, $s['date_heure']);
                    }
                    array_push($temp, $tmp);
                    array_push($tabs, $temp);
                }
            }
            $_SESSION['choix1'] = $choix1;
            $_SESSION['impo1'] = $impo1;
            unset($_SESSION['form']);
            $_SESSION['form'] = 'yes';
            require_once $this->Dir.'views/inscriptionEcole/v_Etape4.php';
            require_once $this->Dir.'views/gabarit.php';
        }
    }
    public function affiche5th($choix2,$impo2) {
        $de = new DateTime("2015-09-01 00:00:00");
        $de = $de->getTimestamp();
        $daate = new DateTime();
        $daate = $daate->getTimestamp();
        $datenew = $daate-$de;
        if($datenew <= 0) {
            $titre = "Prochainement...";
            require_once $this->Dir.'views/inscriptionEcole/block/v_Block.php';
            require_once $this->Dir.'views/gabarit.php';
        }
        else
        {
            $titre = '5ème Etape - Jeune Public';
            $choix2 = addslashes($choix2);
            $impo2 = addslashes($impo2);
            $_SESSION['choix2'] = $choix2;
            $_SESSION['impo2'] = $impo2;
            $listSean = $this->seance->getSeances();
            $listSpec = $this->spectacle->getSpectaclesSaisonCourante();
            $listSp = $this->spectacle->getSpectaclesSaisonCourante();
            $tabs = [];
            $tmp = [];
            foreach ($listSpec as $w) {
                foreach ($listSp as $f){
                    $q = $this->seance->getSeancesBySpec($f['idSpectacle'])->fetch();
                    $c = $this->seance->getSeancesBySpec($f['idSpectacle']);
                    $temp = array('idSpectacle' => $q['idSpectacle'], 'nomSpectacle' => $q['nomSpectacle'], 'typeClasse' => $q['typeClasse']);
                    while ($s = $c->fetch()) {
                        array_push($temp, $s['date_heure']);
                    }
                    array_push($temp, $tmp);
                    array_push($tabs, $temp);
                }
            }
            unset($_SESSION['form']);
            $_SESSION['form'] = 'yes';
            if($_SESSION['choix2'] == $_SESSION['choix1']) {
                $_SESSION['choix2'] = 'non';
            }
            if($_SESSION['choix2'] == 'non') {
                $_SESSION['choix3'] = 'non';
                $_SESSION['impo3'] = null;
                $this->afficheRecap();
            }
            else
            {
                require_once $this->Dir.'views/inscriptionEcole/v_Etape5.php';
                require_once $this->Dir.'views/gabarit.php';
            }
        }
    }
    public function afficheRecap() {
        $de = new DateTime("2015-09-01 00:00:00");
        $de = $de->getTimestamp();
        $daate = new DateTime();
        $daate = $daate->getTimestamp();
        $datenew = $daate-$de;
        if($datenew <= 0) {
            $titre = "Prochainement...";
            require_once $this->Dir.'views/inscriptionEcole/block/v_Block.php';
            require_once $this->Dir.'views/gabarit.php';
        }
        else
        {
            if(!isset($_POST['Choix3'])){
                $_SESSION['choix3'] = 'non';
                $_SESSION['impo3'] = null;
            }
            else
            {
                $choix3 = addslashes($_POST['Choix3']);
                $impo3 = addslashes($_POST['impo3']);
                $_SESSION['choix3'] = $choix3;
                $_SESSION['impo3'] = $impo3;
            }
            if($_SESSION['choix3'] == $_SESSION['choix1']) {
                $_SESSION['choix3'] = 'non';
            }
            if($_SESSION['choix3'] == $_SESSION['choix2']) {
                $_SESSION['choix3'] = 'non';
            }
            if($_SESSION['choix2'] == $_SESSION['choix1']) {
                $_SESSION['choix2'] = 'non';
            }
            $titre = "Récapitulatif de votre demande";
            $Ent = array($_SESSION['typeEcole'],$_SESSION['nomEcole'],'Adresse 1' => $_SESSION['addr1'],$_SESSION['addr2'],
                $_SESSION['cp'],$_SESSION['ville'],$_SESSION['telDir'],$_SESSION['mailDir']
            );
            $Resp = array (
                'Civilité' => $_SESSION['civDir'],
                'Nom' => $_SESSION['nomDir'],
                'Prénom' => $_SESSION['prenomDir']);
            $Divers1 = array (
                'Facture libellée à' => $_SESSION['facture'],
                'Infos diverses sur l\'Etablissement' => $_SESSION['divers1']
            );
            $Ens1 = array ($_SESSION['civEns'],$_SESSION['nomEns'], ucfirst(strtolower($_SESSION['prenomEns'])));
            $Ens3 = array($_SESSION['telEns'],$_SESSION['mailEns']);
            $Ens2 = array (
                'Classe' => $_SESSION['classe'],
                'Elèves' => $_SESSION['nbrEleve'],
                'Accompagnateurs' => $_SESSION['nbrAccom'],
            );
            $Choix1 = array (
                'Choisi' => $_SESSION['choix1'],
                'Impossibilités' => $_SESSION['impo1']
            );
            $Choix2 = array (
                'Choisi' => $_SESSION['choix2'],
                'Impossibilités' => $_SESSION['impo2']
            );
            $Choix3 = array (
                'Choisi' => $_SESSION['choix3'],
                'Impossibilités' => $_SESSION['impo3']
            );
            require_once $this->Dir.'views/inscriptionEcole/v_Recap.php';
            require_once $this->Dir.'views/gabarit.php';
        }
    }
    public function afficheFin() {
        $de = new DateTime("2015-09-01 00:00:00");
        $de = $de->getTimestamp();
        $daate = new DateTime();
        $daate = $daate->getTimestamp();
        $datenew = $daate-$de;
        if($datenew <= 0) {
            $titre = "Prochainement...";
            require_once $this->Dir.'views/inscriptionEcole/block/v_Block.php';
            require_once $this->Dir.'views/gabarit.php';
        }
        else
        {

            $titre = 'MInscription terminée';
            $nomEcole = $this->ecole->getEcoleByName(addslashes($_SESSION['nomEcole']));
            if(!($this->enseignant->getEnseignantByName(addslashes($_SESSION['nomEns']),addslashes($_SESSION['prenomEns'])))){
                $this->enseignant->addEnseignant($_SESSION['civEns'],strtoupper(addslashes($_SESSION['nomEns'])),ucfirst(strtolower(addslashes($_SESSION['prenomEns']))),$_SESSION['telEns'],$_SESSION['mailEns'],$nomEcole['idEcole']);
            }
            $nomEnseignant = $this->enseignant->getEnseignantByName($_SESSION['nomEns'],$_SESSION['prenomEns']);
            $divers = addslashes($_SESSION['divers1']);
            if(empty($_SESSION['impo1']) && empty($_SESSION['impo2']) && empty($_SESSION['impo3'])){
                $impo = '<strong><em>Vide</em></strong>';
            }
            else
            {
                if(empty($_SESSION['impo1'])) {
                    $_SESSION['impo1'] = '<strong><em>Vide</em></strong>';
                }
                if(empty($_SESSION['impo2'])) {
                    $_SESSION['impo2'] = '<strong><em>Vide</em></strong>';
                }
                if(empty($_SESSION['impo3'])) {
                    $_SESSION['impo3'] = '<strong><em>Vide</em></strong>';
                }
                $impo = '1 : '.$_SESSION['impo1'].'<br> 2 : '.$_SESSION['impo2'].'<br> 3 : '.$_SESSION['impo3'];
            }
            $this->inscription->addInscription($nomEnseignant['idEns'],$divers,addslashes($impo),date('Y-m-d H:i:s'),$_SESSION['nbrEleve'],$_SESSION['nbrAccom']);
            $nomSpectacle = $this->spectacle->getSpectacleByName($_SESSION['choix1']);
            $nomInscription = $this->inscription->getInscriptionByIdEnseignantNonJoin($nomEnseignant['idEns']);
            $c = 1;
            $passe = false;
            $envoimail = false;
            foreach ($nomInscription as $key) {
                if(!$this->choix->addChoix($nomSpectacle['idSpectacle'],$key['idInscription'],1)) {
                    $passe = false;
                    $envoimail = false;
                    $_SESSION['error'] = "<h1>La demande d'inscription a échouée, erreur inconnue.</h1>";
                }
                else {
                    $this->choix->addChoix($nomSpectacle['idSpectacle'],$key['idInscription'],1);
                    $passe = true;
                    $envoimail = true;
                    unset($_SESSION['error']);
                }
                if($_SESSION['choix2'] != 'non') {
                    $nomSpectacle = $this->spectacle->getSpectacleByName($_SESSION['choix2']);
                    $this->choix->addChoix($nomSpectacle['idSpectacle'],$key['idInscription'],2);
                    if($_SESSION['choix3'] != 'non') {
                        $nomSpectacle = $this->spectacle->getSpectacleByName($_SESSION['choix3']);
                        $this->choix->addChoix($nomSpectacle['idSpectacle'],$key['idInscription'],3);
                    }
                }
            }
// Fonction modèle
            $mail = $_SESSION['mailDir'];
            /* Fonction envoi de mail d'accusé */
            /*if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail))
            {
                $passage_ligne = "\r\n";
            }
            else
            {
                $passage_ligne = "\n";
            }*/
            $passage_ligne = "\n";
            $boundary = "-----=".md5(rand());
// ==== Création header mail
            $header = "From: kiosque-noreply@kiosque-mayenne.org".$passage_ligne;
            $header.= "Reply-to: \"".$_SESSION['nomEcole']."\" ".$_SESSION['mailDir'].$passage_ligne;
            $header.= "MIME-Version: 1.0".$passage_ligne;
            $header.= 'Content-Type: text/html; charset=iso-8859-1'.$passage_ligne;
            $header.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
// ====
// ==== Création différents messages
            $classes = implode(", ", $_SESSION['classe']) ;

            $message_html = "<html><head><meta charset='UTF-8'></head><body>Bonjour,<br><br>
Nous avons bien reçu l'inscription de votre classe pour la
saison spectacles jeune public.<br>
Nous vous remercions pour votre contribution
et espérons vivement pouvoir vous donner entière satisfaction.<br>
Valérie Martin reste à votre disposition pour tout complément d'information.
N'hésitez pas à la contacter, par mail de préférence à v.martin@kiosque-mayenne.org
ou par téléphone au 02 43 30 10 16.<br>Voici le récapitulatif de votre demande : <br>

<br><strong>Ecole</strong> : <br>Type : ".$_SESSION['typeEcole']."<br>Nom : ".$_SESSION['nomEcole']."<br>Adresse 1 : ".$_SESSION['addr1']."<br>
Adresse 2 : ".$_SESSION['addr2']."<br>Code postal : ".$_SESSION['cp']."<br>Ville : ".$_SESSION['ville']."<br>Téléphone : ".$_SESSION['telDir']."<br>
Mail : ".$_SESSION['mailEns']."<br><br><strong>Responsable</strong> : <br>
Civilité : ".$_SESSION['civDir']."<br>Nom : ".$_SESSION['nomDir']."<br>Prénom : ".$_SESSION['prenomDir']."<br>Facture libellée à : ".$_SESSION['facture']."<br>
<br><strong>Divers</strong> : <br>".$_SESSION['divers1']."<br><br><strong>Enseignant</strong> : <br>
Civilité : ".$_SESSION['civEns']."<br>Nom : ".$_SESSION['nomEns']."<br>Prénom : ".$_SESSION['prenomEns']."<br>Téléphone : ".$_SESSION['telEns']."<br>
Mail : ".$_SESSION['mailEns']."<br>Classe : ".$classes."<br>Elèves : ".$_SESSION['nbrEleve']."<br>Accompagnateurs : ".$_SESSION['nbrAccom']."<br>

<br><strong>Choix : </strong><br>
Premier choix : ".$_SESSION['choix1']."<br>Deuxième choix : ".$_SESSION['choix2']."<br>Troisième choix : ".$_SESSION['choix3']."<br>
<br>À très bientôt.<br>

L'équipe du Kiosque.</body></html>";
// ====
// === Sujet mail
            $sujet = "Confirmation demande d'inscription - Le Kiosque";
// ===
// Création message HTML
            $message = $passage_ligne.$message_html.$passage_ligne;
// =======
//=====Envoi de l'e-mail.
            if($envoimail == true) {
                mail($mail,$sujet,$message,$header);
                mail('v.martin@kiosque-mayenne.org',$sujet,$message,$header);
            }
            $bla = $_SESSION['mailEns'];
// === Mail si diffférent du mail de établissement de celui du responsable
            if($envoimail == true) {
                if(isset($_SESSION['mailEns']) && $_SESSION['mailEns'] != $_SESSION['mailDir'] && $_SESSION['mailEns'] != "" && $_SESSION['mailEns'] != null){
// ==== Création header mail
                    $header = "From: kiosque-noreply@kiosque-mayenne.org".$passage_ligne;
                    $header.= "Reply-to: \"".$_SESSION['nomEcole']."\" ".$_SESSION['mailEns'].$passage_ligne;
                    $header.= "MIME-Version: 1.0".$passage_ligne;
                    $header.= 'Content-Type: text/html; charset=iso-8859-1'.$passage_ligne;
                    $header.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
// ====
                    utf8_encode($message);
                    mail($bla,$sujet,$message,$header);
// ===
                }
            }
//==========
            unset($_SESSION);
            session_destroy();
            require_once $this->Dir.'views/inscriptionEcole/v_Fin.php';
            require_once $this->Dir.'views/gabarit.php';
            unset($_SESSION);
        }
    }
    public function afficheAccueil(){
        $de = new DateTime("2015-09-01 00:00:00");
        $de = $de->getTimestamp();
        $daate = new DateTime();
        $daate = $daate->getTimestamp();
        $datenew = $daate-$de;
        if($datenew <= 0) {
            $titre = "Prochainement...";
            require_once $this->Dir.'views/inscriptionEcole/block/v_Block.php';
            require_once $this->Dir.'views/gabarit.php';
        }
        else
        {
            $titre = 'Le Kiosque';
            if(!(isset($_SESSION['login']))){
                unset($_COOKIE);
                unset($_SESSION);
                session_destroy();
            }
            if(isset($_GET['logout']) && $_GET['logout'] == true) {
                unset($_SESSION['login']);
                header("Location:/JP/");
            }
            require_once $this->Dir.'views/v_Accueil.php';
            require_once $this->Dir.'views/gabarit.php';
        }
    }
    public function afficheProteger() {
        $de = new DateTime("2015-09-01 00:00:00");
        $de = $de->getTimestamp();
        $daate = new DateTime();
        $daate = $daate->getTimestamp();
        $datenew = $daate-$de;
        if($datenew <= 0) {
            $titre = "Prochainement...";
            require_once $this->Dir.'views/inscriptionEcole/block/v_Block.php';
            require_once $this->Dir.'views/gabarit.php';
        }
        else
        {
            $titre = "Identification - Jeune Public";
            require_once $this->Dir.'views/inscriptionEcole/v_FormProteger.php';
            require_once $this->Dir.'views/gabarit.php';
        }
    }
    public function proteger($login,$mdp) {
        $mdp = sha1($mdp);
        $v = $this->admin->getUserByName($login);
        if(strtolower($v['login']) == strtolower($login)) {
            if($v['password'] == $mdp){
                setcookie('login', $login, time() + 365*24*3600, null, null, false, true);
                $_SESSION['access'] = true;
                header("Location:/JP/?choix_ecole=1");
            }
            else
            {
                $_SESSION['error'] = "Erreur lors de la saisie de l'identifiant ou du mot de passe";
                header("Location:/JP/?connexion=0");
            }
        }
        else {
            $_SESSION['error'] = "Erreur lors de la saisie de l'identifiant ou du mot de passe";
            header("Location:/JP/?connexion=0");
        }
    }
    public function afficheList() {
        $de = new DateTime("2015-09-01 00:00:00");
        $de = $de->getTimestamp();
        $daate = new DateTime();
        $daate = $daate->getTimestamp();
        $datenew = $daate-$de;
        if($datenew <= 0) {
            $titre = "Prochainement...";
            require_once $this->Dir.'views/inscriptionEcole/block/v_Block.php';
            require_once $this->Dir.'views/gabarit.php';
        }
        else
        {
            unset($_SESSION);
            $_SESSION['access'] = true;
            $titre = "Votre école - Jeune Public";
            $actuel = $this->saison->getSaisonCourante();
            $listEcole = $this->ecole->getEcoles();
            require_once $this->Dir.'views/inscriptionEcole/v_EcoleTypeChoix.php';
            require_once $this->Dir.'views/gabarit.php';
        }
    }
    public function afficheList2($type) {
        $de = new DateTime("2015-09-01 00:00:00");
        $de = $de->getTimestamp();
        $daate = new DateTime();
        $daate = $daate->getTimestamp();
        $datenew = $daate-$de;
        if($datenew <= 0) {
            $titre = "Prochainement...";
            require_once $this->Dir.'views/inscriptionEcole/block/v_Block.php';
            require_once $this->Dir.'views/gabarit.php';
        }
        else
        {
            if($type == '2') {
                $titre = "Ecoles privée - Jeune Public";
            }
            else
            {
                $titre = "Ecoles publique - Jeune Public";
            }
            $actuel = $this->saison->getSaisonCourante();
            $listEcole = $this->ecole->getEcoleByType($type);
            require_once $this->Dir.'views/inscriptionEcole/v_EcoleTypeChoix.php';
            require_once $this->Dir.'views/gabarit.php';
        }
    }
    public function changeMailEns($mail) {
        $this->ecole->editMailEns($mail,$_SESSION['idEns']);
        $_SESSION['mailDir'] = $mail;
    }
    public function changeNomEns($nom) {
        $this->ecole->editNomEns($nom,$_SESSION['idEns']);
        $_SESSION['nomDir'] = $nom;
    }
    public function changePrenomEns($prenom) {
        $this->ecole->editPrenomEns($prenom,$_SESSION['idEns']);
        $_SESSION['prenomDir'] = $prenom;
    }
    public function changeCivEns($civ) {
        $this->ecole->editCivEns($civ,$_SESSION['idEns']);
        $_SESSION['civDir'] = $civ;
    }
}
