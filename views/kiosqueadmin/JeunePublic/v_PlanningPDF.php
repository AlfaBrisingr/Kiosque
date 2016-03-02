<?php
/**
 * Created by PhpStorm.
 * User: Océane
 * Date: 29/01/2016
 * Time: 11:59
 */ ?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <legend>Planning</legend>
        <div class="overflow-scroll-table">
            <table class="table table-striped table-hover table-bordered table-condensed">
                <thead>
                <tr>
                    <th>Séance</th>
                    <th>Spectacle</th>
                    <th>Séance</th>
                    <th>Inscription</th>
                    <th>Classe</th>
                    <th>N° Téléphone</th>
                    <th>Nbr Enfants</th>
                    <th>Nbr Accompagnateurs</th>
                    <th>Présence</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($_GET['seance'])){ ?>
                    <?php foreach ($listPlanSeance->getCollection() as $planning) { ?>
                        <tr>
                            <td><?= $planning->getSeance()->getId() ?></td>
                            <td><?= $planning->getSeance()->getSpectacle()->getNom() ?></td>
                            <td><?= $planning->getSeance()->getDate()->format('d/m/Y - H:i'); ?></td>
                            <td><?= $planning->getInscription()->getEnseignant()->getEcole()->getNom() ?> <?= '- '.$planning->getInscription()->getEnseignant()->getNom().' '.$planning->getInscription()->getEnseignant()->getPrenom() ?></td>
                            <td><?= $planning->getInscription()->getClasse() ?></td>
                            <td><?= $planning->getInscription()->getEnseignant()->getEcole()->getDirecteur()->getTel() ?></td>
                            <td><?= $planning->getInscription()->getNbEnfants()?></td>
                            <td><?= $planning->getInscription()->getNbAdultes() ?></td>
                            <td>
                                <label>
                                    <input type="checkbox" >
                                </label>
                            </td>
                        </tr>
                    <?php }
                }else{ ?>
                    <?php foreach ($listPlan->getCollection() as $planning) { ?>
                        <tr>
                            <td><?= $planning->getSeance()->getId() ?></td>
                            <td><?= $planning->getSeance()->getSpectacle()->getNom() ?></td>
                            <td><?= $planning->getSeance()->getDate()->format('d/m/Y - H:i'); ?></td>
                            <td><?= $planning->getInscription()->getEnseignant()->getEcole()->getNom() ?> <?= '- '.$planning->getInscription()->getEnseignant()->getNom().' '.$planning->getInscription()->getEnseignant()->getPrenom() ?></td>
                            <td><?= $planning->getInscription()->getClasse() ?></td>
                            <td><?= $planning->getInscription()->getEnseignant()->getEcole()->getDirecteur()->getTel() ?></td>
                            <td><?= $planning->getInscription()->getNbEnfants()?></td>
                            <td><?= $planning->getInscription()->getNbAdultes() ?></td>
                            <td>
                                <label>
                                    <input type="checkbox" >
                                </label>
                            </td>
                        </tr>
                    <?php } }?>
                </tbody>
            </table>
        </div>

        <form action="?uc=admin&action=PlanningPDF" method="POST">
            <div class="clear col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <label for="idSeance">Choisir Une Séance :</label>
                <select name="seance"  id="inputID" class="form-control" onchange="voirPlanningSeance(this.form)">
                    <option disabled selected>-- Sélectionner une séance --</option>
                    <?php foreach ($listSeance->getCollection() as $seance) { ?>
                        <option value="<?= $seance->getId() ?>"><?= 'N°'.$seance->getId().' '.$seance->getDate()->format('d/m/Y - H:i').' '.$seance->getSpectacle()->getNom() ?></option>
                    <?php } ?>
                </select><br>
            </div><br>
        </form>
        <?php if(isset($_GET['seance']) || isset($_SESSION['seance'])){ ?>
            <form action="?uc=admin&action=PlanningPDF" method="POST">
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