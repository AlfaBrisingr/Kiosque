<div class="container">
	<div class="row">
		<div class="jumbotron">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<fieldset><legend>Modifier le lieu <?= $listLieu->getNom() ?></legend></fieldset>
			</div>
			<form action="?uc=lieu&action=ModifierLieu&locations=<?= $listLieu->getId() ?>" method="POST">
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Nom</label>
						<input type="text" name="nomLieu" value="<?= $listLieu->getNom() ?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Adresse</label>
						<input type="text" name="adrLieu" value="<?= $listLieu->getAdresse() ?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Code Postal</label>
						<input type="text" name="cpLieu" value="<?= $listLieu->getCp() ?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Ville</label>
						<input type="text" name="villeLieu" value="<?= $listLieu->getVille() ?>" class="form-control"><br>
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
			<a href="?uc=lieu" class="btn btn-link">Retour</a>
		</div>
	</div>
</div>