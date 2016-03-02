<?php
/**
 * Created by PhpStorm.
 * User: Oc�ane
 * Date: 26/02/2016
 * Time: 16:09
 */ ?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <legend>Séance</legend>
        <div class="overflow-scroll-table">
            <table class="table table-striped table-hover table-bordered table-condensed">
                <thead>
                <tr>
                    <th>N° Séance</th>
                    <th>Spectacle</th>
                    <th>Date/Heure</th>
                    <th>Lieu</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($_GET['spectacle'])){ ?>
                    <?php foreach ($listSeanceSpectacle->getCollection() as $seance) { ?>
                        <tr>
                            <td><?= $seance->getId() ?></td>
                            <td><?= $seance->getSpectacle()->getNom() ?></td>
                            <td><?= $seance->getDate()->format('d/m/Y - H:i')  ?></td>
                            <td><?= $seance->getLieu()->getNom() ?></td>
                        </tr>
                    <?php }
                }else{ ?>
                    <?php foreach ($listSeance->getCollection() as $seance) { ?>
                        <tr>
                            <td><?= $seance->getId() ?></td>
                            <td><?= $seance->getSpectacle()->getNom() ?></td>
                            <td><?= $seance->getDate()->format('d/m/Y - H:i') ?> </td>
                            <td><?= $seance->getLieu()->getNom() ?></td>
                        </tr>
                    <?php } }?>
                </tbody>
            </table>
        </div>

        <form action="?uc=admin&action=SeancePDFCL" method="POST">
            <div class="clear col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <label for="idSpectacle">Choisir Un Spectacle :</label>
                <select name="spectacle"  id="inputID" class="form-control" onchange="voirSeanceSpectacle(this.form)">
                    <option disabled selected>-- Sélectionner un spectacle --</option>
                    <?php foreach ($listSpectacle->getCollection() as $spectacle) { ?>
                        <option value="<?= $spectacle->getId() ?>"><?= $spectacle->getNom() ?></option>
                    <?php } ?>
                </select><br>
            </div><br>
        </form>
        <?php if(isset($_GET['spectacle']) || isset($_SESSION['spectacle'])){ ?>
            <form action="?uc=admin&action=SeancePDFCL" method="POST">
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
            <a href="?uc=admin&action=voirInscriptionCL" class="btn btn-link">Retour</a>
        </div>
    </div>
</div>