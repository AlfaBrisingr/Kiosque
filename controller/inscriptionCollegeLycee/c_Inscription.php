<?php
/**
 * Created by PhpStorm.
 * User: Océane
 * Date: 03/02/2016
 * Time: 14:00
 */

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
switch ($action) {
    case 'login' :
        header("Location:?uc=connexionCL&action=login");
        break;

    case 'choisirTypeEcole' :
        try {
            $saisonCourante = MSaison::getSaisonCourante();
            include("views/inscriptionCollegeLycee/v_EcoleTypeChoix.php");
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'choisirEcole' :
        try {
            $saisonCourante = MSaison::getSaisonCourante();
            if (!isset($_POST['typeEcole'])) {
                header("Location:?uc=cl&action=choisirTypeEcole");
            }
            if ($_POST['typeEcole'] == '3') {
                $listEcole = MEcole::getColleges();
            } else {
                $listEcole = MEcole::getLycees();
            }
            include("views/inscriptionCollegeLycee/v_EcoleChoix.php");
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'etape1':
        try {
            if (isset($_POST['choix'])) {
                $ecole = MEcole::getEcoleById($_POST['choix']);
                $_SESSION['ecole'] = $ecole;
            } else {
                header("Location:?uc=cl&action=choisirTypeEcole");
            }
            include("views/inscriptionCollegeLycee/v_Etape1.php");
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'etape2':
        try {
            if (isset($_SESSION['ecole']) && isset($_POST['facture'])) {
                $_SESSION['facture'] = $_POST['facture'];
                $_SESSION['divers'] = $_POST['divers'];
            }

            $_SESSION['directeur'] = MEnseignant::getEnseignantById($_SESSION['ecole']->getDirecteur()->getId());

            if(isset($_POST['nomEns']) && !empty($_POST['nomEns'])){
                if($_POST['nomEns'] != $_SESSION['directeur']->getNom()){
                    $_SESSION['directeur']->setNom($_POST['nomEns']);
                }
            }

            if(isset($_POST['prenomEns']) && !empty($_POST['prenomEns'])){
                if($_POST['prenomEns'] != $_SESSION['directeur']->getPrenom()){
                    $_SESSION['directeur']->setPrenom($_POST['prenomEns']);
                }
            }

            if(isset($_POST['mailEns']) && !empty($_POST['mailEns'])){
                if($_POST['mailEns'] != $_SESSION['directeur']->getMail()){
                    $_SESSION['directeur']->setMail($_POST['mailEns']);
                }
            }

            if(isset($_POST['civEns']) && !empty($_POST['civEns'])){
                if($_POST['civEns'] != $_SESSION['directeur']->getCivilite()){
                    $_SESSION['directeur']->setCivilite($_POST['civEns']);
                }
            }

            MEnseignant::editDirecteur($_SESSION['directeur']);

            include("views/inscriptionCollegeLycee/v_Etape2.php");

        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'etape3' :
        try {

            $enseignant = MEnseignant::getEnseignantById($_SESSION['ecole']->getDirecteur()->getId());
            $_SESSION['enseignant'] = $enseignant;
            if(isset($_POST['nomEns']) && !empty($_POST['nomEns'])){
                if($_POST['nomEns'] != $_SESSION['enseignant']->getNom()){
                    $_SESSION['enseignant']->setNom($_POST['nomEns']);
                }
            }

            if(isset($_POST['prenomEns']) && !empty($_POST['prenomEns'])){
                if($_POST['prenomEns'] != $_SESSION['enseignant']->getPrenom()){
                    $_SESSION['enseignant']->setPrenom($_POST['prenomEns']);
                }
            }

            if(isset($_POST['mailEns']) && !empty($_POST['mailEns'])){
                if($_POST['mailEns'] != $_SESSION['enseignant']->getMail()){
                    $_SESSION['enseignant']->setMail($_POST['mailEns']);
                }
            }

            if(isset($_POST['civEns']) && !empty($_POST['civEns'])){
                if($_POST['civEns'] != $_SESSION['enseignant']->getCivilite()){
                    $_SESSION['enseignant']->setCivilite($_POST['civEns']);
                }
            }

            if(isset($_POST['telEns']) && !empty($_POST['telEns'])){
                if($_POST['telEns'] != $_SESSION['enseignant']->getTel()){
                    $_SESSION['enseignant']->setTel($_POST['telEns']);
                }
            }

            if(isset($_POST['mailEns']) && !empty($_POST['mailEns'])){
                if($_POST['mailEns'] != $_SESSION['enseignant']->getMail()){
                    $_SESSION['enseignant']->setMail($_POST['mailEns']);
                }
            }

            $lesSpectacles = MSpectacle::getSpectaclesSaisonCourante();

            if(isset($_POST['nbrEnfants']) || isset($_POST['nbrAccom']) || isset($_POST['classe'])) {
                $nbrEleve = $_POST['nbrEleve'];
                $nbrAccom = $_POST['nbrAccom'];
                $classe = $_POST['classe'];
                $_SESSION['nbrEleve'] = $nbrEleve;
                $_SESSION['nbrAccom'] = $nbrAccom;
                $_SESSION['classe'] = $classe;
            }
            include("views/inscriptionCollegeLycee/v_Etape3.php");

        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'etape4':
        try {
            $lesSpectacles = MSpectacle::getSpectaclesSaisonCourante();

            if(isset($_POST['choix1'])) {
                $_SESSION['choix1'] = $_POST['choix1'];
                $_SESSION['impo1'] = $_POST['impo1'];
            }
            include("views/inscriptionCollegeLycee/v_Etape4.php");
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'etape5':
        try {
            $lesSpectacles = MSpectacle::getSpectaclesSaisonCourante();
            if(isset($_POST['choix2'])) {
                $_SESSION['choix2'] = $_POST['choix2'];
                $_SESSION['impo2'] = $_POST['impo2'];
            }
            if ($_SESSION['choix1'] == $_SESSION['choix2']) {
                $_SESSION['choix2'] = 'non';
            }
            if ($_SESSION['choix2'] == 'non') {
                $_SESSION['choix3'] = 'non';
                $_SESSION['impo3'] = null;
            }
            include("views/inscriptionCollegeLycee/v_Etape5.php");
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;

    case 'etape6':
        try {
            $lesSpectacles = MSpectacle::getSpectaclesSaisonCourante();
            if (!isset($_POST['choix3'])) {
                $_SESSION['choix3'] = 'non';
                $_SESSION['impo3'] = null;
            } else {
                $_SESSION['choix3'] = $_POST['choix3'];
                $_SESSION['impo3'] = $_POST['impo3'];
            }
            if ($_SESSION['choix3'] == $_SESSION['choix1']) {
                $_SESSION['choix3'] = 'non';
            }
            if ($_SESSION['choix3'] == $_SESSION['choix2']) {
                $_SESSION['choix3'] = 'non';
            }
            if ($_SESSION['choix2'] == $_SESSION['choix1']) {
                $_SESSION['choix2'] = 'non';
            }
            $Ent = array($_SESSION['ecole']->getType(), $_SESSION['ecole']->getNom(), 'Adresse 1' => $_SESSION['ecole']->getAdresse(), $_SESSION['ecole']->getAdresse2(),
                $_SESSION['ecole']->getCp(), $_SESSION['ecole']->getVille(), $_SESSION['ecole']->getDirecteur()->getTel(), $_SESSION['ecole']->getDirecteur()->getMail()
            );
            $Resp = array(
                'Civilité' => $_SESSION['directeur']->getCivilite(),
                'Nom' => $_SESSION['directeur']->getNom(),
                'Prénom' => $_SESSION['directeur']->getPrenom());
            $Divers1 = array(
                'Facture libellée à' => $_SESSION['facture'],
                'Infos diverses sur l\'Etablissement' => $_SESSION['divers']
            );
            $Ens1 = array($_SESSION['enseignant']->getCivilite(), $_SESSION['enseignant']->getNom(), ucfirst(strtolower($_SESSION['enseignant']->getPrenom())));
            $Ens3 = array($_SESSION['enseignant']->getTel(), $_SESSION['enseignant']->getMail());
            $Ens2 = array(
                'Classe' => $_SESSION['classe'],
                'Elèves' => $_SESSION['nbrEleve'],
                'Accompagnateurs' => $_SESSION['nbrAccom'],
            );
            $Choix1 = array(
                'Choisi' => $_SESSION['choix1'],
                'Impossibilités' => $_SESSION['impo1']
            );
            $Choix2 = array(
                'Choisi' => $_SESSION['choix2'],
                'Impossibilités' => $_SESSION['impo2']
            );
            $Choix3 = array(
                'Choisi' => $_SESSION['choix3'],
                'Impossibilités' => $_SESSION['impo3']
            );
            include("views/inscriptionCollegeLycee/v_Recap.php");
        } catch (Exception $e) {
            Main::setFlashMessage($e->getMessage(), "error");
        }
        break;
    case 'valider' :
        try {
            if (MEnseignant::isEnseignantExistant($_SESSION['enseignant']) == 0) {
                MEnseignant::addEnseignant($_SESSION['enseignant']);
                $unEnseignant = MEnseignant::getEnseignantByName($_SESSION['enseignant']->getNom(), $_SESSION['enseignant']->getPrenom());
                $_SESSION['enseignant']->setId($unEnseignant->getId());
            }
            $divers = $_SESSION['divers'];
            if (empty($_SESSION['impo1']) && empty($_SESSION['impo2']) && empty($_SESSION['impo3'])) {
                $impo = '<strong><em>Vide</em></strong>';
            } else {
                if (empty($_SESSION['impo1'])) {
                    $_SESSION['impo1'] = '<strong><em>Vide</em></strong>';
                }
                if (empty($_SESSION['impo2'])) {
                    $_SESSION['impo2'] = '<strong><em>Vide</em></strong>';
                }
                if (empty($_SESSION['impo3'])) {
                    $_SESSION['impo3'] = '<strong><em>Vide</em></strong>';
                }
                $impo = '1 : ' . $_SESSION['impo1'] . '<br> 2 : ' . $_SESSION['impo2'] . '<br> 3 : ' . $_SESSION['impo3'];
            }
            $date = new DateTime();
            $classe = implode(", ", $_SESSION['classe']);
            $UneInscription = new Inscription(1,$_SESSION['enseignant'], $date, $divers, $impo, $_SESSION['nbrEleve'], $_SESSION['nbrAccom'], $classe);
            $IdInscription = MInscription::addInscription($UneInscription);
            $_SESSION['Spectacle1'] = MSpectacle::getSpectacleByName($_SESSION['choix1']);
            $UneInscription->setId($IdInscription);

            $unChoix = new Choix($UneInscription, $_SESSION['Spectacle1'], 1);
            MChoix::addChoix($unChoix);

            if ($_SESSION['choix2'] != 'non') {
                $_SESSION['Spectacle2'] = MSpectacle::getSpectacleByName($_SESSION['choix2']);
                $unChoix2 = new Choix($UneInscription, $_SESSION['Spectacle2'], 2);
                MChoix::addChoix($unChoix2);

                if ($_SESSION['choix3'] != 'non') {
                    $_SESSION['Spectacle3'] = MSpectacle::getSpectacleByName($_SESSION['choix3']);
                    $unChoix3 = new Choix($UneInscription, $_SESSION['Spectacle3'], 3);
                    MChoix::addChoix($unChoix3);
                }
            }
            $mail = $_SESSION['ecole']->getMailDirecteur();
            $passage_ligne = "\n";
            $boundary = "-----=".md5(rand());
            // ==== Création header mail
            $header = "From: kiosque-noreply@kiosque-mayenne.org".$passage_ligne;
            $header.= "Reply-to: \"".$_SESSION['ecole']->getNom()."\" ".$_SESSION['ecole']->getMailDirecteur().$passage_ligne;
            $header.= "MIME-Version: 1.0".$passage_ligne;
            $header.= 'Content-Type: text/html; charset=UTF-8'.$passage_ligne;
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
        Adresse 2 : ".$_SESSION['ecole']->getAdresse2()."<br>Code postal : ".$_SESSION['ecole']->getCp()."<br>Ville : ".$_SESSION['ecole']->getVille()."<br>Téléphone : ".$_SESSION['ecole']->getDirecteur()->getTel()."<br>
        Mail : ".$_SESSION['ecole']->getMailDirecteur()."<br><br><strong>Responsable</strong> : <br>
        Civilité : ".$_SESSION['enseignant']->getCivilite()."<br>Nom : ".$_SESSION['enseignant']->getNom()."<br>Prénom : ".$_SESSION['enseignant']->getPrenom()."<br>Facture libellée à : ".$_SESSION['facture']."<br>
        <br><strong>Divers</strong> : <br>".$_SESSION['divers']."<br><br><strong>Enseignant</strong> : <br>
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
            mail($mail,$sujet,$message,$header);
            mail('v.martin@kiosque-mayenne.org',$sujet,$message,$header);
            $bla = $_SESSION['enseignant']->getMail();
            // === Mail si diffférent du mail de établissement de celui du responsable

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

            include("views/inscriptionEcole/v_Fin.php");
        }
        catch (Exception $e)
        {
            Main::setFlashMessage($e->getMessage(), "error");
        } break;

}