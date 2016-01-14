<?php
require_once ('models/m_Admin.php');
require_once ('classes/Utilisateur.php');

if(isset($_GET['action']))
{
    $action = $_GET['action'];
}
else
{
    $action = "login";
}

switch ($action)
{
    case 'login' :
    header("Location:?uc=index&action=login"); break;
    case 'choisirTypeEcole' :
    try
    {
        $saisonCourante = MSaison::getSaisonCourante();
        include("views/inscriptionEcole/v_EcoleTypeChoix.php");
    }
    catch (Exception $e)
    {
        Main::setFlashMessage($e->getMessage(), "error");
    } break;
    case 'choisirEcole' :
    try
    {
        $saisonCourante = MSaison::getSaisonCourante();
        if(!isset($_POST['typeEcole']))
        {
            header("Location:?uc=jp&action=choisirTypeEcole");
        }
        if($_POST['typeEcole'] == '1')
        {
            $listEcole = MEcole::getEcolesPublique();
        }
        else
        {
            $listEcole = MEcole::getEcolesPrive();
        }
        include("views/inscriptionEcole/v_EcoleChoix.php");
    }
    catch (Exception $e)
    {
        Main::setFlashMessage($e->getMessage(), "error");
    } break;
    case 'etape1':
    try
    {
        if(isset($_POST['choix']))
        {
            $ecole = MEcole::getEcoleById($_POST['choix']);
            $_SESSION['ecole'] = $ecole;
        }
        else
        {
            header("Location:?uc=jp&action=choisirTypeEcole");
        }
        include("views/inscriptionEcole/v_Etape1.php");
    }
    catch (Exception $e)
    {
        Main::setFlashMessage($e->getMessage(), "error");
    } break;

    case 'etape2':
    try
    {
        if(isset($_SESSION['ecole']))
        {
            $enseignant = MEnseignant::getEnseignantById($_SESSION['ecole']->getDirecteur()->getId());
            $_SESSION['enseignant'] = $enseignant; 
            $_SESSION['facture'] = $_POST['facture'];
            $_SESSION['divers'] = $_POST['divers'];

        }
        else
        {
            header("Location:?uc=jp&action=choisirTypeEcole");
        }

        // NE PAS OUBLIER DE FAIRE LA MODIFICATION 

      /*  if(isset($_POST['civEns'])||isset($_POST['nomEns'])||isset($_POST['prenomEns'])||isset($_POST['telEns'])||isset($_POST['mailEns'])){
            $unEnseignant = array(
                'civEns' => $_POST['civEns'],
                'nomEns' => $_POST['nomEns'],
                'prenomEns' => $_POST['prenomEns'],
                'mailEns' => $_POST['mailEns'],
                'telEns' => $_POST['telEns'], 
                'idEcole' => $_SESSION['ecole']->getId(),
                'id' => $_SESSION['ecole']->getDirecteur()->getId());
            MEnseignant::editEnseignant($unEnseignant);
        } */
        include("views/inscriptionEcole/v_Etape2.php");
    }
    catch (Exception $e)
    {
        Main::setFlashMessage($e->getMessage(), "error");
    } break;

    case 'etape3' :
    try
    {
        $lesSpectacles = MSpectacle::getSpectaclesSaisonCourante();
        $nbrEleve = $_POST['nbrEleve'];
        $nbrAccom = $_POST['nbrAccom'];
        $classe = $_POST['classe'];
        $_SESSION['nbrEleve'] = $nbrEleve;
        $_SESSION['nbrAccom'] = $nbrAccom;
        $_SESSION['classe'] = $classe;
        
        include("views/inscriptionEcole/v_Etape3.php");

    }
    catch (Exception $e)
    {
        Main::setFlashMessage($e->getMessage(), "error");
    } break;

    case 'etape4':
    try{

        $lesSpectacles = MSpectacle::getSpectaclesSaisonCourante();

        $_SESSION['choix1'] = $_POST['choix1'];
        $_SESSION['impo1']= $_POST['impo1'];

        include("views/inscriptionEcole/v_Etape4.php");
    }
    catch (Exception $e)
    {
        Main::setFlashMessage($e->getMessage(), "error");
    } break;

    case 'etape5':
    try{
        $lesSpectacles = MSpectacle::getSpectaclesSaisonCourante();

        $_SESSION['choix2'] = $_POST['choix2'];
        $_SESSION['impo2']= $_POST['impo2'];

        if($_SESSION['choix1'] == $_SESSION['choix2']){
            $_SESSION['choix2'] == 'non';
        }

        if($_SESSION['choix2']== 'non'){
            $_SESSION['choix3'] = 'non';
            $_SESSION['impo3'] = null;
        }
        include("views/inscriptionEcole/v_Etape5.php");
        
    }
    catch (Exception $e)
    {
        Main::setFlashMessage($e->getMessage(), "error");
    } break;

    case 'etape6':
    try{
        $lesSpectacles = MSpectacle::getSpectaclesSaisonCourante();

        if(!isset($_POST['choix3'])){
            $_SESSION['choix3'] = 'non';
            $_SESSION['impo3']= null;
        }else{
            $_SESSION['choix3'] = $_POST['choix3'];
            $_SESSION['impo3']= $_POST['impo3'];
        }

        if($_SESSION['choix3'] == $_SESSION['choix1']){
            $_SESSION['choix3'] = 'non';
        }

        if($_SESSION['choix3'] == $_SESSION['choix2']){
            $_SESSION['choix3'] = 'non';
        }
        if($_SESSION['choix2'] == $_SESSION['choix1']){
            $_SESSION['choix2'] = 'non';
        }

        $Ent = array($_SESSION['ecole']->getType(),$_SESSION['ecole']->getNom(),'Adresse 1' => $_SESSION['ecole']->getAdresse(),$_SESSION['ecole']->getAdresse2(),
            $_SESSION['ecole']->getCp(),$_SESSION['ecole']->getVille(),$_SESSION['ecole']->getDirecteur()->getTel(),$_SESSION['ecole']->getDirecteur()->getMail()
            );
        $Resp = array (
            'Civilité' => $_SESSION['enseignant']->getCivilite(),
            'Nom' => $_SESSION['enseignant']->getNom(),
            'Prénom' => $_SESSION['enseignant']->getPrenom());
        $Divers1 = array (
            'Facture libellée à' => $_SESSION['facture'],
            'Infos diverses sur l\'Etablissement' => $_SESSION['divers']
            );
        $Ens1 = array ($_SESSION['enseignant']->getCivilite(),$_SESSION['enseignant']->getNom(), ucfirst(strtolower($_SESSION['enseignant']->getPrenom())));
        $Ens3 = array($_SESSION['enseignant']->getTel(),$_SESSION['enseignant']->getMail());
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

        include("views/inscriptionEcole/v_Recap.php");
    }
    catch (Exception $e)
    {
        Main::setFlashMessage($e->getMessage(), "error");
    } break;

    case 'valider' : 
    try
    {
        /*if(!(MEnseignant::getEnseignantByName($_SESSION['enseignant']->getNom(),$_SESSION['enseignant']->getPrenom()))){
            MEnseignant::addEnseignant($_SESSION['enseignant']->getCivilite(),$_SESSION['enseignant']->getNom(),$_SESSION['enseignant']->getPrenom(),$_SESSION['enseignant']->getMail(),$_SESSION['enseignant']->getTel(), $_SESSION['ecole']->getId());
        }*/
        $divers = addslashes($_SESSION['divers']);

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

        MInscription::addInscription($_SESSION['enseignant']->getId(), date('Y-m-d H:i:s'), $divers, $impo, $_SESSION['nbrEleve'],$_SESSION['nbrAccom']);

        $nomSpectacle = MSpectacle::getSpectacleByName($_SESSION['choix1']);
        $nomInscription = MInscription::getInscriptionByEnseignant($_SESSION['enseignant']->getId());
        $passe = false;
        $envoimail = false;
        foreach ($nomInscription->getCollection() as $key) {
            if(!(MChoix::addChoix($nomSpectacle['idSpectacle'], $key['idInscription'], 1 ))){
                $passe=false;
                $envoimail = false;
                $_SESSION['error'] = "<h1> La demande d'inscription a échoué, erreur inconnue.</h1>";
            }else{
                MChoix::addChoix($nomSpectacle['idSpectacle'], $key['idInscription'], 1 );
                $passe=true;
                $envoimail = true;
                unset($_SESSION['error']);
            }
            if($_SESSION['choix2'] != 'non') {
                $nomSpectacle = MSpectacle::getSpectacleByName($_SESSION['choix2']);
                MChoix::addChoix($nomSpectacle['idSpectacle'],$key['idInscription'],2);
                if($_SESSION['choix3'] != 'non') {
                    $nomSpectacle = MSpectacle::getSpectacleByName($_SESSION['choix3']);
                    MChoix::addChoix($nomSpectacle['idSpectacle'],$key['idInscription'],3);
                }
            }
        }

        $mail = $_SESSION['ecole']->getMailDirecteur();

        $passage_ligne = "\n";
        $boundary = "-----=".md5(rand());
        // ==== Création header mail
        $header = "From: kiosque-noreply@kiosque-mayenne.org".$passage_ligne;
        $header.= "Reply-to: \"".$_SESSION['nomEcole']."\" ".$_SESSION['ecole']->getMailDirecteur().$passage_ligne;
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

        <br><strong>Ecole</strong> : <br>Type : ".$_SESSION['ecole']->getType()."<br>Nom : ".$_SESSION['ecole']->getNom()."<br>Adresse 1 : ".$_SESSION['ecole']->getAdresse()."<br>
        Adresse 2 : ".$_SESSION['ecole']->getAdresse2()."<br>Code postal : ".$_SESSION['ecole']->getCp()."<br>Ville : ".$_SESSION['ecole']->getVille()."<br>Téléphone : ".$_SESSION['ecole']->getTel()."<br>
        Mail : ".$_SESSION['ecole']->getMail()."<br><br><strong>Responsable</strong> : <br>
        Civilité : ".$_SESSION['enseignant']->getCivilite()."<br>Nom : ".$_SESSION['enseignant']->getNom()."<br>Prénom : ".$_SESSION['enseignant']->getPrenom()."<br>Facture libellée à : ".$_SESSION['facture']."<br>
        <br><strong>Divers</strong> : <br>".$_SESSION['divers1']."<br><br><strong>Enseignant</strong> : <br>
        Civilité : ".$_SESSION['enseignant']->getCivilite()."<br>Nom : ".$_SESSION['enseignant']->getNom()."<br>Prénom : ".$_SESSION['enseignant']->getPrenom()."<br>Téléphone : ".$_SESSION['enseignant']->getTel()."<br>
        Mail : ".$_SESSION['enseignant']->getMail()."<br>Classe : ".$classes."<br>Elèves : ".$_SESSION['nbrEleve']."<br>Accompagnateurs : ".$_SESSION['nbrAccom']."<br>

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
            mail('oceane.martin53960@gmail.com',$sujet,$message,$header);//v.martin@kiosque-mayenne.org
        }
        $bla = $_SESSION['mailEns'];
        // === Mail si diffférent du mail de établissement de celui du responsable
        if($envoimail == true) {
            if($_SESSION['enseignant']->getMail() && $_SESSION['enseignant']->getMail() != $_SESSION['ecole']->getMailDirecteur() && $_SESSION['enseignant']->getMail() != "" && $_SESSION['enseignant']->getMail() != null){
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

        include("views/inscriptionEcole/v_Fin.php");

    }
    catch (Exception $e)
    {
        Main::setFlashMessage($e->getMessage(), "error");
    } break;

}