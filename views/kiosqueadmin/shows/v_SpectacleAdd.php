<div class="container">
	<div class="row">
		<div class="jumbotron">
			<fieldset><legend>Nouveau spectacle</legend></fieldset>
			<form action="?uc=spectacle&action=AjouterSpectacle" method="POST">
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Nom du spectacle</label>
						<input type="text" value="" name="nomSpectacle" id="nomSpectacle" class="form-control" placeholder="Nom du spectacle">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Nombre de places</label>
						<input type="text" name="nbPlaceSpectacle" class="form-control" placeholder="Nombre de place"><br>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Classe</label>
						<input type="text" name="typeClasse" class="form-control" placeholder="ex: PS/MS"><br>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<label>Saison</label>
						<select name="idSaison" class="form-control">
							<?php foreach ($listSaison->getCollection() as $saison) { ?>
							<option value="<?= $saison->getId() ?>" <?php if(($saison->getId()) == ($actuel->getId())) { ?> selected="selected" <?php } ?>><?= $saison->getNom() ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input type="submit" class="btn btn-primary" value="Envoyer">
						<input type="reset" class="btn btn-default" value="Par défaut">
					</div>
				</div>
			</form>
		</div>
		<a href="?uc=spectacle" charset="btn btn-link">Retour</a>
	</div>
</div>
