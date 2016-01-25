<div class="container">
	<div class="row">
		<div class="jumbotron">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<fieldset><legend>Modifier le spectacle <?= $listSpec->getNom() ?></legend></fieldset>
			</div>
			<form action="?uc=spectacle&action=ModifierSpectacle&shows=<?= $listSpec->getId() ?>" method="POST">
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Nom</label>
						<input type="text" name="nomSpectacle" value="<?= $listSpec->getNom() ?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Nombre de places</label>
						<input type="text" name="nbPlaceSpectacle" value="<?= $listSpec->getNbPlace() ?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Classes</label>
						<input type="text" name="typeClasse" value="<?= $listSpec->getTypeClasse() ?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Pour la saison</label>
						<select class="form-control" name="idSaison">
							<?php foreach ($listSaison->getCollection() as $saison) { ?>
							<option value="<?= $saison->getId() ?>" <?php if($saison->getId() == $actuel->getId()) {?>selected="selected" <?php } ?>><?= $saison->getNom() ?></option>
							<?php } ?>
						</select><br>
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
			<a href="?uc=spectacle&action=voirSpectacle" class="btn btn-link">Retour</a>
		</div>
	</div>
</div>
