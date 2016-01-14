<?php ob_start(); ?>
<div class="container">
	<div class="row">
		<div class="jumbotron">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<fieldset><legend>Modifier le lieu <?= $listLieu['nomLieu'] ?></legend></fieldset>
			</div>
			<form action="/JP/kiosqueadmin/locations/?locationseditfinish=1&locations=<?= $idLieu ?>" method="POST">
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Nom</label>
						<input type="text" name="nomLieu" value="<?= $listLieu['nomLieu'] ?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Adresse</label>
						<input type="text" name="adrLieu" value="<?= $listLieu['adrLieu'] ?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Code Postal</label>
						<input type="text" name="cpLieu" value="<?= $listLieu['cpLieu'] ?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Ville</label>
						<input type="text" name="villeLieu" value="<?= $listLieu['villeLieu'] ?>" class="form-control"><br>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input type="submit" value="Envoyer" class="btn btn-primary">
						<input type="reset" value="Par défault" class="btn btn-default">
					</div>
				</div>
			</form>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<a href="/JP/kiosqueadmin/locations" class="btn btn-link">Retour</a>
		</div>
	</div>
</div>
<?php $contenu = ob_get_clean(); ?>
