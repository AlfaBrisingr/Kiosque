<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="jumbotron">
				<fieldset>
					<form action="?uc=admin&action=AjouterSeance" method="POST">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<legend>Ajouter une séance</legend>
						</div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="idSpectacle">Pour le spectacle</label>
								<select name="idSpectacle" class="form-control">
									<?php foreach ($listSpec->getCollection() as $spectacle) { ?>
									<option value="<?= $spectacle->getId() ?>"><?= $spectacle->getNom() ?></option>;
									<?php } ?>
								</select>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="dateHeure">Date et heure (JJ/MM/AAAA HH:MM:SS)</label>
								<input type="datetime" value="" name="dateHeure" class="form-control" placeholder="ex: 15/08/2000 14:34:22">
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label for="idLieu">A</label>
								<select name="idLieu" class="form-control">
									<?php foreach ($listLieu->getCollection() as $lieu) { ?>
									<option value="<?= $lieu->getId() ?>"><?= $lieu->getNom() ?></option>;
									<?php } ?>
								</select><br><br>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<input type="submit" class="btn btn-primary" value="Envoyer">
								<input type="reset" class="btn btn-default" value="Par défaut"><br><br>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<a href="?uc=admin&action=voirInscription" class="btn btn-link">Retour</a>
							</div>
						</div>
					</form>
				</fieldset>
			</div>
		</div>
	</div>
</div>
