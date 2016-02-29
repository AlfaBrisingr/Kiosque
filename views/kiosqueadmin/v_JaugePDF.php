<?php
/**
 * Created by PhpStorm.
 * User: Oc�ane
 * Date: 26/02/2016
 * Time: 16:09
 */ ?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <legend>Jauges</legend>
        <div class="overflow-scroll-table">
            <table class="table table-striped table-hover table-bordered table-condensed">
                <thead>
                <tr>
                    <th>Séance</th>
                    <th>Spectacle</th>
                    <th>Date Séance</th>
                    <th>Nbr Enfants</th>
                    <th>Nbr Adultes</th>
                    <th>Jauge utilisée</th>
                    <th>Jauge restante</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($_GET['spectacle']) || isset($_SESSION['spectacle'])){ ?>
                    <?php foreach ($listJaugeSpectacle->getCollection() as $jauge) { ?>
                        <tr>
                            <td><?= $jauge->getSeance()->getId() ?></td>
                            <td><?= $jauge->getSeance()->getSpectacle()->getNom() ?></td>
                            <td><?= $jauge->getSeance()->getDate()->format('d/m/Y - H:i') ?></td>
                            <td><?= $jauge->getNbEnfants() ?></td>
                            <td><?= $jauge->getNbAdultes() ?></td>
                            <td><?= $jauge->getUtilise() ?></td>
                            <td><?= $jauge->getRestante() ?></td>
                        </tr>
                    <?php }
                }else{ ?>
                    <?php foreach ($listJauge->getCollection() as $jauge) { ?>
                        <tr>
                            <td><?= $jauge->getSeance()->getId() ?></td>
                            <td><?= $jauge->getSeance()->getSpectacle()->getNom() ?></td>
                            <td><?= $jauge->getSeance()->getDate()->format('d/m/Y - H:i') ?></td>
                            <td><?= $jauge->getNbEnfants() ?></td>
                            <td><?= $jauge->getNbAdultes() ?></td>
                            <td><?= $jauge->getUtilise() ?></td>
                            <td><?= $jauge->getRestante() ?></td>
                        </tr>
                    <?php } }?>
                </tbody>
            </table>
        </div>

        <form action="?uc=admin&action=JaugePDF" method="POST">
            <div class="clear col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <label for="idSpectacle">Choisir Un Spectacle :</label>
                <select name="spectacle"  id="inputID" class="form-control" onchange="voirJaugeSpectacle(this.form)">
                    <option disabled selected>-- Sélectionner un spectacle --</option>
                    <?php foreach ($listSpectacle->getCollection() as $spectacle) { ?>
                        <option value="<?= $spectacle->getId() ?>"><?= $spectacle->getNom() ?></option>
                    <?php } ?>
                </select><br>
            </div><br>
        </form>
        <?php if(isset($_GET['spectacle']) || isset($_SESSION['spectacle'])){ ?>
            <form action="?uc=admin&action=JaugePDF" method="POST">
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