<?php
/**
 * Created by PhpStorm.
 * User: Oc�ane
 * Date: 26/02/2016
 * Time: 15:46
 */?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <legend>Courrier à Envoyer</legend>
        <div class="overflow-scroll-table">
            <table class="table table-striped table-hover table-bordered table-condensed">
                <thead>
                <tr>
                    <th>Enseignant</th>
                    <th>Spectacle</th>
                    <th>Séance</th>
                    <th>Classe</th>
                    <th>Nombre Enfants</th>
                    <th>Nombre Adultes</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($_GET['ecole']) || isset($_SESSION['ecole'])){ ?>
                    <?php foreach ($listInsEcole->getCollection() as $planning) { ?>
                        <tr>
                            <td><?= $planning->getInscription()->getEnseignant()->getEcole()->getNom() ?> <?= '- '.$planning->getInscription()->getEnseignant()->getNom().' '.$planning->getInscription()->getEnseignant()->getPrenom() ?></td>
                            <td><?= $planning->getSeance()->getSpectacle()->getNom() ?></td>
                            <td><?= $planning->getSeance()->getDate()->format('d/m/Y - H:i')  ?></td>
                            <td><?= $planning->getInscription()->getClasse()  ?></td>
                            <td><?= $planning->getInscription()->getNbEnfants() ?></td>
                            <td><?= $planning->getInscription()->getNbAdultes() ?></td>
                        </tr>
                    <?php }
                }else{ ?>
                    <?php foreach ($listIns->getCollection() as $planning) { ?>
                        <tr>
                            <td><?= $planning->getInscription()->getEnseignant()->getEcole()->getNom() ?> <?= '- '.$planning->getInscription()->getEnseignant()->getNom().' '.$planning->getInscription()->getEnseignant()->getPrenom() ?></td>
                            <td><?= $planning->getSeance()->getSpectacle()->getNom() ?></td>
                            <td><?= $planning->getSeance()->getDate()->format('d/m/Y - H:i')  ?></td>
                            <td><?= $planning->getInscription()->getClasse()  ?></td>
                            <td><?= $planning->getInscription()->getNbEnfants() ?></td>
                            <td><?= $planning->getInscription()->getNbAdultes() ?></td>
                        </tr>
                    <?php } }?>
                </tbody>
            </table>
        </div>

        <form action="?uc=admin&action=CourrierPDF" method="POST">
            <div class="clear col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <label for="idEcole">Choisir Une Ecole :</label>
                <select name="ecole"  id="inputID" class="form-control" onchange="voirEcole(this.form)">
                    <option disabled selected>-- Sélectionner une école --</option>
                    <?php foreach ($listEcole->getCollection() as $ecole) { ?>
                        <option value="<?= $ecole->getId() ?>"><?php if($ecole->getType() == '1') { echo 'Ecole Publique'; } if($ecole->getType() == '2') { echo 'Ecole Privée'; }?> <?=  '- '.$ecole->getNom() ?></option>
                    <?php } ?>
                </select><br>
            </div><br>
        </form>
        <?php if(isset($_GET['ecole']) || isset($_SESSION['ecole'])){ ?>
            <form action="?uc=admin&action=CourrierPDF" method="POST">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="valider" type="submit" class="btn btn-primary" value="Accès au format PDF">
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
    <div class="form-group">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <a href="?uc=admin&action=voirInscription" class="btn btn-link">Retour</a>
        </div>
    </div>
</div>