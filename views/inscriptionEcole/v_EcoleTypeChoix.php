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
<form action="?uc=jp&action=choisirEcole" method="POST">
    <div class="form-group">
        <label for="ecoles">Votre école est-elle publique ou privée ?</label>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <select onchange="this.form.submit()" name="typeEcole" class="form-control">
                    <option disabled selected> -- Sélectionner un type d'école -- </option>
                    <option value="2">Ecole Privée</option>
                    <option value="1">Ecole Publique</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Suivant">
    </div>
</form>

<?php
if(isset($_SESSION['error']))
    unset($_SESSION['error']);
if(isset($_SESSION['valid']))
    unset($_SESSION['valid']);
