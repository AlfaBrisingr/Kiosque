<div class="container">
	<div class="row">
		<div class="jumbotron">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<fieldset><legend>Changer la saison courante</legend></fieldset>
			</div>
			<form action="?uc=spectacle&action=ChangerSaison&old=<?= $actuel->getId() ?>" method="POST">
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<label>Saison actuelle</label>
						<h4><?= $actuel->getNom() ?></h4>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<label>Nouvelle saison courante</label>
						<select name="nouvelleSaison" class="form-control">
							<?php foreach ($listSaison->getCollection() as $key) { ?>
							<option value="<?= $key->getId() ?>"><?= $key->getNom() ?></option>
							<?php } ?>
						</select><br>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input type="submit" value="Envoyer" class="btn btn-primary">
						<input type="reset" value="Par défaut" class="btn btn-default">
					</div>
				</div>
			</form>
		</div>
		<a href="?uc=spectacle" class="btn btn-link">Retour</a>
	</div>
</div>

