<!-- Alerte valid -->
<?php if(isset($_SESSION['valid'])) { ?>
    <div class="alert alert-success" role="alert">
        <?= $_SESSION['valid'] ?>
    </div>
<?php } ?>
<!-- Alerte error -->
<?php if(isset($_SESSION['error'])) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $_SESSION['error'] ?>
    </div>
<?php } ?>
<?php if(!isset($_POST['prestart'])) { ?>
    <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
            5%
        </div>
    </div>
<?php } else { ?>
    <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:10%;">
            10%
        </div>
    </div>
<?php } ?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h1>Saison Spectacles Jeune Public <?= $saisonCourante->getNom() ?></h1><br><br>
        <p class="text-justify">
            <?php if(!isset($_POST['prestart'])) { ?>
                Merci de répondre avec précision à toutes les questions.
                Si vous souhaitez être accompagné(e) dans cette inscription en ligne, sachez que l'équipe du Kiosque reste à votre disposition.
                Le Kiosque traite les demandes par ordre d'arrivée.<br> <?php } ?>
            Vous pouvez télécharger le programme de la saison <?= $saisonCourante->getNom(); ?> ici -> <a href="http://kiosque-mayenne.com/documents/plaquette.pdf" target="_blank">Plaquette</a> et le dossier Jeune Public ici -> <a target="_blank" href="http://kiosque-mayenne.com/telechargements.html">Dossier</a><br>
            Vous pouvez joindre Valérie Martin de préférence par mail à v.martin@kiosque-mayenne.org ou par tél au 02 43 30 10 16.
        </p>
        <p class="text-justify">
            À bientôt.
        </p>
    </div>
</div>
<?php if(isset($listEcole)) { ?>
    <form action="?uc=jp&action=etape1" method="POST">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <table class="table table-hover table-stripped table-bordered table-condensed">
                    <legend>Ecoles <?php if(isset($_POST['typeEcole']) && $_POST['typeEcole'] == '1') { echo 'Publique'; } else { echo 'Privée'; } ?></legend>
                    <thead>
                    <tr>
                        <th width="3%"></th>
                        <th width="20%">Nom</th>
                        <th width="20%">Adresse</th>
                        <th width="10%">CP</th>
                        <th width="20%">Ville</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($listEcole->getCollection() as $ecole) { ?>
                        <tr>
                            <td><input onchange="this.form.submit()" type="radio" name="choix" required value="<?= $ecole->getId() ?>"></td>
                            <td><?= $ecole->getNom() ?></td>
                            <td><?= $ecole->getAdresse() ?></td>
                            <td><?= $ecole->getCp() ?></td>
                            <td><?= $ecole->getVille() ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Suivant">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <br><a href="?uc=jp&action=choisirTypeEcole">Retour</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>